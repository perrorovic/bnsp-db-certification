<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION["auth_check"])) {
	header("location: database.php");
	exit;
}

include_once('db-connection.php');
include('db-query.php'); 

if (isset($_POST["auth_check"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($connection, "SELECT * FROM `admin` WHERE username='$username'");

	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if ($password == $row["password"]) {
			$_SESSION["auth_check"] = true;
			$_SESSION['username'] = $row["username"];
			$_SESSION['fullname'] = $row["fullname"];
			header("location: database.php");
			exit;
		}
	}
	$error = true;
}
?>

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
<?php $fetch = query("SELECT * FROM `admin` ORDER BY `id` ASC"); ?>

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
    <p>Admin Login</p>
    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" placeholder="Username..." required>
        <br><br>
        <label for="password">Password: </label>
        <input type="password" name="password" placeholder="Password..." required>
        <br><br>
        <a href="index.php"><button type="button">Kembali</button></a> <button name="auth_check">Login <i class="fa fa-sign-in"></i></button>
    </form>
    <br>
    <hr>
    <p>Gunakan username dan password sesuai dengan tabel dibawah</p>
    <table align="center" style="text-align: center;">
        <tr>
            <th colspan="4">Data Admin</th>
        </tr>
        <tr class="hidden">
            <!--<th>Index</th>-->
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($fetch as $row) : ?>
            <tr>
                <!--<td><?php echo $i; ?></td>-->
                <td style="text-align: left"><?php echo $row["fullname"]; ?></td>
                <td style="text-align: left"><?php echo $row["username"]; ?></td>
                <td style="text-align: left"><?php echo $row["password"]; ?></td>
            </tr>
            <?php $i++;
            ?>
        <?php endforeach;
        ?>
    </table>
    <br>
    <hr>
    <?php if (isset($error)) : ?>
        <p style="color: red;"> Login gagal! Silakan periksa informasi lagi! </p>
    <?php endif; ?>
</body>

</html>