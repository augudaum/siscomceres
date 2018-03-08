<?php

    use app\classes\User;
    use app\models\usuarios\Usuario;

    $this->functions[] = $this->functionsToView('showFlashMessages', function($key, $type='negative') {
        return (new app\classes\Flash)->get($key, $type);
    });

    $this->functions[] = $this->functionsToView('userSession', function() {
        return (new User)->getData(new Usuario());
    });