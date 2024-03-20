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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
    <title>Cadastro ADM</title>
</head>
<body>
    <div class="container-main">
        <?php include("../sidebar/sidebar.php");
        include("../sidebarDireita/sidebarDireita.php");?>
        <div class="container-form">
            <form action="" method="post" id="formularioAdm">
                <h1 class="titulo">Cadastro ADM</h1>
                <div class="containerNome">
                    <label for="nomeAdm">Nome</label>
                    <input type="text" id="nomeAdm" name="nomeInput">
                </div>
                <div class="containerLogin">
                    <label for="loginAdm">Login</label>
                    <input type="text" id="loginAdm" name="loginInput">
                </div>
                <div class="containerSenha" id="containerSenha">
                    <label for="senhaAdm">Senha</label>
                    <input type="password" id="senhaAdm" name="senhaInput">
                </div>
                <div class="containerErroSenha">
                    <span class="vazio"></span>
                    <span id="erroSenha" class="erroSenha"></span>
                </div>
                <div class="containerConfirmacaoSenha">
                    <label for="senhaAdmConfirmacao">Confirme a Senha</label>
                    <input type="password" id="senhaAdmConfirmacao" name="senhaConfirmacaoInput">
                </div>
                <button type="submit" name="btn-Cadastrar" class="btn-cadastrar">Cadastrar</button>
                <?php
                    if(isset($_POST["btn-Cadastrar"])){
                        $nome = $_POST["nomeInput"];
                        $login = $_POST["loginInput"];
                        $senha = $_POST["senhaInput"];

                        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

                        include("../conexao.php");
                        $sql = "SELECT * FROM adm WHERE login='$login'";
                        $query = mysqli_query($conexao,$sql);
                        $rows = mysqli_num_rows($query);
                        if($rows >= 1){
                            echo('<p class="email-ja-cadastrado">E-mail já Cadastrado</p>');
                            mysqli_close($conexao);
                            exit;
                        }else{
                            try{
                                $sql = "INSERT INTO adm(nome,login,senha) VALUES('$nome','$login','$senhaCriptografada')";
                                $query = mysqli_query($conexao,$sql);
                                echo '<script>';
                                echo 'window.location.href="confirmacao.php?status=cadastrado";';
                                echo '</script>';
                                mysqli_close($conexao);
                                exit;
                            }catch(\Throwable $th){
                                echo'<p class="email-ja-cadastrado">Erro ao Cadastrar Adm</p>';
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
                    const elemento = document.getElementById("botaoCadastro");
                    elemento.classList.add("active");
                },1);
            });
        </script>
</body> 
</html>