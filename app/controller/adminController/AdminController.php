<?php 
require_once './app/view/AdminView.php';
require_once './app/controller/siteControllers/LayoutController.php';
require_once './app/helpers/AuthHelper.php';
require_once './app/controller/dbControllers/TeamController.php';
require_once './app/controller/dbControllers/LeagueController.php';


class AdminController {
    private $view;
    private $layout;
    private $controllerTeam;
    private $controllerLeague;

    public function __construct () {
        $this->view = new AdminView ();
        $this->layout = new LayoutController();
        $this->controllerTeam= new TeamController();
        $this->controllerLeague= new LeagueController();
    }

    
    public function showAdminCRUD($category, $idItemEdit = null){
        AuthHelper::verifyAdminSession();

        if(!$category){
            header('Location:'.BASE_URL);         /*EN EL CASO DE QUE EL SISTEMA CREZCA/MODIFIQUE Y SE REQUIERA HACER UNA VISTA DE /ADMIN SE QUITA LA CONDICION*/
        }
        $arrData =$this-> _getData($category); /*obtiene los items que necesita para renderizar la vista admin acorde a la categoria que se quiere administrar */

        if(isset($_POST) && !empty($_POST)){
            if($this->_isEmptyValues($_POST, 2)){       /*MAS VALIDACIONES/VERIF AL POST EJEMPLO item CONSIDERADO REPETIDO (RECORRO items Y RETORNO SI ENCUENTRA UNO CON NOMBRE IGUAL AL QUE VIENE POR POST) */
                $this-> _showErrorForm($category, $arrData); /*OTRA VALIDACION A AGREGAR ES SI ELIMINAN UN INPUT DESDE EL FRONT RECHAZAR EL FORMULARIO. HAY QUE RECORRER CUANTOS CAMPOS TIENE LIGAS Y CLUBES, DETECTAR LOS QUE PUEDEN SER NULOS Y VERIFICAR QUE TODOS LOS DEMAS ESTEN SETEADOS Y NO ESTEN VACIOS */
                return;
            }else {
                /*esta editando???? */
                if($idItemEdit){
                    if($category == 'ligas'){
                        $league= array(0 => $_POST, 1 =>intval($idItemEdit));
                        $this->controllerLeague->updateItem($league);
                    }else{
                        $team= array(0 => $_POST , 1 =>intval($idItemEdit),);
                        $this->controllerTeam->updateItem($team);   
                    }
                     
                }else{
                    if($category == 'ligas'){
                        $newLeague= array(0 => $_POST, 1 => 'liga');
                        $this->controllerLeague->addItem($newLeague);

                    }else{
                          /*agrego el nuevo club a la bbdd */
                          $newTeam= array(0 => $_POST, 1 => 'club');
                          $this->controllerTeam->addItem($newTeam);
                    }
                  
                }
                header('Location: '.BASE_URL."admin/$category");
            }

        }

        $this->layout->showHeader("Admin");
        $this->_showCRUD($category, $arrData, $idItemEdit);     /*manda a mostrar el crud acorde a la categoria/item, acorde a los datos de esa categoria/item, y el item que se quiere editar(opcionalmente) */
        $this->layout->showFooter();

    }

    private function _showCRUD($category, $arrData,$idItemEdit=null){
        if($category == 'ligas'){
            if(isset($idItemEdit)){
                $league= $this->_getLeagueById($idItemEdit);
                if($league){
                    $this->view->renderLeagueCRUD($arrData,null,$league); /*agregar param team */
                }else{
                    echo "ERROR URL NO EXISTE adminController";
                }
                
            }else{
                $this->view->renderLeagueCRUD($arrData);
            }

        }else{
            if(isset($idItemEdit)){
                $team= $this->_getTeamById($idItemEdit);
                if($team){
                    $this->view->renderTeamCRUD($arrData,null,$team); /*agregar param team */
                }else{
                    echo "ERROR URL NO EXISTE adminController";
                }
                
            }else{
                $this->view->renderTeamCRUD($arrData);
            }
            
        }

    }

    private function _getData($category){
        $arrData;
        if($category == 'ligas'){
            $arrItems= $this->controllerLeague->getArrItems();
            $arrData= array("ligas" => $arrItems, "categoria" => $category);

        }else{
            $arrItems=$this->controllerTeam->getArrItems();
            $arrLeagues= $this->controllerLeague->getArrItems();

            $arrData= array("clubes" => $arrItems, "ligas" => $arrLeagues, "categoria" => $category);

        }

        return $arrData;
    }

    private function _showErrorForm($category, $arrData){
        $this->layout->showHeader("Admin");

        if($category == 'ligas'){
            $this->view->renderLeagueCRUD($arrData, "Campo/s requeridos incompleto/s.");
        }else{
            $this->view->renderTeamCRUD($arrData, "Campo/s requeridos incompleto/s.");
        }
        $this->layout->showFooter();
    
    }



    public function showDeleteItem($category, $id){
        AuthHelper::verifyAdminSession();

        $this->layout->showHeader("Eliminar / FootballData⚽");
        if($category == "liga"){

            if($this->controllerLeague->getIndexByItemId($id) >= 0){
                $league= $this->controllerLeague->getItem($id);
                $this->view->renderDeleteItem($league, 'ligas');
            }else{
                echo "EEROR 404 adminController";
            }

        }else{
            if($this->controllerTeam->getIndexByItemId($id) >= 0){
                $team= $this->controllerTeam->getItem($id);
                $this->view->renderDeleteItem($team, 'clubes');
                
            }else{
               
                echo "EEROR 404 adminController";
            }
        }
        $this->layout->showFooter();
    }

    public function removeItem($category, $id){
        AuthHelper::verifyAdminSession();
        if($category == 'liga'){
            $this->controllerLeague->removeItem($id);
            header('Location: '.BASE_URL.'admin/ligas');

        }else{
            $this->controllerTeam->removeItem($id);
            header('Location: '.BASE_URL.'admin/clubes');
        }
       

    }
  

    private function _isEmptyValues ($dataForm ,$qValuesNull){
        $pos=0;

        foreach ($dataForm as $value) {
            $pos++;
            if(empty($value)){
                return true;
            }
            if($pos == count($dataForm)-$qValuesNull){
                return false;
            }
        }
        
        return false;
    }

    private function _getLeagueById($id){
        if($this->controllerLeague-> getIndexByItemId($id) < 0){
            return null;
        }

        $league= $this->controllerLeague->getItem($id);
        return $league;

    }

    private function _getTeamById($id){
        if($this->controllerTeam-> getIndexByItemId($id) < 0){
            return null;
        }

        $team= $this->controllerTeam->getItem($id);
        return $team;

    }




}



?>