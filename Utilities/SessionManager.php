<?php
//session_start();


class SessionManager
{

    public static function getTestMessage() {
        if ($_SESSION['msg'])
            return $_SESSION['msg'];
        else
            return "";

    }

    public static function setTestMessage($arg1){
        $_SESSION['msg'] = $arg1;
    }

    public static function getUserId() {
        if ($_SESSION['userId'])
            return $_SESSION['userId'];
        else
            return 0;

    }

    public static function setUserId($arg1){
        $_SESSION['userId'] = $arg1;
    }
}

