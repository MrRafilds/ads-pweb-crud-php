<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página Inicial - Login</title>
</head>
<body>
    <h1>Tela de Login do Sistema</h1>

    <form action="menu.php" method="POST">
        <fieldset style="width: 300px;">
            <legend>Dados de Usuário</legend>
            <table>
                <tbody>
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <tr><td colspan="2" style="color: red;">
                            <?php echo $_SESSION['msg']; ?>
                        </td></tr>
                        <?php unset($_SESSION['msg']); ?>
                    <?php } ?>
                    <tr>
                        <td>Usuário:</td>
                        <td><input type="text" name="usuario" required /></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="password" name="senha" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Entrar" /></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>
</body>
</html>