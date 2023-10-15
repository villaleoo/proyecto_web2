<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::init();

        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_NAME'] = $user->nombre_usuario; 
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verifySessionExist() {
        AuthHelper::init();
        if (isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL );
            die();
        }
    }

    /*si no hay un usuario logueado o si el nombre de usuario no es webadmin, direccionalo al home*/
    public static function verifyAdminSession(){
        AuthHelper::init();
        if( !isset($_SESSION['USER_ID']) || $_SESSION['USER_NAME'] != 'webadmin'){     
            header('Location: '.BASE_URL);
            die();
        }
    }
}
