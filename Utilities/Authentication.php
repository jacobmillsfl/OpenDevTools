<?php
/**
 * Author:  Jacob Mills
 * Description: Class for managing authentication routines
 * Date: 10/15/2017
 */


class Authentication
{

    public static function authLogin($username,$password) {
        $users = User::search(0,$username,"","","","","","","",0);
        if (count($users) != 1) return false;

        if(password_verify($password, $users[0]->getPassword())) {
            return true;
            // User session manager to create new session for this user
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
    }
}

?>