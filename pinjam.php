<?php
include 'connection.php'; // Include connection after checking request method

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check if all required form fields are set
    if (isset($_POST['idbuku']) && isset($_POST['DateBorrow']) && isset($_POST['peminjam']) && isset($_POST['DateReturn'])) {

        // Retrieve form data
        $idbuku = $_POST['idbuku'];
        $dateBorrow = $_POST['DateBorrow'];
        $peminjam = $_POST['peminjam'];
        $dateReturn = $_POST['DateReturn'];

        // Check if idbuku exists in the Book table
        $checkQuery = "SELECT idBuku FROM Book WHERE idBuku = '$idbuku'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // If idbuku exists, insert data into BorrowBook table
            $sql = "INSERT INTO BorrowBook (bookId, userName, borrowDate, returnDate)
                    VALUES (
                        '$idbuku', 
                        '$peminjam', 
                        '$dateBorrow', 
                        '$dateReturn'
                    )";

            // Check if the query is executed successfully
            if ($conn->query($sql) === TRUE) {
                // Redirect to a success page or do something else
                header("Location: telahpinjam.php");
                exit(); // Terminate script execution after redirect
            } else {
                // If there's an error in the query execution
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // If idbuku does not exist in the Book table
            echo "Error: Book ID does not exist.";
        }
    } else {
        // If required form fields are not set
        echo "Required form fields are not set.";
    }

    $conn->close(); // Close connection after handling form submission
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
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
        <main>
            <hr>
            <div class="layer3" align="center">
                <h2><u>Pinjam Buku</u></h2>
                <form action="pinjam.php" method="post">
                    <center>
                        <table>
                            <tr>
                                <td>1. Id Buku<br>
                                    <input type="text" name="idbuku" required>
                                </td>
                                <td>2. Tarikh Pinjam<br>
                                    <input type="date" name="DateBorrow" required>
                                </td>
                            </tr>
                            <tr>
                                <td>3. Nama Peminjam<br>
                                    <input type="text" name="peminjam" required>
                                </td>
                                <td>4. Tarikh Pulang<br>
                                    <input type="date" name="DateReturn" required>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <br>
                    <input type="submit" value="Pinjam">
                </form>
            </div>
            </form>
</body>

</html>