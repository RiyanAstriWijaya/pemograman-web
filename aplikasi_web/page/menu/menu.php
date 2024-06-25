<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<br>
<h2 class="text-center mt-1" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Data</h2>
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
			<th>Stok</th>
			<th>Beli</th>
		</tr> 
	</thead>
	<tbody>
	<?php  
	
	$query=mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_buah asc");
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama_buah']; ?></td>
			<td><?= strtolower($d['harga']); ?></td>
			<td><?= $d['stok']; ?></td>
			<td><a href="?menu=menu&submenu=buy&id=<?= $d['id_buah'];?>">Beli</a></td>
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
                <button type="submit" name="out" class="btn btn-primary">Check Out</button>
                    <hr>
			    <a href="?menu=menu" class="btn btn-info">Kembali</a>
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
				window.location.href = '?menu=menu';
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
				window.location.href = '?menu=menu';
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
				window.location.href = '?menu=menu';
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
				window.location.href = '?menu=menu';
			}
			});
			</script>";
		}
	}
}
}