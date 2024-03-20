$(document).ready(function(){


    $("#formularioMarca").validate({

        rules:{
            nomeMarca:{
                required:true
            }
        },
        messages:{
            nomeMarca:{
                required:"Campo Obrigatório"
            }
        }
    });
});