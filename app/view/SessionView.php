<?php 
class SessionView{

    public function renderFormLogin($errorForm = null){
        require ('./app/templates/forms/login.phtml');
    }
}

?>