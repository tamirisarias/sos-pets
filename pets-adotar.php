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
        <link href="../public/css/sweetalert.css" rel="stylesheet">
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
                    <a href="buscar.php">Buscar</a>
                </li>
                <li class="active">Adotar</li>
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
                                    <a class="btn btn-default pull-right" href="buscar.php" role="button">
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
                                    Dados do Pet <b><?php print $pet->nome; ?></b>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-default pull-right" href="buscar.php" role="button">
                                        <span class="glyphicon glyphicon-share-alt"></span> Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="btn_pet_adopt" class="btn btn-primary btn-lg btn-block">Quero adotar!</button>
                                    <div class="list-group">
                                        <a class="list-group-item">
                                            <h4 class="list-group-item-heading">
                                                Nome
                                            </h4>
                                            <p class="list-group-item-text"><?php print $pet->nome; ?></p>
                                        </a>
                                        <a class="list-group-item">
                                            <h4 class="list-group-item-heading">
                                                Tipo
                                            </h4>
                                            <p class="list-group-item-text"><?php print $pet->tipo_label; ?></p>
                                        </a>
                                        <a class="list-group-item">
                                            <h4 class="list-group-item-heading">
                                                Raça
                                            </h4>
                                            <p class="list-group-item-text"><?php print $pet->raca; ?></p>
                                        </a>
                                        <a class="list-group-item">
                                            <h4 class="list-group-item-heading">
                                                Porte
                                            </h4>
                                            <p class="list-group-item-text"><?php print $pet->porte_label; ?></p>
                                        </a>
                                        <a class="list-group-item">
                                            <h4 class="list-group-item-heading">
                                                Cidade
                                            </h4>
                                            <p class="list-group-item-text"><?php print $pet->city->nome; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
        <div style="display:none;" id="div_pet_adopt">
            <div class="col-md-12">
                <div class="list-group">
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">
                            Nome do tutor
                        </h4>
                        <p class="list-group-item-text"><?php print $pet->user->nome; ?></p>
                    </a>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">
                            Email
                        </h4>
                        <p class="list-group-item-text"><?php print $pet->user->email; ?></p>
                    </a>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">
                            Telefone
                        </h4>
                        <p class="list-group-item-text"><?php print $pet->user->telefone; ?></p>
                    </a>
                </div>
            </div>
        </div>
        <script src="../public/js/jquery-3.1.1.min.js"></script>
        <script src="../public/js/bootstrap.min.js"></script>
        <script src="../public/js/ekko-lightbox.min.js"></script>
        <script src="../public/js/sweetalert.min.js"></script>
        <script src="../public/js/main.js"></script>
    </body>
</html>
