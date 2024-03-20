<div class="container">
    <aside>
        <div class="toggle">
            <div class="logo">
                <a href="#" onclick="registroAdm()">
                <img src="../sidebar/logo2.png">
                <h2>Intervalo<span class="danger">Senac</span></h2>
                </a>
            </div>
            <div class="close" id="close-btn">
                <span class="material-symbols-sharp">
                    close
                </span>
            </div>
        </div>
        <div class="sidebar">
            <a href="#" onclick="registroAdm()" class="botoes" id="botaoRegistro">
                <span class="material-symbols-sharp">
                    contract
                </span>
                <h3>Lista Adm</h3>
            </a>
            <a href="#" onclick="cadastroAdm()" class="botoes" id="botaoCadastro">
                <span class="material-symbols-sharp">
                    app_registration
                </span>
                <h3>Cadastro Adm</h3>
            </a>
            <a href="#" onclick="registroCategoria()" class="botoes" id="botaoRegistroCategoria">
                <span class="material-symbols-sharp">
                    contract
                </span>
                <h3>Lista <br> Categoria</h3>
            <a href="#" onclick="cadastroCategoria()" class="botoes" id="botaoCadastroCategoria">
                <span class="material-symbols-sharp">
                    app_registration
                </span>
                <h3>Cadastro Cateogoria</h3>
            </a>
            <a href="#" onclick="registroMarca()" class="botoes" id="botaoRegistroMarca">
                <span class="material-symbols-sharp">
                        contract
                </span>
                <h3>Lista Marca</h3>
            </a>
            <a href="#" onclick="cadastroMarca()" class="botoes" id="botaoCadastroMarca">
                <span class="material-symbols-sharp">
                    app_registration
                </span>
                <h3>Cadastro Marca</h3>
            </a>
            <a href="#" onclick="registroProduto()" class="botoes" id="botaoRegistroProduto">
                <span class="material-symbols-sharp">
                        contract
                </span>
                <h3>Lista Produto</h3>
            </a>
            <a href="#" onclick="cadastroProduto()" class="botoes" id="botaoCadastroProduto">
                <span class="material-symbols-sharp">
                    app_registration
                </span>
                <h3>Cadastro <br> Produto</h3>
            </a>
            <a href="#" id="logout-btn" name="logout-btn">
                <span class="material-symbols-sharp">
                    logout
                </span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>
</div>
<!-- jQuery -->
<script src="../sidebar/sidebar.js"></script>
<?php
if(isset($_GET["logout"])){
    session_destroy();
    header("Location: ../index.php");
}
?>