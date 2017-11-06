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
            <a href="index">Home</a>
        </li>

        <li class="breadcrumb-item active"> Blog</li>
    </ol>



    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

        <?php
        $blogList=Blog::loadall();
        foreach ($blogList as $blogItem){
            echo "<div class=\"card mb-4\">";
            echo "<img class =\"card-img-top blog-home-img\" src=\"" .$blogItem->getImgUrl() ."\" alt=\"Blog Image\">";
            echo "<div class=\"card-body\">";
            echo "<h2 class=\"card-title\">" . $blogItem->getTitle() . "</h2>";
            echo "<p class=\"card-text\">" . $blogItem->getContent() . "</p>";
            //echo "<a href=\"#\" class=\"btn btn-primary\">" Read More "</a>"; //fix this
            echo"</div>";
            echo "<div class=\"card-footer text muted\">"  . $blogItem->getCreateDate() . "</div>";
            echo "<a href=\"#\">".$blogItem-> getUserId(). "</a>";
            echo "</div>";
        }
        ?>



            <!-- Blog Post -->
            <div class="card mb-4">
                <img class="card-img-top blog-home-img" src="/images/go_lang_mascot_by_kirael_art-cpp15d.gif" alt="Blog Image">
                <div class="card-body">
                    <h2 class="card-title">Go, el mejor lenguaje de programación de código abierto creado por Google</h2>
                    <p class="card-text">Go or más conocido como Golang ha ganado mucha fuerza, grandes empresas confían en golang, entre
                        ellas; Facebook, MongoDB, Mozilla, Netflix, Comcast, Twitter, Shutterfly, y  Dropbox.
                        Check la lista de compañías de todo el mundo que actualmente usan golang en el siguiente link
                        <a href="https://github.com/golang/go/wiki/GoUsers" ><span style="color:#1e90ff">
                                https://github.com/golang/go/wiki/GoUsers</span></a></p>
                    <a href="/blogsample1" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on Noviembre 5, 2017 by
                    <a href="#"> Carla Pastor</a>
                </div>
            </div>

            <!-- Blog Post -->
            <div class="card mb-4">
                <img class="card-img-top blog-home-img" src="/images/opensource.Carla.png" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">El éxito del Open Source</h2>
                    <p class="card-text">La definición básica de open source es aquella que dice que el código fuente de un programa puede
                        ser libremente descargado, utilizado, modificado y redistribuido por cualquiera. El modelo open
                        source podría y debería ser aplicado en todo tipo de investigación y desarrollo, no sólo en el de
                        software.</p>
                    <a href="/blogsample2" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on Noviembre 4, 2017 by
                    <a href="#"> Carla Pastor</a>
                </div>
            </div>

            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card mb-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <a href="#">HTML</a>
                                </li>
                                <li>
                                    <a href="#">Freebies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">JavaScript</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>

    </div><!-- /.row -->
</div><!-- /container -->

<!-- Footer -->
<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>