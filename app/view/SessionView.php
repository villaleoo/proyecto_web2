<?php 
class SessionView{

    public function renderFormLogin($error = null){
        require ('./app/templates/login.phtml');
    }
}

?>