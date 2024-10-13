<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
            background-color: black;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .social-media i {
        color: #000; /* Default icon color */
        margin-right: 8px;
        }

        .social-media a:nth-child(1) i {
            color: #3b5998; /* Facebook blue */
        }

        .social-media a:nth-child(2) i {
            color: #E1306C; /* Instagram pink */
        }

        .social-media a:nth-child(3) i {
            color: #1DA1F2; /* Twitter blue */
        }

        .social-media a:hover i {
            opacity: 0.8; /* Hover effect for icons */
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
        <div class="social-media">
            <a href="https://www.facebook.com" target="_blank">
                <i class="fab fa-facebook-f"></i> Facebook 
            </a>
            <a href="https://www.instagram.com" target="_blank">
                <i class="fab fa-instagram"></i> Instagram 
            </a>
            <a href="https://www.twitter.com" target="_blank">
                <i class="fab fa-twitter"></i> Twitter
            </a>
        </div>
    </div>
</footer>

</body>
</html>
