<?php
include 'connection.php'; // Include connection

// Initialize a variable to store the message
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['delete_idbuku'])) {
        $delete_idbuku = $_POST['delete_idbuku'];

        // SQL query to check if the book exists
        $check_sql = "SELECT * FROM Book WHERE idbuku='$delete_idbuku'";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            // Book exists, proceed to delete
            $sql = "DELETE FROM Book WHERE idbuku='$delete_idbuku'";
            if ($conn->query($sql) === TRUE) {
                header("Location: telahdidelete.php");
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $message = "The book not found, please try again.";
        }
    } else {
        $message = "Form fields are not set.";
    }
    $conn->close(); // Close connection after handling form submission
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#D6DFCC">
    <div class="layer2">
        <header>
            <div class="header">
                <a href="MainMenu.php"><img src="Logo library.png" alt="Library Logo" width="60" height="60"></a>

                <a href="menubuku.php"><img src="Back button.png" alt="Back Button" width="50" height="50"></a>
            </div>
        </header>
        <main>
            <hr>
            <div class="layer3" align="center">
                <h2><u>Delete Buku</u></h2>
                <form action="deletebuku.php" method="post">

                    <label for="delete">No. ID Buku untuk dipadam:</label><br><br>
                    <input type="text" name="delete_idbuku" id="delete_idbuku" required><br><br>
                    <input type="submit" value="Delete">
                </form>
                <?php
                if ($message) {
                    echo "<p style='color: red;'>$message</p>";
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>