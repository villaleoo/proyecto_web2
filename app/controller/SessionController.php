<?php
require_once './app/view/SessionView.php';
require_once './app/model/UsersModel.php';
require_once './app/helpers/AuthHelper.php';


class SessionController {
    private $model;
    private $view;

    public function __construct(){
        $this->model = new UsersModel();
        $this->view=new SessionView();
    }

    public function showLogin(){
        AuthHelper::verifySessionExist();
        $this->view->renderFormLogin();
    }

    public function auth(){
        $userName = $_POST['userName'];
        $password= $_POST['password'];

        if(!isset( $_POST['userName']) || !isset($_POST['password'])){
            header('Location:'.BASE_URL);
        }

        if (empty($userName) || empty($password)) {
            $this->view->renderFormLogin('Campo/s incompleto/s.');
            return;
        }
        $user = $this->model->getUserByUserName($userName);
       
        if($user && password_verify($password, $user->contrasenia)){
           
            AuthHelper::login($user);

            header('Location:'.BASE_URL);

        } else {
            $this->view->renderFormLogin('Usuario y/o contraseña inválido/s.');
        }

    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }



}

?>