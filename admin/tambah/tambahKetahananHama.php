<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_hama = trim($_POST['ketahanan_hama']);
    $ketahanan = trim($_POST['normalisasi']);

    if ($nama_hama && $ketahanan) {
        $query = "INSERT INTO ketahanan_hama (ketahanan_hama, normalisasi) VALUES ('$nama_hama', '$ketahanan')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data Berhasil Ditambahkan'); location.href='../kriteria.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan: " . mysqli_error($koneksi) . "'); location.href='tambahKetahananHama.php';</script>";
        }
    } else {
        echo "<script>alert('Harap mengisi semua field'); location.href='tambahKetahananHama.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ketahanan Hama</title>
    <link rel="stylesheet" href="../assets/tambahKetahananHama.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Tambah Ketahanan Hama</h2>
        <form method="POST" action="">
            <label for="ketahanan_hama">Ketahanan Terhadap Hama</label>
            <input class="input-box" type="text" id="ketahanan_hama" name="ketahanan_hama" placeholder="Masukkan ketahanan hama" required>

            <label for="normalisasi">Normalisasi</label>
            <input class="input-box" type="text" id="normalisasi" name="normalisasi" placeholder="Contoh: 1-4" required>

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger">
                    <a href="../kriteria.php">Cancel</a>
                </button>
            </div>
        </form>
    </div>
</body>

</html>