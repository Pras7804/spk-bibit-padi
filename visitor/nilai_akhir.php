<?php
include "../koneksi.php";

// Ambil data normalisasi kriteria
$kriteriaQuery = "SELECT kriteria_id, normalisasi_kriteria FROM kriteria";
$kriteriaResult = $koneksi->query($kriteriaQuery);

$normalisasiKriteria = [];
while ($row = $kriteriaResult->fetch_assoc()) {
    $normalisasiKriteria[$row['kriteria_id']] = $row['normalisasi_kriteria'];
}

// Ambil data dari tabel nilai_utility
$utilityQuery = "SELECT * FROM nilai_utility";
$utilityResult = $koneksi->query($utilityQuery);


// Ambil data hasil dari tabel rangking untuk ditampilkan, diurutkan secara ascending berdasarkan hasil_akhir
$rangkingQuery = "
    SELECT r.hasil_akhir, 
           u.nilai_umur_padi, 
           u.nilai_tinggi_padi, 
           u.nilai_ketahanan_hama, 
           u.nilai_rata_hasil, 
           a.nama_bibit
    FROM rangking r
    JOIN nilai_utility u ON r.utility_id = u.utility_id
    JOIN detail_informasi d ON u.detail_informasi_id = d.detail_informasi_id
    JOIN alternatif a ON d.alternatif_id = a.alternatif_id 
    
";

$rangkingResult = $koneksi->query($rangkingQuery);

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Nilai Akhir</title>
    <link rel="stylesheet" href="./assets/perangkingan.css">
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
        <a href="utility.php">Nilai Utility</a>
        <a href="#">Nilai Akhir</a>
        <a href="perangkingan.php">Perangkingan</a>
        <a href="../login.php">Logout</a>
    </nav>
    <main>
        <div class="container">
            <section id="perangkingan" class="feature">
                <h2>Hasil Nilai Akhir</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Bibit</th>
                            <th>Hasil Perhitungan Umur Tanaman</th>
                            <th>Hasil Perhitungan Tinggi Tanaman</th>
                            <th>Hasil Perhitungan Ketahanan Hama</th>
                            <th>Hasil Perhitungan Rata-rata Hasil</th>
                            <th>Hasil Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($rangkingResult->num_rows > 0) {
                            while ($row = $rangkingResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['nama_bibit'] . "</td>";
                                echo "<td>" . number_format($row['nilai_umur_padi'] * $normalisasiKriteria[1], 4) . "</td>";
                                echo "<td>" . number_format($row['nilai_tinggi_padi'] * $normalisasiKriteria[2], 4) . "</td>";
                                echo "<td>" . number_format($row['nilai_ketahanan_hama'] * $normalisasiKriteria[3], 4) . "</td>";
                                echo "<td>" . number_format($row['nilai_rata_hasil'] * $normalisasiKriteria[4], 4) . "</td>";
                                echo "<td>" . number_format($row['hasil_akhir'], 4) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data tersedia</td></tr>";
                        }
                        ?>
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