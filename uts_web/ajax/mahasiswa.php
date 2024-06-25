<?php

include "../functions.php";

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa 
            WHERE 
                nim LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%' OR
                email LIKE '%$keyword%' 
            ";
$mahasiswa = query($query);
?>

<table class="table table-striped table-hover table-bordered">
    <tr class="table-dark">
        <th>No.</th>
        <th>Gambar</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Email</th>
        <th class="aksi">Aksi</th>
    </tr>

    <?php
        $no =1;
        foreach ($mahasiswa as $row) : ?>

    <tr>
        <td><?= $no ?></td>

        <td><img src="img/<?= $row["gambar"] ?>" width="50px" alt="error foto"></td>
        <td><?= $row["nim"] ?></td>
        <td><?= $row["nama"] ?></td>
        <td><?= $row["jurusan"] ?></td>
        <td><?= $row["email"] ?></td>

        <td class="aksi">
            <div class='row'>
                <div class='col d-flex justify-content-center'>
                    <a href="ubah.php?id=<?= $row["id"]; ?>" class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i>Update</a> 
                </div>
                <div class='col d-flex justify-content-center'>
                    <a href="hapus.php?id=<?= $row["id"]; ?>"onclick="return confirm('apakah anda yakin ingin menghapus data ini?');" 
                        class='btn btn-sm btn-danger'><i class='bi bi-trash3'></i>Delete</a>
                </div>
            </div>
        </td>

    </tr>

    <?php
        $no++;
        endforeach; ?>
</table>