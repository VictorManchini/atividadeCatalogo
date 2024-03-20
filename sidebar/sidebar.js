const botoes = document.querySelectorAll(".botoes");

function active(){
botoes.forEach(function(botao){
    botao.addEventListener("click", function(){
        botoes.forEach(function(toggle){
            setTimeout(function(){
                toggle.classList.remove("active");
            },334);
        });
            botao.classList.add("active");
    });
});
}

function registroAdm(){
    active();
    window.location.href = "../adm/listaAdm.php";
};

function cadastroAdm(){
    active();
    window.location.href = "../adm/cadastroAdm.php";
};

function cadastroCategoria(){
    active();
    window.location.href = "../categoria/cadastroCategoria.php";
}

function registroCategoria(){
    active();
    window.location.href = "../categoria/listaCategoria.php";
}

function registroMarca(){
    active();
    window.location.href = "../marca/listaMarca.php";
}

function cadastroMarca(){
    active();
    window.location.href = "../marca/cadastroMarca.php";
}

function registroProduto(){
    active();
    window.location.href = "../produto/listaProduto.php";
}

function cadastroProduto(){
    active();
    window.location.href = "../produto/cadastroProduto.php";
}



const botaoLogout = document.getElementById("logout-btn");
botaoLogout.addEventListener("click", function(){
    window.location.href = "../adm/listaAdm.php?logout=1";
});