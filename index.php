<?php include "./includes/header.php";
include "admin_button.php"?>


<body data-bs-spy="scroll" data-bs-target=".navbar" style="align-items: center  justify-content: center">



    <nav class=" navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container flex-lg-column">
            <?php
            admin_button();
            ?>
            <a class="navbar-brand mx-my-auto mb-lg-4" href="#">
                <span class="h3 fw-bold d-block d-lg-none">KHAN PROMISE</span>
                <img src="./assets/images/me.png" alt="avatar" style="height: 150; width:200"
                    class="d-none d-lg-block rounded-circle file align-items-center d-flex">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto flex-lg-column text-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="content">


        <?php include"./includes/home.php"?>
        <?php include"./public/display_service.php"?>
        <?php include"./public/display_project.php"?>
        <?php include"./public/display_about.php"?>

        <?php include"./includes/about.php"?>
        <?php include"./public/contact.php"?>
        <?php include"./includes/footer.php"?> </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/aos.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>