<?php 

include 'db.php';

if(isset($_POST['submit'])){
$title = $_POST['title'];
$description = $_POST['description'];
$image_path = $_FILES['image_path']['name'];
$details = $_POST['details'];

if (empty($title) || empty($description) || empty($image_path)) {
    die('Please fill in all required fields.');
}
$target_dir = "files/";
    $target_file = $target_dir . basename($image_path);
    if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {
        die('File upload failed.');
    }
try {
    $sql = "INSERT INTO projects (title, description, image_path, details) VALUES (:title, :description, :image_path, :details)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':image_path' => $image_path,
        ':details' => $details
    ]);
    header("Location: ../index.php#projects");
    exit();
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
            <h1 class="text-brand"> Add Projects</h1>
        </div>

        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">

            <form action="" method="POST" enctype="multipart/form-data">
                <label for="title">Project Title:</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="project title" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="3"
                    placeholder="description here" required></textarea>

                <label for="image_path">Image Path:</label>
                <input type="file" id="image" name="image_path" class="form-control" placeholder="las la-book" required>

                <label for="details">Details:</label>
                <textarea id="details" name="details" rows="3" class="form-control"
                    placeholder='add project details ...' required></textarea><br>
                <button type="submit" class=" form-control btn btn-brand" name=" submit">Add Project</button>
            </form>

</html>