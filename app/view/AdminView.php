<?php 
class AdminView{


    public function renderAdminCRUD($arrData, $errorForm = null, $teamEdit=null){
        require('./app/templates/categoryList.phtml');
        if(isset($teamEdit)){
            require('./app/templates/forms/updateTeam.phtml');
        }else{
            require('./app/templates/forms/formTeam.phtml');
        }
        
        
    }
    public function renderDeleteItem($item = null, $category){
        require('./app/templates/forms/deleteItem.phtml');
    }


}


?>