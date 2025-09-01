<?php include 'Pet_Adoption.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ Available Pets - Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="pets-container">

        <!-- HEADER -->
        <header class="pet-header">
            <h1>✨ Available Pets</h1>
            <p>These adorable pets are waiting for a loving home 🏡</p>
        </header>

        <!-- NAVIGATION -->
        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="pets.php" class="btn">🐾 All Pets</a>
            <a href="available.php" class="btn active">✨ Available Pets</a>
            <a href="adopted.php" class="btn">❤️ Adopted Pets</a>
            <a href="add_pet.php" class="btn">➕ Add Pet</a>
        </nav>

        <!-- AVAILABLE PETS LIST -->
        <section class="pets-list">
            <?php
            $result = $conn->query("SELECT * FROM pets WHERE status='Available' ORDER BY id DESC");

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="pet-card">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Pet Image" class="pet-img">
                        <h2><?php echo $row['name']; ?></h2>
                        <p><strong>Type:</strong> <?php echo $row['type']; ?></p>
                        <p><strong>Age:</strong> <?php echo $row['age']; ?> years</p>
                        <p class="status available">Status: Available</p>

                        <a href="adopt.php?pet_id=<?php echo $row['id']; ?>" class="btn adopt-btn">Adopt Me 🐕</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No pets are available for adoption at the moment 🐾</p>";
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
