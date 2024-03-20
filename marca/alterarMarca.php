<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}
include("../conexao.php");
$idMarca = $_GET["id"];
$sql = "SELECT * FROM marca WHERE idMarca='$idMarca'";
$resultado = mysqli_query($conexao,$sql);
while($linha = mysqli_fetch_assoc($resultado)){
    $nomeMarca = $linha["nomeMarca"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Marca</title>
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
            <form action="" method="post" id="formularioMarca">
                <h1 class="titulo">Alterar Marca</h1>
                <div class="containerMarca">
                    <label for="nomeMarca">Nome</label>
                    <input type="text" id="nomeMarca" name="nomeMarca" value="<?php echo $nomeMarca; ?>">
                </div>
                <button type="submit" name="btn-alterar" class="btn-alterar">Alterar</button>
                <?php
                    if(isset($_POST["btn-alterar"])){
                        $nomeInserido = $_POST["nomeMarca"];

                        $sql = "SELECT * FROM Marca WHERE nomeMarca='$nomeInserido'";
                        $query = mysqli_query($conexao,$sql);
                        while($linha = mysqli_fetch_assoc($query)){
                            $marcaExistente = $linha["nomeMarca"];
                        }
                        $rows = mysqli_num_rows($query);
                        if($rows >= 1 && $marcaExistente != $nomeMarca){
                            echo('<p class="marca-ja-cadastrada">Marca já Cadastrada</p>');
                            mysqli_close($conexao);
                            exit;
                        }else{
                            try{
                                $sql = "UPDATE marca SET nomeMarca='$nomeInserido' WHERE idMarca='".ucfirst($idMarca)."'";
                                $query = mysqli_query($conexao,$sql);
                                echo '<script>';
                                echo 'window.location.href="confirmacao.php?status=alterada";';
                                echo '</script>';
                                mysqli_close($conexao);
                                exit;
                            }catch(\Throwable $th){
                                echo'<p class="marca-ja-cadastrada">Erro ao Alterar Marca</p>';
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
    </div>
</body>
</html>