<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}
include("../conexao.php");
$idProduto = $_GET["id"];

$sql="SELECT * FROM produto WHERE idProduto='$idProduto'";
$query = mysqli_query($conexao,$sql);
while($linha = mysqli_fetch_assoc($query)){
    $nomeArmazenado = $linha["nomeProduto"];
    $precoArmazenado = $linha["preco"];
    $marcaArmazenada = $linha["marca_id"];
    $categoriaArmazenada = $linha["categoria_id"];

    include("produtoFuncoes.php");
    $marcas = pesquisarMarcas();
    $categorias = pesquisarCategorias();
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
    include("../sidebarDireita/sidebarDireita.php");?>
        <div class="container-form">
            <form action="" method="post">
                <h1 class="titulo">Deseja Excluir</h1>
                <label><?php echo $nomeArmazenado; ?></label>
                <label><?php echo "R$ ".$precoArmazenado; ?></label>
                <label>
                    <?php 
                        foreach($marcas as $marca){
                            if ($marca["idMarca"] == $marcaArmazenada){echo'<td>Marca: '.($marca["nomeMarca"]).'</td>';}
                        }
                    ?>
                </label>
                <label>
                    <?php
                        foreach($categorias as $categoria){
                            if ($categoria["idCategoria"] == $categoriaArmazenada){echo'<td> Categoria: '.($categoria["nomeCategoria"]).'</td>';}
                        }
                    ?>
                </label>
                <div class="opcoes">
                    <input type="submit" name="opcaoSim" class="sim" value="Sim">
                    <input type="submit" name="opcaoNao" class="nao" value="Não">
                </div>
                <?php
                    if(isset($_POST["opcaoSim"])){
                        try {
                            $sql = "SELECT * FROM produto WHERE idProduto='$idProduto'";
                            $resultado = mysqli_query($conexao,$sql);
                            while($linha = mysqli_fetch_assoc($resultado)){
                                $imagemArmazenada = $linha["imagem"];
                            }
                            $pastaImagem = $imagemArmazenada;
                            $pastaImagem = preg_replace('/\s+/', '', $pastaImagem);
                            if(file_exists($pastaImagem)){
                                unlink($pastaImagem);
                            }
                            $sql = "DELETE FROM produto WHERE idProduto='$idProduto'";
                            mysqli_query($conexao,$sql);
                            echo '<script>';
                            echo 'window.location.href="confirmacao.php?status=excluido";';
                            echo '</script>';
                            exit;
                        } catch (\Throwable $th) {
                            echo'<p class="erro">Erro ao Excluir Produto</p>'; 
                        }
                    }else if(isset($_POST["opcaoNao"])){
                        echo '<script>';
                        echo 'window.location.href="listaProduto.php";';
                        echo '</script>';
                        exit;
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>