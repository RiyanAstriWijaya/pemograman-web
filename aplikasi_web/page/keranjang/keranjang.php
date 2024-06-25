<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<br>
<h2 class="text-center mt-1" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Daftar Menu</h2>
<div class="justify-content-center">
<div class="row">
	<div class="col-sm-12">
	<div class="table-responsive ">
	<table id="tableData" class="table table-hover" >
	<thead class="thead-light">
		<tr>
			<th>No</th>
			<th>Nama Buah</th>
			<th>Harga Satuan</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>tanggal</th>
		</tr> 
	</thead>
	<tbody>
	<?php  
	$user = $_SESSION['username'];
	$query=mysqli_query($koneksi, "SELECT a.harga, a.jumlah, a.tanggal, a.total, c.username, c.no_hp, b.nama_buah FROM transaksi_fix as a JOIN barang as b ON a.id_buah=b.id_buah JOIN username as c ON a.id_username=c.id_user WHERE c.username = '$user'");
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama_buah']; ?></td>
			<td><?= strtolower($d['harga']); ?></td>
			<td><?= $d['jumlah']; ?></td>
			<td><?= $d['total']; ?></td>
			<td><?= $d['tanggal']; ?></td>
		</tr>
	<?php 
	$no++;
	} 
	?>
	</tbody>
	</table>
	</div>
	</div>
	</div>
<?php 
break;
case "buy":
?>
<div class="card pt-4 mx-auto" style="width: 30rem; height: 33rem; overflow-y: auto; margin-top:70px;">
<h3 class="text-center" > Transaksi </h3>
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
			    <a href="?menu=menu" class="btn btn-info">Kembali</a>
            </div>
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
            window.location.href = '?menu=menu';
        }
        });
    </script>";
}
}
?>