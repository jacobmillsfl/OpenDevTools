<?php
session_start();
include("Utilities/SessionManager.php");

if (SessionManager::getTestMessage() != "")
{
    echo SessionManager::getTestMessage();
    echo "User ID: " . SessionManager::getUserId();
}
else{
    echo "No Session. Please login";
}

?>