<?php 
class Model {
    protected $db;

    public function __construct(){
        $this->db= new PDO('mysql:host=localhost;dbname=web-tpe;charset=utf8', 'root', '');
    }
}


?>