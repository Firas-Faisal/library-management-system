<?php
include 'connection.php';
// sql to create table
$sql="CREATE TABLE Book(
idBuku INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tajuk VARCHAR(100) NOT NULL,
penerbit VARCHAR(100),
tahunterbit DATE NOT NULL,
genre VARCHAR(255),
kodbuku VARCHAR(255),
tingkat INT(255) NOT NULL,
rak INT(255) NOT NULL
)";
if ($conn -> query($sql) === TRUE){
    echo "New Book created successfully";
}else{
    echo "Error creating table:" . $conn->error;
}
$conn->close();
?>