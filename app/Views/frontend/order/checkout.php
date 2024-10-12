<div class="buy-now-container">
    <h1>Buy Now</h1>
    
    <div class="product-summary">
        <h3>Product: <?= esc($product['name']); ?></h3>
        <p>Price: ₹<?= esc($product['price']); ?></p>
    </div>

    <!-- Payment Form -->
    <form action="<?= base_url('order/processPayment') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Address Input -->
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
        </div>

        <!-- Phone Input -->
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}">
        </div>

        <!-- Razorpay Payment Button -->
        <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="your_razorpay_key"  <!-- Replace with your Razorpay Key -->
            data-amount="<?= $product['price'] * 100 ?>"  <!-- Amount in paise -->
            data-currency="INR"
            data-order_id="<?= $order_id ?>"  <!-- Pass the generated order ID -->
            data-buttontext="Pay with Razorpay"
            data-name="<?= esc($product['name']); ?>"
            data-description="Purchase Product"
            data-image="<?= base_url($product['image_path']) ?>"
            data-prefill.name="<?= esc($user_name); ?>" <!-- Optionally autofill user info -->
            data-prefill.email="<?= esc($user_email); ?>"
            data-theme.color="#F37254">
        </script>

        <!-- Submit Button to complete payment -->
        <button type="submit" class="btn btn-primary">Complete Payment</button>
    </form>

    <!-- QR Code Section for UPI Payment -->
    <div class="qr-code-section">
        <h3>Pay via UPI</h3>
        <img src="<?= base_url('path_to_generated_qr_code') ?>" alt="QR Code for UPI Payment">
    </div>
</div>
