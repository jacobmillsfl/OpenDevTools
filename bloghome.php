<?php

/* Blog home page */

    session_start();

    include_once("DAL/Blog.php");
?>


<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body>

<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">OpenDevTools
        <small>Blog Home</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>

        <li class="breadcrumb-item active"> Blog</li>
    </ol>



    <div class="row">

        <!-- Blog Entries Column -->
        <!--<div class="col-md-8"> -->

        <?php
            $blogList=Blog::loadall();
                foreach ($blogList as $blogItem){
                    echo"<div class =\"col-md-8\">";
                    echo "<div class=\"card mb-4\">";
                    echo "<img class =\"card-img-top\" src=\"" .$blogItem->getImgUrl() ."\" alt=\"\">";
                    echo "<div class=\"card-body\">";
                    echo "<h2 class=\"card-title\">" . $blogItem->getTitle() . "</h2>";
                    echo "<p class=\"card-text\">" . $blogItem->getContent() . "</p>";
                    //echo "<a href=\"#\" class=\"btn btn-primary\">" Read More "</a>";
                    echo"</div>";
                    echo "<div class=\"card-footer text muted\">"  . $blogItem->getCreateDate() . "</div>";
                    echo "<a href=\"#\">".$blogItem-> getUserId(). "</a>";
                    echo "</div>";
                    echo"</div>";
                    
                }
        ?>

        </div><!-- /.row -->

    <!--</div> --> <!--/Blog entries column -->

    <!-- Our Partners -->
    <h2>Our Partners</h2>
    <div class="row">
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid"
                 src="https://www.digitalocean.com/assets/media/logos-badges/png/DO_Logo_Vertical_Blue-6321464d.png"
                 alt="DigitalOcean">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="http://design.ubuntu.com/wp-content/uploads/ubuntu-logo112.png" alt="Ubuntu">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="https://blog.netapsys.fr/wp-content/uploads/2016/08/Nginx-Logo.png" alt="Nginx">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid"
                 src="https://d3nmt5vlzunoa1.cloudfront.net/phpstorm/files/2015/12/PhpStorm_400x400_Twitter_logo_white.png"
                 alt="PHPStorm">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="https://itbeginner.net/wp-content/uploads/2017/07/xampp-logo.jpg" alt="XAMPP">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
            <img class="img-fluid" src="http://www.softura.com/wp-content/uploads/2014/01/mySQL-logo.jpg" alt="MySQL">
        </div>
    </div>
    <!-- /.row -->


</div><!-- /container -->




    <!-- Footer -->
    <?php include "footer.php" ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>



</body>


</html>


