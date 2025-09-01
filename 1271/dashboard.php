<?php 
include 'Pet_Adoption.php';

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="dashboard-container">
        <header class="pet-header">
            <h1>📊 Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
            <p>Your pet adoption dashboard</p>
        </header>

        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="pets.php" class="btn">🐾 All Pets</a>
            <a href="available.php" class="btn">✨ Available Pets</a>
            <a href="adopted.php" class="btn">❤️ Adopted Pets</a>
            <a href="add_pet.php" class="btn">➕ Add Pet</a>
            <a href="logout.php" class="btn">🚪 Logout</a>
        </nav>

        <div class="dashboard-content">
            <div class="dashboard-card">
                <h2>Your Adoptions</h2>
                <?php
                $user_id = $_SESSION['user_id'];
                $adoptions = $conn->query("SELECT p.* FROM pets p 
                                         INNER JOIN adoptions a ON p.id = a.pet_id 
                                         WHERE a.user_id = $user_id");
                
                if($adoptions->num_rows > 0){
                    while($pet = $adoptions->fetch_assoc()){
                        echo "<div class='pet-card'>";
                        echo "<img src='uploads/{$pet['image']}' alt='Pet Image' class='pet-img'>";
                        echo "<h3>{$pet['name']}</h3>";
                        echo "<p><strong>Type:</strong> {$pet['type']}</p>";
                        echo "<p><strong>Age:</strong> {$pet['age']} years</p>";
                        echo "<p class='status adopted'>Status: Adopted</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>You haven't adopted any pets yet.</p>";
                }
                ?>
            </div>

            <div class="dashboard-card">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <a href="pets.php" class="btn">Browse Pets</a>
                    <a href="add_pet.php" class="btn">Add a Pet</a>
                    <a href="available.php" class="btn">Available Pets</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>