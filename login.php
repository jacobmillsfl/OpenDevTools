<?php
session_start();


include_once("Utilities/Authentication.php");

$success = Authentication::authLogin("Test","opendevtools");
if ($success)
{
    echo "Login Success!";
}
else
{
    echo "Login Unsuccessful";
}


?>
