<?php
/**
 * Author: Jacob Mills
 * Date: 10/31/2017
 * Description: This page allows access to the Dalgen software.
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
    <h1 class="mt-4 mb-3">DALGen
        <small>The Data Access Layer Generator</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><strong>Services</strong></li>
        <li class="breadcrumb-item"><a href="/dalgen">Dalgen</a></li>
        <li class="breadcrumb-item active"><a href="/tasktracker">TaskTracker</a></li>
    </ol>

    <div class="row">
        <div class="col-lg-4 col-sm-3"></div>
        <div class="col-lg-4 col-sm-6"><img class="card-img-top rounded mb-4" src="images/dalgenlogo.png" alt="DAL Gen">
        </div>
        <div class="col-lg-4 col-sm-3"></div>
    </div>


    <div class="row">
        <div class="col-lg-12 mb-4">
            <p>DALGen, the Data Access Layer Generator, prepares a robust database access
                architecture by automatically generating database objects and code libraries tailored to
                secure data access. It can produce code for various DBMS platforms, including Microsoft SQL Server,
                MySQL, and Oracle. Additionally, DALGen can produce secure, object-oriented, data access layers for C++,
                C#, Java, Python, and PHP. To use the tool, you first design a database E/R diagram. Then, the schema
                for each entity in the E/R diagram is created via the DALGen graphical user interface. The result is
                a collection of SQL scripts to create an initial database schema along with stored procedures to
                perform basic SCRUD (search create read update delete) operations on each entity, as well as
                object-oriented code libraries for interacting with the generated schema in the programming
                languages of the user’s preference. Since the timeline of this project is limited,
                only SQL Server, MySQL, and PHP will be supported initially. During a later release support
                will be added for other languages.
            </p>
        </div>
    </div>

    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Download Now</h4>
                <div class="card-body">
                    <p class="card-text">This product is still under active development, but feel free to try the <a
                            href="https://www.github.com/h0r53/DALGen">BETA</a> version.</p>
                </div>
                <div class="card-footer">
                    <a href="https://www.github.com/h0r53/DALGen" class="btn btn-primary">Download Beta</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Tutorials</h4>
                <div class="card-body">
                    <p class="card-text">Coming Soon</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Object-Relational Mapping</h4>
                <div class="card-body">
                    <p class="card-text">Coming Soon</p>
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
