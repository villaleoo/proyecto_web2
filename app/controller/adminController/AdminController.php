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

        
        
        $arrTeams= $this->controllerTeam->getTeams();
        // $arrLeagues= $controllerLeague->getLeagues();
        $arrLeagues= ["liga1", "liga2"];
        $arrData= array("clubes" => $arrTeams, "ligas"=> $arrLeagues, "categoriaElegida" => $category);



        if(isset($_POST) && !empty($_POST)){
            if($this->isEmptyValues($_POST)){       /*MAS VALIDACIONES/VERIF AL POST EJEMPLO EQUIPO CONSIDERADO REPETIDO (RECORRO EQUIPOS Y RETORNO SI ENCUENTRA UNO CON NOMBRE IGUAL AL QUE VIENE POR POST) */
                $this->layout->showHeader("Admin");
                $this->view->renderAdminCRUD($arrData, "Campo/s requeridos incompleto/s.");
                $this->layout->showFooter();
                return;
            }else {
                /*esta editando???? */
                if($idItemEdit){
                    if($category == 'ligas'){
                        echo "ligasarasasasasa";

                    }else{
                        $team= array("id_club" =>intval($idItemEdit),"dataForm"=> $_POST);
                        $this->controllerTeam->updateTeam($team);
                        
                    }
                     
                }else{
                    if($category == 'ligas'){

                    }else{
                          /*agrego el nuevo club a la bbdd */
                          $newTeam= array("dataTeam" => $_POST, "entidad" => 'club');
                          $this->controllerTeam->addTeam($newTeam);
                    }
                  
                }
                header('Location: '.BASE_URL."admin/clubes");
            }

        }



        $this->layout->showHeader("Admin");
        if($category == 'ligas'){
            // $this->controllerRequired = new LeaguesController();
            // $arrData= $this->controllerRequired->getLeagues();
            // $this->view-> renderCRUD($arrData, $category);
        }else{
            
            if(isset($idItemEdit)){
                $team= $this->getTeamById($idItemEdit);
                if($team){
                    $this->view->renderAdminCRUD($arrData,null,$team); /*agregar param team */
                }else{
                    echo "ERROR URL NO EXISTE adminController";
                }
                
            }else{
                $this->view->renderAdminCRUD($arrData);
            }
            
            

        }
        $this->layout->showFooter();

    }

    public function showDeleteItem($category, $id){


        if($category == "liga"){



        }else{
            if($this->controllerTeam->getIndexTeam($id) > 0){
                $team= $this->controllerTeam->getTeam($id);
                $this->layout->showHeader("Eliminar / FootballData⚽");
                $this->view->renderDeleteItem($team, 'clubes');
                $this->layout->showFooter();
            }else{
                echo "EEROR 404 adminController";
            }
        }
    }

    public function removeItem($category, $idTeam){
        if($category == 'liga'){

        }else{
           
            $this->controllerTeam->removeTeam($idTeam);
            
        }
        header('Location: '.BASE_URL."admin/clubes");

    }
  



    private function isEmptyValues ($dataForm){
        $qValuesNull= 2;
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

    private function getTeamById($id){
        if($this->controllerTeam-> getIndexTeam($id) < 0){
            return null;
        }

        $team= $this->controllerTeam->getTeam($id);
        return $team;

    }




}



?>