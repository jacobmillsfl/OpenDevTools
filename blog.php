<?php
/**
 * Author: Jacob Mills
 * Description: This is a blog page
 * Date: 11/29/2017
 */

session_start();
include_once("DAL/Blog.php");
include_once("DAL/BlogCategory.php");
include_once("DAL/User.php");
include_once("DAL/Permission.php");
include_once("Utilities/Authentication.php");

$userId = SessionManager::getUserId();


$blogId = 0;

if (isset($_GET['id'])) {
    $blogId = htmlspecialchars($_GET["id"]);
}

$blog = new Blog($blogId);

// Check to ensure a blog has been loaded
if($blog->getId() < 1)
{
    header("location:/bloghome");
}


?>

<!DOCTYPE html>
<html lang="es">

<?php include "head.php" ?>

<body>

<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">OpenDevTools
        <small>Blog</small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="bloghome">Blog Home</a>
        </li>

        <?php
            echo "<li class=\"breadcrumb-item active\">". $blog->getTitle() . "</li>";
        ?>

    </ol>
    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Preview Image -->
            <?php
            echo "<img class=\"img-fluid rounded\" src=\"". $blog->getImgUrl() ."\" alt=\"blogImage\">";
            ?>


            <hr>

            <!-- Date/Time -->
            <?php
            $date = new DateTime($blog->getCreateDate());
            echo "<p>Posted on " . $date->format('l, F d y h:i:s') . "</p>";
            ?>


            <hr>

            <!-- Post Content -->
            <p>
                <?php
                echo nl2br($blog->getContent());
                ?>
            </p>
            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <!-- Comment with nested comments -->
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Commenter Name</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>

                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Commenter Name</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <?php
            if (Authentication::hasPermission($userId,Permission::ManageBlog))
            {
                echo "<div class =\"text-center\">";
                echo "<a href=\"create-blog\" class =\"btn btn-primary btn-lg btn-block\"><i class=\"\"></i>Create Blog</a>";
                echo "</div>";
                echo "<br>";
            }
            ?>
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
                        <?php
                        $BlogCategoryList = BlogCategory::loadall();
                        foreach ($BlogCategoryList as $blogcategory){
                            ?>
                            <div class="col-lg-6">
                                <a href="#"><?php echo $blogcategory->getName() ?></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div><!-- /.container -->

<?php include "footer.php" ?>

</body>
</html>