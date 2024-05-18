<?php
include 'connection.php'; // Include the database connection file

// Initialize a variable to store the search results message
$search_result = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST['cari_id'])) {
		$cari_id = $_POST['cari_id'];

		// SQL query to search for the book by titlems
		$sql = "SELECT * FROM Book WHERE tajuk LIKE '%$cari_id%'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Fetch the results and store them in the search_result variable
			$search_result .= "<table border='1' cellpadding='10'><tr><th>ID Buku</th><th>Tajuk</th><th>Penerbit</th><th>Tahun Terbit</th><th>Genre</th><th>Kod Buku</th><th>Tingkat</th><th>Rak</th></tr>";
			while ($row = $result->fetch_assoc()) {
				$search_result .= "<tr><td>" . $row["idBuku"] . "</td><td>" . $row["tajuk"] . "</td><td>" . $row["penerbit"] . "</td><td>" . $row["tahunterbit"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["kodbuku"] . "</td><td>" . $row["tingkat"] . "</td><td>" . $row["rak"] . "</td></tr>";
			}
			$search_result .= "</table>";
		} else {
			$search_result = "No books found with the title '$cari_id'.";
		}
	} else {
		$search_result = "Please enter a book title to search.";
	}
	$conn->close(); // Close connection after handling form submission
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cari Buku</title>
	<link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#D6DFCC">
	<div class="layer2">
		<header>
			<div class="header">
				<img src="Logo library.png" alt="library Logo" width="60" height="60">
				<h1>Menu Carian Buku</h1>
				<a href="MainMenu.php"><img src="Back button.png" alt="back button" width="50" height="50"></a>
			</div>
		</header>
		<main>
			<hr>
			<div class="layer3-carian">
				<div class="layer4">
					<p>Sila masukkan tajuk buku untuk di cari: </p>
					<form action="carian.php" method="post">
						<input type="text" name="cari_id" id="cari_id" placeholder="Search.." required>
						<input type="submit" value="Cari">
					</form>
				</div>
				<div class="layer5">
					<p>Lokasi</p>
					<?php
					// Display search results
					if ($search_result) {
						echo $search_result;
					}
					?>
				</div>
			</div>

		</main>
	</div>
</body>

</html>