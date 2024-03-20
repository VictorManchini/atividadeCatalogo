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
    <title>Lista Administradores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="../sidebarDireita/sidebarDireita.">
    <link rel="stylesheet" href="lista.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php") ?>
        <div class="container-form">
            <form method="post">
                <label>Nome </label>
                <input type="text" name="nome">
                <button type="submit" name="btn-buscar" class="botaoBuscar">Buscar</button>
            </form>
                <div class="container-lista" id="containerLista">
                    <div class="table-wrap">
                        <?php
                            if(isset($_POST["btn-buscar"])){
                                
                                $buscaNome = $_POST["nome"];
                            }else{

                                $buscaNome = null;
                            }

                            function pesquisarAdm($nome){
                                include "../conexao.php";

                                if(empty($nome)){
                                    $sql="SELECT * FROM adm";
                                }
                                else{
                                    $sql="SELECT * FROM adm WHERE nome LIKE '%$nome%'";
                                }

                                $resultado=mysqli_query($conexao,$sql);
                                
                                if(mysqli_num_rows($resultado)>0){
                                    $autores=array();
                                    while($linha = mysqli_fetch_assoc($resultado)){
                                        $autores[]=$linha;
                                    }
                                    mysqli_close($conexao);
                                    return $autores;
                                }
                            }

                            $adms = pesquisarAdm($buscaNome);

                            if(!empty($adms)){
                                echo'<table>';
                                echo'<tr><th class="head idHead">ID</th>';
                                echo'<th class="head">Nome</th>';
                                echo'<th class="head">Login</th>';
                                echo'<th class="head iconHead"></th>';
                                echo'<th class="head iconHead"></th></tr>';
                                foreach($adms as $adm){
                                    echo'<tr>';
                                        echo'<td class="id">'.($adm["idAdm"]).'</td>';
                                        echo'<td>'.ucfirst($adm["nome"]).'</td>';
                                        echo'<td>'.($adm["login"]).'</td>';
                                        echo'<td class="iconHead"><a href="excluirAdm.php?id='.$adm["idAdm"].'"><span class="material-symbols-outlined">delete</span></a></td>';
                                        echo'<td class="iconHead"><a href="alterarAdm.php?id='.$adm["idAdm"].'"><span class="material-symbols-outlined">edit</span></a></td>';
                                    echo'</tr>';
                                }
                                echo'</table>';
                            }else{
                                echo'<p id="erroLista">a</p>';
                            }
                        ?>
                </div>
            </div>
        </div>
        <span id="spanErroLista" class="span-erro-lista"></span>
        <?php include("../sidebarDireita/sidebarDireita.php"); ?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            setTimeout(function(){
                const elemento = document.getElementById("botaoRegistro");
                elemento.classList.add("active");
            },1);
        });
    </script>
    <script src="lista.js"></script>
</body>
</html>