<?php include 'Pet_Adoption.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>❤️ Adopted Pets - Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="pets-container">

        <!-- HEADER -->
        <header class="pet-header">
            <h1>❤️ Adopted Pets</h1>
            <p>These pets have found their forever homes 🏡</p>
        </header>

        <!-- NAVIGATION -->
        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="pets.php" class="btn">🐾 All Pets</a>
            <a href="available.php" class="btn">✨ Available Pets</a>
            <a href="adopted.php" class="btn active">❤️ Adopted Pets</a>
            <a href="add_pet.php" class="btn">➕ Add Pet</a>
        </nav>

        <!-- ADOPTED PETS LIST -->
        <section class="pets-list">
            <?php
            $result = $conn->query("SELECT * FROM pets WHERE status='Adopted' ORDER BY id DESC");

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Safely handle missing keys
                    $image = !empty($row['image']) ? $row['image'] : 'default.png';
                    $name = $row['name'] ?? 'Unknown';
                    $type = $row['type'] ?? 'Unknown';
                    $breed = $row['breed'] ?? 'Unknown';
                    $age = $row['age'] ?? 'Unknown';
                    ?>
                    <div class="pet-card">
                        <img src="uploads/<?php echo $image; ?>" alt="Pet Image" class="pet-img">
                        <h2><?php echo $name; ?></h2>
                        <p><strong>Type:</strong> <?php echo $type; ?></p>
                        <p><strong>Breed:</strong> <?php echo $breed; ?></p>
                        <p><strong>Age:</strong> <?php echo $age; ?> years</p>
                        <p class="status adopted">Status: Adopted</p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No pets have been adopted yet 🐾</p>";
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
