<?php
include '../../koneksi.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM kriteria WHERE kriteria_id = $id";
    $result = mysqli_query($koneksi, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        // Simpan nilai lama dari database
        $kriteria = $row['kriteria'];
        $bobot = $row['bobot'];
        $normalisasi = $row['normalisasi_kriteria'];
    } else {
        header("Location: ../kriteria.php");
        exit();
    }
}

$errorKriteria = $errorBobot = $errorNormalisasi = "";
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $kriteria = trim($_POST['kriteria']);
    $bobot = trim($_POST['bobot']);
    $normalisasi = trim($_POST['normalisasi']);

    if (empty($kriteria)) {
        $errorKriteria = "Tidak Boleh Kosong.";
    }
    if (empty($bobot)) {
        $errorBobot = "Tidak Boleh Kosong.";
    }
    if (empty($normalisasi)) {
        $errorNormalisasi = "Tidak Boleh Kosong.";
    }
    // Jika tidak ada error, lakukan update
    if (empty($errorKriteria) && empty($errorBobot) && empty($errorNormalisasi)) {
        $query = "UPDATE kriteria SET kriteria = '$kriteria', bobot = '$bobot', normalisasi_kriteria = '$normalisasi' WHERE kriteria_id = '$id'";
        if (mysqli_query($koneksi, $query)) {
            header("Location: ../kriteria.php"); // Redirect setelah berhasil
            exit();
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kriteria</title>
    <link rel="stylesheet" href="../assets/editKriteria.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Edit Data Alternatif</h2>
        <form action="" method="post">
            <label for="kriteria">Penentuan Kriteria</label><br>
            <input type="text" id="kriteria" name="kriteria" placeholder="Masukkan Penentuan Kriteria" value="<?= $kriteria; ?>" class="input-box">

            <label for="bobot">Bobot</label><br>
            <input type="number" id="bobot" name="bobot" placeholder="Masukkan Bobot" value="<?= $bobot; ?>" class="input-box">

            <label for="normalisasi">Normalisasi Bobot</label><br>
            <input type="text" id="normalisasi" name="normalisasi" placeholder="Masukkan Normalisasi Bobot" value="<?= $normalisasi; ?>" class="input-box">

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger">
                    <a href="../Kriteria.php">Cancel</a>
                </button>
            </div>
        </form>
    </div>
</body>

</html>