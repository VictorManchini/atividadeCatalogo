const erro = document.getElementById("erroLista").value;

function isEmpty(str) {
    return (!str || str.length === 0 );
}

if(isEmpty(erro)){
    document.getElementById("containerLista").style.display = "none";
    const span = document.getElementById("spanErroLista");
    span.innerHTML = "Lista Vazia";
    span.classList.add("active");
}