<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    $query = "SELECT user_id, role FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['user_id']; // Simpan user_id ke session
        $_SESSION['username'] = $username;      // Simpan username jika diperlukan
        $_SESSION['peran'] = $user['role'];    // Simpan role ke session

        // Redirect berdasarkan peran (role)
        if ($user['role'] === 'Admin') {
            header("Location: ./admin/kriteria.php");
        } elseif ($user['role'] === 'Visitor') {
            header("Location: ./visitor/index.php");
        } else {
            echo "Peran tidak dikenal.";
        }
        exit();
    } else {
        $error = "Login gagal. Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/login.css">
</head>

<body>
    <div class="container">

        <!-- Right Section (Login Form) -->
        <div class="right-section">
            <div class="form-container">
                <h2>Welcome Back!</h2>
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="input-group">
                        <label for="login-username">Username</label>
                        <input type="text" id="login-username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="input-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                    <p class="sign-up"><a href="sign_up.php">Sign Up?</a></p>
                </form>
            </div>
        </div>

        <!-- Left Section (Login Image and Welcome Back) -->
        <div class="left-section">
            <h1>WELCOME BACK!</h1>
            <div class="image"></div>
        </div>
    </div>
</body>

</html>