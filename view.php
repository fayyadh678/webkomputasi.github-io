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
  <h2>Detail Biodata Mahasiswa</h2>
  <div class="row mb-2">
    <div class="col-sm-12">    
        <span class="m-1">
          <a href="viewall.php" class="btn btn-info" role="button">Kembali</a>
        </span>
    </div> 
    </div>          
  <table class="table table-striped">
    <?php
    include"koneksi.php";
    include"fungsi.php";
    if(isset($_GET['nim'])){
      $nim=bersihkan_input ($_GET['nim']);
    }
    $strSQL="SELECT * FROM mahasiswa WHERE nim='$nim'";
    $execStrSQL=mysqli_query($conn,$strSQL);
    if(mysqli_num_rows($execStrSQL)){
      while($row=mysqli_fetch_assoc($execStrSQL)){

  ?>
    <thead>
      <tr>
        <th>NIM</th>
        <th><?=$row['nim']?> </th>       
      </tr>
    </thead>
    <tr>
        <td>Nama Lengkap</td>        
        <td><?php echo $row['namadepan']." ".$row ['namabelakang']?></td>       
      </tr>
    <tbody>
      <tr>
        <td>Email</td>        
        <td><?=$row['email']?></td>       
      </tr>
    </tbody>
    <?php
    }
    }
  ?>
  </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>
</html>
