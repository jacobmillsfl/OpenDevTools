<?php



include("Utilities/Authentication.php");
include("DAL/Users.php");

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
