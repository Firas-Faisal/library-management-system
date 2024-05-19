<?php
include("connection.php");

//sql create table
$sql = "CREATE TABLE Users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(30) NOT NULL,
	Password VARCHAR(30) NOT NULL
	)";

if ($conn->query($sql) === TRUE) {
	echo "Table Users created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}
$conn->close();
