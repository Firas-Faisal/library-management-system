<?php
include 'connection.php'; // Include connection after checking request method
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    
    if(isset($_POST['tajuk']) && isset($_POST['penerbit']) && isset($_POST['tahunterbit']) && isset($_POST['genre']) && isset($_POST['kodbuku']) && isset($_POST['tingkat']) && isset($_POST['rak'])) {
        // Rest of your code...
    
        $tajuk=$_POST['tajuk'];
        $penerbit=$_POST['penerbit'];
        $tahunterbit=$_POST['tahunterbit'];
        $genre=$_POST['genre'];
        $kodbuku=$_POST['kodbuku'];
        $tingkat=$_POST['tingkat'];
        $rak=$_POST['rak'];

        // Convert the array to a string
        $genre_string = implode(",", $genre);

        $sql= "INSERT INTO Book (tajuk,penerbit,tahunterbit,genre,kodbuku,tingkat,rak)
        VALUES ('$tajuk','$penerbit','$tahunterbit','$genre_string','$kodbuku','$tingkat','$rak')";
        // Check if the query is executed successfully
        if ($conn->query($sql) === TRUE) {

            header("Location: telahditambah.php");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body bgcolor="#d6dfcc">

    <div class="layer2" align="center">
        <header>
            <div class="header">
                <a href="MainMenu.php"><img src="Logo library.png" alt="library Logo" width="60" height="60"> </a>
                <h1>Tambah Buku</h1>
                <a href="menubuku.php"><img src="Back button.png" alt="back button" width="50" height="50"></a>
            </div>
        </header>
        <main>
            <hr>
            <div class="layer3" align="center">
                <form action="tambahbuku.php" method="post" >
                    <center>
                        <table >
                            <tr>
                                <td>
                                    1.
                                </td>
                                <td>
                                <label for="tajuk">Tajuk </label>
                                </td>
                                <td rowspan="8" style="min-width: 100px;">
                                </td>
                                <td>
                                    <strong>Lokasi:</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                <input type="text" name="tajuk" id="tajuk" required>
                                </td>
                                <td>
                                    <label for="tingkat">tingkat:</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2.
                                </td>
                                <td>
                                <label for="penerbit">Penerbit </label>
                                </td>
                                <td>
                                    <select name="tingkat" id="tingkat">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                <input type="text" name="penerbit" id="penerbit" required>
                                </td>
                                <td>
                                    <label for="rak">rak:</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3.
                                </td>
                                <td>
                                <label for="tahunterbit">Tahun Terbitan: </label>
                                </td>
                                <td>
                                    <select name="rak" id="rak">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                <input type="Date" name="tahunterbit" id="tahunterbit">
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    4.
                                </td>
                                <td>
                                <label >Genre:</label>
                                </td>
                                <td>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td colspan="3">
                                    <label for="fiction">Fiction</label>
                                    <input type="checkbox" name="genre[]" value="fiction">
                                    <label for="mystery">Mystery</label>
                                    <input type="checkbox" name="genre[]" value="mystery">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                </td>
                                <td>
                                <label for="sciencefiction">Science fiction</label>
                                    <input type="checkbox" name="genre[]" value="sciencefiction">
                                    <label for="thriller">Thriller</label>
                                    <input type="checkbox" name="genre[]" value="thriller">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    6.
                                </td>
                                <td>
                                    <label for="kodbuku">Kod buku:</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="text" name="kodbuku" id="kodbuku">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center>
                                        <input type="submit" value="tambah" name="tambah">
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div>

        </main>
    </div>


    <footer>

    </footer>
</body>

</html>


