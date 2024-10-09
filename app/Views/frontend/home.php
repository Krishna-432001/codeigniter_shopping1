<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
   Ecommerce Website Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Home</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            color: #fff;
            background: url('<?= base_url('images/ecom.jpg') ?>') no-repeat center center fixed;
            background-size: cover; /* Ensure the image covers the entire area */
        }

        /* Glass Effect Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .navbar a:hover {
            color: #00aaff;
        }

        .container {
            width: 100%;
            height: auto;
            position: relative;
            margin-top: 80px; /* Adjust margin for navbar height */
            padding: 20px;
        }

        .form-container {
            width: 800px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-group input::placeholder {
            color: #ddd;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        /* Product Listing Styles */
        .product-list {
            margin-top: 20px; /* Adjust to make space for navbar */
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;

            gap: 20px; /* Space between product cards */
        }

        .product-card {
            width: 200px;
            margin: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-image {
            width: 100%;
            height: 150px;
            background-size: cover;
            background-position: center;
        }

        .product-info {
            padding: 10px;
        }

        .product-info h3 {
            margin: 0;
            font-size: 18px;
            color: #00aaff;
        }

        .product-info p {
            margin: 5px 0;
            font-size: 14px;
            color: #ddd;
        }

        .product-info .price {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2>Product Categories</h2>
            <form action="<?= base_url('submit-category') ?>" method="post">
                <?= csrf_field() ?> <!-- CSRF protection -->
                <div class="form-group">
                    <label for="category">Select Category:</label>
                    <select id="category" name="category" class="category-select">
                        <option value="" disabled selected>Select a category</option>
                        <?php if (!empty($categories)): ?>  <!-- Check if categories exist -->
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>No categories available</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>

        <!-- Product Listing Section -->
    <div class="product-list">
        <?php if (!empty($products)): ?>  <!-- Check if products exist -->
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image" style="background-image: url('<?= base_url('images/products/' . $product['image_path']) ?>');">
                        <!-- Debugging output for image URL -->
                        <p style="display: none;"><?= base_url('images/products/' . $product['image_path']) ?></p> <!-- Hidden for debugging -->
                    </div>
                    <div class="product-info">
                        <h3><?= $product['name'] ?></h3>
                        <p><?= $product['description'] ?></p>
                        <p class="price">₹<?= number_format($product['price'], 2) ?></p> <!-- Format price to two decimal places -->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?= $this->endSection() ?>
