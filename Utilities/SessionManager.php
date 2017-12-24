<?php
/*
 * Author:      Jacob Mills
 * Date:        10/16/2017
 * Description: This utility provides static functions to implement centralized accessor/mutator methods for all session values.
 *
 */

include_once("DAL/Blog.php");

class SessionManager
{

    public static function getTestMessage() {
        if (isset($_SESSION['msg']))
            return $_SESSION['msg'];
        else
            return "";

    }

    public static function setTestMessage($arg1){
        $_SESSION['msg'] = $arg1;
    }



    public static function getUserId() {
        if (isset($_SESSION['userId']))
            return $_SESSION['userId'];
        else
            return 0;

    }

    public static function setUserId($arg1){
        $_SESSION['userId'] = $arg1;
    }

    public static function getBlogNavItems(){
        if (isset($_SESSION['blogNavItems']))
        {
            $blogNavItems = array();
            $sessionItems = $_SESSION['blogNavItems'];

            foreach($sessionItems as $item)
            {
                $blogNavItems[] = unserialize($item);
            }
            return $blogNavItems;
        }

        else
        {
            $blogNavItems = array();
            $blogs = Blog::loadall();
            $count = 0;
            foreach ($blogs as $blog)
            {
                $blogNav = new Blog();
                $blogNav->setId($blog->getId);
                $blogNav->setTitle($blog->getTitle);
                $blogNavItems[] = serialize($blogNav);
                $count++;

                // Limit blog navigation to 10 items
                if ($count > 9) break;
            }


            $_SESSION['blogNavItems'] = $blogNavItems;
            return $blogNavItems;
        }
    }


}

