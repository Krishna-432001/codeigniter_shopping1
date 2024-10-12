<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    Cart
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Your Cart</h2>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($carts) && is_array($carts)): ?>
        <div class="row product-list">
            <?php foreach ($cartItems as $item): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?= base_url('uploads/products/' . $item['image_path']); ?>" alt="<?= esc($item['product_name']); ?>" width="100" />
                    </div>
                    <div class="product-info">
                        <h3><?= esc($item['product_name']); ?></h3>
                        <p>Price: $<?= number_format($item['price'], 2); ?></p>
                        <p>Quantity: <?= esc($item['quantity']); ?></p>
                        <form action="<?= site_url('cart/remove/' . $item['product_id']); ?>" method="POST">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h4>Cart Summary</h4>
            <p>Total Items: <?= count($carts); ?></p>
            <p>Total Price: $<?= number_format(array_sum(array_column($cartItems, 'price')), 2); ?></p>
            <a href="<?= site_url('frontend/cart/clear'); ?>" class="btn btn-warning">Clear Cart</a>
            <a href="<?= site_url('checkout'); ?>" class="btn btn-success">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<style>
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
        width: 200px; /* Set a fixed width for the card */
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .product-image {
        width: 100%;
        height: 150px;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Ensure the image fits within the card */
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

    .cart-summary {
        margin-top: 20px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
</style>

<?= $this->endSection() ?>
