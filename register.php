<?php
/**
 * Author: Jacob Mills
 * Date: 10/16/2017
 * Description:
 */

session_start();

include_once("Utilities/SessionManager.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Add code to authentication registration
    // Step 1) Ensure username is not already taken
    // Step 2) Use Authentication::createUser() with the form fields to create new user
    // Step 3) Use SessionManager::setUserId() to store the new userID in session
    // Step 4) Redirect to /account.php for the newly created user


    // Temporary Test Code
    SessionManager::setUserId(1);
    header("location: /index.php");
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
                    <br/><br/>
                    <form name="register" id="registerForm" method="post" validate>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Username:</strong><span style="color:red;">*</span>
                                    <br/><small>Please enter a unique username</small>
                                    <input type="text" class="form-control" id="username" required
                                           data-validation-required-message="Please enter a username." maxlength="255">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Password:</strong><span style="color:red;">*</span>
                                    <br/><small>Please enter a strong password</small>
                                    <input type="password" class="form-control" id="password" required
                                           data-validation-required-message="Please enter a password." maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Email Address:</strong><span style="color:red;">*</span>
                                    <br/><small>Please enter your email address</small>
                                    <input type="email" class="form-control" id="email" required
                                           data-validation-required-message="Please enter your email address." maxlength="255">
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>Location:</strong>
                                    <br/><small>Please enter your location</small>
                                    <input type="text" class="form-control" id="location" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>User Avatar:</strong>
                                    <br/><small>Please enter the URL of an image to associate with your profile</small>
                                    <input type="text" class="form-control" id="imgUrl" maxlength="511">
                                </div>
                            </div>
                            <div class="control-group form-group col-lg-6 ">
                                <div class="controls">
                                    <strong>GitHub URL:</strong>
                                    <br/><small>Please enter your GitHub URL</small>
                                    <input type="text" class="form-control" id="githubUrl" maxlength="511">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="control-group form-group col-lg-12">
                                <div class="controls">
                                    <strong>Background:</strong>
                                    <br/><small>Please enter background information about yourself</small>
                                    <textarea rows="10" cols="100" class="form-control" id="bio" maxlength="1047"
                                              style="resize:none"></textarea>
                                </div>
                            </div>
                        </div>

                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary float-right">Register</button>
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
