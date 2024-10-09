<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    Products
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Product List</h2>
    <div class="row">
        <?php if (!empty($products) && is_array($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3">
                    <div class="product-card">
                        <a href="<?= site_url('show/' . $product['id']) ?>" class="product-link">
                            <img src="<?= base_url($product['image_path']) ?>" alt="<?= esc($product['name']) ?>" class="product-image">
                            <h4><?= esc($product['name']) ?></h4>
                            <p>Price: $<?= number_format($product['price'], 2) ?></p>
                            <p>Quantity: <?= esc($product['qty']) ?></p>
                            <p><?= esc($product['description']) ?></p>
                        </a>
                        <form action="<?= site_url('cart/add/' . $product['id']) ?>" method="post">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>

<style>
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
        background: rgba(255, 255, 255, 0.1);
        border-radius: 5px; /* Adjusted to a visible value */
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

<?= $this->endSection() ?>
