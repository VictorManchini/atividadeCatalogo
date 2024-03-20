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
    <title>Lista Marcas</title>
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
                    if(isset($_POST["btn-buscar"])){
                        
                        $buscaNome = $_POST["nome"];
                    }else{

                        $buscaNome = null;
                    }

                    function pesquisarMarcas($nome){
                        include "../conexao.php";

                        if(empty($nome)){
                            $sql="SELECT * FROM marca";
                        }
                        else{
                            $sql="SELECT * FROM marca WHERE nomeMarca='%$nome%'";
                        }

                        $resultado=mysqli_query($conexao,$sql);
                        
                        if(mysqli_num_rows($resultado)>0){
                            $marcas=array();
                            while($linha = mysqli_fetch_assoc($resultado)){
                                $marcas[]=$linha;
                            }
                            mysqli_close($conexao);
                            return $marcas;
                        }
                    }

                    $marcas = pesquisarMarcas($buscaNome);

                    if(!empty($marcas)){
                        echo'<table>';
                        echo'<tr><th class="head">ID</th>';
                        echo'<th class="head">Nome</th>';
                        echo'<th class="head iconHead"></th>';
                        echo'<th class="head iconHead"></th></tr>';
                        foreach($marcas as $marca){
                            echo'<tr>';
                                echo'<td class="id">'.($marca["idMarca"]).'</td>';
                                echo'<td>'.ucfirst($marca["nomeMarca"]).'</td>';
                                echo'<td class="iconHead"><a href="excluirMarca.php?id='.$marca["idMarca"].'"><span class="material-symbols-outlined">delete</span></a></td>';
                                echo'<td class="iconHead"><a href="alterarMarca.php?id='.$marca["idMarca"].'"><span class="material-symbols-outlined">edit</span></a></td>';
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
                const elemento = document.getElementById("botaoRegistroMarca");
                elemento.classList.add("active");
            },1);
        });
    </script>
    <script src="lista.js"></script>
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