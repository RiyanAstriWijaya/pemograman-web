<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<br>     
<h2 class="text-center mt-1" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Daftar Menu</h2>

<div class="container">
<a href="?menu=admin&submenu=tambahin" class="btn btn-primary mb-3">Tambah Barang</a>
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
			<th>Edit</th> 
			<th>Delete</th>
		</tr>
		</thead>
	<tbody>
	<?php 
	
	$query=mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_buah asc");
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	//ini menghasilkan array associative
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama_buah']; ?></td>
			<td><?= strtolower($d['harga']); ?></td>
			<td><?= $d['stok']; ?></td>
			<td><a href="?menu=admin&submenu=edit&id=<?= $d['id_buah'];?>">Edit</a></td>
			<td>
				<a href="?menu=admin&submenu=hapus&id=<?= $d['id_buah'];?>" 
				onClick="return confirm('Yakin mau di hapus?');">Delete</a>
			</td>
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

case "tambahin":
?>
<br>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<form method="POST">
				<div class="form-group">
					<label for="nama">Nama</label><br/>
					<input type="text" class="form-control" name="nama_buah" id="nama" required placeholder="tulis nama" autocomplete="off" />
				</div>
				<div class="form-group">
					<label for="harga">Harga</label><br/>
					<input type="text" class="form-control" name="harga" id="harga"/>
				</div>
				<div class="form-group">
					<label for="stok">Stok</label><br/>
					<input type="text" class="form-control" name="stok" id="stok"/>
				</div>
				<div class="form-group">
					<label for="gambar">Gambar</label><br/>
					<input type="text" class="form-control" name="gambar" id="gambar"/>
				</div>
				
				<button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
				<a href="?menu=admin" class="btn btn-info">Kembali</a>
			</form>
		</div>
	</div>
</div>
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	//mengabaikan tanda petik
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama_buah']);  
	$harga=htmlspecialchars($_POST['harga']); //mengabaikan tag html; 
	$stok=htmlspecialchars($_POST['stok']);
	$gambar=htmlspecialchars($_POST['gambar']);
	// for($a=1; $a<=6; $a++){}
	$query=mysqli_query($koneksi, 
		"INSERT INTO barang VALUES 
		('','$nama','$harga','$stok','$gambar')
		");
	
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di Tambah');
			window.location.href='?menu=admin';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di TambahKAN');
			window.location.href='?menu=admin';
		</script>"; 
}
};
?>
<?php 
break;

case "edit":
//mengambil id yang dikirim melalui URL..
$id=$_GET['id'];
//query ke tabel sesuai dengan ID yang ada di URL
$edit=mysqli_query($koneksi,"SELECT * FROM barang WHERE id_buah='$id'");
$d=mysqli_fetch_array($edit);
?>
<br>
<div class="container">
<div class="row">
	<div class="col-sm-4">
		<form method="POST">
			<input type="hidden" name="id" value="<?=$d['id_buah'];?>" />
			<div class="form-group">
				<label for="nama">Nama</label><br/>
				<input type="text" class="form-control" name="nama_buah" id="nama" value="<?=$d['nama_buah'];?>" required placeholder="tulis nama" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="harga">Harga</label><br/>
				<input type="text" class="form-control"  name="harga" id="harga" value="<?=$d['harga'];?>"/>
			</div>
			<div class="form-group">
				<label for="stok">Stok</label><br/>
				<input type="text" class="form-control"  name="stok" id="stok" value="<?=$d['stok'];?>"/>
			</div>
			<button type="submit" name="submit" class="btn btn-primary">Edi Data</button>
			<a href="?menu=admin" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> 
</div>
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	$id=$_POST['id'];
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama_buah']); //mengabaikan tanda petik
	$harga=htmlspecialchars($_POST['harga']); //mengabaikan tag html;
	$stok=$_POST['stok'];
	$query=mysqli_query($koneksi, "UPDATE barang SET 
	nama_buah='$nama', harga='$harga', stok='$stok'
	WHERE id_buah='$id' ");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di UBAH');
			window.location.href='?menu=admin';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di UBAH');
			window.location.href='?menu=admin';
		</script>"; 
	}
}
break;
case "hapus":
  $query=mysqli_query($koneksi,"SELECT id_buah FROM barang WHERE id_buah='$_GET[id]'");
  $cek=mysqli_num_rows($query);
  if($cek == 0){
	echo "<script>alert('Hapus Data Gagal, Data Tidak Ditemukan');
      window.location=('?menu=admin')</script>";
  }else{
	$hapus=mysqli_query($koneksi,"DELETE FROM barang WHERE id_buah='$_GET[id]'");
	if($hapus){
      echo "<script>
      window.location=('?menu=admin')</script>";
    }else{
      echo "<script>alert('Hapus Data Gagal');
      window.location=('?menu=admin')</script>";
    }
  } 
break;
}
?>