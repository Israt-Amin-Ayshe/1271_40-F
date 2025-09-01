<?php include 'Pet_Adoption.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pet Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pet-body">
    <div class="form-container">
        <header class="pet-header">
            <h1>🔐 Login</h1>
            <p>Welcome back to our pet community</p>
        </header>

        <nav class="nav-links pet-nav">
            <a href="index.php" class="btn">🏠 Home</a>
            <a href="register.php" class="btn">📝 Register</a>
        </nav>

        <div class="form-wrapper">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                
                <input type="submit" name="login" value="Login" class="btn">
            </form>

            <?php
            if(isset($_POST['login'])){
                $email = $conn->real_escape_string($_POST['email']);
                $password = $_POST['password'];
                
                // Check user
                $result = $conn->query("SELECT * FROM users WHERE email='$email'");
                if($result->num_rows > 0){
                    $user = $result->fetch_assoc();
                    if(password_verify($password, $user['password'])){
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_name'] = $user['name'];
                        $_SESSION['user_email'] = $user['email'];
                        
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        echo "<p class='error'>Invalid password!</p>";
                    }
                } else {
                    echo "<p class='error'>User not found!</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>