<?php
// Include connection file
include 'connection.php';

// SQL query to insert data into DisplayFaultyReport table
$query = "INSERT INTO DisplayFaultyReport (borrowId, Title, DateBorrowed, ReturnDate, Overdue)
          SELECT bb.borrowId, b.tajuk, bb.borrowDate, COALESCE(rb.actualReturnDate, '0000-00-00') AS actualReturnDate,
                 CASE
                     WHEN rb.actualReturnDate IS NOT NULL AND rb.actualReturnDate != '0000-00-00' AND rb.actualReturnDate > bb.returnDate THEN 'Yes'
                     ELSE 'No'
                 END AS Overdue
          FROM BorrowBook bb
          JOIN Book b ON bb.bookId = b.idBuku
          LEFT JOIN ReturnBook rb ON bb.borrowId = rb.borrowId
          WHERE NOT EXISTS (
              SELECT 1 FROM DisplayFaultyReport df
              WHERE df.borrowId = bb.borrowId
                AND df.ReturnDate = COALESCE(rb.actualReturnDate, '0000-00-00')
          )";

// Execute query
if ($conn->query($query) === TRUE) {
	echo "";
} else {
	echo "Error generating faulty report: " . $conn->error;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Display Laporan Faulty</title>
	<link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#D6DFCC">

	<div class="layer2" align="center">
		<header>
			<div class="header">
				<a href="MainMenu.php"><img src="Logo library.png" alt="library Logo" width="60" height="60"> </a>
				<a href="MainMenu.php"><img src="Back button.png" alt="back button" width="50" height="50"></a>
			</div>
		</header>
		</table>
		<main>
			<hr>
			<div class="layer3" align="center">
				<h2><u>Display Faulty Report</u></h2>
				<table border="1">
					<tr>
						<th>Title</th>
						<th>Date Borrowed</th>
						<th>Return Date</th>
						<th>Overdue</th>
					</tr>
					<?php
					// Include connection file
					include 'connection.php';

					// SQL query to fetch data from DisplayFaultyReport table
					$sql = "SELECT Title, DateBorrowed, ReturnDate, Overdue FROM DisplayFaultyReport";

					// Execute query
					$result = $conn->query($sql);

					// Check if there are rows returned
					if ($result->num_rows > 0) {
						// Output data of each row
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row['Title'] . "</td>";
							echo "<td>" . $row['DateBorrowed'] . "</td>";
							echo "<td>" . $row['ReturnDate'] . "</td>";
							echo "<td>" . $row['Overdue'] . "</td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='4'>No faulty books found.</td></tr>";
					}

					// Close connection
					$conn->close();
					?>
				</table>
				<br>

</body>

</html>