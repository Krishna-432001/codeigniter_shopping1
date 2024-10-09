<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
   Contact  Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

header {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

header nav ul li {
    display: inline;
    margin-right: 20px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
}

/* Hero Section */
.hero {
    background-color: #007BFF;
    color: white;
    padding: 60px 20px;
    text-align: center;
}

.hero h1 {
    font-size: 2.5em;
}

.hero p {
    font-size: 1.2em;
}

/* Contact Section */
.contact {
    padding: 40px 20px;
    display: flex;
    justify-content: space-around;
}

.contact-container {
    display: flex;
    justify-content: space-between;
    width: 80%;
    margin: 0 auto;
}

.contact-info, .business-info {
    width: 45%;
}

.contact-info form {
    display: flex;
    flex-direction: column;
}

.contact-info h2, .business-info h2 {
    font-size: 2em;
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-size: 1.2em;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 1em;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.btn {
    padding: 10px 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    font-size: 1em;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

/* Business Info */
.business-info p {
    font-size: 1.2em;
    margin: 10px 0;
}

.social-media a {
    color: #007BFF;
    text-decoration: none;
    margin-right: 15px;
}

.social-media a:hover {
    text-decoration: underline;
}

/* Map Section */
.map {
    padding: 40px 20px;
    text-align: center;
}

.map h2 {
    font-size: 2em;
}

.map-container {
    margin-top: 20px;
}

/* Footer */
footer {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
}

footer .social-media a {
    color: white;
    margin: 0 10px;
    text-decoration: none;
}

    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">ShopLogo</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Contact Us</h1>
        <p>We’re here to assist you. Reach out to us via the form below or visit our office.</p>
    </section>

    <!-- Contact Form Section -->
    <section class="contact">
        <div class="contact-container">
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div>

            <!-- Business Info Section -->
            <div class="business-info">
                <h2>Contact Information</h2>
                <p><strong>Address:</strong> cuddalore</p>
                <p><strong>Phone:</strong> +91 9788109122</p>
                <p><strong>Email:</strong> info@shoppingwebsite.com</p>
                <h3>Follow Us</h3>
                <div class="social-media">
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                <a href="https://www.twitter.com" target="_blank">Twitter</a>

                </div>
            </div>
        </div>
    </section>

    <!-- Google Map Embed (Optional) -->
    <section class="map">
        <h2>Visit Us</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=YOUR_GOOGLE_MAP_EMBED_LINK" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>



</body>
</html>

<?= $this->endSection() ?>
