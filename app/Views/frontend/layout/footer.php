<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Basic styles for body and main content */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes full viewport height */
            margin: 0;
        }
        .content {
            flex: 1; /* Allow content to grow and push footer down */
        }
        footer {
            background-color: green;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="content">
    <!-- Your main content here -->
</div>

<footer>
    <div style="max-width: 1200px; margin: 0 auto;">
        <p style="margin: 0;">&copy; <?= date('Y') ?> Your Website Name. All rights reserved.</p>
        <ul style="list-style-type: none; padding: 0; display: flex; justify-content: center; margin: 10px 0;">
            <li style="margin: 0 15px;">
                <a href="<?= base_url('privacy-policy') ?>" style="color: white; text-decoration: none;">Privacy Policy</a>
            </li>
            <li style="margin: 0 15px;">
                <a href="<?= base_url('terms-of-service') ?>" style="color: white; text-decoration: none;">Terms of Service</a>
            </li>
            <li style="margin: 0 15px;">
                <a href="<?= base_url('contact') ?>" style="color: white; text-decoration: none;">Contact Us</a>
            </li>
        </ul>
        <div style="margin-top: 10px;">
            <a href="#" style="color: white; margin: 0 10px;">Facebook</a>
            <a href="#" style="color: white; margin: 0 10px;">Twitter</a>
            <a href="#" style="color: white; margin: 0 10px;">Instagram</a>
        </div>
    </div>
</footer>

</body>
</html>
