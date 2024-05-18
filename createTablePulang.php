<?php
include 'connection.php';
// sql to create table
$sql = "CREATE TABLE ReturnBook (
    returnId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    borrowId INT(6) UNSIGNED NOT NULL,
    actualReturnDate DATE NOT NULL,
    FOREIGN KEY (borrowId) REFERENCES BorrowBook(borrowId)
)";


if ($conn->query($sql) === TRUE) {
    echo "New table created successfully";
} else {
    echo "Error creating table:" . $conn->error;
}
$conn->close();
