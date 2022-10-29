<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importação de Kits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.35/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/magnific-popup.css">
    

</head>
<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 bg-light mt-4 p-2 px-4 rounded">
                <h3 class="text-center pb-2">Importação de Kits</h3>
                <h5 class="text-center pb-2">CXESCAD043</h5>
                <form action="" method="POST" enctype="multipart/form-data" id="csv_upload">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="modulo">Potência do Módulo</label>
                            <select id="potencia" name="potencia" class="form-select" aria-label="Default select example">
                                <option selected>Selecione...</option>
                                <option value="330">330Wp</option>
                                <option value="400">400Wp</option>
                                <option value="445">445Wp</option>
                                <option value="510">510Wp</option>
                                <option value="550">550Wp</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="finame">Finame</label>
                            <select id="finame" name="finame" class="form-select" aria-label="Default select example">
                                <option selected>Selecione...</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="custom-file">
                        <label for="arquivo_kits" class="custom-file-label">Arquivo CSV</label>
                            <input type="file" name="arquivo_kits" id="arquivo_kits" class="form-control custom-file-input">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="Importar Kits" style="width: 100%;">
                    </div>
                    <br>
                    <h5 class="text-center text-success" id="result">Status</h5>
                </form>
            </div>
        </div>
    </div>

</body>

<script src="js/CXESCAD043ACOES.js?time=<?php echo time(); ?>"></script>
</html>