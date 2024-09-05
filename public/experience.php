<?php
include 'db.php';

define('EXPERIENCE_TYPE', 'experience');

$experienceRecords = [];

try {
    // Retrieve Experience records
    $sql = "SELECT id, title, description, image_path FROM information WHERE type = :type";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':type' => EXPERIENCE_TYPE]);
    $experienceRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$experienceRecords) {
        echo "No Experience records found.";
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
    <title>Experience Records</title>
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

    <h1 class="text-brand" style="text-align:center">Experience Records</h1>

    <?php if ($experienceRecords): ?>
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
            <?php foreach ($experienceRecords as $record): ?>
            <tr>
                <td><?php echo htmlspecialchars($record['id']); ?></td>
                <td><?php echo htmlspecialchars($record['title']); ?></td>
                <td><?php echo htmlspecialchars($record['description']); ?></td>
                <td>
                    <img src="files/experience/<?php echo htmlspecialchars($record['image_path']); ?>"
                        alt="<?php echo htmlspecialchars($record['title']); ?>" width="100">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No Experience records found.</p>
    <?php endif; ?>
</body>

</html>