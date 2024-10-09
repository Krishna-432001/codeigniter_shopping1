<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
   Service Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">ShopLogo</div>
    
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Our Premium Services</h1>
        <p>We offer a range of services to enhance your shopping experience.</p>
    </section>

    <!-- Services Section -->
    <section class="services">
        <h2>What We Offer</h2>
        <div class="service-grid">
            <div class="service-card">
                <img src="path/to/image1.jpg" alt="Service 1">
                <h3>Fast Delivery</h3>
                <p>Get your orders delivered to your doorstep within 24 hours.</p>
            </div>
            <div class="service-card">
                <img src="path/to/image2.jpg" alt="Service 2">
                <h3>24/7 Customer Support</h3>
                <p>We're always here to help you with any queries or issues.</p>
            </div>
            <div class="service-card">
                <img src="path/to/image3.jpg" alt="Service 3">
                <h3>Secure Payments</h3>
                <p>Safe and reliable payment methods to ensure secure transactions.</p>
            </div>
            <div class="service-card">
                <img src="path/to/image4.jpg" alt="Service 4">
                <h3>Easy Returns</h3>
                <p>Hassle-free returns within 30 days of purchase.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <blockquote>"Excellent delivery speed and amazing customer support!" - Customer A</blockquote>
        <blockquote>"Secure payments and trustworthy service, highly recommend!" - Customer B</blockquote>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <h2>Experience Our Services</h2>
        <a href="#" class="btn">Get Started</a>
    </section>

    
</body>
</html>

<?= $this->endSection() ?>
