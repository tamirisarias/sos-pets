<?php

if (!empty($_POST) && isset($_POST['type']) && ($_POST['type'] == 'form-register')) {
    $request_nome = Util::get($_POST,'nome',null);
    $request_email = Util::get($_POST,'email',null);
    $request_senha = Util::get($_POST,'senha',null);
    $request_telefone = Util::get($_POST,'telefone',null);

    if (empty($request_nome) || empty($request_email) || empty($request_senha)) {
        $response->setFlashMessage('Preencha todos os campos obrigatórios!');

    } else {
        $register->setResponse($response);
        $register->setNome($request_nome);
        $register->setEmail($request_email);
        $register->setSenha($request_senha);
        $register->setTelefone($request_telefone);
        $result = $register->save();

        if (empty($result)) {
            $response->setFlashMessage('Não foi possível cadastrar este usuário, tente novamente!');

        } else {
            $session->setEmail($request_email);
            $session->setSenha($request_senha);
            $result = $session->loginInit();

            if (!empty($result)) {
                $response->setFlashMessage('Cadastro concluído com sucesso!');
            }
        }
    }
}
