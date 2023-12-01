<?php
session_start();
include_once 'koneksi.php'; // Include your database connection file

// Inisialisasi pesan
$message = '';

// Kode PHP untuk menangani formulir login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Lakukan validasi atau autentikasi di sini sesuai kebutuhan
    $sql = "SELECT * FROM users WHERE name = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if user exists in the database
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Autentikasi berhasil
                // Simpan informasi pengguna ke dalam sesi
                $_SESSION['username'] = $username;

                // Redirect ke halaman beranda jika login berhasil
                header("Location: beranda.php");
                exit();
            } else {
                // Autentikasi gagal (password tidak cocok)
                $message = 'Invalid username or password';
            }
        } else {
            // Autentikasi gagal (user tidak ditemukan)
            $message = 'Invalid username or password';
        }
    } else {
        // Error executing the query
        $message = 'Database error';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
    <div class="wrapper">
        <?php if ($message): ?>
            <div class="notification"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required> 
                <i class='bx bx-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me </label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>