<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .buy-now-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-summary {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #f1f1f1;
        }
        .qr-code-section {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="buy-now-container">
    <h1 class="text-center">Order Confirmation</h1>

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
            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Phone Input -->
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" class="form-control" required pattern="[0-9]{10}">
        </div>

        <!-- Razorpay Payment Button -->
        <button id="pay-btn">Pay Now</button>        

        <!-- Submit Button to Complete Payment -->
        <button type="submit" class="btn btn-primary btn-block">Complete Payment</button>
    </form>

    <!-- QR Code Section for UPI Payment -->
    <div class="qr-code-section">
        <h3>Pay via UPI</h3>
       
</div>

<script>
        document.getElementById('pay-btn').onclick = function() {
            console.log("WOrking");
            
            fetch('<?= base_url('frontend/order/create') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.order_id) {
                    var options = {
                        key: 'YOUR_RAZORPAY_KEY_ID', // Your Razorpay key
                        amount: 50000, // Amount in paise
                        currency: 'INR',
                        name: 'Krishna Info Tech',
                        description: 'Test Transaction',
                        order_id: data.order_id, // Use the response order_id
                        handler: function (response){
                            alert('Payment Successful! Payment ID: ' + response.razorpay_payment_id);
                        },
                        prefill: {
                            name: 'Customer Name',
                            email: 'customer@example.com',
                            contact: '9999999999'
                        },
                        notes: {
                            address: 'Customer Address'
                        },
                        theme: {
                            color: '#F37254'
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                } else if (data.error) {
                    alert('Error: ' + data.error);
                }
            });
        };
    </script>

<!-- Bootstrap JS (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
