<!DOCTYPE html>
<html lang="en">
<?php include_once('db-connection.php');
include('db-query.php');
include('db-function.php'); ?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/x-icon" href="bnsp-icon.png">
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
<?php $fetch = query("SELECT * FROM `produk` ORDER BY `nama_produk` ASC"); ?>
<?php
//search function
if (isset($_POST["search"])) {
  $fetch = produkSearch($_POST["keyword"]);
}
if (isset($_POST["sortPrice_ASC"])) {
  $fetch = sortPrice_ASC();
}
if (isset($_POST["sortPrice_DESC"])) {
  $fetch = sortPrice_DESC();
}
if (isset($_POST["sortStock_ASC"])) {
  $fetch = sortStock_ASC();
}
if (isset($_POST["sortStock_DESC"])) {
  $fetch = sortStock_DESC();
}
if (isset($_POST["sortName_ASC"])) {
  $fetch = sortName_ASC();
}
if (isset($_POST["sortName_DESC"])) {
  $fetch = sortName_DESC();
}
?>

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
  <form action="" method="post">
    <p>
      <a href="login.php"><button type="button">Admin Login <i class="fa fa-sign-in"></i></button></a> 
    </p>
  </form>
  <form action="" method="post">
    <p>
      <input type="text" name="keyword" placeholder="Cari Produk..." autocomplete="off" required>
      <button type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
      <button onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
    </p>
  </form>
  <form action="" method="post">
    <p>
      Sorting nama produk
      <button type="submit" name="sortName_ASC">A ke Z</button>
      <button type="submit" name="sortName_DESC">Z ke A</button>
    </p>
  </form>
  <form action="" method="post">
    <p>Sorting harga produk
      <button type="submit" name="sortPrice_ASC">Termurah - Termahal</button>
      <button type="submit" name="sortPrice_DESC">Termahal - Termurah</button>
    </p>
  </form>
  <form action="" method="post">
    <p>
      Sorting stok produk
      <button type="submit" name="sortStock_DESC">Banyak - Sedikit</button>
      <button type="submit" name="sortStock_ASC">Sedikit - Banyak</button>
    </p>
  </form>
  <hr>
  <table align="center" style="text-align: center;">
    <tr>
      <th colspan="4">List Produk</th>
    </tr>
    <tr class="hidden">
      <!--<th>Index</th>-->
      <th>Kode</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Stok</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($fetch as $row) : ?>
      <tr>
        <!--<td><?php echo $i; ?></td>-->
        <td style="text-align: left"><?php echo $row["kode_produk"]; ?></td>
        <td style="text-align: left"><?php echo $row["nama_produk"]; ?></td>
        <td style="text-align: right">Rp <?php echo number_format($row["harga"], 0, ',', '.'); ?></td>
        <td style="text-align: center"><?php echo $row["stok"]; ?></td>
      </tr>
      <?php $i++;
      ?>
    <?php endforeach;
    ?>
  </table>
  <hr>
  <article>
    <h3>Entitas Database </h3>
    <p>(Memiliki 5 tabel yang saling terkait dengan kolom masing-masing tabel adalah 5)</p>
    <img src="bnsp_database_designer.png" alt="">
  </article>
  <hr>
  <article>
    <h3>Procedure </h3>
    <p>(Untuk mengecek stok produk yang kurang dari 10)</p>
    <img src="bnsp_procedure.png" alt=""> <br>
    <img src="bnsp_call.png" alt="">
  </article>
  <hr>
  <article>
    <h3>Function </h3>
    <p>(Pencarian produk dengan nama/kode produk dan Sorting mengenai produk diatas tabel list produk)</p>
  </article>
  <hr>
  <article>
    <h3>Trigger </h3>
    <p>(Otomatis mengubah nilai stok produk jika ada penjualan dengan produk tersebut) <br> Trigger pada tabel `penjualan_detail` untuk update tabel `produk`</p>
    <img src="bnsp_trigger.png" alt="">
  </article>
  <hr>
  <article>
    <h3> Commit dan Rollback </h3>
    <p>(Digunakan untuk melakukan backup data sebelum melakukan interaksi terhadap database. <br>
      jika terjadi kesalahan dapat melakukan rollback untuk mengembalikan database seperti saat commit dijalankan)</p>
    <img src="bnsp_commit_and_rollback_1.png" alt="">
    <p>Gunakan transaction untuk melakukan commit dan rollback <br> Dapat dilihat ada 6 produk sebelum commit dilakukan dan ada berberapa produk yang dihapus <br>
      pada tabel terlihat bahwa hanya tersisa 3 produk yang ada didalam tabel</p>
    <img src="bnsp_commit_and_rollback_2.png" alt="">
    <p>Dapat dilihat sebelum rollback dilakukan pada tabel produk hanya ada 3 produk. <br>
      Namun setelah rollback dilakukan tabel produk kembali seperti semula dengan 6 produk didalamnya</p>
  </article>
  <hr>
  <article>
    <h3>Algoritma sorting dan searching</h3>
    <p>(Fitur sorting dan searching dapat digunakan pada awal halaman berada diatas tabel) <br>Algoritma sorting dan searching menggunakan koneksi database dari PHP dengan query yang sesuai</p>
    <img src="bnsp_sorting.png" alt="">
    <p>Fitur sorting sesuai dengan tombol yang digunakan</p>
    <img src="bnsp_searching.png" alt="">
    <p>Fitur searching untuk pencarian menggunakan nama/kode produk</p>
  </article>
  <hr>
  <article>
    <h3>Perintah eksekusi query SQL</h3>
    <p>(Perintah query SQL dilakukan oleh file 'db-query.php' yang membutuhkan sambungan dari file 'db-connection.php')</p>
    <img src="bnsp-query-sql.png" alt="">
  </article>
  <hr>
  <article>
    <h3>Koneksi database ke aplikasi</h3>
    <p>(Koneksi menggunakan PHP dengan menggunakan fungsi `mysqli_connect`)</p>
    <img src="bnsp-connection.png" alt="">
  </article>
  <hr>
  <article>
    <h3>Memasukan dan menampilkan data melalui aplikasi</h3>
    <p>(Penampilan data ada dibagian awal halaman pada tabel atau <a href="index.php" style="text-decoration: none; color:blue;"> klik disini</a>) <br>

      Akses terhadap data dibatasi untuk pengunjung. <br>
      Silakan login pada bagian atas awal halaman dengan tombol 'Login' untuk melakukan CRUD pada database</p>
  </article>
  <hr>
  <article>
    <h3>Berberapa user dengan hak akses</h3>
    <p>(User admin memiliki akses CRUD pada database) <br>
      Silakan gunakan tombol login pada bagian atas awal halaman atau <a href="index.php" style="text-decoration: none; color:blue;"> klik disini</a> untuk melihat <br> username & password para admin yang terdaftar pada sistem</p>
  </article>
</body>

</html>