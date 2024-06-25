<?php
$menu=isset($_GET['menu'])?$_GET['menu']:"home";
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">
<div class="container">
  <a class="navbar-brand" href="https://www.instagram.com/ryn_a.w/"><b>TOKO <span style="color:goldenrod;">BUAH SEGAR</span></b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ms-auto">
    <li class="nav-item <?= ($menu == "home")?"active":""?>">
      <a class="nav-link" href="?menu=home">Beranda<span class="sr-only"></span></a>
    </li>
    <li class="nav-item <?= ($menu == "admin")?"active":""?>">
      <a class="nav-link" href="?menu=admin">Menu</a>
    </li>
    <li class="nav-item <?= ($menu == "productadmin")?"active":""?>">
      <a class="nav-link" href="?menu=productadmin">Produk</a>
    </li>
    </li>
    <li class="nav-item <?= ($menu == "transaksiadmin")?"active":""?>">
      <a class="nav-link" href="?menu=transaksiadmin">transaksi</a>
    </li>
  </ul>
</div>
</div>  
  <a class="nav-link" href="logout.php" onclick="return confirm('apakah anda yakin ingin keluar dari aplikasi ini?');" ><i class="bi bi-power"></i></a>
</nav>