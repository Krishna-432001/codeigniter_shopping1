<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    Cart
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Your Cart</h2>
    <?php if (!empty($cart) && is_array($cart)): ?>
        <div class="row">
            <?php foreach ($cart as $productId => $item): ?>
                <div class="col-md-3">
                    <div class="cart-card">
                        <a href="<?= site_url('product_detail/' . $productId) ?>" class="cart-link">
                            <img src="<?= base_url($item['image_path']) ?>" alt="<?= esc($item['name']) ?>" class="cart-image">
                            <h4><?= esc($item['name']) ?></h4>
                            <p>Price: $<?= number_format($item['price'], 2) ?></p>
                            <p>Quantity: <?= esc($item['quantity']) ?></p>
                            <p>Total: $<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                        </a>
                        <form action="<?= site_url('cart/remove') ?>" method="POST">
                            <input type="hidden" name="product_id" value="<?= esc($productId) ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="cart-summary">
            <h4>Cart Summary</h4>
            <p>Total Items: <?= count($cart) ?></p>
            <p>Total Price: $<?= number_format(array_sum(array_column($cart, 'total')), 2) ?></p>
            <form action="<?= site_url('checkout') ?>" method="POST">
                <button type="submit" class="btn btn-success">Proceed to Checkout</button>
            </form>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<style>
    .cart-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        transition: transform 0.2s;
    }

    .cart-card:hover {
        transform: scale(1.05);
    }

    .cart-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .cart-summary {
        margin-top: 20px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
</style>

<?= $this->endSection() ?>
