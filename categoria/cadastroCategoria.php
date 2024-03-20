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
    <title>Cadastro Categoria</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php");
        include("../sidebarDireita/sidebarDireita.php");?>
        <div class="container-form">
            <form action="" method="post" id="formularioCategoria">
                <h1 class="titulo">Cadastro Categoria</h1>
                <label for="nomeCategoria" class="labelNomeCategoria">Nova Categoria</label>
                <input type="text" id="nomeCategoria" name="nomeCategoria" class="inputNomeCategoria">
                <button type="submit" name="btn-Cadastrar" class="btn-Cadastrar">Cadastrar</button>
                <?php
                    if(isset($_POST["btn-Cadastrar"])){
                        $nome = $_POST["nomeCategoria"];
                        
                        if(empty($nome)){
                            echo('<p class="categoria-ja-cadastrada">Categoria Inválida</p>');
                        }else{
                            include("../conexao.php");
                            $sql = "SELECT * FROM categoria WHERE nomeCategoria='$nome'";
                            $query = mysqli_query($conexao,$sql);
                            $rows = mysqli_num_rows($query);
                            if($rows >= 1){
                                echo('<p class="categoria-ja-cadastrada">Categoria já Cadastrada</p>');
                                mysqli_close($conexao);
                                exit;
                            }else{
                                try {
                                    $sql = "INSERT INTO categoria(nomeCategoria) VALUES('$nome')";
                                    $query = mysqli_query($conexao,$sql);
                                    echo '<script>';
                                    echo 'window.location.href="confirmacao.php?status=cadastrada";';
                                    echo '</script>';
                                    mysqli_close($conexao);
                                    exit;
                                } catch (\Throwable $th) {
                                    echo '<p class="categoria-ja-cadastrada">Erro ao Cadastrar Categoria</p>';
                                }
                            }
                        }
                    }
                ?>
            </form>
        </div>
    <div class="container-main">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Validate -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- jQuery mascara -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            setTimeout(function(){
                const elemento = document.getElementById("botaoCadastroCategoria");
                elemento.classList.add("active");
            },1);
        });
    </script>
</body>
</html>