<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION["auth_check"])) {
    header("location: login.php");
    exit;
}
?>

<?php include_once('db-connection.php');
include('db-query.php');
include('db-function.php'); 

if (isset($_POST["input"])) {
    if (databaseInsert($_POST)>0) {
        echo "
        <script>
            alert('Data berhasil dimasukan kedalam database!');
            document.location.href='database.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data gagal untuk dimasukan kedalam database!');
            document.location.href='database.php';
        </script>
        ";
       }	
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/bnsp-icon.png">
    <title>TUK-003.001100 - FR.IA.02.</title>
</head>
<style>
    body {
        max-width: max-content;
        margin: auto;
        text-align: center;
    }

    table {
        width: 100%;
        border: hidden;
    }
</style>

<body>
    <header>
        <h3>
            SKM/0317/00010/2/2019/15 <br />
            TUK-003.001100 <br />
            FR.IA.02.
        </h3>
        <hr>
        <h3>Pero Roberto Kristovic <br>
            <a href="https://github.com/perrorovic/bnsp-db-certification" target="_blank" style="text-decoration: none; color:blue;">github.com/perrorovic/bnsp-db-certification</a>
        </h3>
    </header>
    <hr>
    <h3>Tambah data Produk</h3>
    <form action="" method="post" style="text-align: left;">
        <table>
            <tr>
                <td><label for="kode_produk">Kode Produk: </label></td>
                <td><input type="text" name="kode_produk" size="8" required></td>
            </tr>
            <tr>
                <td><label for="nama_produk">Nama Produk: </label></td>
                <td><input type="text" name="nama_produk" required></td>
            </tr>
            <tr>
                <td><label for="harga">Harga: </label></td>
                <td>Rp. <input type="number" name="harga" style="width: 100px;" required></td>
            </tr>
            <tr>
                <td><label for="stok">Stok: </label></td>
                <td><input type="text" name="stok" style="width: 40px;" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><br><a href="database.php"><button type="button">Kembali</button></a> <input type="submit" name="input" value="Tambahkan Produk"></td>
            </tr>
        </table>
        <br>
    </form>
</body>

</html>