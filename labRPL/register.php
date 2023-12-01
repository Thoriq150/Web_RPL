<?php
include_once 'koneksi.php';

$message = ''; // Inisialisasi pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hashed password
    $alamat = $_POST["alamat"];

    // Simpan data pengguna ke dalam database
    $sql = "INSERT INTO users (name, email, password, alamat) VALUES ('$username', '$email', '$password', '$alamat')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Redirect ke halaman login setelah pendaftaran berhasil
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <?php if ($message): ?>
            <div class="notification"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required> 
                <i class='bx bx-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required> 
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="input-box">
                <input type="text" name="alamat" placeholder="Alamat" required> 
                <i class='bx bx-map' ></i>
            </div>
            <button type="submit" class="btn">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
