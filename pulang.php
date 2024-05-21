<?php
include 'connection.php'; // Include connection after checking request method

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Check if all required form fields are set
	if (isset($_POST['IDBukuPulang']) && isset($_POST['ActualReturnDate'])) {

		// Retrieve form data
		$borrowId = $_POST['IDBukuPulang'];
		$actualReturnDate = $_POST['ActualReturnDate'];

		// Check if the book with Borrow ID exists in the BorrowBook table
		$checkQuery = "SELECT * FROM BorrowBook WHERE borrowId = ?";
		$stmt = $conn->prepare($checkQuery);
		$stmt->bind_param("i", $borrowId);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			// Book is currently borrowed, proceed to update ReturnBook table
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
			// Book has not been borrowed or does not exist
			$message = "You cannot return this book because it has not been borrowed or does not exist.";
		}
	} else {
		// Required form fields are not set
		$message = "Required form fields are not set.";
	}

	$stmt->close(); // Close prepared statement
	$conn->close(); // Close connection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Return Book</title>
	<link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#D6DFCC">

	<div class="layer2" align="center">
		<header>
			<div class="header">
				<a href="MainMenu.php"><img src="Logo library.png" alt="Library Logo" width="60" height="60"></a>
				<a href="MainMenu.php"><img src="Back button.png" alt="Back Button" width="50" height="50"></a>
			</div>
		</header>
		<main>
			<hr>
			<div class="layer3" align="center">
				<h2><u>Return Book</u></h2>
				<form action="pulang.php" method="post">
					<center>
						<table>
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
					</center>
				</form>
			</div>
		</main>
	</div>
</body>

</html>