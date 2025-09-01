<?php
include 'Pet_Adoption.php';

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['pet_id'])){
    $pet_id = $conn->real_escape_string($_GET['pet_id']);
    $user_id = $_SESSION['user_id'];
    
    // Check if pet is available
    $pet_check = $conn->query("SELECT * FROM pets WHERE id = $pet_id AND status = 'Available'");
    
    if($pet_check->num_rows > 0){
        // Update pet status
        $conn->query("UPDATE pets SET status = 'Adopted' WHERE id = $pet_id");
        
        // Record adoption
        $conn->query("INSERT INTO adoptions (user_id, pet_id, adoption_date) VALUES ($user_id, $pet_id, NOW())");
        
        header("Location: dashboard.php?adoption=success");
        exit();
    } else {
        header("Location: pets.php?error=notavailable");
        exit();
    }
} else {
    header("Location: pets.php");
    exit();
}
?>