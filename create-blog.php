<?php
/**
 * Author: Jacob Mills
 * Date: 10/16/2017
 * Description:
 */

session_start();

include_once("Utilities/SessionManager.php");
include_once("Utilities/Authentication.php");
include_once("Utilities/Mailer.php");
include_once("DAL/User.php");
include_once("DAL/Blog.php");

$errorMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {


    $title = $_POST["blogname"];
    $imgUrl = $_POST["imgUrl"];
    $categoryId = $_POST["blogcategory"];
    $content = $_POST["blogcontent"];
    $currentDate = date('Y-m-d H:i:s');
    $uid = SessionManager::getUserId();
    //insert blog into table

    $blog = new Blog();
    $blog->setTitle($title);
    $blog->setImgUrl($imgUrl);
    $blog->setBlogCategoryId($categoryId);
    $blog->setContent($content);
    $blog->setCreateDate($currentDate);
    $blog->setUserId($uid);
    $blog->save();


    //direct back to bloghome page
     header("location: /bloghome");

}

?>


<!DOCTYPE html>
<html lang="en">
    <?php include "head.php" ?>
    <body>
        <?php include "header.php" ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mt-4">
                    <br/><br/>
                    <h3>Blog Entry</h3> <small></small>
                    <br/>
                    <?php
                    if ($errorMessage != "")
                    {
                        echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
                        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                        echo "<span aria-hidden=\"true\">&times;</span>";
                        echo "</button>";
                        echo "<strong>Error</strong> " . $errorMessage;
                        echo "</div>";
                    }
                    ?>

                    <br/>
                    <form name="createblog" id="blogForm" method="post" validate>
                        <div class="row">
                            <div class="control-group form-group col-lg-6">
                                <div class="controls">
                                    <strong>Title:</strong><span style="color:red">*</span>
                                    <input type="text" class="form-control" id="blogname" name="blogname" required
                                           data-validation-required-message="Please enter a Title for your blog." maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Image 1:</strong>
                                    <br/><small>Please enter the URL of an image to associate with your blog</small>
                                    <input type="text" class="form-control" id="imgUrl" name="imgUrl" maxlength="511">
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Blog Category</strong>
                                    <br/><small>Please Enter a the category that your blog falls under.</small>
                                    <select name="blogcategory" id="blogcategory" class="form-control">
                                        <option>--Select Category--</option>
                                        <option value="1">Web Design</option>
                                        <option value="2">Security</option>
                                        <option value="3">Databases</option>
                                        <option value="4">Tutorials</option>
                                        <option value="5">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-lg-12">
                                <div class="controls">
                                    <strong>Content:</strong><span style="color:red">*</span>
                                    <br/><small>Please enter the content that you would like to add to your entry.</small>
                                    <textarea rows="10" cols="100" class="form-control" id="blogcontent" name="blogcontent" required maxlength="32768"
                                              style="resize:vertical overflow:auto;" ></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->


        <?php include "footer.php" ?>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
