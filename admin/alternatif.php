<?php
include "../koneksi.php";

$alternatif = mysqli_query($koneksi, "
    SELECT * FROM alternatif
");

if (!$alternatif) {
    die("Query gagal: " . mysqli_error($koneksi));
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari tabel user
    $query = "DELETE FROM alternatif WHERE alternatif_id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Berhasil Dihapus'); location.href='alternatif.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data Gagal di Hapus: " . mysqli_error($koneksi) . "'); location.href='alternatif.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</title>
    <link rel="stylesheet" href="./assets/alternatif.css">
</head>

<body>
    <header>
        <h1>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</h1>
    </header>
    <nav>
        <a href="kriteria.php">Kriteria</a>
        <a href="#">Alternatif</a>
        <a href="nilaiAlternatif.php">Nilai Alternatif</a>
        <a href="utility.php">Nilai Utility</a>
        <a href="nilai_akhir.php">Nilai Akhir</a>
        <a href="perangkingan.php">Perangkingan</a>
        <a href="../login.php">Logout</a>
    </nav>
    <main>
        <div class="container">
            <section id="alternatif" class="feature">
                <h2>Alternatif</h2>
                <p>Kelola data alternatif bibit padi.</p>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($alternatif)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama_bibit']); ?></td>
                                <td>
                                    <div class="btn-group aksi">
                                        <!-- Tombol Edit -->
                                        <a href="edit/editAlternatif.php?id=<?= htmlspecialchars($row['alternatif_id']); ?>">Edit</a>
                                        <!-- Tombol Delete -->
                                        <a href="alternatif.php?id=<?= htmlspecialchars($row['alternatif_id']); ?>"
                                            onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini?')">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
            <div class="tambah">
                <a href="tambah/tambahAlternatif.php">Tambah Data Alternatif</a>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Sistem Pendukung Keputusan</p>
    </footer>
</body>

</html>