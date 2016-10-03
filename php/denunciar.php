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
                        <li class="active">
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
            <ol class="breadcrumb">
                <li>
                    <a href="index.php">SOS Pets</a>
                </li>
                <li class="active">Denunciar</li>
            </ol>
            <div class="col-md-12">
                <div class="row">
                    <form class="form">
                        <div class="panel panel-default">
                            <div class="panel-heading">Preencha todos os campos corretamente, os dados serão analisados e se denuncia for válida, encaminharemos para as autoridades.</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Nome para contato</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nome para contato">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">* Descreva a situação do animal</label>
                                    <textarea class="form-control" rows="10">Encontrei um pet abandonado por seu dono...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">* Carregar imagem</label>
                                    <input type="file" id="exampleInputFile">
                                    <p class="help-block">Envie uma imagem para termos mais detalhes em relação a situação do animal.<p>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
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
    </body>
</html>
