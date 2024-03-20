<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}

include("../conexao.php");
$idProduto = $_GET["id"];
$sql = "SELECT * FROM produto WHERE idProduto='$idProduto'";
$resultado = mysqli_query($conexao,$sql);
while($linha = mysqli_fetch_assoc($resultado)){
    $nomeArmazenado = $linha["nomeProduto"];
    $precoArmazenado = $linha["preco"];
    $imagemArmazenada = $linha["imagem"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Produto</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="alterar.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php") ?>
        <?php include("../sidebarDireita/sidebarDireita.php");?>
        <div class="container-form">
            <form action="" method="post" enctype="multipart/form-data" id="formularioProduto">
                <div class="container-titulo">
                    <h1 class="titulo">Alterar Produto</h1>
                </div>
                <div class="container-nomeMarca">
                    <label for="nomeProduto">Nome</label>
                    <div class="erro-nome">
                        <input type="text" id="nomeProduto" name="nomeInput" value="<?php echo $nomeArmazenado; ?>">
                    </div>
                    <label for="marcaProduto">Marca</label>
                    <select name="marcaProduto" id="marcaProduto">
                        <?php
                            $sql = "SELECT * FROM marca";
                            $resultado=mysqli_query($conexao,$sql);
                            while($linha = mysqli_fetch_assoc($resultado)){
                                echo '<option value="'.$linha["idMarca"].'">'.$linha["nomeMarca"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="container-precoCategoria">
                    <label for="precoProduto">Preço</label>
                    <div class="erro-preco">
                        <input type="number" id="precoProduto" name="precoInput" value="<?php echo $precoArmazenado; ?>">
                    </div>
                    <label for="categoriaProduto">Categoria</label>
                    <select name="categoriaProduto" id="categoriaProduto">
                        <?php
                            $sql = "SELECT * FROM categoria";
                            $resultado=mysqli_query($conexao,$sql);
                            while($linha = mysqli_fetch_assoc($resultado)){
                                echo '<option value="'.$linha["idCategoria"].'">'.$linha["nomeCategoria"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="container-botao">
                    <button type="submit" name="btn-Alterar">Alterar</button>
                </div>
                <div class="container-imagem">
                    <div class="imagem-preview" id="imagem-preview"></div>
                    <label for="imagemProduto">Nova Imagem</label>
                    <input type="file" name="imagemProduto" id="imagemProduto" style="display:none;">
                    <?php
                        if(isset($_POST["btn-Alterar"])){
                            $imagem = $_FILES["imagemProduto"]["name"];
                            if(empty($imagem)){
                                $pastaImagem = $imagemArmazenada;
                            }else{
                                $pastaImagem = $imagemArmazenada;
                                if(file_exists($pastaImagem)){
                                    copy($_FILES["imagemProduto"]["tmp_name"],$pastaImagem);
                                }else{
                                    $imagemFileType = pathinfo($imagem,PATHINFO_EXTENSION);
                                    if($imagemFileType !="jpg" && $imagemFileType !="png" && $imagemFileType !="jpeg" && $imagemFileType !="webp"){
                                        echo"<p>Insira uma Imagem (.jpg/.png/.webp)</p>";
                                    }else{
                                        $pasta = "../imagensArmazenadas";
                                        $pastaImagem = $pasta . "/" . $imagem;
                                        move_uploaded_file($_FILES["imagemProduto"]["tmp_name"],$pastaImagem);
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Validate -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- jQuery mascara -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="cadastro.js"></script>
</body>
</html>
<?php
if(isset($_POST["btn-Alterar"])){
    $nomeInserido = $_POST["nomeInput"];
    $precoInserido = $_POST["precoInput"];
    $marcaInserida = $_POST["marcaProduto"];
    $categoriaInserida = $_POST["categoriaProduto"];

    try{
        $sql = "UPDATE produto SET nomeProduto='$nomeInserido', preco='$precoInserido', imagem='$pastaImagem', marca_id='$marcaInserida', categoria_id='$categoriaInserida' WHERE idProduto='$idProduto'";
        $query = mysqli_query($conexao,$sql);
        echo '<script type="text/javascript">';
        echo 'window.location.href="confirmacao.php?status=alterado";';
        echo '</script>';
        mysqli_close($conexao);
        exit;
    }catch(\Throwable $th){
        echo"<p>Erro ao Alterar Produto</p>";
    }
}

?>