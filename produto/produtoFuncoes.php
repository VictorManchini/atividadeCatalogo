<?php
function pesquisarProdutos($nome){
    include "../conexao.php";

    if(empty($nome)){
        $sql="SELECT * FROM produto";
    }
    else{
        $sql="SELECT * FROM produto WHERE nomeProduto LIKE'%$nome%'";
    }

    $resultado=mysqli_query($conexao,$sql);
    
    if(mysqli_num_rows($resultado)>0){
        $produtos=array();
        while($linha = mysqli_fetch_assoc($resultado)){
            $produtos[]=$linha;
        }
        return $produtos;
    }
}

function pesquisarMarcas(){
    include "../conexao.php";
    $sqlMarca = "SELECT * FROM marca";
    $resultadoMarca = mysqli_query($conexao,$sqlMarca);
    if(mysqli_num_rows($resultadoMarca)>0){
        $marcas=array();
        while($linha = mysqli_fetch_assoc($resultadoMarca)){
            $marcas[]=$linha;
        }
        return $marcas;
    }
}

function pesquisarCategorias(){
    include "../conexao.php";
    $sqlCategoria = "SELECT * FROM categoria";
    $resultadoCategoria = mysqli_query($conexao,$sqlCategoria);
    if(mysqli_num_rows($resultadoCategoria)>0){
        $categorias=array();
        while($linha = mysqli_fetch_assoc($resultadoCategoria)){
            $categorias[]=$linha;
        }
        return $categorias;
    }
}
?>