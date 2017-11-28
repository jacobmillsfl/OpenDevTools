<?php
/**
 * Author:  Jacob Mills
 * Description: Class for managing authentication routines
 * Date: 10/15/2017
 */

include_once("SessionManager.php");
include_once("DAL/User.php");
include_once("DAL/Permission.php");

class Authentication
{

    // Returns boolean indication if user is found
    public static function authLogin($username,$password) {
        $user = User::lookup($username);
        if($user != null && password_verify($password, $user->getPassword())) {
            SessionManager::setUserId($user->getId());
            return true;
        }
        else {
            return false;
        }
    }

    public static function createUser($paramUsername,$paramPassword,$paramEmail,$paramBio,$paramLocation,$paramImgUrl,$paramGithubUrl,$paramCreateDate,$paramRoleId)
    {
        // Create password using the code below to generate a hash

        $options = [
            'cost' => 10,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $hash = password_hash($paramPassword, PASSWORD_BCRYPT, $options);

        $user = new User(0,$paramUsername,$hash,$paramEmail,$paramBio,$paramLocation,$paramImgUrl,$paramGithubUrl,$paramCreateDate,$paramRoleId);
        $user->save();

        return $user;
    }

    public static function hasPermission($userId,$permissionName)
    {
        return Permission::checkUserPermission($userId,$permissionName);
    }

    public static function updatePassword($userId,$paramPassword)
    {
        // Hash the new password and update the user

        $options = [
            'cost' => 10,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];

        $hash = password_hash($paramPassword, PASSWORD_BCRYPT, $options);
        $user = new User($userId);
        $user->setPassword($hash);
        $user->save();
    }
}

?>