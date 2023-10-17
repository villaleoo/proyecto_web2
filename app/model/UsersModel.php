<?php 
require_once './app/model/Model.php';

class UsersModel extends Model{
   

    public function getUserByUserName($userName){

        $request= $this->db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $request->execute([$userName]);
        $user = $request->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    public function getAllItems(){
        return null;
    }
}
?>