<?php
include 'db.php'; 
// include 'header.php'; 

$project_id = intval($_GET['id']);

try {
    $sql = "SELECT title, details FROM projects WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$project) {
        throw new Exception("Project not found");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<?php
    // include '../includes/go_back_button.php';
    // GoBackButton();
?>


<!DOCTYPE html>
<div lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Education Records</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <style>
        body {
            margin: 0;
            color: black;
            font-size: 30px;
            font-weight: 500;
            font-family: 'Times New Roman', Times, serifa;
            background-image: url(../assets/images/ou.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

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
    </head>

    <body>
        <div class="nav">
            <a class="link-custom" href=" ../index.php#services">GO BACK</a>
        </div>
        <div class="col-lg-8 pb-4">
            <h2 style="text-align:center;color:black;  text-decoration-line: underline; ">
                <?php echo htmlspecialchars($project['title']); ?></h2>
            <div><?php echo $project['details']; ?></div>

        </div>
    </body>

    </html>