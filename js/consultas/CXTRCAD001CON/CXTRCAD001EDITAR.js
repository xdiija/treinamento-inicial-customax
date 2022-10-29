jQuery(document).ready(function() {
    var cpf = $("#cpf").val();
    
    alert(mascara(cpf))
    
    /*$(document).on("change", "#cpf", function() {
        alert('oii')

       
    });*/
});




function mascara(i) {

    var v = i.value;

    if (isNaN(v[v.length - 1])) { 
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
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