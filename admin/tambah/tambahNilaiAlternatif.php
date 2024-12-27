<?php
include "../../koneksi.php";

// Ambil data dari tabel alternatif untuk dropdown nama bibit
$alternatif = mysqli_query($koneksi, "SELECT alternatif_id, nama_bibit FROM alternatif");
if (!$alternatif) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Ambil data dari tabel ketahanan_hama untuk dropdown ketahanan hama
$ketahanan_hama = mysqli_query($koneksi, "SELECT ketahanan_hama_id, ketahanan_hama FROM ketahanan_hama");
if (!$ketahanan_hama) {
    die("Query gagal: " . mysqli_error($koneksi));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alternatif_id = $_POST['nama_bibit'];
    $umur_tanaman = trim($_POST['umur_tanaman']);
    $tinggi_tanaman = trim($_POST['tinggi_tanaman']);
    $ketahanan_id = $_POST['ketahanan_hama'];
    $rata_rata_hasil = trim($_POST['rata_rata_hasil']);

    if ($alternatif_id && $umur_tanaman && $tinggi_tanaman && $ketahanan_id && $rata_rata_hasil) {
        $query = "INSERT INTO detail_informasi (alternatif_id, umur_padi, tinggi_padi, ketahanan_hama_id, rata_hasil) 
                  VALUES ('$alternatif_id', '$umur_tanaman', '$tinggi_tanaman', '$ketahanan_id', '$rata_rata_hasil')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data Berhasil Ditambahkan'); location.href='../nilaiAlternatif.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan: " . mysqli_error($koneksi) . "'); location.href='tambahDetailInformasi.php';</script>";
        }
    } else {
        echo "<script>alert('Harap mengisi semua field'); location.href='tambahDetailInformasi.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Informasi</title>
    <link rel="stylesheet" href="../assets/tambahNilaiAlternatif.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Tambah Detail Informasi</h2>
        <form method="POST" action="">
            <label for="nama_bibit">Nama Bibit</label>
            <select id="nama_bibit" name="nama_bibit" class="input-box" required>
                <option value="">Pilih Nama Bibit</option>
                <?php while ($row = mysqli_fetch_assoc($alternatif)) : ?>
                    <option value="<?= $row['alternatif_id'] ?>">
                        <?= htmlspecialchars($row['nama_bibit']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="umur_tanaman">Umur Tanaman</label>
            <input type="text" id="umur_tanaman" name="umur_tanaman" placeholder="Masukkan umur tanaman" class="input-box" required>

            <label for="tinggi_tanaman">Tinggi Tanaman</label>
            <input type="text" id="tinggi_tanaman" name="tinggi_tanaman" placeholder="Masukkan tinggi tanaman" class="input-box" required>

            <label for="ketahanan_hama">Ketahanan Hama</label>
            <select id="ketahanan_hama" name="ketahanan_hama" class="input-box" required>
                <option value="">Pilih Ketahanan Hama</option>
                <?php while ($row = mysqli_fetch_assoc($ketahanan_hama)) : ?>
                    <option value="<?= $row['ketahanan_hama_id'] ?>">
                        <?= htmlspecialchars($row['ketahanan_hama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="rata_rata_hasil">Rata-Rata Hasil</label>
            <input type="text" id="rata_rata_hasil" name="rata_rata_hasil" placeholder="Masukkan rata-rata hasil" class="input-box" required>

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger">
                    <a href="../nilaiAlternatif.php">Cancel</a>
                </button>
            </div>
        </form>
    </div>
</body>

</html>