<?php 
require_once './app/helpers/AuthHelper.php';
require_once './app/controller/siteControllers/LayoutController.php';
require_once './app/view/AdminView.php';
abstract class AdminController {
    protected $layout;
    protected $view;
    protected $controller;
    protected $titleSection;/*ligas o clubes */

    /*los controladores admin se comunican con otros controladores (de ligas o equipos) para solicitarle que le den informacion de la bbdd */
    /*tiene su propia vista adminView y se le asocia el controlador layout para que todos los controladores admin (de ligas o equipos) ya tengan acceso a header y footer */
    /*titleSection y controller lo determinan las clases hijas */
    public function __construct ( $controller ,$titleSection) {
        AuthHelper::verifyAdminSession();
        $this->layout=new LayoutController();
        $this->view= new AdminView();
        $this->controller=$controller;
        $this->titleSection=$titleSection;

    }

    /*funcion que se dispara cuando se accede a administrar items,si se quiere editar un item se le pasa el id del item, tambien captura los post de los formularios que administran items*/
    /*verifica los post y si no hay pedido de post, manda a renderizar el crud con la funcion showCRUD */
    public function adminCRUD($idItemEdit = null ){
        $arrData =$this-> getData();

        /*para capturar imagenes enctype="multipart/form-data" en form y se usa $_FILES para acceder a imagenes (no implementado)*/
        if(isset($_POST) && !empty($_POST)){
            if($this->_isEmptyValues($_POST, 2) || $this->validationLenghtInput($_POST)){       /*MAS VALIDACIONES/VERIF AL POST EJEMPLO item CONSIDERADO REPETIDO (RECORRO items Y RETORNO SI ENCUENTRA UNO CON NOMBRE IGUAL AL QUE VIENE POR POST) */
                $this-> showErrorForm($arrData, $idItemEdit);
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


    /*funcion que muestra el "desea eeliminar item". Necesita del id de un item (liga o equipo) para renderizar */
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

    /*funcion que se la invoca cuando se acepta eliminar un item, necesita el id del item a eliminar  */
    public function removeItem($id){
        $this->controller->removeItem($id);
        header('Location: '.BASE_URL.'admin/'.$this->titleSection);

    }

    /*funcion que verifica si algun campo de un formulario esta vacio, el segundo parametro controla si hay campos que no son necesarios completar*/
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

    /*funcion que manda a renderizar un error si se busca una URL inexistente */
    public function showError(){
        $this->view->renderError();
    }


    /*FUNCIONES ABSTRACTAS QUE DEBEN IMPLEMENTAR LAS CLASES HIJAS ADMINISTRADORAS DE ITEMS Y CATEGORIAS */

    /*obtiene los datos que debe renderizar la vista de admin (acorde a si se solicita administrar items o categorias) */
    abstract function getData();
    /*renderiza el crud acorde a la data obtenida de getData y completa el formulario con los valores del item a editar (si lo hay) */
    abstract function showCRUD($arrData, $idItemEdit= null);
    /*crea un nuevo item o categoria (segun que clase la invoque) con el contenido que le hace llegar adminCrud extraido de $_POST*/  
    abstract function createNewItem($postContent);
    /*muestra error en el formulario (campos vacios o campos eliminados desde el front) es abstracta porque mandan a renderizar distintos templates(distintos forms item-categoria)*/
    abstract function showErrorForm($arrData ,$idItemEdit);
    /*valida que los datos venidos por $_POST sean todos los que tiene el form (si el form tiene 10 inputs, que esten los 10 seteados) */
    abstract function validationLenghtInput($arrForm);

}

?>