<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.35/dist/sweetalert2.all.min.js"></script>

</head>

    <body class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="bg-light col-md-6 offset-md-3 formulario mt-4 p-2 px-4 rounded" style="margin-top: 50px">
                    <h4 class="titulo">Área de Login</h4>
                    <br>
                    <form action="" id="form" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Login</label>
                                <input type="text" id="usuario" name="usuario" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Senha</label>
                                <input type="password" id="senha" name="senha" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <button id="enviar" name="enviar" type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                            </div>
                            <div class="col-md-3">
                                <a href="CXTRCAD001CAD" class="btn btn-secondary" role="button" style="width: 100%;">Cadastrar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script src="js/login/scripts.js"></script>

</html>

