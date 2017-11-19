<?php
/* Blog home page */
session_start();
include_once("DAL/Blog.php");
include_once("DAL/BlogCategory.php");
include_once("DAL/User.php");
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
    <?php
    //if logged in, show button to create blog
    //$status= SessionManager::getUserId();
    //if($status==0)
    //{
    //    echo '<div class = "text - right">';
    //        echo '<a href="create - blog" class ="btn btn - info btn - lg">Create Blog</a>';
    //    echo '</div>';
    // }
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index">Home</a>
        </li>

        <li class="breadcrumb-item active"> Blog</li>
    </ol>
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- uses the loadall() method from Blog.php to dynamically load blog images, titles, contents, dates, and user IDs -->
            <?php
            $blogList=Blog::loadall();
            foreach ($blogList as $blogItem){
                ?>
                <div class="card mb-4">
                    <img class="card-img-top blog-home-img" src="<?php echo $blogItem->getImgUrl(); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $blogItem->getTitle(); ?></h2>
                        <p class="card-text"><?php echo $blogItem->getContent(); ?></p>
                        <!--<a href="/blogsample2" class="btn btn-primary">Read More &rarr;</a>-->
                    </div>
                    <div class="card-footer text-muted">
                        Posted on <?php echo $blogItem->getCreateDate(); ?> by
                        <a href="#">
                            <?php
                            $user = new User();
                            $user->load($blogItem->getUserId());
                            echo $user->getUsername();
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
            <div class ="text-center">
                <a href="create-blog" class ="btn btn-primary btn-lg btn-block"><i class=""></i> Create Blog</a>
            </div>
            <br>
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