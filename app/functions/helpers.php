<?php

    use app\validate\Validate;
    use app\validate\Sanitize;
    use app\models\database\DefaultModel;
    use app\classes\Login;
    use app\classes\Redirect;
    use app\classes\Flash;
    use app\classes\User;

    function dd($dump) {
        var_dump($dump);
        die();
    }

    function toJson($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    function validate(Validate $v) {
        $v->validate();
        return $v;
    }

    /**
     * Retorna o campo passado por parâmetros sanizitado
     */
    function request($field = null) {
        $sanitized = new Sanitize();
        if(!is_null($field)) {
            return $sanitized->sanitized()->$field;
        }
        return $sanitized->sanitized();
    }

    function authenticate(DefaultModel $model) {
        return (new Login)->login($model);
    }

    function redirect($target) {
        return Redirect::redirect($target);
    }

    /**
     * Redireciona para a página anterior
     */
    function back() {
        return Redirect::back();
    }

    function flash($messages) {
        return Flash::add($messages);
    }

    function getUser(DefaultModel $model) {
        $user = new User();
        return $user->getData($model);
    }

?>