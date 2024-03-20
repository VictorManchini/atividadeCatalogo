<?php
    if(isset($_POST["btnLogin"])){
        include("../conexao.php");

        $login = $_POST["email"];
        $senha = $_POST["senha"];
        $nomeArmazenado = "";
        $loginArmazenado = "";
        $senhaArmazenada = "";
        
        $sql = "SELECT * FROM adm WHERE login='$login'";
        $resultado = mysqli_query($conexao, $sql);
        while($row = $resultado -> fetch_assoc()){
            $nomeArmazenado = $row["nome"];
            $loginArmazenado = $row["login"];
            $senhaArmazenada = $row["senha"];
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="sidebarDireita.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container">
    <?php  include("sidebarLogin/sidebarDireita.php") ?>
        <form action="#" method="post">
            <h1>Login</h1>
            <div class="emailContainer">
                <label for="email">E-mail</label>
                <input type="text" id="email" name="email">
                <?php
                if(isset($_POST["btnLogin"])){
                    if($loginArmazenado != $login || $loginArmazenado == ""){
                        echo'<p class="erroLogin">E-mail Incorreto</p>';
                        $loginBoolean = false;
                    }else{
                        $loginBoolean = true;
                    }
                }
                ?>
            </div>
            <div class="senhaContainer">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha">
                <?php
                if(isset($_POST["btnLogin"])){
                    if(!password_verify($senha, $senhaArmazenada)){
                        echo'<p class="erroSenha">Senha Incorreta</p>';
                        $passwordBoolean = false;
                    }else{
                        $passwordBoolean = true;
                    }
                }
            ?>
            </div>
            <button type="submit" name="btnLogin">Login</button>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST["btnLogin"])){
        if($loginBoolean && $passwordBoolean){
            session_start();
            $_SESSION['username'] = $nomeArmazenado;
            header("Location: ../adm/listaAdm.php");
        }
    }
?>
