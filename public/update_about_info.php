<?php
include 'db.php'; 


define('EDUCATION_ID', 1);
define('EXPERIENCE_ID', 2);


$selectedId = null;
$record = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedId = (int)$_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_path = $_POST['image_path'];

  
    if (!in_array($selectedId, [EDUCATION_ID, EXPERIENCE_ID])) {
        die("Invalid ID");
    }

    try {
        $sql = "UPDATE information SET title = :title, description = :description, image_path = :image_path WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':image_path' => $image_path,
            ':id' => $selectedId
        ]);

        echo "Record updated successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $selectedId = (int)$_GET['id'];

   
    if (!in_array($selectedId, [EDUCATION_ID, EXPERIENCE_ID])) {
        die("Invalid ID");
    }

    try {
        $sql = "SELECT title, description, image_path FROM information WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $selectedId]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            die("Record not found");
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
</head>

<body>
    <h1>Update Information</h1>
    <form action="update_information.php" method="POST">
        <label for="id">ID:</label>
        <select id="id" name="id" required>
            <option value="<?php echo EDUCATION_ID; ?>" <?php echo ($selectedId === EDUCATION_ID) ? 'selected' : ''; ?>>
                Education</option>
            <option value="<?php echo EXPERIENCE_ID; ?>"
                <?php echo ($selectedId === EXPERIENCE_ID) ? 'selected' : ''; ?>>Experience</option>
        </select>
        <br>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($record['title'] ?? ''); ?>"
            required>
        <br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"
            required><?php echo htmlspecialchars($record['description'] ?? ''); ?></textarea>
        <br>

        <label for="image_path">Image Path:</label>
        <input type="text" id="image_path" name="image_path"
            value="<?php echo htmlspecialchars($record['image_path'] ?? ''); ?>" required>
        <br>

        <button type="submit">Update Record</button>
    </form>
</body>

</html>