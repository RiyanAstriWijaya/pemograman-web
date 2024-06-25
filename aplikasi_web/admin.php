<?php
session_start();
if (empty($_SESSION['username'])){
  header("location:index.php");
}
if($_SESSION['username'] == 'admin')
header("location:login_admin.php");?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link rel="icon" type="image/png" href="ryn5.jpg" sizes="16x16" />

  <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>Toko buah</title>
</head>

<body class="mt-5">
  <?php include "menu.php"; ?>
      <?php include "config.php"; ?>

<div class="mt-5"></div>
  <footer>
    <?php include "footer.php"; ?>
  </footer>


    <script src="bootstrap5/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap5/js/popper.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src=" https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function () {
      $("#tableData").DataTable();
    });
  </script>

</body>
</html>