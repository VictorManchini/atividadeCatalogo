<?php $username = $_SESSION['username']; ?>
<div class="right-section">
    <div class="nav">
        <button id="menu-btn">
            <span class="material-symbols-sharp">
                menu
            </span>
        </button>
        <div class="dark-mode">
            <span class="material-symbols-sharp active">
                light_mode
            </span>
            <span class="material-symbols-sharp">
                dark_mode
            </span>
        </div>
        <div class="profile">
            <div class="info">
                <p>Olá, <b><?php echo $username;?></b></p>
                <small class="text-muted">Admin</small>
            </div>
        </div>
    </div>
</div>
<script src="../sidebarDireita/sidebarDireita.js"></script>
