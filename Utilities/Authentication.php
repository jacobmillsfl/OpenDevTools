<?php
/**
 * Author:  Jacob Mills
 * Description: Class for managing authentication routines
 * Date: 10/15/2017
 */


/*$user = new Users();
$user->setUsername("Test");

$options = [
    'cost' => 10,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$hash = password_hash("opendevtools", PASSWORD_BCRYPT, $options);

$user->setPassword($options);
$user->save();*/


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
}

?>