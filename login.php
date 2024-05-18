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
			header("Location: http://localhost/Librarymanagementsystem/MainMenu.php");
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

<body bgcolor="#D6DFCC">

	<fieldset style="background-color:#FFF5ED;">
		<table border="0" bgcolor="#FFF5ED" align="center">
			<tr align="center">
				<td width="100">
					<img width="30" height="30" src="Logo library.png" alt="Library logo"></a>
				</td>
				<td width="1100">Login</td>
			</tr>
		</table>
	</fieldset>

	<form action="login.php" method="post">
		<fieldset style="background-color:#B9BBDD" ;>

			<table border="0" cellspacing="10" align="center">
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
		</fieldset>
	</form>

</body>

</html>