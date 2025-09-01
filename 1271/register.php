<?php include 'Pet_Adoption.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="form-container">
        <header class="pet-header">
            <h1>📝 Create Account</h1>
            <p>Join our pet loving community</p>
        </header>

        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="login.php" class="btn">🔐 Login</a>
        </nav>

        <div class="form-wrapper">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="name" required>
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label>Confirm Password:</label>
                    <input type="password" name="confirm_password" required>
                </div>
                
                <input type="submit" name="register" value="Register" class="btn">
            </form>

            <?php
            if(isset($_POST['register'])){
                $name = $conn->real_escape_string($_POST['name']);
                $email = $conn->real_escape_string($_POST['email']);
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                
                // Check if passwords match
                if($password !== $confirm_password){
                    echo "<p class='error'>Passwords do not match!</p>";
                } else {
                    // Check if email already exists
                    $check_email = $conn->query("SELECT id FROM users WHERE email='$email'");
                    if($check_email->num_rows > 0){
                        echo "<p class='error'>Email already registered!</p>";
                    } else {
                        // Hash password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        
                        // Insert user
                        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
                        if($conn->query($sql)){
                            echo "<p class='success'>Registration successful! <a href='login.php'>Login here</a></p>";
                        } else {
                            echo "<p class='error'>Error: " . $conn->error . "</p>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
