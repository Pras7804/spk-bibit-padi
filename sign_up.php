<?php
include 'koneksi.php';

$error = "";
$username = $nama = $email = $password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $peran = "Visitor"; // Default role

    if (preg_match('/\s/', $username)) {
        $error = "Username tidak boleh mengandung spasi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
    } elseif (strlen($password) < 8) {
        $error = "Password harus memiliki minimal 8 karakter.";
    } else {
        $password = md5($password);

        $query_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $result_check = mysqli_query($koneksi, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            $error = "Username atau email sudah terdaftar. Silakan gunakan yang lain.";
        } else {
            $query_users = "INSERT INTO users (username, nama, email, password, role) 
                            VALUES ('$username', '$nama', '$email', '$password', '$peran')";
            if (!mysqli_query($koneksi, $query_users)) {
                $error = "Error saat menambahkan user: " . mysqli_error($koneksi);
            } else {
                header("Location: login.php");
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./assets/sign_up.css">
</head>

<body>
    <div class="container">
        <!-- Left Section (Image and Welcome Message) -->
        <div class="left-section">
            <h1>WELCOME</h1>
            <div class="image"></div>
        </div>

        <!-- Right Section (Sign Up Form) -->
        <div class="right-section">
            <div class="form-container">
                <h2>Hello!<br>We are glad to see you :)</h2>
                <?php if ($error): ?>
                    <div class="error-message">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required value="<?php echo htmlspecialchars($username); ?>">
                    </div>
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="nama" placeholder="Enter your name" required value="<?php echo htmlspecialchars($nama); ?>">
                    </div>
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="agree" required>
                        <label for="agree">I agree <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    <button type="submit" class="signup-btn">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>