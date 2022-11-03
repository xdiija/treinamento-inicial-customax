<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="pt-br">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="assets/images/favicon.ico" />
        <meta name="msapplication-tap-highlight" content="no">
        <link href="./main.css" rel="stylesheet">
        <link href="./css/checkbox.css" rel="stylesheet">
        <style>
            #dynamic_chartdiv {
            width: 50%;
            height: 500px;
            }
            #dynamic_chartdiv2 {
            width: 100%;
            height: 500px;
            }
            #dynamic_chartdiv3 {
            width: 100%;
            height: 800px;
            }
        </style>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@4.0.5/bootstrap-4/bootstrap-4.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
        <script src="js/amd-index.js"></script>
        <script src="js/amd-percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="js/amd-animated.js"></script>
    
    </head>
    
    <body>
        <div id="container">
            <div class="form-row">
                <div class="col-md-12 offset-md-4">
                    <h1>Gráfico de Usuários 1</h1>
                </div>
            </div>
            <div id="dynamic_chartdiv" class="col-md-12 offset-md-3"></div>
            <div class="form-row">
                <div class="col-md-12 offset-md-4">
                    <h1>Gráfico de Usuários 2</h1>
                </div>
            </div>
            <div id="dynamic_chartdiv2"></div>
            <div class="form-row">
                <div class="col-md-12 offset-md-4">
                    <h1>Gráfico de Usuários 3</h1>
                </div>
            </div>
            <div id="dynamic_chartdiv3"></div>
        </div>
        <script src="js/consultas/CXTRCAD001CON/CXTRCAD001GRAFICO.js?time=<?php echo time(); ?>"></script>
    </body>
</html>