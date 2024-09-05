<?php
session_start();
include '../public/db.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION["error"]= 'All fields reqired!';
    }

    try {
        $sql = "SELECT password_hash FROM admin_users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_button']=true;
            header("Location: ../admin_dashboard.php");
            exit;
        } else{
         $_SESSION["error"]='Invalid username or password. please <a href="register_admin.php">Register</a> to continue.';
         
        }


}catch (PDOException $e) {
die("Error: " . $e->getMessage());
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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

/* a {
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
} */

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
                <h1 class="text-brand">Admin Login</h1>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">

                <form action="login_admin.php" method="POST">
                    <label for="username">Admin:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="admin name"
                        required>
                    <br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="admin password" required>
                    <br>

                    <button type=" submit" class="form-control btn btn-brand" name="login">Login</button><br>
                </form>

                <?php
                 if(isset($_SESSION["error"])){
                    $error=$_SESSION["error"]
                    ?>
                <?php 
                if(!empty($error)){
                    echo "<p style='color:red; font-size:small'>$error</p>";
                    unset($_SESSION['error']);
                    } 
                }
                ?>

            </div>

        </div>
    </div>
</body>

</html>