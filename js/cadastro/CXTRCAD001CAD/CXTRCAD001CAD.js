function ValidarForm() {
    var forms = document.getElementsByClassName('needs-validation');
    let obrigatorios = true;
    var campo = "";

    $('.obrigatorios').each(function() {

        if ($(this).val() == '') {
            if (campo == "") {
                campo = $(this).attr("id");
            }
            obrigatorios = false;
            return;
        }
        
    });
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.classList.add('was-validated');
    });

    return campo;
}

$(document).ready(function(){

    $("#confirm_senha, #senha").keyup(function(){
        if ($("#senha").val() != $("#confirm_senha").val()) {
            $("#msg").html("Senhas não combinam").css("color","red");
        }else{
            $("#msg").html("Senhas combinam").css("color","green");
       }
  });
  
});

$(document).ready(function() {
    
    $('#form_usuario').submit(function() {
        
        var retorno = ValidarForm();

        if(retorno == ""){
            var dados = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "processos/CXTRCAD001CAD/CXTRCAD001CADREG.php",
                data: dados,
                success: function(data) {
                    var resposta = JSON.parse(data);

                    if(resposta.ok) {
                        Swal.fire({
                            'title': 'Sucesso',
                            'text': resposta.msg,
                            'icon': 'success'
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            'title': 'Aviso',
                            'text': resposta.msg,
                            'icon': 'warning'
                        }); 
                    }
                }
            })
        }  else {
            var campo_retorno = retorno;
            $("#"+campo_retorno).focus();
            return false;
        }  
       
        return false;
    })
});
/*
$(document).ready(function() {
    vcad = new Vue({
        el: "#div_cadastro",
        data: {},
        methods: {
          submitForm() {
            var retorno = ValidarForm();
            if(retorno == ""){
                var dados = $("#form_usuario").serialize();
                vcad.envioForm(dados);
            } else {
                var campo_retorno = retorno;
                $("#"+campo_retorno).focus();
                return false;
            }  
          },
          envioForm(dados) {
            $.ajax({
                type: "POST",
                url: "processos/CXTRCAD001CAD/CXTRCAD001CADREG.php",
                data: dados,
                success: function(data) {
                    var resposta = JSON.parse(data);
                    alert(data)
                    if(resposta.ok) {
                        Swal.fire({
                            'title': 'Sucesso',
                            'text': resposta.msg,
                            'icon': 'success'
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            'title': 'Aviso',
                            'text': resposta.msg,
                            'icon': 'warning'
                        }); 
                    }
                }
            })
            return false;
          },
        },
      });
});
*/


$(document).ready(function () {
		
    $.getJSON('json/estados_cidades.json', function (data) {

        var items = [];
        var options = '<option value="">Selecione um Estado</option>';	

        $.each(data, function (key, val) {
            options += '<option value="' + val.nome + '">' + val.nome + '</option>';
        });					
        $("#estado").html(options);				
        
        $("#estado").change(function () {				
        
            var options_cidades = '';
            var str = "";					
            
            $("#estado option:selected").each(function () {
                str += $(this).text();
            });
            
            $.each(data, function (key, val) {
                if(val.nome == str) {							
                    $.each(val.cidades, function (key_city, val_city) {
                        options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                    });							
                }
            });

            $("#cidade").html(options_cidades);
            
        }).change();		
    
    });

});

$(document).ready(function() {

    $( '#estado, #cidade' ).select2( {
        theme: 'bootstrap-5'
    } );

 });


function fMasc(objeto,mascara) {

    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)

}

function fMascEx() {

    obj.value=masc(obj.value)

}

function mCPF(cpf){

    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    return cpf

}

function mascaraDate(i) {
    var v = i.value;

    if (isNaN(v[v.length - 1])) { 
        i.value = v.substring(0, v.length - 1);
        return;
    }
    i.setAttribute("maxlength", "10");
    if (v.length == 2 || v.length == 5) i.value += "/";
}

function mascaraTelefone(event) {
    let tecla = event.key;
    let telefone = event.target.value.replace(/\D+/g, "");

    if (/^[0-9]$/i.test(tecla)) {
        telefone = telefone + tecla;
        let tamanho = telefone.length;

        if (tamanho >= 12) {
            return false;
        }
        
        if (tamanho > 10) {
            telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (tamanho > 5) {
            telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (tamanho > 2) {
            telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            telefone = telefone.replace(/^(\d*)/, "($1");
        }

        event.target.value = telefone;
    }

    if (!["Backspace", "Delete"].includes(tecla)) {
        return false;
    }
}