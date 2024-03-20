<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}

include("../conexao.php");
$idCategoria = $_GET["id"];
$sql = "SELECT * FROM categoria WHERE idCategoria='$idCategoria'";
$resultado = mysqli_query($conexao,$sql);
while($linha = mysqli_fetch_assoc($resultado)){
    $nomeCategoria = $linha["nomeCategoria"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Categoria</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="alterar.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php");
        include("../sidebarDireita/sidebarDireita.php"); ?>
        <div class="container-form">
            <form action="" method="post" id="formularioCategoria">
                <h1 class="titulo">Alterar Categoria</h1>
                <div class="containerCategoria">
                    <label for="nomeCategoria">Nome</label>
                    <input type="text" id="nomeCategoria" name="nomeCategoria" value="<?php echo $nomeCategoria; ?>">
                </div>
                <button type="submit" name="btn-Alterar" class="btn-alterar">Alterar</button>
                <?php
                    if(isset($_POST["btn-Alterar"])){
                        $nomeInserido = $_POST["nomeCategoria"];

                        $sql = "SELECT * FROM categoria WHERE nomeCategoria='$nomeInserido'";
                        $query = mysqli_query($conexao,$sql);
                        while($linha = mysqli_fetch_assoc($query)){
                            $categoriaExistente = $linha["nomeCategoria"];
                        }
                        $rows = mysqli_num_rows($query);
                        if($rows >= 1 && $categoriaExistente != $nomeCategoria){
                            echo('<p class="categoria-ja-cadastrada">Categoria já Cadastrada</p>');
                            mysqli_close($conexao);
                            exit;
                        }else{
                            try{
                                $sql = "UPDATE categoria SET nomeCategoria='$nomeInserido' WHERE idCategoria='".ucfirst($idCategoria)."'";
                                $query = mysqli_query($conexao,$sql);
                                echo '<script type="text/javascript">';
                                echo 'window.location.href="confirmacao.php?status=alterada";';
                                echo '</script>';
                                mysqli_close($conexao);
                                exit;
                            }catch(\Throwable $th){
                                echo'<p class="categoria-ja-cadastrada">Erro ao Alterar Categoria</p>';
                            }
                        }

                    }
                ?>
            </form>
        </div>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- jQuery Validate -->
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <!-- jQuery mascara -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="script.js"></script>
    <div class="container-main">
</body>
</html>