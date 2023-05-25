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
include('db-function.php'); ?>

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
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    th {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        color: #fff !important;
        background-color: #333 !important;
    }
</style>
<?php $fetch = query("SELECT * FROM `produk` ORDER BY `id` DESC"); ?>

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
    <p>Halo <?php echo $_SESSION['fullname'] ?>! <a href="logout.php"><button type="button"><i class="fa fa-sign-in"></i> Logout</button></a></p>
    <p style="color: gray;">Sesuai FR.IA.02. Bab C No. 10 (Hal. 2)<br> Maka aplikasi hanya dapat memasukan dan menampilkan data</p>
    <hr>
    <article>
        <h3>Memasukan dan menampilkan data melalui aplikasi</h3>
        <table align="center" style="text-align: center;">
            <tr>
                <th colspan="6">List Produk</th>
            </tr>
            <tr class="hidden">
                <th>Index</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th><button><a href="database-insert.php"><i class="fa fa-plus-square"> Tambah Data</i></a></button></th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($fetch as $row) : ?>
                <tr>
                    <td style="text-align: center"> <?php echo $row["id"]; //echo $i; ?></td>
                    <td style="text-align: left"><?php echo $row["kode_produk"]; ?></td>
                    <td style="text-align: left"><?php echo $row["nama_produk"]; ?></td>
                    <td style="text-align: right">Rp <?php echo number_format($row["harga"], 0, ',', '.'); ?></td>
                    <td style="text-align: center"><?php echo $row["stok"]; ?></td>
                    <td>
                        <button><a href="database-edit.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-pencil-square-o"> Ubah</i></a></button>
                        <button><a href="database-delete.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Konfirmasi untuk penghapusan data');"><i class="fa fa-trash"> Hapus</i></a></button>
                    </td>
                </tr>
                <?php $i++;
                ?>
            <?php endforeach;
            ?>
        </table>
    </article>
    <p>Data didalam tabel dapat ditambahkan dan dihapus. Silakan untuk mencoba!</p>
</body>

</html>