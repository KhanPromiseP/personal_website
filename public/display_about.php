<?php
include 'db.php';

try {
    $sql = "SELECT title, description, image_path FROM about ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $about = $stmt->fetch(PDO::FETCH_ASSOC);

  
    if (!$about) {
        echo "<p style='color:red;'>No data found in the about table.</p>";
    } else {
        echo "<p style='color:green;'>Data fetched successfully:</p>";
        // echo "<pre>" . print_r($about, true) . "</pre>"; 
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<section id="about" class="full-height px-lg-5">
    <div class="container">
        <div class="row ">
            <div class="col-12 text-center">
                <h6 class="text-brand">ABOUT US</h6>
                <div class="line"></div>
                <h1>"<?php echo htmlspecialchars($about['title']); ?>"</h1>
            </div>
        </div>

        <div class="row gy-3 justify-content-between align-items-center ms-2">
            <div class="col-lg-6">
                <div class="card-custom rounded-4 bg-base">
                    <div class="card-custom-image rounded-4">
                        <div class="rounded-4">
                            <img src="public/files/<?php echo htmlspecialchars($about['image_path']); ?>"
                                alt="<?php echo htmlspecialchars($about['title']); ?>" height="80%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-custom ms-2">
                    <div class="card-custom-image ">
                        <p class="mt-3 mb-4"><?php echo htmlspecialchars($about['description']); ?></p>
                        <div class="d-flex pt-4 mb-3">
                            <div class="iconbox rounded-4 me-4">
                                <i class="las la-book"></i>
                            </div>
                            <div>
                                <h5>Booking</h5>
                                <p>Studying is a continuous process</p>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="iconbox rounded-4 me-4">
                                <i class="las la-laptop"></i>
                            </div>
                            <div>
                                <h5>Expertise</h5>
                                <p>We strive to stand out in our field</p>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="iconbox rounded-4 me-4">
                                <i class="las la-tools"></i>
                            </div>
                            <div>
                                <h5>Fun</h5>
                                <p>Having some fun is what keeps the mind more focused</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <a href="./public/education.php" class="btn btn-brand d-flex">Education</a>
                </div>
                <div class="col-md-6">
                    <a href="./public/experience.php" class="btn btn-brand d-flex">Experience</a>
                </div>
            </div>
        </div>
    </div>
</section>