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

$errorMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Add code to authentication registration
    // Step 1) Ensure username is not already taken
    // Step 2) Use Authentication::createUser() with the form fields to create new user
    // Step 3) Use SessionManager::setUserId() to store the new userID in session
    // Step 4) Redirect to /account.php for the newly created user
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordconf = $_POST["passwordconf"];
    $email = $_POST["email"];
    $location = $_POST["location"];
    $imgUrl = $_POST["imgUrl"];
    $githubUrl = $_POST["githubUrl"];
    $bio = $_POST["bio"];



    // 1) Ensure username is not already taken
    $user = User::lookup($username);
    if ($user != null) {
        // This username is already taken
        $errorMessage = "The provided username is already in use. Please try another username.";
    }
    elseif($password != $passwordconf) {
        $errorMessage = "The passwords you entered do not match. Please try again.";
    }
    else {
        $currentDate = date('Y-m-d H:i:s');
        $defaultRoleId = 1; // This corresponds to the GENERAL default Role (Not Admin, Moderator, or Blogger)
        $user = Authentication::createUser($username,$password,$email,$bio,$location,$imgUrl,$githubUrl,$currentDate,$defaultRoleId);

        if ($user == null) {
            // Something went wrong while attempting to create this user
            $errorMessage = "An error occurred during the creation of this user account. Please try again. If the problem continues, contact OpenDevTools support at opendevtools@gmail.com";
        }
        else {
            // Set session values for successful login
            $userId = $user->getId();
            SessionManager::setUserId($userId);

            // Send registration email
            Mailer::sendRegistrationEmail($user->getEmail(),$user->getUsername());

            // Redirect to account page
            header("location: /account");
        }
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
                    <h3>Register</h3> <small></small>
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
                    <form name="register" id="registerForm" method="post" validate>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Username:</strong><span style="color:red;">*</span>
                                    <br/><small>Please enter a unique username</small>
                                    <input type="text" class="form-control" id="username" name="username" required
                                           data-validation-required-message="Please enter a username." maxlength="255">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-3 ">
                                <div class="controls">
                                    <strong>Password:</strong><span style="color:red;">*</span>
                                    <br/><small>Please enter a strong password</small>
                                    <input type="password" class="form-control" id="password" name="password" required
                                           data-validation-required-message="Please enter a password." maxlength="255">
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-3 ">
                                <div class="controls">
                                    <strong>Password Confirmation:</strong><span style="color:red;">*</span>
                                    <br/><small>Please retype your password</small>
                                    <input type="password" class="form-control" id="passwordconf" name="passwordconf" required
                                           data-validation-required-message="Please Re-enter password." maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Email Address:</strong><span style="color:red;">*</span>
                                    <br/><small>Please enter your email address</small>
                                    <input type="email" class="form-control" id="email" name="email" required
                                           data-validation-required-message="Please enter your email address." maxlength="255">
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Location:</strong>
                                    <br/><small>Please enter your location</small>
                                    <input type="text" class="form-control" id="location" name="location" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>User Avatar:</strong>
                                    <br/><small>Please enter the URL of an image to associate with your profile</small>
                                    <input type="text" class="form-control" id="imgUrl" name="imgUrl" maxlength="511">
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>GitHub URL:</strong>
                                    <br/><small>Please enter your GitHub URL</small>
                                    <input type="text" class="form-control" id="githubUrl" name="githubUrl" maxlength="511">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="control-group form-group col-lg-12">
                                <div class="controls">
                                    <strong>Background:</strong>
                                    <br/><small>Please enter background information about yourself</small>
                                    <textarea rows="10" cols="100" class="form-control" id="bio" name="bio" maxlength="1047"
                                              style="resize:none"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Register</button>
                    </form>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->


        <?php include "footer.php" ?>

    </body>
</html>
