<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_path = $_POST['image_path'];

    try {
        $sql = "UPDATE about SET title = :title, description = :description, image_path = :image_path WHERE id = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':image_path' => $image_path
        ]);
        echo "Record updated successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

try {
    $sql = "SELECT title, description, image_path FROM about WHERE id = 1";
    $stmt = $pdo->query($sql);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$record) {
        throw new Exception("Record not found");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update About Page</title>
</head>

<body>
    <form action="update_about.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($record['title']); ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"
            required><?php echo htmlspecialchars($record['description']); ?></textarea>
        <br>
        <label for="image_path">Image Path:</label>
        <input type="text" id="image_path" name="image_path"
            value="<?php echo htmlspecialchars($record['image_path']); ?>" required>
        <br>
        <button type="submit">Update Record</button>
    </form>
</body>

</html>