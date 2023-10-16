<?php 
require_once './app/helpers/AuthHelper.php';
require_once './app/controller/siteControllers/LayoutController.php';
require_once './app/view/AdminView.php';
abstract class AdminController {
    protected $layout;
    protected $view;
    protected $controller;
    protected $titleSection;/*ligas o clubes */

    public function __construct ( $controller ,$titleSection) {
        AuthHelper::verifyAdminSession();
        $this->layout=new LayoutController();
        $this->view= new AdminView();
        $this->controller=$controller;
        $this->titleSection=$titleSection;

    }

    public function adminCRUD($idItemEdit = null ){
        $arrData =$this-> getData();

        if(isset($_POST) && !empty($_POST)){
            if($this->_isEmptyValues($_POST, 2)){       /*MAS VALIDACIONES/VERIF AL POST EJEMPLO item CONSIDERADO REPETIDO (RECORRO items Y RETORNO SI ENCUENTRA UNO CON NOMBRE IGUAL AL QUE VIENE POR POST) */
                $this-> showErrorForm($arrData); /*OTRA VALIDACION A AGREGAR ES SI ELIMINAN UN INPUT DESDE EL FRONT RECHAZAR EL FORMULARIO. HAY QUE RECORRER CUANTOS CAMPOS TIENE LIGAS Y CLUBES, DETECTAR LOS QUE PUEDEN SER NULOS Y VERIFICAR QUE TODOS LOS DEMAS ESTEN SETEADOS Y NO ESTEN VACIOS */
                return;
            }else{
                if($idItemEdit){
                    $item= array(0 => $_POST, 1 =>intval($idItemEdit));
                    $this->controller->updateItem($item);
                }else{
                    $this->createNewItem($_POST);
                }
                header('Location: '.BASE_URL."admin/$this->titleSection");
            }
        }

        $this->layout->showHeader("Admin");
        $this->showCRUD($arrData, $idItemEdit);     /*manda a mostrar el crud acorde a la categoria/item, acorde a los datos de esa categoria/item, y el item que se quiere editar(opcionalmente) */
        $this->layout->showFooter();
    }


    
    public function showDeleteItem($id){
        $this->layout->showHeader("Eliminar");
        
        if($this->controller->getIndexByItemId($id) >= 0){
            $item= $this->controller->getItem($id);
            $this->view->renderDeleteItem($item, $this->titleSection); 
        }else{
            $this->showError();
        }
        $this->layout->showFooter();
        
    }

    public function removeItem($id){
        $this->controller->removeItem($id);
        header('Location: '.BASE_URL.'admin/'.$this->titleSection);

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
    public function showError(){
        $this->view->renderError();
    }
    abstract  function showCRUD($arrData, $idItemEdit= null);
    abstract function createNewItem($postContent);
    abstract function getData();
    abstract function showErrorForm($arrData);


}

?>