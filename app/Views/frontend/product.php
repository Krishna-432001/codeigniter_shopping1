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
                    <a href="<?= site_url('product/detail/' . $product['id']) ?>" class="product-link">
                        <img src="<?= base_url($product['image_path']) ?>" alt="<?= esc($product['name']) ?>" class="product-image">
                        <h4><?= esc($product['name']) ?></h4>
                        <p>Price: $<?= number_format($product['price'], 2) ?></p>
                        <p>Quantity: <?= esc($product['qty']) ?></p>
                        <p><?= esc($product['description']) ?></p>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .product-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
        margin-bottom: 20px;
        background-color: #fff;
    }
    .product-image {
        max-width: 100%;
        height: auto;
    }

    .product-link {
        text-decoration: none;
        color: inherit;
    }
</style>

<?= $this->endSection() ?>
