<?php
include("connection.php");

$message = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get the values from the form
	$nameUser = $_POST["nameuser"];
	$passUser = $_POST["passuser"];

	// SQL query to fetch user data from database
	$sql = "SELECT id, Name, Password FROM Users WHERE Name = '$nameUser'";
	$result = $conn->query($sql);

	// Check if there's a matching record
	if ($result->num_rows > 0) {
		// Fetch the result as an associative array
		$row = $result->fetch_assoc();

		// Verify password
		if ($passUser == $row["Password"]) {
			header("Location: MainMenu.php");
		} else {
			$message = "Incorrect password, Please try again";
		}
	} else {
		$message = "User not found, Please try again";
	}
}
$conn->close();
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log in</title>
	<link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#D6DFCC">

	<div class="layer2" align="center">
		<header>
			<div class="header">
				<a href="login.php"><img src="Logo library.png" alt="library Logo" width="60" height="60"> </a>

			</div>
		</header>
		</table>
		<main>
			<hr>
			<div class="layer3">
				<center>
					<h2><u>Login</u></h2>
				</center>
				<form action="login.php" method="post">
					<center>
						<table>
							<tr>
								<td colspan="2">
									<h3> Sila Masukkan Maklumat :
							</tr>

							<tr>
								<td><b>Name:</td>
								<td><input type="text" name="nameuser" required> </td>
							<tr>

							<tr>
								<td><b>password:</td>
								<td><input type="password" name="passuser" required> </td>
							</tr>
							<?php if (!empty($message)) : ?>
								<tr>
									<td colspan="2" align="center" style="color:red;"><?php echo $message; ?></td>
								</tr>
							<?php endif; ?>
							<tr>
								<td colspan="2" align="center"> <input type="submit" name="submitTextBox"></td>
							</tr>

						</table>
					</center>
				</form>
			</div>
		</main>
	</div>

</body>

</html>