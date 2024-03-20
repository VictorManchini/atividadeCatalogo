<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Produtos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="lista.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php") ?>
        <?php include("../sidebarDireita/sidebarDireita.php");?>
        <div class="containerFormLista" id="containerFormLista">
            <div class="container-form">
                <form method="post">
                    <label>Nome</label>
                    <input type="text" name="nome">
                    <button type="submit" name="btn-buscar" class="botaoBuscar">Buscar</button>
                </form>
            </div>
            <div class="container-lista" id="containerLista">
                    <div class="table-wrap">
                    <?php
                    include "../conexao.php";
                    if(isset($_POST["btn-buscar"])){
                        
                        $buscaNome = $_POST["nome"];
                    }else{

                        $buscaNome = null;
                    }

                    include("produtoFuncoes.php");

                    $produtos = pesquisarProdutos($buscaNome);
                    $marcas = pesquisarMarcas();
                    $categorias = pesquisarCategorias();

                    if(!empty($produtos)){
                        echo '<table>';
                        echo'<tr><th class="head idHead">ID</th>';
                        echo'<th class="head">Nome</th>';
                        echo'<th class="head preco">Preço</th>';
                        echo'<th class="head">Marca</th>';
                        echo'<th class="head">Categoria</th>';
                        echo'<th class="head">Imagem</th>';
                        echo'<th class="head iconHead"></th>';
                        echo'<th class="head iconHead"></th></tr>';
                        foreach($produtos as $produto){
                            echo'<tr>';
                                echo'<td class="id">'.($produto["idProduto"]).'</td>';
                                echo'<td>'.ucfirst($produto["nomeProduto"]).'</td>';
                                echo'<td class="preco">'.($produto["preco"]).'</td>';
                                foreach($marcas as $marca){
                                    if ($marca["idMarca"] == $produto["marca_id"]){echo'<td>'.($marca["nomeMarca"]).'</td>';}
                                }
                                foreach($categorias as $categoria){
                                    if ($categoria["idCategoria"] == $produto["categoria_id"]){echo'<td>'.($categoria["nomeCategoria"]).'</td>';}
                                }
                                echo'<td><div class="img-container"><img src="'.$produto["imagem"].'"></div></td>';
                                echo'<td class="iconHead"><a href="excluirProduto.php?id='.$produto["idProduto"].'"><span class="material-symbols-outlined">delete</span></a></td>';
                                echo'<td class="iconHead"><a href="alterarProduto.php?id='.$produto["idProduto"].'"><span class="material-symbols-outlined">edit</span></a></td>';
                            echo'</tr>';
                        }
                        echo'<table>';
                    }else{
                        echo'<p id="erroLista">a</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <span id="spanErroLista" class="span-erro-lista"></span>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            setTimeout(function(){
                const elemento = document.getElementById("botaoRegistroRegistro");
                elemento.classList.add("active");
            },1);
        });
    </script>
    <script src="lista.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            setTimeout(function(){
                const elemento = document.getElementById("botaoRegistroProduto");
                elemento.classList.add("active");
            },1);
        });
    </script>
</body>
<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}
</style>
</html>