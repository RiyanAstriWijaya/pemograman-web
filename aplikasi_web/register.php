<?php
session_start();
if (!empty($_SESSION['username'])){
  header("location:admin.php?menu=home");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="r.jpg" sizes="16x16" />
  <title>Web Programming</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="d-lg-flex half justify-content-center" style="background-image: url('login-form/images/seb.jpg')">
  <div class="container">
    <div class="row justify-content-center align-items-center inner-row">
      <div class="col-lg-5 col-md-7">
        <div class="form-box registration-form p-md-5 p-3">
          <div class="form-title">
          <h2 class="form-floating mb-3" style="text-align: center;"><b>Daftar Akun</b></h2>
          <form method="post" action="">
            <div class="col form-floating mb-3">
              <input type="name" class="form-control form-control-sm" placeholder="firstname" id="floatinginput" name="firstname" required>
              <label for="floatinginput">Nama depan</label>
            </div>
            <div class="col form-floating mb-3">
              <input type="name" class="form-control form-control-sm" placeholder="lastnamename" id="floatinginput" name="lastname">
              <label for="floatinginput">Nama belakang (opsional)<label>
            </div>
            <div class="form-floating mb-3">
              <input type="number" class="form-control form-control-sm" placeholder="hanphone" id="floatinginput" name="hanphone" required>
              <label for="floatinginput">No Hanphone</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control form-control-sm" placeholder="email" id="floatinginput" name="email" required>
              <label for="floatinginput">Email</label>
            </div>
            <div class="form-floating mb-3">
              <input type="username" class="form-control form-control-sm" placeholder="username" id="floatinginput" name="username" required>
              <label for="floatinginput">Username</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control form-control-sm" placeholder="password" id="floatingpassword" name="password" required>
              <label for="floatingpassword">Password</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control form-control-sm" placeholder="re-password" id="floatinginput" name="verifikasi" required>
              <label for="floatinginput">Konfirmasi Password</label>
            </div>
              <button class="third" name="daftar">Buat Akun</button>
              <a href="index.php?menu=login"> <button class="third" name="kembali">Kembali</a></button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "koneksi.php";
if(isset($_POST['daftar'])){
  $nama_depan = $_POST['firstname'];
  $nama_belakang = $_POST['lastname'];
  $hanphone = $_POST['hanphone'];
  $email = $_POST['email'];
	$username = $_POST['username'];
	$pass = md5($_POST['password']); //md5 (untuk menyamarkan password)
  $verifikasi = $_POST['verifikasi'];
	$login=mysqli_query($koneksi, 
		"INSERT INTO username VALUES 
		('','$nama_depan','$nama_belakang','$hanphone','$email','$username','$pass','$verifikasi')
		");
	$ketemu=mysqli_affected_rows($koneksi);
	if ($ketemu > 0){  
	  echo '
      <script>
          alert("Akun berhasil dibuat, Silahkan LOGIN !!");
          window.location.href="index.php?menu=login";
      </script>
      ';
	}else{
	  echo '
      <script>
          alert("Gagal Mendaftar!");
          window.location.href="index.php?menu=login";
      </script>
      ';
	}
}
?>
</body>
</html>