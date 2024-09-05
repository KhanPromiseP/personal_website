<?php
include 'db.php'; 

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
//     $title = $_POST['title'];
//     $description = $_POST['description'];

//     if (empty($title) || empty($description)) {
//         $_SESSION['messages'] = "Please fill in all fields.";
//         header('Location: add_about.php');
//         exit;
//     }

//     if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
//         $image_path = $_FILES['image_path']['name'];
//         $target_dir = 'files/';
//         if (!is_dir($target_dir)) {
//             mkdir($target_dir, 0755, true);  
//         }

//         $target_file = $target_dir . basename($image_path);

//         try {
//             $sql = "INSERT INTO about (title, description, image_path) VALUES (:title, :description, :image_path)";
//             $stmt = $pdo->prepare($sql);
//             $result = $stmt->execute([
//                 ':title' => $title,
//                 ':description' => $description,
//                 ':image_path' => $image_path
//             ]);

//             if ($result) {
//                 if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {
//                     $_SESSION['messages'] = "Record inserted successfully!";
//                 } else {
//                     $_SESSION['messages'] = "File upload failed!";
//                 }
//                 header('Location: ../index.php#about');
//             } else {
//                 $_SESSION['messages'] = "Record NOT inserted successfully!";
//                 header('Location: add_about.php');
//             }
//         } catch (PDOException $e) {
//             echo"Database Error: " . $e->getMessage();
//         }
//     } else {
//         $_SESSION['messages'] = "File upload failed or no file was uploaded.";
//         header('Location: add_about.php');
//     }
// }
// ?>







<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image_path = $_FILES['image_path']['name'] ?? '';
    if (empty($title) || empty($description) || empty($image_path)) {
        die('Please fill in all required fields.');
    }
    $target_dir = "files/";
    $target_file = $target_dir . basename($image_path);
    if (!move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {
        die('File upload failed.');
    }

    try {
        $sql = "INSERT INTO about (title, description, image_path) VALUES (:title, :description, :image_path)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':image_path' => $image_path,
        ]);
        header("Location: ../index.php#about");
        exit;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

< <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create About Information</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/line-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <body>
        <div class="nav">
            <?php include '../includes/go_back_button.php'; GoBackButton(); ?>
        </div>
        <div class="container">
            <div class="row justify-content-center text-center" data-aos="fade-up">
                <div class="col-lg-8 pb-4">
                    <h1 class="text-brand">Create About Information</h1>
                </div>
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
                    <?php
                if (isset($_SESSION['messages']) && $_SESSION['messages'] != '') {
                    echo $_SESSION['messages'];
                    unset($_SESSION['messages']);
                }
                ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="title" required>
                        <br>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="3"
                            placeholder="description" required></textarea>
                        <br>
                        <label for="image_path">Image Path:</label>
                        <input type="file" id="image_path" name="image_path" class="form-control" required>
                        <br>
                        <button type="submit" name="submit" class="form-control btn btn-brand">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>