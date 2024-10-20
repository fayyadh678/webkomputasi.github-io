<?php
include "koneksi.php";
include "fungsi.php";
$nim = $namaDepan = $namaBelakang = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim = bersihkan_input($_POST['nim']);
    $namaDepan = bersihkan_input($_POST['namadepan']);
    $namaBelakang = bersihkan_input($_POST['namabelakang']);
    $email = bersihkan_input($_POST['email']);

    // Cek apakah NIM sudah ada di database
    $cekNim = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $result = mysqli_query($conn, $cekNim);

    if (mysqli_num_rows($result) > 0) {
        // Update data mahasiswa
        $strSQL = "UPDATE mahasiswa 
                   SET namadepan='$namaDepan', 
                       namabelakang='$namaBelakang',
                       email='$email'  
                   WHERE nim='$nim'";

        $execStrSQL = mysqli_query($conn, $strSQL);
        if ($execStrSQL) {
?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>Data Berhasil</b> diupdate dalam database
            </div>
<?php
        } else {
?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>Data Tidak Berhasil</b> diupdate ke dalam database <br>
                <?php echo "Error: " . mysqli_error($conn); ?>
            </div>
<?php
        }
    } else {
        echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b>Error:</b> NIM tidak ditemukan.
              </div>";
    }
} else {
    if (isset($_GET['nim'])) {
        $nim = bersihkan_input($_GET['nim']);
        $strSQL = "SELECT * FROM mahasiswa WHERE nim='$nim'";
        $execStrSQL = mysqli_query($conn, $strSQL);
        if (mysqli_num_rows($execStrSQL)) {
            while ($row = mysqli_fetch_assoc($execStrSQL)) {
                $namaDepan = $row['namadepan'];
                $namaBelakang = $row['namabelakang'];
                $email = $row['email'];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

    <?php include_once "menu.php"; ?>

    <div class="container">

        <h2>Update Biodata Mahasiswa</h2>
        <div class="row mb-2">
            <div class="col-sm-12">
                <span class="m-1">
                    <a href="viewall.php" class="btn btn-info" role="button">Kembali</a>
                </span>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th><input type="text" class="form-control" name="nim" value="<?=$nim?>" readonly></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nama Depan</td>
                        <td><input type="text" class="form-control" name="namadepan" value="<?=$namaDepan?>"></td>
                    </tr>
                    <tr>
                        <td>Nama Belakang</td>
                        <td><input type="text" class="form-control" name="namabelakang" value="<?=$namaBelakang?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" class="form-control" name="email" value="<?=$email?>"></td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <span class="m-1">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
