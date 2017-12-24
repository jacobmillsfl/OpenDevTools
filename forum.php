<?php
/**
 * Author: Jacob Mills
 * Description: This is a forum page
 * Date: 11/29/2017
 */

session_start();
include_once("DAL/Forum.php");
include_once("DAL/ForumCategory.php");
include_once("DAL/ForumComment.php");
include_once("DAL/User.php");
include_once("DAL/Permission.php");
include_once("Utilities/Authentication.php");

$userId = SessionManager::getUserId();


$forumId = 0;

if (isset($_GET['id'])) {
    $forumId = htmlspecialchars($_GET["id"]);
}

$forum = new Forum($forumId);

// Check to ensure a forum has been loaded
if($forum->getId() < 1)
{
    header("location:/forumhome");
}
else
{
    // Increment forum views
    $forum->setViews($forum->getViews() + 1);
    $forum->save();
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["SubmitComment"])) //Check if Submit (comment) button was clicked
    {
        $returnVal = true;
        isset($_POST["Content"]) && $_POST["Content"] != "" ? $comment = $_POST["Content"] : $returnVal = false;    //check that textarea is not empty
        if($returnVal){
            $currentDate = date('Y-m-d H:i:s');

            $forumcomment = new ForumComment();

            $forumcomment->setForumId($forumId);
            $forumcomment->setComment($comment);
            $forumcomment->setCreateDate($currentDate);
            $forumcomment->setUserId($userId);

            $forumcomment->save();
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
        <small>Forum</small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="forumhome">Forum Home</a>
        </li>

        <?php
        echo "<li class=\"breadcrumb-item active\">". $forum->getTitle() . "</li>";
        ?>

    </ol>

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">




            <hr>

            <!-- Date/Time -->
            <?php
            $date = new DateTime($forum->getCreateDate());
            echo "<p>Posted on " . $date->format('l, F d y h:i:s') . "</p>";
            ?>


            <hr>




            <!-- Post Content -->
            <p>
                <?php
                echo nl2br($forum->getContent());
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
            // Load all comments for this forum id from the database

            $comments = ForumComment::search(null,$forumId,null,null,null);


            foreach ($comments as $comment) {
                $commentUserId = $comment->getUserId();
                $user = new User($commentUserId);

                ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle forumComment" src="<?php echo $user->getImgUrl(); ?>" alt="">
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
            if (Authentication::hasPermission($userId,Permission::ManageForum))
            {
                echo "<div class =\"text-center\">";
                echo "<a href=\"create-forum\" class =\"btn btn-primary btn-lg btn-block\"><i class=\"\"></i>Create Forum</a>";
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
                        $ForumCategoryList = ForumCategory::loadall();
                        foreach ($ForumCategoryList as $forumcategory){
                            ?>
                            <div class="col-lg-6">
                                <a href="#"><?php echo $forumcategory->getName() ?></a>
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