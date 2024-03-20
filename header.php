<div class="header">
        <?php
        include("darkMode.php");
        ?>
        <div class="logo">
                <a href="index.php">
                <img src="sidebar/logo2.png">
                <h2>Intervalo<span class="danger">Senac</span></h2>
            </a>
        </div>
        <form action="" method="post" class="barra-pesquisa">
            <span class="material-symbols-sharp lupa">
                search
            </span>
            <input type="text" name="nomeProduto">
            <button type="submit" name="btn-search">Busca</button>
        </form>
</div>
<?php
if(isset($_POST["btn-search"])){
    $busca = $_POST["nomeProduto"];
    header("Location: pesquisa.php?busca=".$busca."&pagina=0");
}
?>