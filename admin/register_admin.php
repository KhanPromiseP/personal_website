<?php
include '../public/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error']="All fields required!.";
    }

    if($username<5 && $username>15){
        $_SESSION['error'] = 'Name must be between 5 to 15 characters!';
    }
    
    $testpassword = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (!preg_match($testpassword, $password)) {
        $_SESSION['error'] = "Password must be at least 8 characters long, with at least one uppercase letter, one number, and one special character.";
    } 

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO admin_users (username, password_hash) VALUES (:username, :password_hash)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => $password_hash
        ]);

        echo "Admin registered successfully!";
        header('location:login_admin.php');
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/aos.css"> -->
    <link rel="stylesheet" href="../assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<style>
body {
    margin: 0;
    padding: 0;

    /* background-image: url(../assets/images/ou.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center; */
}

a:hover {
    background-color: grey;
}

a {
    border-radius: 3px;
    position: relative;
    background-color: black;
    font-weight: 500;
    text-decoration: none;
    color: limegreen;
    flex: none;
    padding: 5px;
    width: 10px;
    height: 5px;
    font-size: medium;
    top: 26px;
    left: 10px
}

.nav {
    background-color: rgb(48, 94, 77);
    overflow: hidden;
    flex: none;
    width: 100%;
    height: 70px;
    top: 0%;
    box-shadow: 10px, 5px 8px rgba(60, 90, 10, 0.2);

}
</style>

<div class="nav">
    <?php
    include '../includes/go_back_button.php';
    GoBackButton();
?>
</div>

<body>
    <div class="container">
        <div class="row justify-content-center text-center " data-aos="fade-up">
            <div class="col-lg-8 pb-4">
                <h1 class="text-brand">Admin Registration</h1>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <form action="register_admin.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="admin name"
                        required>
                    <br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="admin password" required>
                    <br>

                    <button type="submit" name="register" class="form-control btn btn-brand">Register</button>
                </form>

                <?php
                 if(isset($_SESSION["error"])){
                    $error=$_SESSION["error"]
                    ?>
                <?php 
                if(!empty($error)){
                    echo "<p style='color:red'>$error</p>";
                    unset($_SESSION['error']);
                    } 
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>