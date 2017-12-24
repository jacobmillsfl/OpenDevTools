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
include_once("DAL/Forum.php");
include_once("DAL/Permission.php");
include_once("DAL/ForumCategory.php");

$errorMessage = "";
$userId = SessionManager::getUserId();
if (false )// !Authentication::hasPermission($userId,Permission::ManageForum))
{
    header("location: /forumhome");
}
else
{
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = $_POST["forumname"];
        $categoryId = $_POST["forumcategory"];
        $content = $_POST["forumcontent"];
        $currentDate = date('Y-m-d H:i:s');
        //insert forum into table

        $forum = new Forum();
        $forum->setTitle($title);
        $forum->setForumCategoryId($categoryId);
        $forum->setContent($content);
        $forum->setCreateDate($currentDate);
        $forum->setCreatedByUserId($userId);
        $forum->save();


        //direct back to forumhome page
        header("location: /forumhome");

    }
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
            <h3>Forum Entry</h3> <small></small>
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
            <form name="createforum" id="forumForm" method="post" validate>
                <div class="row">
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Title:</strong><span style="color:red">*</span>
                            <input type="text" class="form-control" id="forumname" name="forumname" required
                                   data-validation-required-message="Please enter a Title for your forum." maxlength="255">
                        </div>
                    </div>
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Forum Category</strong>
                            <small>Please Select a the category that your forum falls under.</small>
                            <select name="forumcategory" id="forumcategory" class="form-control">
                                <option>--Select Category--</option>

                                <?php
                                $forumCategoryList = ForumCategory::loadall();
                                if(!empty($forumCategoryList)){
                                    foreach ($forumCategoryList as $forumcategory){
                                        ?>
                                        <option value="<?php echo $forumcategory->getId(); ?>"><?php echo $forumcategory->getName(); ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="control-group form-group col-lg-12">
                        <div class="controls">
                            <strong>Content:</strong><span style="color:red">*</span>
                            <br/><small>Please enter the content that you would like to add to your entry.</small>
                            <textarea rows="10" cols="100" class="form-control" id="forumcontent" name="forumcontent" required maxlength="32768"
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

</body>
</html>
