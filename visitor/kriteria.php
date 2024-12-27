<?php
include "../koneksi.php";

// Query untuk tabel kriteria
$kriteria = mysqli_query($koneksi, "
    SELECT kriteria_id, kriteria, bobot, normalisasi_kriteria FROM kriteria
");

if (!$kriteria) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Query untuk tabel ketahanan_hama
$ketahananHama = mysqli_query($koneksi, "
    SELECT * FROM ketahanan_hama
");

if (!$ketahananHama) {
    die("Query gagal: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</title>
    <link rel="stylesheet" href="./assets/Kriteria.css">
</head>

<body>
    <header>
        <h1>Sistem Pendukung Keputusan - Pemilihan Bibit Padi</h1>
    </header>
    <nav>
        <a href="index.php">Homepage</a>
        <a href="#">Kriteria</a>
        <a href="alternatif.php">Alternatif</a>
        <a href="nilaiAlternatif.php">Nilai Alternatif</a>
        <a href="utility.php">Nilai Utility</a>
        <a href="nilai_akhir.php">Nilai Akhir</a>
        <a href="perangkingan.php">Perangkingan</a>
        <a href="../login.php">Logout</a>
    </nav>
    <main>
        <div class="container">
            <!-- Section Kriteria -->
            <section id="kriteria" class="feature">
                <h2>Kriteria</h2>
                <p>Kriteria untuk sistem pendukung keputusan.</p>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penentuan Kriteria</th>
                            <th>Bobot</th>
                            <th>Normalisasi Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($kriteria)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['kriteria']); ?></td>
                                <td><?= htmlspecialchars($row['bobot']); ?></td>
                                <td><?= htmlspecialchars($row['normalisasi_kriteria']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>

            <!-- Section Ketahanan Hama -->
            <section id="ketahanan_hama" class="feature">
                <h2>Ketahanan Hama</h2>
                <p>Data ketahanan hama pada bibit padi.</p>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Hama</th>
                            <th>Ketahanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($ketahananHama)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['ketahanan_hama']); ?></td>
                                <td><?= htmlspecialchars($row['normalisasi']); ?></td>
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