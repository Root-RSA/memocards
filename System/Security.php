<?php

namespace System;

class Security
{
    public $credentials = [];

    public static function sanitize()
    {
        $credentials['username'] = isset($_POST['username']) ? htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8') : header('location: ../views/login');
        $credentials['password'] = isset($_POST['password']) ? htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8') : header('location: ../views/login');
        return $credentials;
    }

    public static function is_authorized()
    {
        //Check if the user is logged in
        if(!($_COOKIE['userid'])) {
            header('location: ../views/login');
        }
    }

    public static function checkFeedback()
    {
        if(isset($_COOKIE['feedback'])){
            setcookie('feedback', null, time() - 3600, '/');
            return $_COOKIE['feedback'];
        } else {
            return null;
        }
    }
}