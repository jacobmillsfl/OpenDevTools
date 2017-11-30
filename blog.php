<?php
/**
 * Author: Jacob Mills
 * Description: This is a blog page
 * Date: 11/29/2017
 */

session_start();
include_once("DAL/Blog.php");
include_once("DAL/BlogCategory.php");
include_once("DAL/BlogComment.php");
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


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["SubmitComment"])) //Check if Submit (comment) button was clicked
    {
        $returnVal = true;
        isset($_POST["Content"]) && $_POST["Content"] != "" ? $comment = $_POST["Content"] : $returnVal = false;    //check that textarea is not empty
        if($returnVal){
            $currentDate = date('Y-m-d H:i:s');

            $blogcomment = new BlogComment();

            $blogcomment->setBlogId($blogId);
            $blogcomment->setComment($comment);
            $blogcomment->setCreateDate($currentDate);
            $blogcomment->setUserId($userId);

            $blogcomment->save();
        }
        else{
            $errorMessage = "Enter a comment.";
        }

    }

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
            <?php if($userId > 0): ?>
                <?php
                if (isset($errorMessage) && $errorMessage != "")
                {
                    echo "<div class=\"alert alert-danger\">" . $errorMessage . "</div>";
                }
                ?>
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form method = "post">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="Content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="SubmitComment">Submit</button>
                        </form>
                    </div>
                </div>
            <?php endif ?>


            <!-- Single Comment -->
            <?php
            // Load all comments for this blog id from the database

            $comments = BlogComment::search(null,$blogId,null,null,null);


            foreach ($comments as $comment) {
                $commentUserId = $comment->getUserId();
                $user = new User($commentUserId);

                ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle blogComment" src="<?php echo $user->getImgUrl(); ?>" alt="">
                    <div class="media-body">

                        <h5 class="mt-0"><?php echo $user->getUsername(); ?> </h5>
                        <small class="float-right">
                            <?php
                            $date = new DateTime($comment->getCreateDate());
                            echo " Posted on " . $date->format('l, F d y h:i:s') ;
                            ?>
                        </small>
                        <br>
                        <?php echo nl2br($comment->getComment());?>
                    </div>
                </div>
            <?php
            }//end foreach

            ?>



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