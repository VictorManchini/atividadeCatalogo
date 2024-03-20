$(document).ready(function(){


    $("#formularioCategoria").validate({

        rules:{
            nomeCategoria:{
                required:true
            }
        },
        messages:{
            nomeCategoria:{
                required:"Campo Obrigatório"
            }
        }
    });
});