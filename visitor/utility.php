<?php
include "../koneksi.php";

// Ambil data dari tabel utility
$query = "SELECT u.utility_id, a.nama_bibit, u.nilai_umur_padi, u.nilai_tinggi_padi, u.nilai_ketahanan_hama, u.nilai_rata_hasil
          FROM nilai_utility u
          JOIN detail_informasi di ON u.detail_informasi_id = di.detail_informasi_id
          JOIN alternatif a ON di.alternatif_id = a.alternatif_id
          ORDER BY di.detail_informasi_id";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . htmlspecialchars(mysqli_error($koneksi)));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Utility</title>
    <link rel="stylesheet" href="./assets/utility.css">
</head>

<body>
    <header>
        <h1>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</h1>
    </header>
    <nav>
        <a href="index.php">Homepage</a>
        <a href="kriteria.php">Kriteria</a>
        <a href="alternatif.php">Alternatif</a>
        <a href="nilaiAlternatif.php">Nilai Alternatif</a>
        <a href="#">Nilai Utility</a>
        <a href="nilai_akhir.php">Nilai Akhir</a>
        <a href="perangkingan.php">Perangkingan</a>
        <a href="../login.php">Logout</a>
    </nav>
    <main>
        <div class="container">
            <section id="utility" class="feature">
                <h2>Perhitungan Nilai Utility</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bibit</th>
                            <th>Nilai Umur Padi</th>
                            <th>Nilai Tinggi Padi</th>
                            <th>Nilai Ketahanan Hama</th>
                            <th>Nilai Rata-Rata Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_bibit']); ?></td>
                                    <td><?= htmlspecialchars($row['nilai_umur_padi']); ?></td>
                                    <td><?= htmlspecialchars($row['nilai_tinggi_padi']); ?></td>
                                    <td><?= htmlspecialchars($row['nilai_ketahanan_hama']); ?></td>
                                    <td><?= htmlspecialchars($row['nilai_rata_hasil']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">Data tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Sistem Pendukung Keputusan</p>
    </footer>
</body>

</html>