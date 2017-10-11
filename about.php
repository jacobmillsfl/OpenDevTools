<?php
/**
 * Author: Jacob Mills
 * Date: 9/18/2017
 * Description: This file is the about page
 */



include("DAL/TeamMember.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About Us</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">OpenDevTools
        <small>About Us</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">About</li>
    </ol>

    <!-- Intro Content -->
    <div class="row">
        <div class="col-lg-6">
            <img class="img-fluid rounded mb-4" src="/images/opendevtoolslogo.PNG" alt="logo">
        </div>
        <div class="col-lg-6">
            <h2>Background</h2>
            <p>Our team consists of application developers, network administrators, project managers, and quality assurance testers with a passion for computing technology. Throughout the years, our workforce experience helped us envision OpenDevTools as a critical resource for all stages of the project development lifecycle. We have combined our expertise to design a platform for assisting software engineers ranging from individuals to large organizations.</p>
            <p>Our mission is to provide project management solutions and software development utilities that assist clients from individual developers to large corporations.  OpenDevTools will encourage adoption of our software solutions by releasing them as opensource tools, encouraging expert community feedback, and implementing the latest security standards throughout our design to ensure confidentiality, integrity, and reliability.</p>
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
        foreach($memberList as $member)
        {
            echo "<div class=\"col-lg-4 mb-4\">";
            echo "<div class=\"card h-100 text-center\">";
            echo "<img class=\"card-img-top\" src=\"" . $member->getImgUrl() . "\" alt=\"\">";
            echo "<div class=\"card-body\">";
            echo "<h4 class=\"card-title\">" . $member->getName() . "</h4>";
            echo "<h6 class=\"card-subtitle mb-2 text-muted\"> ". $member->getTitle() . " </h6>";
            echo "<p class=\"card-text\">" . $member->getBio() . "</p>";
            echo "</div>";
            echo "<div class=\"card-footer\">";
            echo "<a href=\"#\">". $member->getEmail() . "</a>";
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
                <img class="img-fluid" src="https://www.digitalocean.com/assets/media/logos-badges/png/DO_Logo_Vertical_Blue-6321464d.png" alt="DigitalOcean">
            </div>
            <div class="col-lg-2 col-sm-4 mb-4">
                <img class="img-fluid" src="http://design.ubuntu.com/wp-content/uploads/ubuntu-logo112.png" alt="Ubuntu">
            </div>
            <div class="col-lg-2 col-sm-4 mb-4">
                <img class="img-fluid" src="https://blog.netapsys.fr/wp-content/uploads/2016/08/Nginx-Logo.png" alt="Nginx">
            </div>
            <div class="col-lg-2 col-sm-4 mb-4">
                <img class="img-fluid" src="https://d3nmt5vlzunoa1.cloudfront.net/phpstorm/files/2015/12/PhpStorm_400x400_Twitter_logo_white.png" alt="PHPStorm">
            </div>
            <div class="col-lg-2 col-sm-4 mb-4">
                <img class="img-fluid" src="https://itbeginner.net/wp-content/uploads/2017/07/xampp-logo.jpg" alt="XAMPP">
            </div>
            <div class="col-lg-2 col-sm-4 mb-4">
                <img class="img-fluid" src="http://www.softura.com/wp-content/uploads/2014/01/mySQL-logo.jpg" alt="MySQL">
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
