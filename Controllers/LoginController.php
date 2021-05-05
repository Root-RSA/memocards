<?php

namespace Controllers;

use System\View;
use Models\UserModel;

class LoginController
{

    //Checks if the user with entered username exists
    public function actionLogin()
    {
        $user = (new UserModel())->read();

        if($user !== false) {
            $this->verify($user);
        } else {
            $msg = "No user with such a username. Please try again!";
            setcookie('feedback', $msg, time()+60, '/', false, false, true);
            header('location: ../views/login');
        }
    }

    //Verifies the entered password and loggs the user in or provides him a feedback
    public function verify(array $user)
    {
        if(password_verify(htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8'), $user['password']))
        {
            //Sets user session cookie for one month
            setcookie('userid', $user['id'], time()+60*60*24*30, '/', false, false, true);
            header('location: ../views/allcards');

        } else {
            $msg = "The password isn't correct. Please try again!";
            setcookie('feedback', $msg, time()+60*60*24*30, '/', false, false, true);
            header('location: ../views/login');
        }
    }

    public function actionLogout()
    {
        session_destroy();
        if (isset($_COOKIE['userid'])) {
            setcookie('userid', null, time() - 3600, '/');
        } /*else {
            echo "No cookie has been detected";
        }*/
        header('location: ../views/login');
    }
}