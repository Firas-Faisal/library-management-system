<?php
include 'connection.php';


$message = "";


$sort = isset($_POST['sortby']) ? $_POST['sortby'] : 'title';
$sort_column = 'tajuk';

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
</head>

<body bgcolor="#D6DFCC">

	<fieldset style="background-color:#FFF5ED;">
		<table border="0" bgcolor="#FFF5ED" align="center">
			<tr align="center">
				<td width="100"><a href="MainMenu.php"><img width="30" height="30" src="Logo library.png" alt="Library logo"></a></td>
				<td width="1100">Display Buku</td>
				<td width="100"><a href="menubuku.php"><img width="30" height="30" src="Back button.png" alt="Back Button"></a></td>
			</tr>
		</table>
	</fieldset>

	<fieldset style="background-color:#FFF5ED;">
		<fieldset style="background-color:#B9BBDD;">
			<form action="" method="post">
				<label>Sort by:</label><br>
				<label for="title">Title</label>
				<input type="radio" id="title" name="sortby" value="title" <?php if ($sort == 'title') echo 'checked'; ?>><br>
				<label for="bookcode">Book code</label>
				<input type="radio" id="bookcode" name="sortby" value="bookcode" <?php if ($sort == 'bookcode') echo 'checked'; ?>><br>
				<label for="penerbit">Penerbit</label>
				<input type="radio" id="penerbit" name="sortby" value="penerbit" <?php if ($sort == 'penerbit') echo 'checked'; ?>><br>
				<input type="submit" value="Sort">
			</form>
			<table border="1" align="center" bgcolor="#FFF5ED">
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
				<?php
				if ($result->num_rows > 0) {
					// Output data of each row
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
					echo "<tr><td colspan='7'>No records found</td></tr>";
				}
				?>
				<br>
		</fieldset>
	</fieldset>


</body>

</html>