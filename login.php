<?php



include("Utilities/Authentication.php");
include("DAL/User.php");

$result = Authentication::authLogin("Test1","opendevtools1");
if ($result == true)
{
    echo "Login Success!";
}
else
{
    echo "Login Unsuccessful";
}


?>
