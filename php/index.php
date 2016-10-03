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
                        <li class="">
                            <a href="buscar.php">Buscar</a>
                        </li>
                        <li>
                            <a href="cadastrar.php">Cadastrar</a>
                        </li>
                        <li>
                            <a href="denunciar.php">Denunciar</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Senha" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <img src="../public/img/pet-logo-1.jpg"  alt="SOS Pets" class="img-rounded" style="width:1140px;height:530px">
                </div>
            </div>
            <div style="width:100%;height:20px;float:left;"></div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="../public/img/pet-busca-1.jpg" alt="Busca Pets" class="img-circle" style="width:340px;height:340px">
                            <div class="caption">
                                <h3>Buscar Pets</h3>
                                <p>Encontre e adote um novo amigo!</p>
                                <p>
                                    <a href="buscar.php" class="btn btn-primary" role="button">Procurar</a> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="../public/img/pet-cadastro-1.jpg" alt="Busca Pets" class="img-circle" style="width:340px;height:340px">
                            <div class="caption">
                                <h3>Cadastre um novo Pet</h3>
                                <p>Entre aqui e cadastre um pet abandonado!</p>
                                <p>
                                    <a href="cadastrar.php" class="btn btn-primary" role="button">Cadastrar</a> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="../public/img/pet-denuncie-1.jpg" alt="Busca Pets" class="img-circle" style="width:340px;height:340px">
                            <div class="caption">
                                <h3>Denuncie!</h3>
                                <p>Encontrou algum animal sofrendo maus tratos, ajude a denunciar!</p>
                                <p>
                                    <a href="denunciar.php" class="btn btn-primary" role="button">Denunciar</a> 
                                </p>
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
        <script src="../public/js/jquery-3.1.1.min.js"></script>
        <script src="../public/js/bootstrap.min.js"></script>
    </body>
</html>
