<?php
    include_once './app/controller/HomeController.php';
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
        
        default:
            echo "defaul";
            break;
    }


?>