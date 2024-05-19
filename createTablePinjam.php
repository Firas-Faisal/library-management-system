<?php
include 'connection.php';
// sql to create table
$sql = "CREATE TABLE BorrowBook (
    borrowId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bookId INT(6) UNSIGNED NOT NULL,
    userName VARCHAR(100) NOT NULL,
    borrowDate DATE NOT NULL,
    returnDate DATE NOT NULL,
    FOREIGN KEY (bookId) REFERENCES Book(idBuku)
)";


if ($conn->query($sql) === TRUE) {
    echo "New table created successfully";
} else {
    echo "Error creating table:" . $conn->error;
}
$conn->close();
