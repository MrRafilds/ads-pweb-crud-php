<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Tela de Login do Sistema</h1>
    
    <form action="menu.php" method="POST">
        <fieldset>
            <legend>Dados de Usuário</legend>
            
            <?php if (isset($_SESSION['msg'])) { ?>
                <p style="color: red;"><?php echo $_SESSION['msg']; ?></p>
                <?php session_destroy(); ?>
            <?php } ?>

            <label>Usuário:</label>
            <input type="text" name="usuario" required /> <br><br>
            
            <label>Senha:</label>
            <input type="password" name="senha" required /> <br><br>
            
            <input type="submit" value="Entrar" />
        </fieldset>
    </form>
</body>
</html>