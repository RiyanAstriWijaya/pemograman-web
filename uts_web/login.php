<?php

session_start();
include "functions.php";
//cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
//ambil username berdasarkan id
$result = mysqli_query($conn,"SELECT username FROM user WHERE id = $id");
$row = mysqli_fetch_assoc($result);
//cek cookie dan username
    if( $key === hash('sha256', $row['username']) ){
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"]) ) {
    header("location: index.php");
    exit; 
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    //cek username
    if(mysqli_num_rows($result) === 1){ //cek apakah ada baris yang dikembalikan jika ada hasilnya = 1
        //cek paswordnya
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            //set session
            $_SESSION["login"] = true;
            //cek remember me
            if( isset($_POST["remember"]) ) {
                //buat cookie
                setcookie('id', $row['id'], time()+60); //set cookie 1 mnt
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }
            header("location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Halaman Login</title>
</head>
<body>
    <h1 class="h1-log">Halaman Login</h1>

    <?php if (isset($error) ) : ?>
        <p style="color:red; font-style:italic; text-align:center;">username / password salah</p>
    <?php endif; ?>
    <div class="w-50 mx-auto border p-3 mt-3"> 
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" class="form-control" required 
                    placeholder="Enter username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" class="form-control" required
                    placeholder="Enter password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me </label>
            </li>
            <li>
                <button type="submit" name="login" class="btn btn-success mt-1">Login</button>
            </li>
        </ul>
    </form>
    </div>
</body>
</html>