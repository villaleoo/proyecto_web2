<?php
    include_once './app/controller/SessionController.php';
    include_once './app/controller/adminController/AdminTeamController.php';
    include_once './app/controller/adminController/AdminLeagueController.php';
    $INIT_APP="ligas";   /*ESTA CONSTANTE DETERMINA A DONDE SE DIRECCIONA CUANDO LA URL SEA SOLO LA RAIZ */
    $action=$INIT_APP; /*ASIGNAMOS A ACTION EL VALOR DE LA CONSTANTE POR DEFECTO. */
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');   /*OBTIENE/DETERMINA LA RAIZ DEL SITIO*/

    /*"action" es la palabra clave en el archivo .htaccess, el get["action"] obtiene lo que hay despues de la raiz de nuestro sisito www.ejemplo.com/action=valorEn$_GET["action"]*/
    if(!empty($_GET["action"])){
        $action=$_GET["action"];    /*se guarda el valor que toma action en la url en la variable $action, si esta no está vacia y esta inicializada*/
    }

    /*toma el valor de action y lo itera entre barras("/") y guarda en un array. "action" puede valor un string de este tipo: "home/algo/otraCosa/otraOtraCosa..."*/
    $params=explode("/", $action);  
    
    
    
    switch ($params[0]) {
        case "clubes":
            $controllerTeam= new TeamController();
            if(isset($params[1]) && !empty($params[1])){
                $controllerTeam->showItemDetail($params[1]);
            }else{
                $controllerTeam->showItemList($params[0]);
            }
            break;
        case "ligas":
            $controllerLeague= new LeagueController();
            if(isset($params[1]) && !empty($params[1])){
                $controllerLeague->showItemDetail($params[1]);
            }else{
                $controllerLeague->showItemList($params[0]);
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
            $edit= isset($params[2]) && !empty($params[2]);
            switch ($params[1]) {
                case 'ligas':
                    $controllerAdmin= new AdminLeagueController();
                    if($edit){
                        $controllerAdmin->adminCRUD($params[2]);
                    }else{
                        $controllerAdmin->adminCRUD();
                    }
                    break;
                case 'clubes':
                    $controllerAdmin= new AdminTeamController();
                    if($edit){
                        $controllerAdmin->adminCRUD($params[2]);
                    }else{
                        $controllerAdmin->adminCRUD();
                    }
                    break;
                default:
                    header('Location: '.BASE_URL);
                    break;
            }
            break;
        case "eliminar":
            $qParams= count($params);
            switch ($params[1]) {
                case 'liga':
                    $controllerAdmin= new AdminLeagueController();
                    if($qParams == 3){
                        $controllerAdmin->showDeleteItem($params[2]);
                    }elseif ($qParams == 4) {
                        $controllerAdmin->removeItem($params[2]);
                    }
                    break;
                case 'club':
                    $controllerAdmin= new AdminTeamController();
                    if($qParams == 3){
                        $controllerAdmin->showDeleteItem($params[2]);
                    }elseif ($qParams == 4) {
                        $controllerAdmin->removeItem($params[2]);
                    }
                    break;
                default:
                    header('Location: '.BASE_URL);
                    break;
            }
            break;
        default:
            header('Location: '.BASE_URL);
            break;
    }


?>