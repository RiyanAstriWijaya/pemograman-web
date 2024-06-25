<?php
include "koneksi.php";
$action = isset($_GET['submenu']) ? $_GET['submenu'] : '';

// Pagination settings
$items_per_page = 3; // Number of items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

switch ($action) {
    default:
        // Count total number of records
        $total_records_query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transaksi,barang WHERE transaksi.id_buah = barang.id_buah");
        $total_records = mysqli_fetch_assoc($total_records_query)['total'];

        // Calculate the number of total pages
        $total_pages = ceil($total_records / $items_per_page);

        // Calculate the starting record for the current page
        $start = ($page - 1) * $items_per_page;

        $beli = mysqli_query($koneksi, "SELECT * FROM transaksi,barang WHERE transaksi.id_buah = barang.id_buah LIMIT $start, $items_per_page");
?>
<br>     
<h2 class="text-center mt-1" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Produk Unggulan</h2>
<div class="row align-items-start justify-content-center">
    <?php while ($d = mysqli_fetch_assoc($beli)) { ?>
        <div class="card" style="width: 280px;">
            <img src="page/img/products/<?= $d['gambar']; ?>"  height="250px" class="card-img-top" alt="Gambar Error">
            <div class="card-body">
                <div class="form-group">
                    <input type="button" class="form-control" name="harga" id="harga" value="<?= $d['nama_buah']; ?>" autocomplete="off" />
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control" name="harga" id="harga" value="Rp.<?= $d['harga']; ?>" autocomplete="off" />
                </div>
            </div>
            <div class="card-body">
                <a href="?menu=product&submenu=keranjang&id=<?= $d['id_transaksi'];?>" class="card-link"><button class="btn btn-primary"><i class="bi bi-cart-plus"></i> Keranjang</button></a>
                <a href="?menu=transaksi&submenu=beli&id=<?= $d['id_transaksi']; ?>" class="card-link"><button class="btn btn-danger">Beli</button> </a>
            </div>
        </div>
        
    <?php } ?>
</div>

<!-- Pagination links -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1) { ?>
            <li class="page-item"><a class="page-link" href="?menu=product&submenu=&page=1">First</a></li>
            <li class="page-item"><a class="page-link" href="?menu=product&submenu=&page=<?= $page - 1; ?>">Previous</a></li>
        <?php } ?>

        <?php for ($i = max(1, $page - 2); $i <= min($page + 2, $total_pages); $i++) { ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?menu=product&submenu=&page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php } ?>

        <?php if ($page < $total_pages) { ?>
            <li class="page-item"><a class="page-link" href="?menu=product&submenu=&page=<?= $page + 1; ?>">Next</a></li>
            <li class="page-item"><a class="page-link" href="?menu=product&submenu=&page=<?= $total_pages; ?>">Last</a></li>
        <?php } ?>
    </ul>
</nav>
<?php
break;

case "beli":
$id=$_GET['id'];
$beli=mysqli_query($koneksi,"SELECT * FROM transaksi,barang WHERE transaksi.id_buah AND barang.id_buah = '$id'");
$d=mysqli_fetch_assoc($beli);
?>

<div class="container justify-content-center">
<div class="row" style="margin-top:80px;">
	<div class="col-sm-4">
		<form method="POST">
			<input type="hidden" name="id" value="<?=$d['id_buah'];?>" />
			<div class="form-group">
				<label for="harga">Harga Satuan</label><br/>
				<input type="text" class="form-control" name="harga" id="harga" value="<?=$d['harga'];?>" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="kuantitas">Jumlah</label><br/>
				<input type="number" class="form-control" name="jumlah" id="kuantitas" value="1" min="1" max="100" required autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="tanggal">Tanggal</label><br/>
				<input type="date" class="form-control" name="tanggal" id="tanggal"/>
			</div>
			<button type="submit" name="out" class="btn btn-primary">Check Out</button>
			<a href="?menu=product" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> 
</div>

