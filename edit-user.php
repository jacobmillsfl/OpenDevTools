<?php
/**
 * Created by PhpStorm.
 * User: annabelle
 * Date: 11/18/17
 * Time: 4:17 PM
 */


session_start();

include_once("Utilities/SessionManager.php");
include_once("Utilities/Authentication.php");
include_once("Utilities/Mailer.php");
include_once("DAL/User.php");

$errorMessage = "";


$userId = SessionManager::getUserId();
// If the user is not logged in, they should not have access to this page
if ($userId == 0) {
    header("location:/login");
} else {
    $user = new User($userId);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $returnVal=true;
    $email = $_POST["email"];
    if($_POST["email"]=="")
        $returnVal=false;
    $location = $_POST["location"];

    if($_POST["location"]=="")
        $returnVal=false;

    $imgUrl = $_POST["imgUrl"];
    $githubUrl = $_POST["githubUrl"];
    $bio = $_POST["bio"];

    if($returnVal==true) {

        $user->setEmail($email);
        $user->setLocation($location);
        $user->setImgUrl($imgUrl);
        $user->setGithubUrl($githubUrl);
        $user->setBio($bio);


        $user->save();

    }


    //redirect to account page
    header("location:/account");

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
            <h3>Update</h3> <small></small>
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
            <form name="update" id="updateForm" method="post" validate>

                <div class="row">
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Email Address:</strong><span style="color:red;">*</span>
                            <br/><small>Please enter a new email address</small>
                            <input type="email" class="form-control" id="email" name="email" required
                                   data-validation-required-message="Please enter your email address." maxlength="255"
                                value = "<?php echo $user->getEmail()?>">
                        </div>
                    </div>
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Location:</strong>
                            <br/><small>Please enter a new location</small>
                            <input type="text" class="form-control" id="location" name="location" maxlength="255"
                                value="<?php echo $user->getLocation() ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>User Avatar:</strong>
                            <br/><small>Please enter the URL of an image to associate with your profile</small>
                            <input type="text" class="form-control" id="imgUrl" name="imgUrl" maxlength="511"
                                value ="<?php echo $user->getImgUrl() ?>">
                        </div>
                    </div>
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>GitHub URL:</strong>
                            <br/><small>Please enter your GitHub URL</small>
                            <input type="text" class="form-control" id="githubUrl" name="githubUrl" maxlength="511"
                            value = " <?php echo $user->getGithubUrl() ?>">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="control-group form-group col-lg-12">
                        <div class="controls">
                            <strong>Background:</strong>
                            <br/><small>Please enter background information about yourself</small>
                            <textarea rows="10" cols="100" class="form-control" id="bio" name="bio" maxlength="1047"
                                      style="resize:none"> <?php echo $user->getBio() ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<?php include "footer.php" ?>

</body>
</html>