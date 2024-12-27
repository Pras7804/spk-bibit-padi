<?php
include "../koneksi.php";

// Ambil semua data dari tabel detail_informasi dengan join ke ketahanan_hama
$query = "SELECT di.umur_padi, di.tinggi_padi, kh.normalisasi AS ketahanan_hama, di.rata_hasil, di.detail_informasi_id
          FROM detail_informasi di
          JOIN ketahanan_hama kh ON di.ketahanan_hama_id = kh.ketahanan_hama_id
          WHERE di.detail_informasi_id NOT IN (SELECT detail_informasi_id FROM nilai_utility)
          ORDER BY di.detail_informasi_id";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Jika tidak ada data baru, hentikan proses
if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('Semua data sudah terhitung. Tidak ada data baru untuk diproses.'); location.href='utility.php';</script>";
    exit;
}

// Ambil cmax dan cmin untuk setiap kolom
$cmax_cmin_query = "SELECT 
                        MAX(umur_padi) AS max_umur, MIN(umur_padi) AS min_umur, 
                        MAX(tinggi_padi) AS max_tinggi, MIN(tinggi_padi) AS min_tinggi, 
                        MAX(kh.normalisasi) AS max_ketahanan, MIN(kh.normalisasi) AS min_ketahanan,
                        MAX(rata_hasil) AS max_hasil, MIN(rata_hasil) AS min_hasil
                    FROM detail_informasi di
                    JOIN ketahanan_hama kh ON di.ketahanan_hama_id = kh.ketahanan_hama_id";

$cmax_cmin_result = mysqli_query($koneksi, $cmax_cmin_query);
if (!$cmax_cmin_result) {
    die("Query cmax_cmin gagal: " . mysqli_error($koneksi));
}

$cmax_cmin = mysqli_fetch_assoc($cmax_cmin_result);

// Inisialisasi nilai cmax dan cmin
$cmax_umur = $cmax_cmin['max_umur'];
$cmin_umur = $cmax_cmin['min_umur'];
$cmax_tinggi = $cmax_cmin['max_tinggi'];
$cmin_tinggi = $cmax_cmin['min_tinggi'];
$cmax_ketahanan = $cmax_cmin['max_ketahanan'];
$cmin_ketahanan = $cmax_cmin['min_ketahanan'];
$cmax_hasil = $cmax_cmin['max_hasil'];
$cmin_hasil = $cmax_cmin['min_hasil'];

// Proses perhitungan dan penyimpanan nilai utility
while ($row = mysqli_fetch_assoc($result)) {
    $detail_id = $row['detail_informasi_id'];
    $umur_padi = $row['umur_padi'];
    $tinggi_padi = $row['tinggi_padi'];
    $ketahanan_hama = $row['ketahanan_hama'];
    $rata_hasil = $row['rata_hasil'];

    // Hitung nilai utility berdasarkan rumus
    $nilai_umur_padi = ($cmax_umur - $umur_padi) / ($cmax_umur - $cmin_umur);
    $nilai_tinggi_padi = ($tinggi_padi - $cmin_tinggi) / ($cmax_tinggi - $cmin_tinggi);
    $nilai_ketahanan_hama = ($ketahanan_hama - $cmin_ketahanan) / ($cmax_ketahanan - $cmin_ketahanan);

    // Pastikan tidak ada pembagian dengan nol untuk rata_hasil
    if ($cmax_hasil !== $cmin_hasil) {
        $nilai_rata_hasil = ($rata_hasil - $cmin_hasil) / ($cmax_hasil - $cmin_hasil);
    } else {
        // Jika semua nilai rata_hasil sama, atur default nilai 0
        $nilai_rata_hasil = 0;
    }

    // Masukkan ke dalam tabel utility
    $insert_query = "INSERT INTO nilai_utility (nilai_umur_padi, nilai_tinggi_padi, nilai_ketahanan_hama, nilai_rata_hasil, detail_informasi_id) 
                     VALUES ('$nilai_umur_padi', '$nilai_tinggi_padi', '$nilai_ketahanan_hama', '$nilai_rata_hasil', '$detail_id')";

    if (!mysqli_query($koneksi, $insert_query)) {
        die("Gagal menyimpan data utility: " . mysqli_error($koneksi));
    }
}

$koneksi->close();
echo "<script>alert('Perhitungan dan penyimpanan nilai utility selesai.'); location.href='utility.php';</script>";
