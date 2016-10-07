<?php require('Core/Constant.php'); ?>
<?php require('Core/Util.php'); ?>
<?php require('Core/WException.php'); ?>
<?php require('Core/Response.php'); ?>
<?php require('Core/Transaction.php'); ?>
<?php require('Core/Model/Session.php'); ?>
<?php require('Core/Model/Register.php'); ?>
<?php require('Core/Model/PetRegister.php'); ?>
<?php require('Core/Controller/Main.php'); ?>
<?php require('Core/Controller/Session.php'); ?>
<?php require('Core/Controller/Register.php'); ?>
<?php require('Core/Controller/PetRegister.php'); ?>
<?php

if (empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])) {
    $response->httpRedirect('cadastrar.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="sos pets">
        <meta name="author" content="tamiris arias">
        <title>SOS Pets</title>
        <link href="../public/css/bootstrap.min.css" rel="stylesheet">
        <link href="../public/css/ekko-lightbox.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">SOS Pets</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="buscar.php">Buscar</a>
                        </li>
                        <li class="active">
                            <?php if (!empty($_SESSION['user'])) { ?>
                            <a href="meus-pets.php"><i>Meus Pets</i></a>
                            <?php } else { ?>
                            <a href="cadastrar.php">Cadastrar</a>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="denunciar.php">Denunciar</a>
                        </li>
                    </ul>
                    <?php if (!empty($_SESSION['user'])) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a>Bem vindo(a) <u><?php print $_SESSION['user']['nome']; ?></u></a>
                            </li>
                            <li>
                                <a href="index.php?logout=1">
                                    <span class="glyphicon glyphicon-log-out"></span> Logout
                                </a>
                            </li>
                        </u>
                    <?php } else { ?>
                    <form class="navbar-form navbar-right" method="POST" action="index.php">
                        <input name="type" value="form-login" type="hidden">
                        <div class="form-group">
                            <input name="email" type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input name="senha" type="password" placeholder="Senha" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <?php $flash_message_list = $response->getFlashMessage(); if (!empty($flash_message_list)) { ?>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($flash_message_list as $flash_message) { ?>
                        <p><?php print $flash_message; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="index.php">SOS Pets</a>
                </li>
                <li>
                    <a href="meus-pets.php">Meus Pets</a>
                </li>
                <li class="active"><?php if (!empty($pet->id)) { ?>Editar<?php } else { ?>Cadastrar<?php } ?></li>
            </ol>
            <div class="col-md-12">
                <div class="row">
                    <?php if (!empty($pet->id)) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6" style="padding-top:8px;">
                                    Fotos do Pet <b><?php if (!empty($pet->nome)) { print $pet->nome; } ?></b>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-default pull-right" href="meus-pets.php" role="button">
                                        <span class="glyphicon glyphicon-share-alt"></span> Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php foreach ($pet_photo as $photo) { ?>
                                <div class="col-md-4">
                                    <a href="<?php print $photo->path; ?>" class="thumbnail" data-title="Foto do Pet <b><?php if (!empty($pet->nome)) { print $pet->nome; } ?></b>" data-toggle="lightbox" data-gallery="gallery-pet">
                                        <img src="<?php print $photo->path; ?>" class="img-responsive img-rounded" height="250" width="250" alt="<?php if (!empty($pet->nome)) { print $pet->nome; } ?>">
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6" style="padding-top:8px;">
                                    Cadastro de novo Pet!
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-default pull-right" href="meus-pets.php" role="button">
                                        <span class="glyphicon glyphicon-share-alt"></span> Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form" enctype="multipart/form-data" method="POST" action="meus-pets-cadastrar.php">
                                <input name="type" value="form-pet-register" type="hidden">
                                <input name="id" value="<?php print $pet->id; ?>" type="hidden">
                                <div class="form-group">
                                    <label for="pet_register_input_name">* Nome para o Pet</label>
                                    <input type="text" name="nome" value="<?php if (!empty($pet->nome)) { print $pet->nome; } ?>" class="form-control" id="pet_register_input_name" placeholder="Nome do Pet">
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_type">* Tipo</label>
                                    <select class="form-control" name="tipo" id="pet_register_input_type">
                                        <option value="">--- Selecione ---</option>
                                        <option value="1" <?php if (!empty($pet->tipo) && $pet->tipo == '1') { ?>selected="selected"<?php } ?>>Cão</option>
                                        <option value="2" <?php if (!empty($pet->tipo) && $pet->tipo == '2') { ?>selected="selected"<?php } ?>>Gato</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_breed">* Raça</label>
                                    <input type="text" name="raca" value="<?php if (!empty($pet->raca)) { print $pet->raca; } ?>" class="form-control" id="pet_register_input_breed" placeholder="Raça">
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_postage">* Porte</label>
                                    <select class="form-control" name="porte" id="pet_register_input_postage">
                                        <option value="">--- Selecione ---</option>
                                        <option value="1" <?php if (!empty($pet->porte) && $pet->porte == '1') { ?>selected="selected"<?php } ?>>Filhote</option>
                                        <option value="2" <?php if (!empty($pet->porte) && $pet->porte == '2') { ?>selected="selected"<?php } ?>>Adulto</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_city">* Cidade</label>
                                    <select class="form-control" name="city_id" id="pet_register_input_city">
                                        <option value="0">--- Selecione ---</option>
                                        <?php if (!empty($pet_city_listing)) { ?>
                                        <?php foreach ($pet_city_listing as $state => $city_listing) { ?>
                                        <optgroup label="<?php print $state; ?>">
                                        <?php foreach ($city_listing as $city) { ?>
                                        <option value="<?php print $city->id; ?>" <?php if ($pet->city_id == $city->id) { ?>selected="selected"<?php } ?>><?php print utf8_encode($city->nome); ?></option>
                                        <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_city">Fotos</label>
                                    <input name="photo_1" type="file" id="pet_register_input_photo_1">
                                    <p class="help-block">* Foto principal.</p>
                                    <input name="photo_2" type="file" id="pet_register_input_photo_2">
                                    <input name="photo_3" type="file" id="pet_register_input_photo_3">
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </form>
                        </div>
                        <div class="panel-footer">
                            Campos com (*) são de preenchimento obrigatório.
                        </div>
                    </div>
                </div>
            </div>
            <footer class="col-md-12" style="margin-top:40px">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body" style="text-align:center;">
                            <p class="text-muted">2016 - SOS Pets</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="../public/js/jquery-3.1.1.min.js"></script>
        <script src="../public/js/bootstrap.min.js"></script>
        <script src="../public/js/ekko-lightbox.min.js"></script>
        <script src="../public/js/main.js"></script>
    </body>
</html>
