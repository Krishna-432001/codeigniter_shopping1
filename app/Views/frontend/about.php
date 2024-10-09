<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
   About Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }

        header nav ul {
            list-style: none;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .hero {
            background: url('path/to/hero-image.jpg') no-repeat center center/cover;
            color: #fff;
            padding: 100px 20px;
            text-align: center;
        }

        .brand-story, .mission-values, .team, .testimonials, .cta {
            padding: 40px 20px;
            text-align: center;
        }

        .team-member {
            display: inline-block;
            margin: 20px;
            width: 200px;
        }

        .team-member img {
            width: 100%;
            border-radius: 50%;
        }

        .testimonials blockquote {
            font-style: italic;
            margin: 20px;
        }

        .cta .btn {
            background: #007BFF;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   
 <section class="hero">
        <h1>Our Journey</h1>
        <p>Discover our story and the values that drive us.</p>
    </section>

    <section class="brand-story">
        <h2>About Us</h2>
        <p>We are a passionate team dedicated to bringing you the best shopping experience. Our journey began in 2020...</p>
        <img src="path/to/image.jpg" alt="Our Journey">
    </section>

    <section class="mission-values">
        <h2>Our Mission & Values</h2>
        <ul>
            <li><strong>Quality:</strong> We believe in offering the best products.</li>
            <li><strong>Customer Satisfaction:</strong> Your happiness is our priority.</li>
            <li><strong>Innovation:</strong> We strive to bring you the latest trends.</li>
        </ul>
    </section>

    <section class="team">
        <h2>Meet Our Team</h2>
        <div class="team-member">
            <img src="path/to/member1.jpg" alt="Team Member 1">
            <h3>John Doe</h3>
            <p>Founder & CEO</p>
        </div>
        <div class="team-member">
            <img src="path/to/member2.jpg" alt="Team Member 2">
            <h3>Jane Smith</h3>
            <p>Marketing Head</p>
        </div>
        <!-- Add more team members as needed -->
    </section>

    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <blockquote>"This is the best shopping experience I've ever had!" - Customer A</blockquote>
        <blockquote>"Fantastic products and great service." - Customer B</blockquote>
    </section>

    <section class="cta">
        <h2>Join Us on Our Journey</h2>
        <a href="#" class="btn">Shop Now</a>
    </section>
</body>
</html>

<?= $this->endSection() ?>
