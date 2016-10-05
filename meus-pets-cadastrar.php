<?php require('Core/Constant.php'); ?>
<?php require('Core/Util.php'); ?>
<?php require('Core/WException.php'); ?>
<?php require('Core/Response.php'); ?>
<?php require('Core/Transaction.php'); ?>
<?php require('Core/Model/Session.php'); ?>
<?php require('Core/Model/Register.php'); ?>
<?php require('Core/Controller/Main.php'); ?>
<?php require('Core/Controller/Session.php'); ?>
<?php require('Core/Controller/Register.php'); ?>
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
                <li class="active">Cadastrar</li>
            </ol>
            <div class="col-md-12">
                <div class="row">
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
                            <form class="form" method="POST" action="meus-pets-cadastrar.php">
                                <input name="type" value="form-pet-register" type="hidden">
                                <div class="form-group">
                                    <label for="pet_register_input_name">Nome para o Pet</label>
                                    <input type="text" name="nome" class="form-control" id="pet_register_input_name" placeholder="Nome do Pet">
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_type">Tipo</label>
                                    <select class="form-control" name="tipo" id="pet_register_input_type">
                                        <option value="">--- Selecione ---</option>
                                        <option value="1">Cão</option>
                                        <option value="2">Gato</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_breed">Raça</label>
                                    <input type="text" name="raca" class="form-control" id="pet_register_input_breed" placeholder="Raça">
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_postage">Porte</label>
                                    <select class="form-control" name="porte" id="pet_register_input_postage">
                                        <option value="">--- Selecione ---</option>
                                        <option value="1">Filhote</option>
                                        <option value="2">Adulto</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pet_register_input_city">Cidade</label>
                                    <select class="form-control" name="cidade" id="pet_register_input_state">
                                        <option value="1">--- Selecione ---</option>
                                        <optgroup label="RS">
                                            <option value="1">Porto Alegre</option>
                                            <option value="2">Canoas</option>
                                            <option value="3">Novo Hamburgo</option>
                                        </optgroup>
                                        <optgroup label="SC">
                                            <option value="4">Santa Catarina</option>
                                            <option value="5">Camboriú</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </form>
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
    </body>
</html>
