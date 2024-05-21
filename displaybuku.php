<?php
include 'connection.php';

$message = "";

$sort = isset($_POST['sortby']) ? $_POST['sortby'] : 'title';
$sort_column = '';

switch ($sort) {
	case 'bookcode':
		$sort_column = 'kodbuku';
		break;
	case 'penerbit':
		$sort_column = 'penerbit';
		break;
	default:
		$sort_column = 'tajuk';
		break;
}

$sql = "SELECT * FROM Book ORDER BY $sort_column";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Display Buku</title>
	<link rel="stylesheet" href="style.css">
	<style>
		body {
			background-color: #d6dfcc;
		}

		.layer2 {
			padding: 20px;
		}

		.header-flexstart {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 0 20px;
		}

		.header-flexend {
			margin-left: auto;
			padding-right: 20px;
		}

		.logo-main-menu img,
		.header-flexend img {
			display: block;
		}

		.layer3 {
			padding: 20px;
			background-color: #FFF5ED;
			border-radius: 10px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #B9BBDD;
		}

		h2 {
			text-align: center;
			color: #333;
		}

		.form-section {
			background-color: #B9BBDD;
			padding: 20px;
			border-radius: 10px;
			margin-bottom: 20px;
		}

		.form-section label {
			display: block;
			margin-bottom: 5px;
		}

		.form-section input[type="radio"] {
			margin-right: 10px;
		}

		.form-section input[type="submit"] {
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="layer2">
		<header>
			<div class="header-flexstart">
				<div class="logo-main-menu">
					<a href="MainMenu.php">
						<img src="Logo library.png" alt="Library Logo" width="60" height="60">
					</a>
				</div>
				<div>
					<!-- Empty div for spacing -->
				</div>
				<div class="header-flexend">
					<a href="menubuku.php">
						<img src="Back button.png" alt="Back Button" width="60" height="60">
					</a>
				</div>
			</div>
		</header>
		<main>
			<hr>
			<div class="layer3">
				<h2><u>DISPLAY BUKU</u></h2>
				<div class="form-section">
					<form action="" method="post">
						<label>Sort by:</label>
						<label for="title">Title</label>
						<input type="radio" id="title" name="sortby" value="title" <?php if ($sort == 'title') echo 'checked'; ?>>
						<label for="bookcode">Book code</label>
						<input type="radio" id="bookcode" name="sortby" value="bookcode" <?php if ($sort == 'bookcode') echo 'checked'; ?>>
						<label for="penerbit">Penerbit</label>
						<input type="radio" id="penerbit" name="sortby" value="penerbit" <?php if ($sort == 'penerbit') echo 'checked'; ?>>
						<input type="submit" value="Sort">
					</form>
				</div>
				<table>
					<thead>
						<tr>
							<th>ID Buku</th>
							<th>Tajuk</th>
							<th>Book Code</th>
							<th>Penerbit</th>
							<th>Tahun Terbit</th>
							<th>Genre</th>
							<th>Tingkat</th>
							<th>Rak</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row["idBuku"] . "</td>";
								echo "<td>" . $row["tajuk"] . "</td>";
								echo "<td>" . $row["kodbuku"] . "</td>";
								echo "<td>" . $row["penerbit"] . "</td>";
								echo "<td>" . $row["tahunterbit"] . "</td>";
								echo "<td>" . $row["genre"] . "</td>";
								echo "<td>" . $row["tingkat"] . "</td>";
								echo "<td>" . $row["rak"] . "</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='8'>No records found</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</main>
	</div>
</body>

</html>