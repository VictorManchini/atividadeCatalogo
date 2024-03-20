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
    <title>Confirmação</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="../sidebar/sidebar.css">
    <link rel="stylesheet" href="../sidebarDireita/sidebarDireita.">
    <link rel="stylesheet" href="confirmacao.css">
    <link rel="shortcut icon" href="../sidebar/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container-main">
    <?php include("../sidebar/sidebar.php") ?>
        <div class="container-confirmacao">
            <p>Marca <?php
                $status = $_GET["status"];
                echo $status;
            ?> 
            com Sucesso</p>
        </div>
        <?php include("../sidebarDireita/sidebarDireita.php"); ?>
     <div class="container-main">
    <script type="text/javascript">
        setTimeout(function () {
            window.location.href="listaMarca.php";
        }, 2000);
    </script>
</body>
</html>