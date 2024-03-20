let maiusculaBoolean = true;
let minusculaBoolean = true;
let caractereBoolean = true;
let numeroBoolean = true;
let tamanhoBoolean = true;
let maiuscula = /[A-Z]/;
let minuscula = /[a-z]/;
let caractereSpecial = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
let numero = /[\d]/;

$.validator.addMethod("emailCorreto", function(){

    let regexEmail = /^([a-zA-Z0-9._%\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,})$/

    let emailInformado = document.getElementById("loginAdm").value;
    if(regexEmail.test(emailInformado)){
        return true;
    }else{
        return false;
    }
});

$.validator.addMethod("senhaForte", function(){

    let senhaInformada = document.getElementById("senhaAdm").value;
    if(maiuscula.test(senhaInformada) && minuscula.test(senhaInformada) && caractereSpecial.test(senhaInformada) && numero.test(senhaInformada) && senhaInformada.length >= 6){
        return true;
    }else{
        return false;
    }
});

let inputSenha = document.getElementById("senhaAdm");
inputSenha.addEventListener("input", function(){

    let senhaInformada = document.getElementById("senhaAdm").value;
    if(maiuscula.test(senhaInformada)){
        maiusculaBoolean = true;
    }else{
        maiusculaBoolean = false;
    }

    if(minuscula.test(senhaInformada)){
        minusculaBoolean = true;
    }else{
        minusculaBoolean = false
    }

    if(caractereSpecial.test(senhaInformada)){
        caractereBoolean = true;
    }else{
        caractereBoolean = false;
    }

    if(numero.test(senhaInformada)){
        numeroBoolean = true;
    }else{
        numeroBoolean = false;
    }

    if(senhaInformada.length >= 6){
        tamanhoBoolean = true;
    }else{
        tamanhoBoolean = false;
    }

    if(!maiusculaBoolean){
        document.getElementById("erroSenha").innerHTML = "Digite uma letra maiuscula";
        adicionarCampos();
    }else if(!minusculaBoolean){
        document.getElementById("erroSenha").innerHTML = "Digite uma letra minuscula";
        adicionarCampos();
    }else if(!numeroBoolean){
        document.getElementById("erroSenha").innerHTML = "Digite um Número";
        adicionarCampos();
    }else if(!caractereBoolean){
        document.getElementById("erroSenha").innerHTML = "Digite um caractere especial";
        adicionarCampos();
    }else if(!tamanhoBoolean){
        document.getElementById("erroSenha").innerHTML = "Minimo de 6 caracteres";
        adicionarCampos();
    }else{
        removerCampos();
    }

});

function adicionarCampos(){
    document.getElementById("erroSenha").style.marginBottom = "10px";
    document.getElementById("erroSenha").style.display = "block";
    document.getElementById("containerSenha").style.marginBottom = "0px";
}

function removerCampos(){
    document.getElementById("erroSenha").innerHTML = "";
    document.getElementById("erroSenha").style.marginBottom = "0px";
    document.getElementById("erroSenha").style.display = "none";
    document.getElementById("containerSenha").style.marginBottom = "4rem";
}

$(document).ready(function(){

    $("#formularioAdm").validate({

        rules:{
            nomeInput:{
                required:true
            },
            loginInput:{
                required:true,
                emailCorreto:true
            },
            senhaInput:{
                required:true,
                senhaForte:true
            },
            senhaConfirmacaoInput:{
                required:true,
                equalTo:senhaAdm
            }
        },
        messages:{
            nomeInput:{
                required:"Campo Obrigatório"
            },
            loginInput:{
                required:"Campo Obrigatório",
                emailCorreto:"E-mail Inválido"
            },
            senhaInput:{
                required:"Campo Obrigatório",
                senhaForte:"Senha inválida"
            },
            senhaConfirmacaoInput:{
                required:"Campo Obrigatório",
                equalTo:"As senhas devem ser iguais"
            }
        }
    });
});