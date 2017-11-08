<?php
/**
 * Author: Jacob Mills
 * Date: 10/31/2017
 * Description: This page allows access to the TaskTracker service.
 */

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body>

<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Task Tracker
        <small>Project Management Made Easy</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><strong>Services</strong></li>
        <li class="breadcrumb-item"><a href="/dalgen">Dalgen</a></li>
        <li class="breadcrumb-item active"><a href="/tasktracker">TaskTracker</a></li>
    </ol>

    <div class="row">
        <div class="col-lg-4 col-sm-3"></div>
        <div class="col-lg-4 col-sm-6"><img class="card-img-top rounded mb-4" src="images/tasktrackerlogo.png"
                                            alt="DAL Gen">
        </div>
        <div class="col-lg-4 col-sm-3"></div>
    </div>


    <div class="row">
        <div class="col-lg-12 mb-4">
            <p>TaskTracker is a project management service for software development teams.
                The TaskTracker website will allow users to create development teams and projects
                under each team. Tasks that are associated with each project will be assigned to
                members of that project’s team. Users can update their assigned tasks with comments
                and mark tasks as complete. Tasks can be further validated by a member of a Quality
                Assurance team. Metrics from each project are aggregated to provide helpful graphs and
                statistics to project administrators.
            </p>
        </div>
    </div>

    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Access Now</h4>
                <div class="card-body">
                    <p class="card-text">This product is still under active development, but feel free to try the <a
                                href="https://tasktracker.opendevtools.org">BETA</a> version.</p>
                </div>
                <div class="card-footer">
                    <a href="https://tasktracker.opendevtools.org" class="btn btn-primary">Access Beta</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Tutorials</h4>
                <div class="card-body">
                    <p class="card-text">Coming Soon</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Project Management Blog</h4>
                <div class="card-body">
                    <p class="card-text">Coming Soon</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
