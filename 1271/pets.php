<?php include 'Pet_Adoption.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐾 All Pets - Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="pets-container">

        <!-- HEADER -->
        <header class="pet-header">
            <h1>🐾 Meet Our Pets</h1>
            <p>Browse all pets looking for a loving home ❤️</p>
        </header>

        <!-- NAVIGATION -->
        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="pets.php" class="btn active">🐾 All Pets</a>
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

        <!-- PET LIST -->
        <section class="pets-list">
            <?php
            $result = $conn->query("SELECT * FROM pets ORDER BY status ASC, id DESC");

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="pet-card">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Pet Image" class="pet-img">
                        <h2><?php echo $row['name']; ?></h2>
                        <p><strong>Type:</strong> <?php echo $row['type']; ?></p>
                        <p><strong>Age:</strong> <?php echo $row['age']; ?> years</p>
                        <p class="status <?php echo strtolower($row['status']); ?>">
                            Status: <?php echo $row['status']; ?>
                        </p>

                        <?php if($row['status'] == 'Available'): ?>
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <a href="adopt.php?pet_id=<?php echo $row['id']; ?>" class="btn adopt-btn">Adopt Me 🐕</a>
                            <?php else: ?>
                                <a href="login.php" class="btn adopt-btn">Login to Adopt</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="btn disabled">Already Adopted ❤️</span>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No pets available right now 🐾</p>";
            }
            ?>
        </section>
        
        <!-- FOOTER -->
        <footer class="pet-footer">
            <p>© 2025 Online Pet Adoption Portal | Made with ❤️ for animal lovers</p>
        </footer>
    </div>
</body>
</html>