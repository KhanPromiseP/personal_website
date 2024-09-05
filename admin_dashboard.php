<?php session_start(); if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) { 
    header("Location:./admin/login_admin.php"); 
    exit; 
} 
    
    ?>

<?php include"./includes/header.php"?>

<body>
    <!-- <div class="container">
        <div class="row justify-content-center text-center " data-aos="fade-up">
            <div class="col-lg-8 pb-4">
                <h1 class="text-brand"> Welcome to the Admin Dashboard</h1>
            </div> -->

    <!-- <div data-aos="fade-up" data-aos-delay="300"> -->

    <button class="btn btn-succes"><a href="./public/add_service.php">services</a></button>
    <button class="btn btn-succes"><a href="./public/add_project.php">projects</a></button>
    <button class="btn btn-succes"><a href="./public/add_about_info.php">education/experience</a></button>
    <button class="btn btn-succes"><a href="./public/add_about.php">about</a></button>
    <button class="btn btn-succes"><a href="index.php">Dashboard</a></button>
    <button class="btn btn-danger" style="float:right"><a href="./admin/logout_admin.php">Logout</a></button>
    <!-- </div> -->
    <!-- </div>
    </div> -->

</body>


</html>