<?php
session_start();
include_once("Utilities/SessionManager.php");
include_once("DAL/User.php");

$userId = SessionManager::getUserId();

// If the user is not logged in, they should not have access to this page
if ($userId == 0)
{
    header("location:/login");
}
else{
    $user = new User($userId);
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
            <h1>Account</h1>
            <br/>
            <br/>
            <div class = "text-right">
                <a href="edit-user.php" class ="btn btn-info btn-lg">Edit Profile</a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div>
                        <?php
                            echo "<img class=\"img-responsive \" src=\"" . $user->getImgUrl() . "\" alt=\"avatar\" style=\"max-height:255px;max-width:255px;\" />";
                        ?>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-6">
                    <div class="row">
                        <?php
                        echo "<h2>" . $user->getUsername() . "</h2>"
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        echo "<p style='font-style: italic;'>" . $user->getLocation() . "</p>";
                        ?>
                    </div>
                    <div class="row">
                        <?php
                            echo "<p><a href='mailto:" . $user->getEmail() . "'>" . $user->getEmail() . "</a></p>";
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        echo "<p><a href='" . $user->getGithubUrl() . "'>" . $user->getGithubUrl() . "</a></p>";
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        echo "<p>" . $user->getBio() . "</p>";
                        ?>
                    </div>
                </div>
            </div>
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

