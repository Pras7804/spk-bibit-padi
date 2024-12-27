<?php
include '../../koneksi.php';

$errorNama = "";
$nama = "";
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nama = $_POST['nama'];
    // Validasi form sederhana
    if (empty($nama)) {
        $errorNama = "Semua data harus diisi!";
    }
    if (empty($errorNama)) {
        $query = "INSERT INTO alternatif (nama_bibit) VALUES('$nama')";
        mysqli_query($koneksi, $query);
        header("Location: ../alternatif.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Alternatif</title>
    <link rel="stylesheet" href="../assets/tambahAlternatif.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Tambah Data Alternatif</h2>
        <form action="" method="post">
            <label for="nama">Nama Bibit</label><br>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Bibit" class="input-box" required>

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger">
                    <a href="../alternatif.php">Cancel</a>
                </button>
            </div>
        </form>
    </div>
</body>

</html>