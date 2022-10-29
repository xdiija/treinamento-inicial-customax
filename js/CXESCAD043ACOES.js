function salvarImagem(dados) {
    var caminho = caminho;
    var form = new FormData();
    form.append('file', $("#nova_foto").prop('files')[0]);
    form.append('caminho', caminho);

    $.ajax({
        url: 'processos/AMAZONEDITGRAV.php',
        data: { dados: dados },
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(retornoAjax) {
            console.log(retornoAjax)
            var exp = retornoAjax.split("_?_");
            var msg = exp[1];
            var status = exp[0];
            /*
            if (status == 1) {

                $("#div_imagem_usuario").empty();
                $("#div_imagem_usuario").html('<img id="imagem_usuario" style="width: 60px; height: 60px;" src="img/aguarde.gif" />');

                setTimeout(() => {
                    $("#div_imagem_usuario").empty();
                    $("#div_imagem_usuario").html('<img id="imagem_usuario" style="width: 160px; height: 160px;" src="' + msg + '" />');


                }, 1000);

            } else {


                Swal.fire({
                    title: 'Confirmação',
                    icon: 'error',
                    html: "Erro! " + msg,

                });

            }

            return false;
            */
        }
        
    });
    return false;
}

$(document).ready(function() {
    $('#csv_upload').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'processos/CXESCAD043GRA.php',
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response){
                $('#result').html('Status: ' + response);
            }
        })
    })
})

$(document).ready(function() {

    load_images();

    $('#amazon_upload').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'processos/AMAZONUPLOAD.php',
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response){
                $('#result').html('Status: ' + response);
                load_images();
            }
        })
    })

    function load_images() {
        $.ajax({
            url: 'processos/AMAZONLOAD.php',
            method: 'get',
            success: function(data) {
              $("#images_preview").html(data);
              magnific()
            }
        })
    }

    function magnific() {
        $('.parent-container').magnificPopup({
            delegate: 'a', 
            type: 'image',
            gallery:{enabled:true}
        });
    }
    
    
})

function deletarArquivo() {
    var caminho = $(".mfp-img").attr('id')

    $.ajax({
        type: "POST",
        url: "processos/AMAZONDELETE.php",
        data: { caminho: caminho },
        success: function() {
            window.location.reload();
            return false;
        }
    });

    return false;
}

function editarArquivo() {
    var caminho = $(".mfp-img").attr('id')
    var source = $(".mfp-img").attr('src')
    console.log(caminho);

    $.ajax({
        type: 'POST',
        url: 'processos/AMAZONEDIT.php',
        data: { 
            caminho: caminho,
            acao: 'buscar',
            source: source
         },
        success: function(retornoAjax) {
            Swal.fire({
                title: 'Editar Foto',
                html: retornoAjax,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                reverseButtons: true,
                cancelButtonColor: "red",
                confirmButtonColor: "green",
                preConfirm: () => {
                    var campo_foto = $("#nova_foto").val();
                    var fd = new FormData(document.getElementById("form_foto"));
                    var acao = "editar"
                    fd.append("acao", acao)
                    fd.append("caminho_excluir", caminho)
                    if (campo_foto == "") {
                        Swal.showValidationMessage('Carregue uma Foto!');
                    } else {
                        $.ajax({
                            url: 'processos/AMAZONEDIT.php',
                            data: fd,
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            success: function(data){
                                console.log(data);
                                window.location.reload();
                            },
                            error: function(data){
                                alert(data);              
                            }
                          });  
                    }
                    return false;
                }
            })        
        }
    })
    
}

function substituirImagem(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
            $('#imagem_usuario').attr('src', e.target.result);
            

        }
        reader.readAsDataURL(input.files[0]);
    }
    else{
         $('#imagem_usuario').attr('src', '/assets/no_preview.png');
    }
       
}