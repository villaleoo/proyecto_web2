<?php 
require_once './config.php';
abstract class Model {
    protected $db;

    public function __construct(){
       
        $this->_createBBDD();
        $this->_deploy();
        
    }

    private function _createBBDD(){
        try {
            $this->db = new PDO("mysql:host=".MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $dbname = MYSQL_DB;
        
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        
            $this->db->exec($sql);
        
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 

    }

  
    private function _deploy(){
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);            
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if(count($tables) == 0){
            $sql = file_get_contents('./db/webtpe.sql');
            $this->db->exec($sql);
       
        }
    }

   abstract public function getAllItems();
}


?>