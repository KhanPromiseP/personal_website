<?php
include 'db.php'; 
// include '../includes/header.php';

try {
    $sql = "SELECT id, title, description, icon_class FROM services";
    $stmt = $pdo->query($sql);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<section id="services" class="full-height  px-lg-5">
    <div class="container">
        <div class="row pd-4">
            <div data-aos="fade-up" data-aos-delay="50" class="col-lg-8">
                <h6 class="text-brand">SERVICES</h6>
                <h1>Services That I Offer</h1>
            </div>
        </div>
        <div class="row gy-4">
            <?php if ($services): ?>
            <?php foreach ($services as $service): ?>
            <div class="col-md-4">
                <div class="service p-4 bg-base rounded-4 shadow-effect" data-aos="fade-up" data-aos-delay="100">
                    <div class="iconbox rounded-4">
                        <i class="<?php echo htmlspecialchars($service['icon_class']); ?>"></i>
                    </div>
                    <h5 data-aos="fade-up" data-aos-delay="150" class="mt-4 mb-2">
                        <?php echo htmlspecialchars($service['title']); ?></h5>
                    <p data-aos="fade-up" data-aos-delay="250"><?php echo htmlspecialchars($service['description']); ?>
                    </p>
                    <a data-aos="fade-up" data-aos-delay="300"
                        href="./public/service_detail.php?id=<?php echo htmlspecialchars($service['id']); ?>"
                        class="link-custom">Read More</a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No services found.</p>
            <?php endif; ?>
        </div>
    </div>
    </sectsection>