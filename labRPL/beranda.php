<?php
include_once 'koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$menuItems = array('Shop', 'Massage', 'Payment');
$productList = array(
    array('id' => 1, 'name' => 'Laptop', 'price' => 1200, 'image' => 'laptop.jpg'),
    array('id' => 2, 'name' => 'Smartphone', 'price' => 800, 'image' => 'smartphone.jpg'),
    array('id' => 3, 'name' => 'Headphones', 'price' => 100, 'image' => 'headphones.jpg'),
    array('id' => 4, 'name' => 'Wireless Mouse', 'price' => 25, 'image' => 'mouse.jpg'),
    array('id' => 5, 'name' => 'External Hard Drive', 'price' => 120, 'image' => 'hard_drive.jpg')
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Beranda</title>
    <link rel="stylesheet" href="style1.css">
    <!-- Tambahkan link ke CSS atau file gaya lainnya jika diperlukan -->
    
</head>
<body>
    <header>
        <h1>Welcome to Beranda, <?php echo $username; ?>!</h1>
    </header>

    <nav>
        <a href="beranda.php">Home</a>
        <?php foreach ($menuItems as $menuItem): ?>
            <a href="#"><?php echo $menuItem; ?></a>
        <?php endforeach; ?>
        <a href="login.php">Logout</a>
    </nav>

    <main>
        <h2>Menu</h2>
        <p>Choose your favorite menu:</p>
        <?php foreach ($menuItems as $menuItem): ?>
            <div class="product"><?php echo $menuItem; ?></div>
        <?php endforeach; ?>

        <h2>Product List</h2>
        <p>Explore our products:</p>
        <?php foreach ($productList as $product): ?>
            <div class="product">
                <h3><?php echo $product['name']; ?></h3>
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="100">
                <p>Price: $<?php echo $product['price']; ?></p>
                <button>Add to Cart</button>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
