<?php include 'Pet_Adoption.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐾 Online Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="home-container pet-theme">
        
        <!-- HEADER -->
        <header class="pet-header">
            <h1>🐶🐱 Online Pet Adoption Portal</h1>
            <p>"Find your furry friend and give them a forever home 🏡"</p>
        </header>

        <!-- NAVIGATION -->
        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="pets.php" class="btn">🐾 All Pets</a>
            <a href="available.php" class="btn">✨ Available Pets</a>
            <a href="adopted.php" class="btn">❤️ Adopted Pets</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="btn">📊 Dashboard</a>
                <a href="add_pet.php" class="btn">➕ Add Pet</a>
                <a href="logout.php" class="btn">🚪 Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn">🔐 Login</a>
                <a href="register.php" class="btn">📝 Register</a>
            <?php endif; ?>
        </nav>

        <!-- HERO SECTION -->
        <section class="hero pet-hero">
            <h2>"Adopt, Don't Shop!"</h2>
            <p>We connect loving families with pets who need a home. Start your adoption journey today!</p>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="pets.php" class="btn hero-btn">🐕 View Pets</a>
            <?php else: ?>
                <a href="register.php" class="btn hero-btn">🐕 Get Started</a>
            <?php endif; ?>
        </section>

        <!-- FOOTER -->
        <footer class="pet-footer">
            <p>© 2025 Online Pet Adoption Portal | Made with ❤️ for animal lovers</p>
        </footer>
    </div>
</body>
</html>