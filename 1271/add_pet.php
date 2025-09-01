<?php 
include 'Pet_Adoption.php';

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Create uploads directory if it doesn't exist
$upload_dir = "uploads/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Pet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="form-container">
        <header class="pet-header">
            <h2>Add New Pet</h2>
            <p>Share a pet for adoption</p>
        </header>

        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="dashboard.php" class="btn">📊 Dashboard</a>
            <a href="pets.php" class="btn">🐾 All Pets</a>
            <a href="logout.php" class="btn">🚪 Logout</a>
        </nav>

        <div class="form-wrapper">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                </div>
                
                <div class="form-group">
                    <label>Type:</label>
                    <input type="text" name="type" required>
                </div>
                
                <div class="form-group">
                    <label>Age:</label>
                    <input type="number" name="age" required>
                </div>
                
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" required></textarea>
                </div>
                
                <div class="form-group">
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                
                <input type="submit" name="submit" value="Add Pet" class="btn">
            </form>

            <?php
            if(isset($_POST['submit'])){
                $name = $conn->real_escape_string($_POST['name']);
                $type = $conn->real_escape_string($_POST['type']);
                $age  = $conn->real_escape_string($_POST['age']);
                $desc = $conn->real_escape_string($_POST['description']);
                $user_id = $_SESSION['user_id'];
                
                // Handle file upload
                if(isset($_FILES['image'])) {
                    $image_name = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_error = $_FILES['image']['error'];
                    
                    // Check for upload errors
                    if($image_error === UPLOAD_ERR_OK) {
                        // Check if image file is an actual image
                        $check = getimagesize($image_tmp);
                        if($check !== false) {
                            // Generate unique filename to prevent overwriting
                            $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                            $new_image_name = uniqid('pet_', true) . '.' . $image_ext;
                            $target_file = $upload_dir . $new_image_name;
                            
                            // Check file size (max 5MB)
                            if ($_FILES['image']['size'] > 5000000) {
                                echo "<p class='error'>Sorry, your file is too large. Maximum size is 5MB.</p>";
                            } 
                            // Allow certain file formats
                            else if(!in_array($image_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                echo "<p class='error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
                            } 
                            // Try to upload file
                            else if(move_uploaded_file($image_tmp, $target_file)){
                                // Insert into database
                                $sql = "INSERT INTO pets (name, type, age, description, image, status, added_by) 
                                        VALUES ('$name','$type','$age','$desc','$new_image_name','Available', '$user_id')";
                                if($conn->query($sql)){
                                    echo "<p class='success'>Pet added successfully!</p>";
                                } else {
                                    // Delete the uploaded file if database insertion fails
                                    unlink($target_file);
                                    echo "<p class='error'>Database error: " . $conn->error . "</p>";
                                }
                            } else {
                                echo "<p class='error'>Sorry, there was an error uploading your file. Please check folder permissions.</p>";
                            }
                        } else {
                            echo "<p class='error'>File is not an image.</p>";
                        }
                    } else {
                        echo "<p class='error'>File upload error: ";
                        switch ($image_error) {
                            case UPLOAD_ERR_INI_SIZE:
                            case UPLOAD_ERR_FORM_SIZE:
                                echo "File is too large.";
                                break;
                            case UPLOAD_ERR_PARTIAL:
                                echo "File was only partially uploaded.";
                                break;
                            case UPLOAD_ERR_NO_FILE:
                                echo "No file was uploaded.";
                                break;
                            case UPLOAD_ERR_NO_TMP_DIR:
                                echo "Missing temporary folder.";
                                break;
                            case UPLOAD_ERR_CANT_WRITE:
                                echo "Failed to write file to disk.";
                                break;
                            default:
                                echo "Unknown error.";
                        }
                        echo "</p>";
                    }
                } else {
                    echo "<p class='error'>Please select an image file.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>