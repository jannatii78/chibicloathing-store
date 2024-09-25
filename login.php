<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = mysqli_query($koneksi, 
        "SELECT * FROM tb_user WHERE username='$username' and password='$password'"
    );
    
    if (mysqli_num_rows($login) > 0) {
        $data = mysqli_fetch_assoc($login);
        
        if ($data['role'] == "admin") {
            $_SESSION['admin'] = $username; 
            header("Location: dashboard.php");
        } elseif ($data['role'] == "pelanggan") { 
            $_SESSION['user'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['id_user'] = $data['id'];
            header("Location: profil.php");
    
        }
    } else {
        
        echo "username atau password salah";
        header("Location: login.php");

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
    <title>LOGIN</title>
  </head>
  <body>
    <div class="container">
    <form class="form-group" method="post">
      <div class="mb-2 p-2 bg rounded">
      <h2 class="text-center">Login</h2>
  <label for="exampleFormControlInput1" class="form-label mt-3 fw-semibold"></label>
  <input type="username" name="username" class="form-control" id="exampleFormControlInput1" placeholder="Username"/><br>
  <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password"/><br>
  <p>belum punya akun? <a href="registrasi.php">buat disini</a></p>
  <input type="submit" name="login" value="Login" class="form-control btn-color mt-3" id="exampleFormControlInput1"/>
      </div>
   </form>
   </div>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>