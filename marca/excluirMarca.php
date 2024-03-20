<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}
include("../conexao.php");
$idMarca = $_GET["id"];

$sql="SELECT * FROM marca WHERE idMarca='$idMarca'";
$query = mysqli_query($conexao,$sql);
while($linha = mysqli_fetch_assoc($query)){
    $nomeArmazenado = $linha["nomeMarca"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo'Excluir '.$nomeArmazenado; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="../sidebarDireita/sidebarDireita.">
    <link rel="stylesheet" href="excluir.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php");
        include("../sidebarDireita/sidebarDireita.php"); ?>
        <div class="container-form">
            <form action="" method="post">
                <h1 class="titulo">Deseja Excluir</h1>
                <label class="nome"><?php echo $nomeArmazenado; ?></label>
                <input type="submit" name="opcaoSim" class="sim" value="Sim">
                <input type="submit" name="opcaoNao" class="nao" value="Não">
                <?php
                    if(isset($_POST["opcaoSim"])){
                        try {
                            $sql = "DELETE FROM marca WHERE idMarca='$idMarca'";
                            mysqli_query($conexao,$sql);
                            echo '<script>';
                            echo 'window.location.href="confirmacao.php?status=excluida";';
                            echo '</script>';
                            exit;
                        } catch (\Throwable $th) {
                            echo'<p class="erro">Erro ao Excluir Marca, Por-favor exclua os produtos relacionados primeiramente</p>';
                        }
                    }else if(isset($_POST["opcaoNao"])){
                        echo '<script>';
                        echo 'window.location.href="listaMarca.php";';
                        echo '</script>';
                        exit;
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>