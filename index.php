<?php
/**
 * Author: Jacob Mills
 * Date: 9/18/2017
 * Description: This file is the landing page for OpenDevTools
 */



include("DAL/SiteBanner.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenDevTools.Org</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">OpenDevTools</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                        <a class="dropdown-item" href="portfolio-2-col.html">DALGen</a>
                        <a class="dropdown-item" href="portfolio-3-col.html">TaskTracker</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                        <a class="dropdown-item" href="blog-home-2.html">Blog Home</a>
                        <a class="dropdown-item" href="blog-post.html">Blog Sample</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <?php
                    $loggedIn = false;
                    if (!$loggedIn){
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"register.php\">Register</a></li>";
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>";
                    }
                    else{
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"account.php\">Account</a></li>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php

            $bannerList = SiteBanner::loadall();
            $active = true;
            foreach($bannerList as $banner)
            {

                echo "<div class=\"carousel-item" . ($active ? " active" : "") . "\" style=\"background-image: url('" . $banner->getImgUrl() . "')\">";
                echo "<div class=\"carousel-caption d-none d-md-block\">";
                echo "<h3>" . $banner->getTitle() . "</h3>";
                echo "<p>" . $banner->getMessage() . "</p>";
                echo "</div>";
                echo "</div>";
                $active = false;
            }

            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<!-- Page Content -->
<div class="container">

    <h1 class="my-4">Welcome to OpenDevTools</h1>

    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Background</h4>
                <div class="card-body">
                    <p class="card-text">Our team consists of application developers, network administrators, project managers, and quality assurance testers with a passion for computing technology. Throughout the years, our workforce experience helped us envision OpenDevTools as a critical resource for all stages of the project development lifecycle. We have combined our expertise to design a platform for assisting software engineers ranging from individuals to large organizations.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Mission</h4>
                <div class="card-body">
                    <p class="card-text">Our mission is to provide project management solutions and software development utilities that assist clients from the individual developer to the large organization. We will distribute our content and services free of charge and most of the software we produce will be released as opensource to encourage community feedback and improvement. The utmost security standards will be implemented throughout the design of our software to ensure confidentiality, integrity, and reliability.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Proposal</h4>
                <div class="card-body">
                    <p class="card-text">We will be using the Scrum framework for incremental agile software development to continually refine project requirements and adapt to the needs of our consumers. The initial implementation of the OpenDevTools mission will involve the development of three primary deliverables, which are listed in the following section.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Products And Services Section -->
    <h2>Products And Services</h2>

    <div class="row">
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="images/opendevtoolslogo.png" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">opendevtools.org</a>
                    </h4>
                    <p class="card-text">This website will serve as a centralized distribution center for all products and services offered by the OpenDevTools team. Users will be able to navigate to the website, learn more about our organization, create accounts, access our software and services, and participate in the OpenDevTools community.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">DALGen</a>
                    </h4>
                    <p class="card-text">DALGen, the Data Access Layer Generator, prepares a robust database access architecture by automatically generating database objects and code libraries tailored to secure data access. It has support for various DBMS platforms, including Microsoft SQL Server, MySQL, and Oracle. Additionally, DALGen can produce secure, object-oriented, data access layers for C++, C#, Java, Python, and PHP. To use the tool, you first design a database E/R diagram. Then, the schema for each entity in the E/R diagram is created via the DALGen graphical user interface. The result is a collection of SQL scripts to create an initial database schema along with stored procedures to perform basic SCRUD (search create read update delete) operations on each entity, as well as object-oriented code libraries for interacting with the generated schema in the programming languages of the user’s preference.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">TaskTracker</a>
                    </h4>
                    <p class="card-text">TaskTracker is a project management service for software development teams. The TaskTracker website will allow users to create development teams and projects under each team. Tasks that are associated with each project will be assigned to members of that project’s team. Users can update their assigned tasks with comments and mark tasks as complete. Tasks can be further validated by a member of a Quality Assurance team. Metrics from each project are aggregated to provide helpful graphs and statistics to project administrators.</p>
                </div>
            </div>
        </div>
        <!--         <div class="col-lg-4 col-sm-6 portfolio-item">
                  <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="#">Project Four</a>
                      </h4>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                  <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="#">Project Five</a>
                      </h4>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                  <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="#">Project Six</a>
                      </h4>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
                    </div>
                  </div>
                </div> -->
    </div>
    <!-- /.row -->

    <!-- Features Section -->
    <!--       <div class="row">
            <div class="col-lg-6">
              <h2>Modern Business Features</h2>
              <p>The Modern Business template by Start Bootstrap includes:</p>
              <ul>
                <li>
                  <strong>Bootstrap v4</strong>
                </li>
                <li>jQuery</li>
                <li>Font Awesome</li>
                <li>Working contact form with validation</li>
                <li>Unstyled page elements for easy customization</li>
              </ul>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
            </div>
            <div class="col-lg-6">
              <img class="img-fluid rounded" src="http://placehold.it/700x450" alt="">
            </div>
          </div>

          <hr>

          <div class="row mb-4">
            <div class="col-md-8">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
            </div>
            <div class="col-md-4">
              <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
            </div>
          </div> -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; opendevtools.org 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
