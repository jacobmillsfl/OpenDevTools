<?php
/* Forum home page */
session_start();
include_once("DAL/forumhome.php");
include_once("DAL/ForumCategory.php");
include_once("DAL/User.php");
include_once("DAL/Permission.php");
include_once("Utilities/Authentication.php");

$userId = SessionManager::getUserId();

$forumContent = null;
$forumCategoryId = null;
$pageNum = 0;


if (isset($_GET['content'])) {
    $forumContent = htmlspecialchars($_GET["content"]);
}

if (isset($_GET['forumCategoryId'])) {
    $forumCategoryId = htmlspecialchars($_GET["forumCategoryId"]);
}

if (isset($_GET['page'])) {
    $pageNum = htmlspecialchars($_GET["page"]);
}

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
        <small>Forum Home</small>
    </h1>
    <ol class="breadcrumb">

    </ol>
    <div class="row">
        <!-- Forum Entries Column -->
        <div class="col-md-8">
            <!-- uses the loadall() method from Forum.php to dynamically load forum images, titles, contents, dates, and user IDs -->
            <?php
            $forumList=Forumhome::loadForumHome($forumContent,$forumCategoryId,$pageNum);
            foreach ($forumList as $forumItem){
                ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $forumItem->getTitle(); ?></h2>
                        <p class="card-text"><?php echo nl2br(substr($forumItem->getContent(), 0, 300)); ?>...</p>
                        <?php
                        echo "<a href=\"/forum?id=". $forumItem->getForumId() ."\" class=\"btn btn-primary\">Read More &rarr;</a>";
                        ?>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on <?php echo $forumItem->getCreateDate(); ?> by
                        <a href="#">
                            <?php
                            echo $forumItem->getUsername()
                            ?>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item disabled">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>
            <!-- Pagination Example
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul> -->

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <?php
            if (Authentication::hasPermission($userId,Permission::ManageForum))
            {
                echo "<div class =\"text-center\">";
                echo "<a href=\"create-forum\" class =\"btn btn-primary btn-lg btn-block\"><i class=\"\"></i>Create Thread</a>";
                echo "</div>";
                echo "<br>";
            }
            ?>
            <!-- Search Widget -->
            <form action="forumhome" method="GET">
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" name="content" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                              <button class="btn btn-secondary" type="submit">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>


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
                                <a href="forumhome?forumCategoryId=<?php echo $forumcategory->getId(); ?>"><?php echo $forumcategory->getName(); ?></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div><!-- /container -->

<!-- Footer -->
<?php include "footer.php" ?>


</body>
</html>