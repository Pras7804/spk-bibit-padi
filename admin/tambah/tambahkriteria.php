<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kriteria = trim($_POST['kriteria']);
    $bobot = trim($_POST['bobot']);
    $normalisasi = trim($_POST['normalisasi']);

    if ($kriteria && $bobot && $normalisasi) {
        $query = "INSERT INTO kriteria (kriteria, bobot, normalisasi_kriteria) VALUES ('$kriteria', '$bobot', '$normalisasi')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data Berhasil Ditambahkan'); location.href='../kriteria.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan: " . mysqli_error($koneksi) . "'); location.href='tambahKriteria.php';</script>";
        }
    } else {
        echo "<script>alert('Harap mengisi semua field'); location.href='tambahKriteria.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kriteria</title>
    <link rel="stylesheet" href="../assets/tambahKetahananHama.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Tambah Kriteria</h2>
        <form method="POST" action="">
            <label for="kriteria">Kriteria</label>
            <input class="input-box" type="text" id="kriteria" name="kriteria" placeholder="Masukkan kriteria" required>

            <label for="bobot">Bobot</label>
            <input class="input-box" type="number" id="bobot" name="bobot" placeholder="Masukkan bobot" step="0.01" required>

            <label for="normalisasi">Normalisasi Kriteria</label>
            <input class="input-box" type="text" id="normalisasi" name="normalisasi" placeholder="Masukkan Normalisasi Kriteria" required>

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