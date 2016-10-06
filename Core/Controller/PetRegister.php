<?php

$pet = new stdClass;
$pet->id = null;
$pet->user = null;
$pet->city = null;
$pet->nome = null;
$pet->tipo = null;
$pet->raca = null;
$pet->porte = null;
$pet->status = null;
$pet->dataatualizacao = null;
$pet->datacriacao = null;

$pet_photo = [];

if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    if (isset($_REQUEST['delete']) && !empty($_REQUEST['delete'])) {
        $pet_register->setResponse($response);
        $pet_register->setId($_REQUEST['id']);
        $pet_register->delete();

        $error_list = $pet_register->getError();

        if (!empty($error_list)) {
            foreach ($error_list as $error) {
                $response->setFlashMessage($error);
            }

        } else {
            $response->setFlashMessage('Pet removido com sucesso!');
            $response->httpRedirect('meus-pets.php');

            exit();
        }

    } else {
        $pet_register->setResponse($response);
        $pet_register->setId($_REQUEST['id']);
        $pet = $pet_register->get();
        $pet_photo = $pet_register->photoListing();
    }
}

if (!empty($_POST) && isset($_POST['type']) && ($_POST['type'] == 'form-pet-register')) {
    $request_id = Util::get($_POST,'id',null);
    $request_city_id = Util::get($_POST,'city_id',null);
    $request_nome = Util::get($_POST,'nome',null);
    $request_tipo = Util::get($_POST,'tipo',null);
    $request_raca = Util::get($_POST,'raca',null);
    $request_porte = Util::get($_POST,'porte',null);
    $request_photo_1 = Util::get($_FILES,'photo_1',null);
    $request_photo_2 = Util::get($_FILES,'photo_2',null);
    $request_photo_3 = Util::get($_FILES,'photo_3',null);

    if (empty($request_city_id) || empty($request_nome) || empty($request_tipo) || empty($request_raca) || empty($request_porte) || (empty($request_photo_1['tmp_name']) && empty($request_id))) {
        $response->setFlashMessage('Preencha todos os campos obrigatórios!');

    } else {
        $pet_register->setResponse($response);
        $pet_register->setId($request_id);
        $pet_register->setUserId($_SESSION['user']['id']);
        $pet_register->setCityId($request_city_id);
        $pet_register->setNome($request_nome);
        $pet_register->setTipo($request_tipo);
        $pet_register->setRaca($request_raca);
        $pet_register->setPorte($request_porte);
        $pet_register->setPhoto1($request_photo_1);
        $pet_register->setPhoto2($request_photo_2);
        $pet_register->setPhoto3($request_photo_3);
        $pet_register->save();

        $error_list = $pet_register->getError();

        if (!empty($error_list)) {
            foreach ($error_list as $error) {
                $response->setFlashMessage($error);
            }

        } else {
            $response->setFlashMessage('Cadastro concluído com sucesso!');
            $response->httpRedirect('meus-pets.php');

            exit();
        }
    }
}
