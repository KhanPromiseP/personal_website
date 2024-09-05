<?php
include 'db.php'; 

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $sql = "DELETE FROM contact_form_submissions WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        echo "Record deleted successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

try {
    $sql = "SELECT * FROM contact_form_submissions";
    $stmt = $pdo->query($sql);
    $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Submissions</title>
</head>

<body>

    <?php
    include '../includes/go_back_button.php';
    GoBackButton();
    ?>

    <h1>Manage Contact Submissions</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $submission): ?>
            <tr>
                <td><?php echo htmlspecialchars($submission['id']); ?></td>
                <td><?php echo htmlspecialchars($submission['name']); ?></td>
                <td><?php echo htmlspecialchars($submission['email']); ?></td>
                <td><?php echo htmlspecialchars($submission['subject']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($submission['message'])); ?></td>
                <td><?php echo htmlspecialchars($submission['created_at']); ?></td>
                <td>
                    <a href="manage_submissions.php?delete=<?php echo $submission['id']; ?>"
                        onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>