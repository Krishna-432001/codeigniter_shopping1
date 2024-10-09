<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    <?= esc($product['name']) ?> - Product Details
<?= $this->endSection() ?>

<?= $this->section('content') ?>
echo route_to('home.show', 1);

    <div class="product-details">
            <p><strong>Name:</strong> <?= esc($product['name']); ?></p>
            <p><strong>Price:</strong> <?= esc($product['price']); ?></p>
            <p><strong>Description:</strong> <?= esc($product['description']); ?></p>
            <p><strong>Quantity Available:</strong> <?= esc($product['qty']); ?></p>
            <p><strong>Alert Stock:</strong> <?= esc($product['alert_stock']); ?></p>
            <p><strong>Image:</strong> <img src="<?= esc($productImagePath); ?>" alt="<?= esc($product['name']); ?>" width="150"></p>
        </div>

        <h2>Category</h2>
        <div class="category-details">
            <p><strong>Category Name:</strong> <?= esc($category['name']); ?></p>
            <p><strong>Category Description:</strong> <?= esc($category['description']); ?></p>
        </div>

        <h2>Brand</h2>
        <div class="brand-details">
            <p><strong>Brand Name:</strong> <?= esc($brand['name']); ?></p>
            <p><strong>Brand Description:</strong> <?= esc($brand['description']); ?></p>
        </div>
<?= $this->endSection() ?>
