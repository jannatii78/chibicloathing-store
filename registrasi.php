<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hp = $_POST['hp'];
  $alamat = $_POST['alamat'];
  $role = 'tb_user';

  $query = "INSERT INTO tb_user(nama,email,username,password,hp,alamat,role)
   VALUES('$nama','$email','$username','$password','$hp','$alamat','pelanggan')";

  $simpan = mysqli_query($koneksi, $query);
  if($simpan) {
    header("Location: profil.php");
    exit();
  } else {
    echo "Gagal Menambahkan Data: " . mysqli_error($koneksi);
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="chibi.png" type="image/x-icon">
    <title>Registrasi</title>
  </head>
  <body>
    <div class="container">
      <form class="form-group" method="post">
        <div class="mb-2 p-2 bg rounded">
          <h2 class="text-center">Masuk ke halaman</h2>
          <label for="exampleFormControlInput1" class="form-label mt-3 fw-semibold"></label>
          <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" placeholder="nama"/><br>
          <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="email"/><br>
          <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="Username"/><br>
          <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password"/><br>
          <input type="text" name="hp" class="form-control" id="exampleFormControlInput1" placeholder="Hp"/><br>
          <input type="text" name="alamat" class="form-control" id="exampleFormControlInput1" placeholder="Alamat"/>
          <p>sudah punya akun? <a href="login.php">Login disini</a></p>
          <input type="submit" name="submit" value="submit" class="form-control btn-color mt-3" id="exampleFormControlInput1"/><br>
        </div>
      </form>
    </div>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script><script src="dashboard.js"></script></body>
</html>