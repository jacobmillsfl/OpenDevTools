<?php
session_start();
include_once("Utilities/SessionManager.php");

if (SessionManager::getUserId() != 0)
{
    echo SessionManager::getTestMessage();
    echo "User ID: " . SessionManager::getUserId();
}
else{
    echo "No Session. Please login";
}

?>