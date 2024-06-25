<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    } 
    return $rows;
}

function tambah($data){
    global $conn;
    //ambil data dari tiap elemen dalam form
    $nim = htmlspecialchars($data["nim"]) ;
    $nama = htmlspecialchars($data["nama"]) ;
    $jurusan = htmlspecialchars($data["jurusan"]) ;
    //upload gambar
    $gambar = upload();
    if(!$gambar){ 
        return false;
    }
    $email = htmlspecialchars($data["email"]);
    //query insert data
    $query = "INSERT INTO mahasiswa VALUES ('','$nim','$nama','$jurusan','$gambar','$email')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn); //mengembalikan angka kalo success pasti 1
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size']; 
    $error = $_FILES['gambar']['error'];
    $tmpName= $_FILES['gambar']['tmp_name'];
    //cek apakah tidak ada gambar yang di upload
    if($error === 4){ //4 artinya tidak ada file yg di upload
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }
    //cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower( end($ekstensiGambar) );
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
            return false;
    }
    //cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000){ //1 megabyte
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }
    //lolos pengecekan,gambar siap di upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
 
function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
    //unlink()
}

function ubah($data){
    global $conn;
    //ambil data dari tiap elemen dalam form
    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]) ; 
    $nama = htmlspecialchars($data["nama"]) ;
    $jurusan = htmlspecialchars($data["jurusan"]) ;
    $gambarLama = htmlspecialchars($data["gambarlama"]) ;
    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }
    $email = htmlspecialchars($data["email"]);
    //query update data
    $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                jurusan = '$jurusan',
                gambar = '$gambar',
                email = '$email'
            WHERE id = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn); //return angka ketika ada data yang di di update di db
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa 
                WHERE 
                    nim LIKE '%$keyword%' OR
                    nama LIKE '%$keyword%' OR
                    jurusan LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' 
    ";
    return query($query); 
}

function registrasi($data){
    global $conn;
    $username = strtolower( stripslashes( $data["username"]) );
    $password = mysqli_real_escape_string( $conn, $data["password"] );
    $password2 = mysqli_real_escape_string( $conn, $data["password2"] );
    //cek username sudah ada appa belom
    $result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
        if( mysqli_fetch_assoc($result)){
            echo "<script>
                alert('username sudah terdaftar!');
            </script>";
            return false;
        }
    //cek konfirmasi password
    if( $password !== $password2){
        echo" 
        <script>
            alert('konfirmasi password tidak sesuai!');
        </script>
        ";
        return false;
    }
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //tambahkan user baru ke db
    mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");
    return mysqli_affected_rows($conn);
}

?>