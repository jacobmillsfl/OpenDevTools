<?php
/**
 * Author: Jacob Mills
 * Date: 11/28/2017
 * Description: This page enables users request a password reset
 */



session_start();

include_once("Utilities/SessionManager.php");
include_once("Utilities/Authentication.php");
include_once("Utilities/Mailer.php");
include_once("DAL/User.php");

$errorMessage = "";
$success = false;

$userId = SessionManager::getUserId();
// If the user is not logged in, they should not have access to this page
if ($userId != 0) {
    header("location:/account");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $isValid=true;
    if($_POST["username"]=="")
        $isValid=false;
    if($_POST["email"]=="")
        $isValid=false;

    if($isValid==true) {
        $username = $_POST["username"];
        $email = $_POST["email"];

        $searchResults = User::search(null,$username,null,$email,null,null,null,null,null,null);

        if (count($searchResults) > 0)
        {
            $userId = $searchResults[0]->getId();
            $username = $searchResults[0]->getUsername();


            // Generate random password
            $password = bin2hex(openssl_random_pseudo_bytes(16));

            // Update the user's password
            Authentication::updatePassword($userId,$password);

            // Create the email and send the message
            $email_subject = "New OpenDevTools Password";
            $email_body = "You recently requested a password reset for the following account: $username<br/><br/>New Password: $password<br/><br/>If you did not request this password change, please contact opendevtools@gmail.com immediately.<br/><br/>Sincerely,<br/>The OpenDevTools team";

            Mailer::sendGenericEmail($email,$email_subject,$email_body);
        }

        // Display success message regardless of whether or not an email was found.
        // We don't want malicious users to be able to identify usernames and emails of others.
        $success = true;
    }
    else {
        $errorMessage = "All fields are required.";
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
            <h3>Forgot Password</h3> <small></small>
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
            } elseif ($success)
            {
                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                echo "<span aria-hidden=\"true\">&times;</span>";
                echo "</button>";
                echo "<strong>Success</strong> We sent a new password for this account to your email address.";
                echo "</div>";
            }
            ?>


            <br/>
            <form name="update" id="updateForm" method="post" validate>

                <div class="row">
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Username:</strong><span style="color:red;">*</span>
                            <input type="text" class="form-control" id="username" name="username" required
                                   data-validation-required-message="Please enter your username." maxlength="255">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="control-group form-group col-lg-6 ">
                        <div class="controls">
                            <strong>Email Address:</strong><span style="color:red;">*</span>
                            <input type="email" class="form-control" id="email" name="email" required
                                   data-validation-required-message="Please enter the email address for this account." maxlength="255">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3 col-sm-12">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Remind Me</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<?php include "footer.php" ?>

</body>
</html>