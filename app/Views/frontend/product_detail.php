<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    <?= esc($product['name']) ?> - Product Details
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url($product['image_path']) ?>" alt="<?= esc($product['name']) ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?= esc($product['name']) ?></h2>
            <p>Price: $<?= number_format($product['price'], 2) ?></p>
            <p>Quantity Available: <?= esc($product['qty']) ?></p>
            <p><?= esc($product['description']) ?></p>
            <button class="btn btn-primary">Add to Cart</button>
        </div>
    </div>
    <div class="mt-4">
        <a href="<?= site_url('products') ?>" class="btn btn-secondary">Back to Products</a>
    </div>
</div>

<?= $this->endSection() ?>
