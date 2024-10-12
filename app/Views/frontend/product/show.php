<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    <?= esc($product['name']) ?> - Product Details
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="product-details-container">
    <div class="product-image-section">
        <img src="<?= base_url($product['image_path']) ?>" alt="<?= esc($product['name']) ?>" class="product-image">
    </div>
    <div class="product-info-section">
        <h1 class="product-name"><?= esc($product['name']); ?></h1>
        <p class="product-price">Price: ₹<?= esc($product['price']); ?></p>
        <p class="product-quantity">Quantity Available: <?= esc($product['qty']); ?></p>
        <p class="product-alert-stock">Alert Stock: <?= esc($product['alert_stock']); ?></p>
        <p class="product-description"><?= esc($product['description']); ?></p>

        <!-- Quantity input field -->
        <div class="product-quantity-section">
            <label for="qty">Quantity:</label>
            <input type="number" id="qty" name="qty" value="1" min="1" max="<?= esc($product['qty']); ?>" class="product-quantity-input">
        </div>

        <!-- Add to Cart and Buy Now buttons -->
        <div class="product-actions">
            <a href="/frontend/cart/add/<?= $product['id'] ?>?qty=" class="btn btn-add-cart" 
               onclick="this.href += document.getElementById('qty').value">Add to Cart</a>

               <a href="/frontend/order/confirmation/<?= $product['id'] ?>" class="btn btn-buy-now">Buy Now</a>
               <a href="<?= base_url('frontend/order/confirmation/' . $product['id']); ?>">View Confirmation</a>



        </div>
    </div>
</div>


<style>
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    /* Product Details Section */
    .product-details-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @media (min-width: 768px) {
        .product-details-container {
            flex-direction: row;
            justify-content: space-between;
        }
    }

    .product-image-section {
        flex: 1;
        padding-right: 20px;
        text-align: center;
    }

    .product-image {
        width: 100%;
        max-width: 400px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .product-info-section {
        flex: 2;
        padding-left: 20px;
    }

    .product-name {
        font-size: 2em;
        margin-bottom: 10px;
        color: #333;
    }

    .product-price {
        font-size: 1.5em;
        margin-bottom: 15px;
        color: #28a745;
        font-weight: bold;
    }

    .product-quantity,
    .product-alert-stock,
    .product-description {
        margin-bottom: 15px;
        font-size: 1em;
        color: #555;
    }

    /* Button Styling */
    .product-actions {
        margin-top: 20px;
        display: flex;
        gap: 20px;
    }

    .btn {
        display: inline-block;
        padding: 12px 30px;
        font-size: 16px;
        text-align: center;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-add-cart {
        background-color: #00aaff;
    }

    .btn-add-cart:hover {
        background-color: #0077cc;
    }

    .btn-buy-now {
        background-color: #28a745;
    }

    .btn-buy-now:hover {
        background-color: #218838;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .product-info-section {
            padding-left: 0;
            padding-top: 20px;
        }

        .product-details-container {
            flex-direction: column;
        }

        .product-actions {
            flex-direction: column;
        }
    }
</style>

<?= $this->endSection() ?>
