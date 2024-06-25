<?php
session_start();
if (!empty($_SESSION['username'])){
  header("location:admin.php?menu=home");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" />
    <link rel="stylesheet" href="login-form/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="login-form/css/owl.carousel.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login-form/css/bootstrap.min.css" />
    <!-- Style -->
    <link rel="stylesheet" href="login-form/css/style.css" />
    <link rel="icon" type="image/png" href="r.jpg" sizes="16x16" />
    <title>Web Programming</title>
  </head>
  <body>
    <div style="background-image: url('login-form/images/seb.jpg')">
    <div class="d-lg-flex half justify-content-center">
      <div class="contents">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7">
              <div class="mb-4">
                <h3 style="text-align: center;"><b>WELCOME!!!</b></h3>
              </div>
              <form method="post">
                <div class="form-group first">
                  <label for="username"></label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="username" required/>
                </div>
                <div class="form-group last mb-3">
                  <label for="password"></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="password" required/>
                </div>

                <div class="d-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox"/>
                    <div class="control__indicator"></div>
                  </label> <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                </div>

                <input type="submit" name="login" value="Log In" class="btn btn-block btn-primary"/>
                  <?php if(isset($_GET['login'])=="gagal"){?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Login Gagal</strong> Cek Kembali Username dan Passwordmu
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php } ?>

                <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>

                <div class="social-login">
                  <a href="register.php?menu=register"class="google btn d-flex justify-content-center align-items-center">Register</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    </div>

<?php 
include "koneksi.php";
if(isset($_POST['login'])){ //jika tombol submit di klik
	$username = $_POST['username'];
	$pass = md5($_POST['password']); //md5 (untuk menyamarkan password)
	$login=mysqli_query($koneksi,"SELECT * FROM username WHERE username='$username' AND password='$pass' ");
	//utk mengetahui jumlah baris dari $login
	$ketemu=mysqli_num_rows($login);
	$r=mysqli_fetch_array($login);
	// Apabila username dan password ditemukan
	if ($ketemu > 0){  
	  $_SESSION['username']     = $r['username'];
	  $_SESSION['nama_lengkap']  = $r['nama_lengkap'];
	  
	  header("location:admin.php?menu=home");
	}else{
	  header("location:index.php?login=gagal");
	}
	
}
?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>