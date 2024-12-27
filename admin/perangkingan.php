<?php
// Koneksi ke database
include "../koneksi.php";

// Query untuk mengambil data nama_bibit dan hasil_akhir, diurutkan secara descending
$sql = "SELECT 
            alternatif.nama_bibit, 
            rangking.hasil_akhir,
            rangking.rangking_id
        FROM rangking
        INNER JOIN nilai_utility ON rangking.utility_id = nilai_utility.utility_id
        INNER JOIN detail_informasi ON nilai_utility.detail_informasi_id = detail_informasi.detail_informasi_id
        INNER JOIN alternatif ON detail_informasi.alternatif_id = alternatif.alternatif_id
        ORDER BY rangking.hasil_akhir DESC";

$result = $koneksi->query($sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari tabel user
    $query = "DELETE FROM rangking WHERE rangking_id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Berhasil Dihapus'); location.href='perangkingan.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data Gagal di Hapus: " . mysqli_error($koneksi) . "'); location.href='perangkingan.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perangkingan</title>
    <link rel="stylesheet" href="./assets/rangking.css">
</head>

<body>
    <header>
        <h1>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</h1>
    </header>
    <nav>
        <a href="kriteria.php">Kriteria</a>
        <a href="alternatif.php">Alternatif</a>
        <a href="nilaiAlternatif.php">Nilai Alternatif</a>
        <a href="utility.php">Nilai Utility</a>
        <a href="nilai_akhir.php">Nilai Akhir</a>
        <a href="#">Perangkingan</a>
        <a href="../login.php">Logout</a>
    </nav>
    <main>
        <div class="container">
            <section id="perangkingan" class="feature">
                <h2>Rangking Bibit Padi</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bibit</th>
                            <th>Hasil Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_bibit']); ?></td>
                                    <td><?= number_format($row['hasil_akhir'], 4); ?></td>
                                    <td>
                                        <div class="btn-group aksi">
                                            <a href="perangkingan.php?id=<?= htmlspecialchars($row['rangking_id']); ?>"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Tidak ada data</td>
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

<?php $koneksi->close(); ?>