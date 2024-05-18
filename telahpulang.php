<?php
include 'connection.php'; // Include connection after checking request method

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check if all required form fields are set
    if (isset($_POST['IDBukuPulang']) && isset($_POST['DateReturn'])) {

        // Retrieve form data
        $idBukuPulang = $_POST['IDBukuPulang'];
        $dateReturn = $_POST['DateReturn'];

        // Check if the book has an active borrowing entry
        $checkQuery = "SELECT * FROM BorrowBook WHERE bookId = '$idBukuPulang' AND returnDate IS NULL";
        $result = $conn->query($checkQuery);

        if ($result->num_rows == 0) {
            // Book has not been borrowed yet, inform the user
            echo "The book has not been borrowed yet.";
        } else {
            // Update the ReturnBook table with the return date
            $sql = "INSERT INTO ReturnBook (borrowId, returnDate)
                    SELECT borrowId, '$dateReturn' FROM BorrowBook WHERE bookId = '$idBukuPulang' AND returnDate IS NULL";

            // Check if the query is executed successfully
            if ($conn->query($sql) === TRUE) {
                // Redirect to a success page or do something else
                header("Location: telahpulang.php");
            } else {
                // If there's an error in the query execution
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
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
    <title>Berjaya Pulang</title>
    <link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#d6dfcc">
    <div class="layer2">
        <header>
            <div class="header-flexstart">
                <div class="logo">
                    <a href="MainMenu.php"> <img src="Logo library.png" alt="library Logo" width="60" height="60"></a>
                </div>
                <h1>Pulang Buku</h1>
            </div>
        </header>
        <main>
            <hr>
            <div class="layer3" align="center">
                <h2>BUKU TELAH DIPULANG</h2>
                <h2>BALIK KE MENU: </h2>
                <a href="menubuku.php"><img src="Back button.png" alt="" width="50"></a>
            </div>
        </main>
    </div>
</body>

</html>