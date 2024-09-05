<?php
include 'db.php';

define('EDUCATION_TYPE', 'education');

$educationRecords = [];

try {
    // Retrieve Education records
    $sql = "SELECT id, title, description, image_path FROM information WHERE type = :type";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':type' => EDUCATION_TYPE]);
    $educationRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$educationRecords) {
        echo "No Education records found.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Records</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        color: blue;
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
        left: 10px;
    }

    table {
        position: relative;
        left: 130px;
        width: 80%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        color: whitesmoke;
        background-color: black;
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
        <a href="../index.php#about">GO BACK</a>
    </div>

    <h1 class="text-brand" style="text-align:center">Education Records</h1>

    <?php if ($educationRecords): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($educationRecords as $record): ?>
            <tr>
                <td><?php echo htmlspecialchars($record['id']); ?></td>
                <td><?php echo htmlspecialchars($record['title']); ?></td>
                <td><?php echo htmlspecialchars($record['description']); ?></td>
                <td>
                    <img src="files/education/<?php echo htmlspecialchars($record['image_path']); ?>"
                        alt="<?php echo htmlspecialchars($record['title']); ?>" width="100">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No Education records found.</p>
    <?php endif; ?>
</body>

</html>