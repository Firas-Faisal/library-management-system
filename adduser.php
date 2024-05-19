<?php
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['namenewuser']) && isset($_POST['password_newuser'])) {
        $namenewuser = $_POST['namenewuser'];
        $password_newuser = $_POST['password_newuser'];

        // SQL query to insert data into database
        $sql = "INSERT INTO users (Name, Password)
                VALUES ('$namenewuser', '$password_newuser')";

        if ($conn->query($sql) === TRUE) {
            header("Location: telahadduser.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Form fields are not set.";
    }
    $conn->close(); // Close connection after handling form submission
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #d6dfcc;
        }

        .layer2 {
            background-color: #fff5ed;
            margin-left: 2%;
            margin-right: 2%;
            margin-top: 90px;
            border-style: solid;
            min-width: 700px;
        }

        .layer3 {
            background-color: #b9bbdd;
            padding: 3%;
            margin: 2%;
            margin-bottom: 7%;
            border-radius: 30px;
        }

        .header-flexstart {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            /* Add padding to create space on both sides */
        }

        .logo-main-menu img,
        .header-flexend img {
            display: block;
        }

        .logo-main-menu {
            padding-right: 25%;
        }

        .header-flexend {
            padding-left: 25%;
        }

        .header-flexend img {
            padding-left: 25%;
        }

        table {
            margin-left: auto;
            margin-right: auto;
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
                    <a href="MainMenu.php">
                        <img src="Back button.png" alt="Back Button" width="60" height="60">
                    </a>
                </div>
            </div>
        </header>
        <main>
            <hr>
            <div class="layer3">
                <center>
                    <h2><u>TAMBAH USER</u></h2>
                </center>
                <form action="adduser.php" method="post">
                    <table>
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="namenewuser" required></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password_newuser" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="Submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </div>
</body>

</html>