<?php 
if(isset($_POST['out'])){
	$harga = $_POST['harga'];
	$jumlah = $_POST['jumlah'];
	$total = $harga * $jumlah;
	echo "<script>
        Swal.fire({
        title: 'Transaksi Sukses',
        text: 'Total pada pembelian anda Rp.$total',
        icon: 'success',
        confirmButtonText: 'OK'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '?menu=product';
        }
        });
    </script>";
}
break;

case "keranjang":
    
    include "koneksi.php";
    $action=isset($_GET['submenu'])? $_GET['submenu'] :'';
    
    
    ?>
    <div class="card pt-4 mx-auto" style="width: 30rem; height: 33rem; overflow-y: auto; margin-top:70px;">
    <h3 class="text-center" > Keranjang </h3>
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
    <?php
    
    $id=$_GET['id'];
    $beli=mysqli_query($koneksi,"SELECT * FROM transaksi,barang WHERE transaksi.id_buah AND barang.id_buah = '$id'");
    $d=mysqli_fetch_assoc($beli);
    
    ?>
    
    <div class="container justify-content-center">
    <div class="row" style="margin-top:31px;">
        <div class="col-sm">
            <form method="POST">
                <input type="hidden" name="id" value="<?=$d['id_buah'];?>" />
                <div class="form-group">
                    <label for="harga">Nama Buah</label><br/>
                    <input type="text" class="form-control" name="harga" id="harga" value="<?=$d['nama_buah'];?>" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="harga">Harga Satuan</label><br/>
                    <input type="text" class="form-control" name="harga" id="harga" value="<?=$d['harga'];?>" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="kuantitas">Jumlah</label><br/>
                    <input type="number" class="form-control" name="jumlah" id="kuantitas" value="1" min="1" max="100" required autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label><br/>
                    <input type="date" class="form-control" name="tanggal" id="tanggal"/>
                </div>
                </div >
                <hr>
                    <button type="submit" name="out" class="btn btn-primary">Keranjang</button>
                        <hr>
                    <a href="?menu=product" class="btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </div> 
    </div>
    
    <?php 
    if(isset($_POST['out'])){
        $id =  $_POST['id'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total = $harga * $jumlah;
        $tanggal = $_POST['tanggal'];
        $user = $_SESSION['username'];
    
        $qwr =mysqli_query($koneksi, 
        "SELECT id_user FROM username WHERE username = '$user'");
        $r = mysqli_fetch_array($qwr);
        $username = $r['id_user'];
    
        if(empty($tanggal)){
            $query=mysqli_query($koneksi, 
            "INSERT INTO transaksi_fix VALUES 
            ('','$harga','$jumlah','$total',NOW(),'$id','$username')
            ");
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses > 0){
                echo "<script>
                Swal.fire({
                title: 'Transaksi Sukses',
                text: 'Total pada pembelian anda Rp.$total',
                icon: 'success',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?menu=product';
                }
                });
                </script>";
                $query=mysqli_query($koneksi, 
                "UPDATE barang SET stok = stok - '$jumlah' WHERE id_buah = $id
                ");
            }else{
                echo "<script>
                Swal.fire({
                title: 'Transaksi Gagal',
                icon: 'error',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?menu=product';
                }
                });
                </script>";
            }
        }else{
            $query=mysqli_query($koneksi, 
            "INSERT INTO transaksi_fix VALUES 
            ('','$harga','$jumlah','$total','$tanggal','$id','$username')
            ");
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses > 0){
                echo "<script>
                Swal.fire({
                title: 'Transaksi Sukses',
                text: 'Total pada pembelian anda Rp.$total',
                icon: 'success',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?menu=product';
                }
                });
                </script>";
                $query=mysqli_query($koneksi, 
                "UPDATE barang SET stok = stok - '$jumlah' WHERE id_buah = $id
                ");
            }else{
                echo "<script>
                Swal.fire({
                title: 'Transaksi Gagal',
                icon: 'error',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?menu=product';
                }
                });
                </script>";
            }
        }
    
        
    }
break;
}
?>
