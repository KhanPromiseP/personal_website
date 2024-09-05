<?php 
include 'db.php' ;



 if(isset($_POST['submit'])){
    $title=$_POST['title']; 
    $description=$_POST['description'];
    $icon_class=$_POST['icon_class']; 
    $details=$_POST['details']; 
    
    try {
    $sql="INSERT INTO services (title, description, icon_class, details) VALUES (:title, :description, :icon_class, :details)"; 
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
    ':title' => $title,
    ':description' => $description,
    ':icon_class' => $icon_class,
    ':details' => $details
    ]);
    header("Location: ../index.php#services");
    // exit();
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
    <title>Create About Information</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/aos.css"> -->
    <link rel="stylesheet" href="../assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<style>
body {
    margin: 0;
    padding: 0;
    /* 
    background-image: url(../assets/images/ou.jpg);
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
<div class="container">
    <div class="row justify-content-center text-center " data-aos="fade-up">
        <div class="col-lg-8 pb-4">
            <h1 class="text-brand"> Add Services</h1>
        </div>
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">

            <form action="" method="POST">
                <label for="title">Service Title:</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Title..." required>

                <label for=" description">Description:</label>
                <textarea id="description" class="form-control" name="description" rows="3"
                    placeholder="description here..." required></textarea>

                <label for=" icon_class">Icon Class:</label>
                <input type="text" id="icon_class" class="form-control" name="icon_class" value="las la-pencil-ruler"
                    required>

                <label for="details">Details:</label>
                <textarea id="details" class="form-control" name="details" rows="3" placeholder="details here..."
                    required></textarea><br>

                <button name="submit" class="form-control btn btn-brand" type="submit">Add Service</button>
            </form>
        </div>
    </div>
</div>

</html>