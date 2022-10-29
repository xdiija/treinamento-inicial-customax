<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.35/dist/sweetalert2.all.min.js"></script>

    <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>



   
    
    

</head>
<body>
    <div id="div_cadastro">
    <div class="container">
        <div class="row">
            <div class="col-md-12 formulario" style="margin-top: 50px">
                <h5 class="titulo">Cadastro de Usuários</h5>
                <br>
                <form class="needs-validation" action="" id="form_usuario" method="POST" novalidate>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control obrigatorios" required>
                            <div class="invalid-feedback">
                                Preencha o Nome!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="form-control obrigatorios" required onkeydown="javascript: fMasc( this, mCPF );">
                        </div>
                        <div class="col-md-4">
                            <label for="">Email</label>
                            <input type="email" id="email" name="email" class="form-control obrigatorios" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Login</label>
                            <input type="text" id="login" name="login" class="form-control obrigatorios" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control obrigatorios" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Confirmação de Senha</label>
                            <input type="password" id="confirm_senha" name="confirm_senha" class="form-control obrigatorios" required>
                            <span id="msg"></span>
                        </div>
                        <div class="col-md-2">
                            <label for="">Perfil</label>
                            <select  name="perfil" id="perfil" class="form-select obrigatorios" required>
                                <option value="">Selecione um Perfil</option>
                                <option value="1">Administrador</option>
                                <option value="2">Vendedor</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Telefone</label>
                            <input type="text" onkeydown="return mascaraTelefone(event)" id="telefone" name="telefone" class="form-control obrigatorios" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col-md-4">
                            <label for="">Rua</label>
                            <input type="text" id="rua" name="rua" class="form-control obrigatorios" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Numero</label>
                            <input type="text" id="numero" name="numero" class="form-control obrigatorios" required >
                        </div>
                        <div class="col-md-2">
                            <label for="">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="form-control obrigatorios" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Estado</label>
                            <select id="estado" name="estado" class="form-select obrigatorios" required>
                                <option value="">Selecione um estado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Cidade</label>
                            <select id="cidade" name="cidade" class="form-select obrigatorios" required>
                                <option value="">Selecione um estado</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="form-control obrigatorios" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Nascimento</label>
                            <input type="text" oninput="mascaraDate(this)" id="nascimento" name="nascimento" class="form-control obrigatorios" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="offset-md-4 col-md-4">
                            <button @click="submitForm()" class="btn btn-primary" style="width: 100%;">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script src="js/cadastro/CXTRCAD001CAD/CXTRCAD001CAD.js?time=<?php echo time(); ?>"></script>

</html>