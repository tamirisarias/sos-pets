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
                        <li class="active">
                            <a href="buscar.php">Buscar</a>
                        </li>
                        <li>
                            <?php if (!empty($_SESSION['user'])) { ?>
                            <a href="meus-pets.php"><i><b>Meus Pets</b></i></a>
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
                <li class="active">Buscar</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="row">
                            <form class="form-inline" method="GET" action="buscar.php">
                                <input name="type" value="form-pet-search" type="hidden">
                                <div class="form-group">
                                    <label for="search_pet_input_type">Tipo</label>
                                    <select name="tipo" class="form-control" id="search_pet_input_type">
                                        <option value="">--- selecione ---</option>
                                        <option value="1" <?php if (!empty($flag_pet_search)) { if ($request_tipo == '1') { ?>selected="selected"<?php } } ?>>Cão</option>
                                        <option value="2" <?php if (!empty($flag_pet_search)) { if ($request_tipo == '2') { ?>selected="selected"<?php } } ?>>Gato</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="search_pet_input_porte">Porte</label>
                                    <select name="porte" class="form-control" id="search_pet_input_porte">
                                        <option value="">--- selecione ---</option>
                                        <option value="1" <?php if (!empty($flag_pet_search)) { if ($request_porte == '1') { ?>selected="selected"<?php } } ?>>Filhote</option>
                                        <option value="2" <?php if (!empty($flag_pet_search)) { if ($request_porte == '2') { ?>selected="selected"<?php } } ?>>Adulto</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="search_pet_input_raca">Raça</label>
                                    <input name="raca" type="text" value="<?php if (!empty($flag_pet_search)) { print $request_raca; } ?>" class="form-control" id="search_pet_input_raca" placeholder="Raça">
                                </div>
                                <div class="form-group">
                                    <label for="search_pet_input_cidade">Cidade</label>
                                    <select name="city_id" class="form-control" id="search_pet_input_cidade">
                                        <option value="0">--- Selecione ---</option>
                                        <?php if (!empty($pet_city_listing)) { ?>
                                        <?php foreach ($pet_city_listing as $state => $city_listing) { ?>
                                        <optgroup label="<?php print $state; ?>">
                                        <?php foreach ($city_listing as $city) { ?>
                                        <option value="<?php print $city->id; ?>" <?php if (!empty($flag_pet_search)) { if ($request_city_id == $city->id) { ?>selected="selected"<?php } } ?>><?php print utf8_encode($city->nome); ?></option>
                                        <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar Pet</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Encontre um Pet para adotar!
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Porte</th>
                                    <th>Raça</th>
                                    <th>Região</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($flag_pet_search)) { ?>
                                <?php $pet_register_listing = $pet_register_search; ?>
                                <?php } else { ?>
                                <?php $pet_register_listing = $pet_register->listing(); ?>
                                <?php } ?>
                                <?php if (empty($pet_register_listing)) { ?>
                                <tr>
                                    <td colspan="8">
                                        <?php if (!empty($flag_pet_search)) { ?>
                                        <p class="text-center">Nenhum Pet encontrado para sua consulta!</p>
                                        <?php } else { ?>
                                        <p class="text-center">Não há Pets cadastrados!</p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php foreach ($pet_register_listing as $key => $pet_register) { ?>
                                <tr>
                                    <td>
                                        <img src="<?php print $pet_register->photo[1]->path; ?>" class="img-responsive img-thumbnail" width="50" height="50" title="<?php print $pet_register->nome; ?>" alt="<?php print $pet_register->nome; ?>"></img>
                                    </td>
                                    <td><?php print utf8_encode($pet_register->nome); ?></td>
                                    <td><?php print $pet_register->tipo_label; ?></td>
                                    <td><?php print utf8_encode($pet_register->raca); ?></td>
                                    <td><?php print $pet_register->porte_label; ?></td>
                                    <td><?php print $pet_register->city->estadosigla; ?>/<?php print utf8_encode($pet_register->city->nome); ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="pets-adotar.php?id=<?php print $pet_register->id; ?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-heart-empty"></span> Adotar!
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
