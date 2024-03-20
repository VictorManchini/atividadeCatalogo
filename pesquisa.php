<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Pesquisa</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="pesquisa.css">
    <link rel="shortcut icon" href="sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <?php
    include("header.php");
    ?>
    <div class="bg-image"></div>
    <div class="container">
        <div class="ultimos-produtos">
            <?php
                if(isset($_GET["busca"])){
                    $busca = $_GET["busca"];
                    $pagina = $_GET["pagina"];
                    $pastaImagem = "";
                    $categoria = "";
                    $marca = "";

                    include ("conexao.php");

                    $sqlQuantidade = "SELECT nomeProduto FROM produto WHERE nomeProduto LIKE '%$busca%'";
                    $resultadoQuantidade = mysqli_query($conexao, $sqlQuantidade);
                    $rows = mysqli_num_rows($resultadoQuantidade);
                    $numeroPaginas = floor($rows/5);
                    if($rows % 5 == 0){
                        $numeroPaginas -= 1;
                    }

                    $sql = "SELECT * FROM produto WHERE nomeProduto LIKE '%$busca%' ORDER BY idProduto DESC LIMIT ". $pagina*5 ." , 5 ";
                    $resultado = mysqli_query($conexao, $sql);
                    if(mysqli_num_rows($resultado) > 0){
                        $produtos = array();
                        while($linha = mysqli_fetch_assoc($resultado)){
                            $produtos[] = $linha;
                        }
                        foreach($produtos as $produto){
                            $pastaImagem = $produto["imagem"];
                            $pastaImagem = trim($pastaImagem, ".");
                            $pastaImagem = trim($pastaImagem, "/");
                            echo '<div class="produto-container">';
                            echo '<h2>'.$produto["nomeProduto"].'</h2>';
                            echo '<div class="img-container">';
                            echo '<img src="'.$pastaImagem.'">';
                            echo '</div>';
                            echo '<p class="preco">R$'.$produto["preco"].'</p>';
                            echo '<div class="categora-marca">';

                            $sqlCategoria = "SELECT nomeCategoria FROM categoria WHERE idCategoria='".$produto["categoria_id"]."'";
                            $resultadoCategoria = mysqli_query($conexao, $sqlCategoria);
                            while($linha = mysqli_fetch_assoc($resultadoCategoria)){
                                $categoria = $linha["nomeCategoria"];
                            }

                            echo '<p><destaque>categoria:</destaque> '.$categoria.'</p>';

                            $sqlMarca = "SELECT nomeMarca FROM marca WHERE idMarca='".$produto["marca_id"]."'";
                            $resultadoMarca = mysqli_query($conexao, $sqlMarca);
                            while($linha = mysqli_fetch_assoc($resultadoMarca)){
                                $marca = $linha["nomeMarca"];
                            }

                            echo '<p><destaque>marca:</destaque> '.$marca.'</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
                ?>
        </div>
        <div class="botoesTrocarPagina">
            <a class="mudar-pagina" href="pesquisa.php?busca=<?php echo $busca; ?>&pagina=<?php if($pagina == 0){echo $pagina;}else{echo $pagina-1;} ?>">Página anterior</a>
            <a class="mudar-pagina" href="pesquisa.php?busca=<?php echo $busca; ?>&pagina=<?php if($pagina == $numeroPaginas){echo $pagina;}else{echo $pagina+1;} ?>">Proxima página</a>
        </div>
    </div>
    <div class="footer">
        <p class="desenvolvido-por">Desenvolvido por Victor Manchini</p>
        <a href="login/login.php" class="botaoAdm">
            <span class="material-symbols-sharp">
                lock
            </span>
            Adm
        </a>
    </div>
    <script src="darkMode.js"></script>
</body>
</html>