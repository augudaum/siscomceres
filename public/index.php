<?php

    require "../bootstrap.php";

    use core\Controller;
    use core\Method;
    use core\Parameters;
    use app\classes\Permissions;

    
    try {
        $controllerFound = new Controller;
        $controller = $controllerFound->load();

        $method = new Method;
        $method = $method->load($controller);

        $parameters = new Parameters;
        $parameters = $parameters->load();

        $permission = new Permissions($controllerFound->getController(), $method);
        $permission->checkPermissions();

        $controller->$method($parameters);

    } catch (\Exception $e) {
        dd($e->getMessage());
    }
