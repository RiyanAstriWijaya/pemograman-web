<?php

if ($menu=='home'){
	include "page/home/home.php";
}

elseif ($menu=='about'){
    include "page/about/about.php";   
}

elseif ($menu=='menu'){
    include "page/menu/menu.php";  
}

elseif ($menu=='product'){
    include "page/product/product.php";   
}
elseif ($menu=='admin'){
    include "page/admin/admin.php";
}
elseif ($menu=='keranjang'){
    include "page/keranjang/keranjang.php";
}
elseif ($menu=='transaksi'){
    include "page/transaksi/transaksi.php";
}
elseif ($menu=='productadmin'){
    include "page/productadmin/productadmin.php";
}
elseif ($menu=='transaksiadmin'){
    include "page/transaksiadmin/transaksiadmin.php";
}

else{
  echo "<h4 class='text-center' style='margin-top:60px;'><b>PAGE BELUM ADA ATAU BELUM LENGKAP ATAU ANDA TIDAK BERHAK 
  MENGAKSES HALAMAN INI</b></h4>";
}
?>
