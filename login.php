<?php
session_start();


include("Utilities/Authentication.php");
include("Utilities/SessionManager.php");
include("DAL/User.php");

$result = Authentication::authLogin("Test1","opendevtools1");
if ($result == true)
{
    echo "Login Success!";
    // Place UserID into session
}
else
{
    echo "Login Unsuccessful";
    SessionManager::setTestMessage("HELLO WORLD! FROM SESSION");
    SessionManager::setUserId(1);
}


?>
