<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
   Register Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background: #000;
            color: #fff;
        }

        /* Glass Effect Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: background 0.3s ease-in-out;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .navbar a:hover {
            color: #00aaff;
        }

        .container {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
            margin-top: 80px; /* Adjust margin for navbar height */
        }

        #imageContainer {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .image {
            width: 100%;
            height: 100vh;
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .visible {
            opacity: 1;
        }

        .form-container {
            width: 400px; /* Adjust width for registration form */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 90%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-group input::placeholder {
            color: #ddd;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        .toggle-btn {
            text-align: center;
            margin-top: 15px;
            cursor: pointer;
            color: #00aaff;
            transition: color 0.3s ease-in-out;
        }

        .toggle-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container" id="imageContainer"></div>

    <div class="form-container">
        <h2>Register</h2>
        <form action="<?= base_url('register') ?>" method="post">
            <?= csrf_field() ?> <!-- CSRF protection -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <div class="toggle-btn">
                <a href="<?= base_url('login') ?>">Already have an account? Login here</a>
            </div>
        </form>
    </div>

    <script>
        // Image Scrolling Logic
        const imagePaths = [
            "<?= base_url('images/image1.jpg') ?>",
            "<?= base_url('images/image2.jpg') ?>",
            "<?= base_url('images/image3.jpg') ?>"
        ];

        const container = document.getElementById('imageContainer');

        let currentIndex = 0;

        imagePaths.forEach((path, index) => {
            const imageDiv = document.createElement('div');
            imageDiv.classList.add('image');
            if (index === 0) {
                imageDiv.classList.add('visible');
            }
            imageDiv.style.backgroundImage = `url('${path}')`;
            container.appendChild(imageDiv);
        });

        const images = document.querySelectorAll('.image');

        container.addEventListener('click', (e) => {
            const y = e.clientY;
            const halfHeight = window.innerHeight / 2;

            if (y < halfHeight) {
                transitionToPreviousImage();
            } else {
                transitionToNextImage();
            }
        });

        window.addEventListener('wheel', (e) => {
            const delta = e.deltaY;

            if (delta > 0) {
                transitionToNextImage();
            } else if (delta < 0) {
                transitionToPreviousImage();
            }
        });

        let startY = 0;
        container.addEventListener('touchstart', (e) => {
            startY = e.touches[0].clientY;
        });

        container.addEventListener('touchmove', (e) => {
            const moveY = e.touches[0].clientY;
            if (moveY < startY) {
                transitionToNextImage();
            } else if (moveY > startY) {
                transitionToPreviousImage();
            }
            startY = moveY;
        });

        function transitionToNextImage() {
            if (currentIndex < images.length - 1) {
                images[currentIndex].classList.remove('visible');
                currentIndex++;
                images[currentIndex].classList.add('visible');
            }
        }

        function transitionToPreviousImage() {
            if (currentIndex > 0) {
                images[currentIndex].classList.remove('visible');
                currentIndex--;
                images[currentIndex].classList.add('visible');
            }
        }
    </script>

</body>
</html>

<?= $this->endSection() ?>
