<?php
include 'connection.php';

// SQL to create DisplayFaultyReport table
$sql = "CREATE TABLE DisplayFaultyReport (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    borrowId INT(11) NOT NULL,
    Title VARCHAR(100) NOT NULL,
    DateBorrowed DATE NOT NULL,
    ReturnDate DATE NOT NULL,
    Overdue VARCHAR(3) NOT NULL,
    UNIQUE KEY unique_report (borrowId, ReturnDate)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table DisplayFaultyReport created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
