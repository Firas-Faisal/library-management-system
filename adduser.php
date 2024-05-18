<?php
include 'connection.php'; // Include connection after checking request method
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    
    if(isset($_POST['namenewuser']) && isset($_POST['password_newuser'])) {
        // Rest of your code...
    
        $namenewuser=$_POST['namenewuser'];
        $password_newuser=$_POST['password_newuser'];

        // SQL query to insert data into database
        $sql= "INSERT INTO users (Name,Password)
        VALUES ('$namenewuser','$password_newuser')";
        // Check if the query is executed successfully
        if ($conn->query($sql) === TRUE) {
            header("Location: telahadduser.php");
        } 
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } 
    else 
    {
        echo "Form fields are not set.";
    }
    $conn->close(); // Close connection after handling form submission
}
?>

<html lang="en">
<head>
    <title>Add User</title>
</head>
<body bgcolor="#D6DFCC">
    <fieldset style="background-color:#FFF5ED;">
        <table border="0" bgcolor="#FFF5ED" align="center">
            <tr align="center">
                <td width="100"><a href="MainMenu.php"><img width="30" height="30" src="Logo library.png"
                            alt="Library logo"></a></td>
                <td width="1100">Tambah User</td>
                <td width="100"><a href="MainMenu.php"><img width="30" height="30" src="Back button.png"
                            alt="Back Button"></a></td>
            </tr>
        </table>
    </fieldset>
    <form action="" method="post"> <!-- Removed unnecessary redirect in form action -->
        <fieldset style="background-color:#FFF5ED;">
            <fieldset style="background-color:#B9BBDD;">
                <table border="0" align="center">
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="namenewuser" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password_newuser" required></td>
                    </tr>
                </table>
                <br>
                <center><input type="submit" name="Submit"></center>
            </fieldset>
        </fieldset>
    </form>
</body>
</html>