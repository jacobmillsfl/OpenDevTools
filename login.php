<?php
session_start();


include_once("Utilities/Authentication.php");

$errorMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $success = Authentication::authLogin($username,$password);
    if ($success)
    {
        header("location: /index.php");
    }
    else
    {
        $errorMessage = "Incorrect username or password. Try again.";
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
            <h3>Login</h3> <small></small>
            <br/><br/>
            <form name="login" id="loginForm" method="post" validate>
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
                </div>
                <div class="row">
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Password:</strong><span style="color:red;">*</span>
                            <br/><small>Please enter a strong password</small>
                            <input type="password" class="form-control" id="password" name="password" required
                                   data-validation-required-message="Please enter a password." maxlength="255">
                        </div>
                    </div>
                </div>
                <?php
                    if ($errorMessage != "")
                    {
                        echo "<div id=\"success\">" . $errorMessage . "</div>";
                    }
                ?>
                <div class="row">
                    <div class="col-lg-6 ">
                        <button type="submit" class="btn btn-primary float-right">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    <br/>
</div>
<!-- /.container -->


<?php include "footer.php" ?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
