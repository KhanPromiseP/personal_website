<?php


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$service_id = intval($_GET['id']);


$sql = "SELECT title, description, image_url FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $service = $result->fetch_assoc();
} else {
    die("Service not found");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($service['title']); ?></title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/aos.css">
    <link rel="stylesheet" href="./assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <h1><?php echo htmlspecialchars($service['title']); ?></h1>
    </header>
    <main>
        <img src="<?php echo htmlspecialchars($service['image_url']); ?>"
            alt="<?php echo htmlspecialchars($service['title']); ?>">
        <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
    </main>
    <footer>
        <a href="../index.php">Back to Home</a>
    </footer>
</body>

</html>