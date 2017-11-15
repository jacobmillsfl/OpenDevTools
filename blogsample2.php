<!DOCTYPE html>
<html lang="es">

<?php
/*
* Blog home page, Nov 2017
* Author: CarlaPastor cpp15d
*/
?>

<?php include "head.php" ?>

<body>


<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Blog
        <small>- Open Source </small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index">Home</a>
        </li>
        <li class="breadcrumb-item active">Blog </li>
    </ol>

    <!-- Blog Post -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <a href="#">
                        <img class="img-fluid rounded" src="/images/opensource.Carla.png" alt="">
                    </a>
                </div>
                <div class="col-lg-6">

                    <h2 class="card-title">The success of Open Source</h2>
                    <p class="card-text">

                    <p style="text-align:justify;">
                        A fundamental principle of open-source development is that the source code should be freely
                        available. The source code of the program can be freely downloaded, used, modified and
                        redistributed by anyone. The open source model could and should be applied in all types of
                        research and development, not only in software. Many of the most successful companies in the
                        world attribute at least some of their success to open source platforms: Amazon uses Apache as
                        a web server, large parts of Yahoo! they are built on Linux, FreeBSD and Apache, written in PHP
                        and Perl; Google has completely based on Linux its Android mobile operating system; Mozilla has
                        developed Firefox, one of the most used browsers for years in the world.
                    </p>
                    <p style="text-align:justify;">
                        The flexibility of free software makes it possible to reduce costs in many ways and accelerate
                        the development of projects by having fewer restrictions that can be presented using closed
                        models. The freedoms end up being important for the users, for the developers and for the
                        companies; and at the same time, society can adapt the model to make culture flourish, just as
                        scientific research can obtain results more quickly, which will have an impact on the benefit
                        of the whole of humanity.

                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Posted on Noviembre 4, 2017 by
            <a href="#">Carla Pastor</a>
        </div>
    </div>


</div>

</div>
<!-- /.container -->

<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
