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
                        <li class="active">
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
            <ol class="breadcrumb">
                <li>
                    <a href="index.php">SOS Pets</a>
                </li>
                <li class="active">Buscar</li>
            </ol>
            <div class="col-md-12">
                <div class="row">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="exampleInputName2">Tipo</label>
                            <select class="form-control">
                                <option>--- selecione ---</option>
                                <option>Cachorro</option>
                                <option>Gato</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Porte</label>
                            <select class="form-control">
                                <option>--- selecione ---</option>
                                <option>Filhote</option>
                                <option>Adulto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Raça</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Raça">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Estado</label>
                            <select class="form-control">
                                <option>--- selecione ---</option>
                                <option>RS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Cidade</label>
                            <select class="form-control">
                                <option>--- selecione ---</option>
                                <option>Porto Alegre</option>
                                <option>Canoas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar Pet</button>
                    </form>
                </div>
            </div>
            <div style="width:100%;height:20px;float:left;"></div>
            <div class="col-md-12">
                <div class="row">
                    <table class="table table-striped">
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
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                            <tr>
                                <td>[FOTO.JPG]</td>
                                <td>Bixano</td>
                                <td>GATO</td>
                                <td>Filhote</td>
                                <td>Siames</td>
                                <td>RS/Porto Algre</td>
                            </tr>
                        </tbody>
                    </table>
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
