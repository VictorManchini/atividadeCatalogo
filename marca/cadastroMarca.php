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
    <title>Cadastro Marca</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php") ?>
        <?php include("../sidebarDireita/sidebarDireita.php");?>
        <div class="container-form">
            <form action="" method="post" id="formularioMarca">
                <h1 class="titulo">Cadastro Marca</h1>
                <label for="nomeMarca" class="labelNomeMarca">Nova Marca</label>
                <input type="text" id="nomeMarca" name="nomeMarca" class="inputNomeMarca">
                <button type="submit" name="btn-Cadastrar" class="btn-Cadastrar">Cadastrar</button>
                <?php
                    if(isset($_POST["btn-Cadastrar"])){
                        $nome = $_POST["nomeMarca"];

                        include("../conexao.php");
                        $sql = "SELECT * FROM marca WHERE nomeMarca='$nome'";
                        $query = mysqli_query($conexao,$sql);
                        $rows = mysqli_num_rows($query);
                        if($rows >= 1){
                            echo('<p class="marca-ja-cadastrada">Marca já Cadastrada</p>');
                            mysqli_close($conexao);
                            exit;
                        }else{
                            try {
                                $sql = "INSERT INTO marca(nomeMarca) VALUES('$nome')";
                                $query = mysqli_query($conexao,$sql);
                                echo '<script>';
                                echo 'window.location.href="confirmacao.php?status=cadastrada";';
                                echo '</script>';
                                exit;
                            } catch (\Throwable $th) {
                                echo '<p class="marca-ja-cadastrada">Erro ao Cadastrar Marca</p>';
                            }
                        }
                    }
                ?>
            </form>
        </div>
    </div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery Validate -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<!-- jQuery mascara -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        setTimeout(function(){
            const elemento = document.getElementById("botaoCadastroMarca");
            elemento.classList.add("active");
        },1);
    });
</script>
</body>
</html>