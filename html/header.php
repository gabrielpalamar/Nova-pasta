<div id="sessao-usuario">
    <h1>
        <?php echo 'Bem-vindo, ' . $_SESSION['usuario'] . '!'; ?>
    </h1>

    <form action="/php/logout.php" method="post">
        <input type="submit" class="logout-bt" value="Logout">
    </form>
</div>