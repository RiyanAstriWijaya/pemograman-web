<?php 
//untuk ngecek, apakah ada atau tidak tipe get menu di URL browser, agar tidak muncul error 
//jika menu tidak di tulis
$menu=isset($_GET['menu'])?$_GET['menu']:"home";
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-warning fixed-top">
<div class="container">
  <a class="navbar-brand" href="https://www.instagram.com/ryn_a.w/"><b>TOKO <span style="color:darkred;">BUAH SEGAR</span></b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ms-auto">
    <li class="nav-item <?= ($menu == "home")?"active":""?>">
      <a class="nav-link" href="?menu=home">Beranda<span class="sr-only"></span></a>
    </li>
    <li class="nav-item <?= ($menu == "menu")?"active":""?>">
      <a class="nav-link" href="?menu=menu">Menu</a>
    </li>
    <li class="nav-item <?= ($menu == "product")?"active":""?>">
      <a class="nav-link" href="?menu=product">Produk</a>
    </li>
    <li class="nav-item <?= ($menu == "keranjang")?"active":""?>">
      <a class="nav-link" href="?menu=keranjang">Riwayat Pesanan</a>
    </li>
    <li class="nav-item <?= ($menu == "about")?"active":""?>"> 
      <a class="nav-link" href="?menu=about">Tentang Kami</a>
    </li>
  </ul>
</div>
</div>
  <a class="nav-link" href="logout.php" onclick="return confirm('apakah anda yakin ingin keluar dari aplikasi ini?');" ><i class="bi bi-power"></i></a>
</nav>
