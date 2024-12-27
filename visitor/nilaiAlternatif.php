<?php
include "../koneksi.php";

// Ambil data dari tabel detail_informasi untuk ditampilkan
$query = "SELECT di.detail_informasi_id, a.nama_bibit, di.umur_padi, di.tinggi_padi, kh.ketahanan_hama AS ketahanan_hama, di.rata_hasil
          FROM detail_informasi di
          JOIN alternatif a ON di.alternatif_id = a.alternatif_id
          JOIN ketahanan_hama kh ON di.ketahanan_hama_id = kh.ketahanan_hama_id
          ORDER BY di.detail_informasi_id ASC"; // Tambahkan ORDER BY di sini
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Detail Informasi</title>
    <link rel="stylesheet" href="./assets/nilaiAlternatif.css">
</head>

<body>
    <header>
        <h1>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</h1>
    </header>
    <nav>
        <a href="index.php">Homepage</a>
        <a href="kriteria.php">Kriteria</a>
        <a href="alternatif.php">Alternatif</a>
        <a href="#">Nilai Alternatif</a>
        <a href="utility.php">Nilai Utility</a>
        <a href="nilai_akhir.php">Nilai Akhir</a>
        <a href="perangkingan.php">Perangkingan</a>
        <a href="../login.php">Logout</a>
    </nav>
    <main>
        <div class="container">
            <section id="nilaiAlternatif" class="feature">
                <h2>Data Detail Informasi</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bibit</th>
                            <th>Umur Tanaman</th>
                            <th>Tinggi Tanaman</th>
                            <th>Ketahanan Hama</th>
                            <th>Rata-Rata Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama_bibit']); ?></td>
                                <td><?= htmlspecialchars($row['umur_padi']); ?> Hari</td>
                                <td><?= htmlspecialchars($row['tinggi_padi']); ?> cm</td>
                                <td><?= htmlspecialchars($row['ketahanan_hama']); ?></td>
                                <td><?= htmlspecialchars($row['rata_hasil']); ?></td>
                            </tr>
                        <?php endwhile; ?>
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