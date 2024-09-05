<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!in_array($type, ['education', 'experience'])) {
        die("Invalid type");
    }

    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
        $image_path = $_FILES['image_path']['name'];

        $target_dir = $type === 'education' ? 'files/education/' : 'files/experience/';

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);  
        }

        $target_file = $target_dir . basename($image_path);

    } else {
        $_SESSION['messages'] = "File upload failed or no file was uploaded.";
        header('location:add_about_info.php');
        exit;
    }

    try {
        $sql = "INSERT INTO information (type, title, description, image_path) VALUES (:type, :title, :description, :image_path)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':type' => $type,
            ':title' => $title,
            ':description' => $description,
            ':image_path' => $image_path
        ]);

        if ($result) {
            if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {
                $_SESSION['messages'] = "Record inserted successfully!";
            } else {
                $_SESSION['messages'] = "File upload failed!";
            }
            header('location:../index.php#about');
        } else {
            $_SESSION['messages'] = "Record NOT inserted successfully!";
            header('location:add_about_info.php');
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<?php include '../includes/header.php' ;?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add education or experience info</title>
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
                <h1 class="text-brand">Insert Education or Experience</h1>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
                <?php
                if(isset($_SESSION['messages']) && $_SESSION != ''){
                    echo $_SESSION['messages'];
                    unset($_SESSION['messages']);
                }
                ?> <form action="" method="POST" enctype="multipart/form-data">
                    <label for="type">Type:</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="education">Education</option>
                        <option value="experience">Experience</option>
                    </select>
                    <br>

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="title" required>
                    <br>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" placeholder="description"
                        required></textarea>


                    <label for="image_path">Image Path:</label>
                    <input type="file" id="image_path" name="image_path" class="form-control" required>
                    <br>
                    <button name="submit" type="submit" class="form-control btn btn-brand">Insert Record</button>
                </form>
            </div>
        </div>
    </div>
</body>

<?php include '../includes/header.php' ;?>

</html>