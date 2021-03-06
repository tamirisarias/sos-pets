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

if (!empty($_SESSION) && isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $response->httpRedirect('meus-pets.php');
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
                        <li class="">
                            <a href="buscar.php">Buscar</a>
                        </li>
                        <li class="active">
                            <?php if (!empty($_SESSION['user'])) { ?>
                            <a href="meus-pets.php"><i><b>Meus Pets<b></i></a>
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
                <li class="active">Cadastrar</li>
            </ol>
            <div class="row">
                <div class="col-md-6">
                    <form class="form" method="POST" action="cadastrar.php">
                        <input name="type" value="form-login" type="hidden">
                        <div class="panel panel-default">
                            <div class="panel-heading">Ja sou cadastrado!</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="login_input_email">Email</label>
                                    <input type="text" name="email" class="form-control" id="login_input_email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="login_input_senha">Senha</label>
                                    <input type="password" name="senha" class="form-control" id="login_input_senha" placeholder="Senha">
                                </div>
                                <button type="submit" class="btn btn-primary">Acessar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form" method="POST" action="cadastrar.php">
                        <input name="type" value="form-register" type="hidden">
                        <div class="panel panel-default">
                            <div class="panel-heading">Quero me cadastrar!</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="register_input_nome">* Nome do tutor</label>
                                    <input type="text" name="nome" class="form-control" id="register_input_nome" placeholder="Nome do tutor">
                                </div>
                                <div class="form-group">
                                    <label for="register_input_email">* Email</label>
                                    <input type="text" name="email" class="form-control" id="register_input_email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="register_input_senha">* Senha</label>
                                    <input type="password" name="senha" class="form-control" id="register_input_senha" placeholder="Senha">
                                </div>
                                <div class="form-group">
                                    <label for="register_input_telefone">Telefone</label>
                                    <input type="text" name="telefone" class="form-control" id="register_input_telefone" placeholder="Telefone">
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                            <div class="panel-footer">
                                Campos com (*) são de preenchimento obrigatório.
                            </div>
                        </div>
                    </form>
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
