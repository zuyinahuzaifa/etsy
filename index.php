<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Platform</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            line-height: 1.6;
            background-color: #f4f4f4;
        }

        /* Header styles */
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        nav {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Main content styles */
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        main h2 {
            color: #2c3e50;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2rem;
        }

        /* Product grid */
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .product {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .product:hover {
            transform: translateY(-5px);
        }

        .product h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .product p {
            color: #3498db;
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            header {
                text-align: center;
            }

            nav {
                justify-content: center;
            }

            .product-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 1.5rem;
            }

            .product {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome to Our E-Commerce Store</h1>
    <nav>
        <?php if (isset($_SESSION["user_id"])) { ?>
            <a href="dashboard.php" class="btn">Dashboard</a>
            <a href="cart.php" class="btn">Cart</a>
            <a href="order_item.php" class="btn">Orders</a>
            <a href="logout.php" class="btn">Logout</a>
        <?php } else { ?>
            <a href="signup.php" class="btn">Signup</a>
            <a href="login.php" class="btn">Login</a>
        <?php } ?>
    </nav>
</header>
<main>
    <h2>Our Products</h2>
    <div class="product-container">
        <?php
        $products = $conn->query("SELECT * FROM products");
        while ($product = $products->fetch_assoc()) {
        ?>
            <div class="product">
                <h3><?php echo $product["name"]; ?></h3>
                <p>$<?php echo number_format($product["price"], 2); ?></p>
                <a href="add_cart.php?id=<?php echo $product['id']; ?>" class="btn">Add to Cart</a>
            </div>
        <?php } ?>
    </div>
</main>
</body>
</html>
