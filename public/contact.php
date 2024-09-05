<?php
include 'db.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("Please fill in all fields.");
    }
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $subject = htmlspecialchars($subject);
    $message = htmlspecialchars($message);

    try {
        $sql = "INSERT INTO contact_form_submissions (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        
        $to = 'khanpennpromise@gmail.com'; 
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $email_subject = "Contact Form Submission: $subject";
        $email_body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

        mail($to, $email_subject, $email_body, $headers);

        echo "Thank you for contacting us!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>



<!-- contact -->
<section id="contact" class="full-height  px-lg-5">
    <div class="container">
        <div class="row justify-content-center text-center " data-aos="fade-up">
            <div class="col-lg-8 pb-4">
                <h6 class="text-brand">CONTACT</h6>
                <h2>Interested in working together? Need my services? Let's talk.</h2>
            </div>
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
                <form action="" class="row g-lg-3 gy-3" method="post">
                    <div class="form-group col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Enter your name">
                    </div>
                    <div class="form-group col-md-6">

                        <input type="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea name="message" rows="4" class="form-control"
                            placeholder="Enter your message"></textarea>
                    </div>
                    <div class="form-group col-md-12 d-grid">
                        <button class="btn btn-brand" type="submit" name="submit">Contact me</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>