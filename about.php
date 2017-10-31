<?php
/**
 * Author: Jacob Mills
 * Date: 9/18/2017
 * Description: This file is the about page
 */

session_start();

include_once("DAL/TeamMember.php");

?>


<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body>

<!-- Navigation -->
<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">About Us
    </h1>

    <!-- Intro Content -->
    <div class="row">
        <div class="col-lg-6">
            <img class="img-fluid rounded mb-4" src="/images/opendevtoolslogo.PNG" alt="logo">
        </div>
        <div class="col-lg-6">
            <h2>Background</h2>
            <p>Our team consists of application developers, network administrators, project managers, and quality
                assurance testers with a passion for computing technology. Throughout the years, our workforce
                experience helped us envision OpenDevTools as a critical resource for all stages of the project
                development lifecycle. We have combined our expertise to design a platform for assisting software
                engineers ranging from individuals to large organizations.</p>
            <p>Our mission is to provide project management solutions and software development utilities that assist
                clients from individual developers to large corporations. OpenDevTools will encourage adoption of our
                software solutions by releasing them as open-source tools, encouraging expert community feedback, and
                implementing the latest security standards throughout our design to ensure confidentiality, integrity,
                and reliability.</p>
        </div>
    </div>
    <!-- /.row -->

    <!-- Team Members -->
    <h2>Our Team</h2>

    <div class="row">
        <?php

        // Change this to be TeamMember::loadall()
        //  Then, use the get methods to dynamically display MemberImgUrl, MemberName, MemberBio, and MemberEmail

        $memberList = TeamMember::loadall();
        foreach ($memberList as $member) {
            echo "<div class=\"col-lg-4 mb-4\">";
            echo "<div class=\"card h-100 text-center\">";
            echo "<img class=\"card-img-top\" src=\"" . $member->getImgUrl() . "\" alt=\"\">";
            echo "<div class=\"card-body\">";
            echo "<h4 class=\"card-title\">" . $member->getName() . "</h4>";
            echo "<h6 class=\"card-subtitle mb-2 text-muted\"> " . $member->getTitle() . " </h6>";
            echo "<p class=\"card-text\">" . $member->getBio() . "</p>";
            echo "</div>";
            echo "<div class=\"card-footer\">";
            echo "<a href=\"#\">" . $member->getEmail() . "</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

        }

        ?>
    </div>
    <!-- /.row -->

    <!-- Our Partners -->
    <h2>Our Partners</h2>
    <div class="row">
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid"
                 src="images/DigitalOcean_Logo.png"
                 alt="DigitalOcean">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="images/Ubuntu_Logo.png" alt="Ubuntu">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="images/Nginx_Logo.png" alt="Nginx">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid"
                 src="images/PhpStorm_Logo.png"
                 alt="PHPStorm">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="images/Xampp_Logo.jpg" alt="XAMPP">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="images/MySQL_Logo.jpg" alt="MySQL">
        </div>
    </div>
    <!-- /.row -->

</div>

<!-- /.container -->

<!-- Footer -->
<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
