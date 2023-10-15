<?php
    include_once './app/controller/siteControllers/HomeController.php';
    include_once './app/controller/SessionController.php';
    include_once './app/controller/adminController/AdminController.php';
    $INIT_APP="home";   /*ESTA CONSTANTE DETERMINA A DONDE SE DIRECCIONA CUANDO LA URL SEA SOLO LA RAIZ */
    $action=$INIT_APP; /*ASIGNAMOS A ACTION EL VALOR DE LA CONSTANTE POR DEFECTO. */
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');   /*OBTIENE/DETERMINA LA RAIZ DEL SITIO*/

    /*"action" es la palabra clave en el archivo .htaccess, el get["action"] obtiene lo que hay despues de la raiz de nuestro sisito www.ejemplo.com/action=valorEn$_GET["action"]*/
    if(!empty($_GET["action"])){
        $action=$_GET["action"];    /*se guarda el valor que toma action en la url en la variable $action, si esta no está vacia y esta inicializada*/
    }

    /*toma el valor de action y lo itera entre barras("/") y guarda en un array. "action" puede valor un string de este tipo: "home/algo/otraCosa/otraOtraCosa..."*/
    $params=explode("/", $action);  
    
    
    
    switch ($params[0]) {
        case "home":
            $controllerHome=new HomeController();
            $controllerHome->showHome();  /*invoca al controlador del home del sitio */
            break;
        case "clubes":
            $controllerTeam= new TeamController();
            if(isset($params[1]) && !empty($params[1])){
                $controllerTeam->showTeam($params[1]);
            }else{
                $controllerTeam->showTeamsList();
            }
            break;
        case "login":
            $controllerSession= new SessionController();
            $controllerSession->showLogin();
            break;
        case 'auth':
            $controllerSession = new SessionController();
            $controllerSession->auth();
            break;
        case 'logout':
            $controllerSession = new SessionController();
            $controllerSession->logout();
            break;
        case "admin":
            $controllerAdmin= new AdminController ();

            if(isset($params[2]) && !empty($params[2])){
                $controllerAdmin->showAdminCRUD($params[1], $params[2]);
               
            }else{
                $controllerAdmin->showAdminCRUD($params[1]);
            }
            break;
        case "eliminar":
            $controllerAdmin = new AdminController();
            if(count($params) == 3){
                $controllerAdmin->showDeleteItem($params[1], $params[2]);
            }
            if(count($params) == 4){
                $controllerAdmin->removeItem($params[1], $params[2]);
            }

            break;
        default:
            echo "defaul";
            break;
    }


?>