<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
}

include("../conexao.php");
$idAdm = $_GET["id"];
$sql = "SELECT * FROM adm WHERE idAdm='$idAdm'";
$resultado = mysqli_query($conexao,$sql);
while($linha = mysqli_fetch_assoc($resultado)){
    $nome = $linha["nome"];
    $login = $linha["login"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="alterar.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
    <title>Alterar Administrador</title>
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php");
         include("../sidebarDireita/sidebarDireita.php");?>
        <div class="container-form">
            <form action="" method="post" id="formularioAdm">
                <h1 class="titulo">Alterar Administrador</h1>
                <div class="containerNome">
                    <label for="nomeAdm">Nome</label>
                    <input type="text" id="nomeAdm" name="nomeInput" value="<?php echo $nome; ?>">
                </div>
                <div class="containerLogin">
                    <label for="loginAdm">Login</label>
                    <input type="text" id="loginAdm" name="loginInput" value="<?php echo $login; ?>">
                </div>
                <div class="containerSenha" id="containerSenha">
                    <label for="senhaAdm">Senha</label>
                    <input type="password" id="senhaAdm" name="senhaInput">
                </div>
                <div class="containerErroSenha">
                    <span class="vazio"></span>
                    <span class="erroSenha" id="erroSenha"></span>
                </div>
                <div class="containerConfirmacaoSenha">
                    <label for="senhaAdmConfirmacao">Confirme a Senha</label>
                    <input type="password" id="senhaAdmConfirmacao" name="senhaConfirmacaoInput">
                </div>
                <button type="submit" name="btn-Alterar" class="btn-alterar">Alterar</button>
                <?php
                    if(isset($_POST["btn-Alterar"])){
                        $nomeInserido = $_POST["nomeInput"];
                        $loginInserido = $_POST["loginInput"];
                        $senhaInserida = $_POST["senhaInput"];

                        $senhaCriptografada = password_hash($senhaInserida, PASSWORD_DEFAULT);

                        $sql = "SELECT * FROM adm WHERE login='$loginInserido'";
                        $query = mysqli_query($conexao,$sql);
                        while($linha = mysqli_fetch_assoc($query)){
                            $loginExistente = $linha["login"];
                        }
                        $rows = mysqli_num_rows($query);
                        if($rows >= 1 && $loginExistente != $login){
                            echo('<p class="email-ja-cadastrado">E-mail já Cadastrado</p>');
                            mysqli_close($conexao);
                            exit;
                        }else{
                            try{
                                $sql = "UPDATE adm SET nome='$nomeInserido', login='$loginInserido', senha='$senhaCriptografada' WHERE idAdm='$idAdm'";
                                $query = mysqli_query($conexao,$sql);
                                echo '<script type="text/javascript">';
                                echo 'window.location.href="confirmacao.php?status=alterado";';
                                echo '</script>';
                                mysqli_close($conexao);
                                exit;
                            }catch(\Throwable $th){
                                echo"<p>Erro ao Alterar Adm</p>";
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
</body>
</html>