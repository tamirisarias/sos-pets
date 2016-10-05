<?php

if (!empty($_GET) && isset($_GET['logout']) && ($_GET['logout'] == '1')) {
    $session->logout();
}

if (!empty($_POST) && isset($_POST['type']) && ($_POST['type'] == 'form-login')) {
    $request_email = Util::get($_POST,'email',null);
    $request_senha = Util::get($_POST,'senha',null);

    $session->setEmail($request_email);
    $session->setSenha($request_senha);
    $result = $session->loginInit();

    if (empty($result)) {
        $response->setFlashMessage('Usuário não encontrado, tente novamente!');

    } else {
        $response->setFlashMessage('Bem vindo!');
    }

}
