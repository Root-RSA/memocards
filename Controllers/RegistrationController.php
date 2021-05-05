<?php
namespace Controllers;

use System\View;
use System\Conn;
use System\Security;
use Models\UserModel;


class RegistrationController
{
    public function actionRegister()
    {
        //Sanitize the iserted data
        $credentials = Security::sanitize();

        $user = new UserModel();

        //Check if the username is already in use
        $check = $user->userExists($credentials['username']);

        if(!$check) {
            $this->createUser($user, $credentials['username'], password_hash($credentials['password'], PASSWORD_DEFAULT));
        } else {
            $msg = "Another user found with this username. Please try an alternative one.";
            setcookie('feedback', $msg, time()+60, '/', false, false, true);
            header('location: ../views/register');
        }
    }

    //Creates a new user and gives feedback in case a new user creation fails
    public function createUser(UserModel $user, $username, $password)
    {
        //Create a user
        $newUser = $user->create($username, $password);

        if($newUser) {
            View::render('login');
        } else {
            $msg = "Registration procedure failed for thechnical reasons. Please try another combination of username and password";
            setcookie('feedback', $msg, time()+60, '/', false, false, true);
            header('location: ../views/register');
        }
    }
}