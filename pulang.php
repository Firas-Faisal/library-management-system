<?php
include 'connection.php';

$message = "";
$stmt = null; // Initialize $stmt variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	if (isset($_POST['IDBukuPulang']) && isset($_POST['ActualReturnDate'])) {

		$borrowId = $_POST['IDBukuPulang'];
		$actualReturnDate = $_POST['ActualReturnDate'];

		// Using prepared statement to prevent SQL injection
		$checkQuery = "SELECT * FROM BorrowBook WHERE borrowId = ?";
		$stmt = $conn->prepare($checkQuery);
		$stmt->bind_param("i", $borrowId);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			// Update the ReturnBook table with the actual return date
			$sql = "INSERT INTO ReturnBook (borrowId, actualReturnDate) VALUES (?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("is", $borrowId, $actualReturnDate);

			if ($stmt->execute()) {
				// Redirect to a success page
				header("Location: telahpulang.php");
				exit(); // Terminate script execution after redirect
			} else {
				$message = "Error executing query: " . $conn->error;
			}
		} else {
			$message = "The book with Borrow ID $borrowId is unavailable for return as it has not been borrowed.";
		}
	} else {
		$message = "Required form fields are not set.";
	}
	if ($stmt !== null) {
		$stmt->close(); // Close prepared statement
	}
	$conn->close(); // Close connection
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Return Book</title>
</head>

<body bgcolor="#D6DFCC">

	<fieldset style="background-color:#FFF5ED;">
		<table border="0" bgcolor="#FFF5ED" align="center">
			<tr align="center">
				<td width="100"><a href="MainMenu.php"><img width="30" height="30" src="Logo library.png" alt="Library logo"></a></td>
				<td width="1100">Return Book</td>
				<td width="100"><a href="menubuku.php"><img width="30" height="30" src="Back button.png" alt="Back Button"></a></td>
			</tr>
		</table>
	</fieldset>
	<form action="pulang.php" method="post">
		<fieldset style="background-color:#FFF5ED;">
			<fieldset style="background-color:#B9BBDD;">
				<table border="0" align="center">
					<tr>
						<td>Sila masukkan Borrow ID buku untuk dipulangkan:</td>
					</tr>
					<tr>
						<td><input type="text" name="IDBukuPulang" required></td>
					</tr>
					<tr>
						<td>Bilakah masa sebenar dipulangkan:</td>
					</tr>
					<tr>
						<td><input type="date" name="ActualReturnDate" required></td>
					</tr>
					<?php if (!empty($message)) { ?>
						<tr>
							<td><span style="color:red;"><?php echo $message; ?></span></td>
						</tr>
					<?php } ?>
				</table>
				<br>
				<center><input type="submit" value="Pulang"></center>
			</fieldset>
		</fieldset>
	</form>
</body>

</html>