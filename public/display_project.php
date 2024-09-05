<?php
include 'db.php';
// include 'header.php';

try {
    $sql = "SELECT id, title, description, image_path FROM projects";
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<section id="projects" class="full-height  px-lg-5">
    <div class="container">
        <div class="row pd-4">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="50">
                <h6 class="text-brand">PROJECTS</h6>
                <h1>My Recent Projects</h1>
            </div>
        </div>
        <div class="row gy-4">
            <?php if ($projects): ?>
            <?php foreach ($projects as $project): ?>
            <div class="col-lg-6">
                <div class="card-custom rounded-4 bg-base shadow-effect" data-aos="fade-up" data-aos-delay="60">
                    <div class="card-custom-image rounded-4" data-aos="fade-up" data-aos-delay="100">
                        <img class="rounded-4" src="<?php echo "public/files/". $project['image_path']; ?>"
                            alt="<?php echo htmlspecialchars($project['title']); ?>">
                    </div>
                    <div class="card-custom-content p-4" data-aos="fade-up" data-aos-delay="150">
                        <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                        <p><?php echo htmlspecialchars($project['description']); ?></p>
                        <a href="./public/project_detail.php?id=<?php echo htmlspecialchars($project['id']); ?>"
                            class="link-custom" data-aos="fade-up" data-aos-delay="200">Read More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No projects found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>