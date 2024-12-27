<?php
include '../../koneksi.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM alternatif WHERE alternatif_id = $id";
    $result = mysqli_query($koneksi, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        // Simpan nilai lama dari database
        $nama = $row['nama_bibit'];
    } else {
        header("Location: ..alternatif.php");
        exit();
    }
}

$errorNama = "";
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nama = trim($_POST['nama']);

    if (empty($nama)) {
        $errorNama = "Tidak Boleh Kosong.";
    }
    // Jika tidak ada error, lakukan update
    if (empty($errorNama)) {
        $query = "UPDATE alternatif SET nama_bibit = '$nama' WHERE alternatif_id = '$id'";
        if (mysqli_query($koneksi, $query)) {
            header("Location: ../alternatif.php"); // Redirect setelah berhasil
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
    <title>Edit Data Alternatif</title>
    <link rel="stylesheet" href="../assets/editAlternatif.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Edit Data Alternatif</h2>
        <form action="" method="post">
            <label for="nama">Nama Bibit</label><br>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Bibit" value="<?= $nama; ?>" class="input-box">

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger">
                    <a href="alternatif.php">Cancel</a>
                </button>
            </div>
        </form>
    </div>
</body>

</html>