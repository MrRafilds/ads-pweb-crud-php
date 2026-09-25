<?php
include_once './conexao.php';
session_start();

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $consulta = mysqli_query($conn, "SELECT cod, nome, login, senha FROM usuario WHERE login = '$usuario' AND senha = '$senha'");
    $dados = mysqli_fetch_assoc($consulta);

    if ($dados != null) {
        $_SESSION['user_id'] = $dados['cod']; 
        $_SESSION['nome'] = $dados['nome'];
    } else {
        $_SESSION['msg'] = "Usuário ou senha incorretos!!!";
        header("Location: index.php");
        exit;
    }
} else if (!isset($_SESSION['nome'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!!";
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página de Menu</title>
</head>
<body>
    <h1>Usuário logado: <?php echo $_SESSION['nome']; ?></h1>
    <a href="logout.php">Sair</a>
    <hr>

    <h2>Adicionar Tarefa</h2>
    <form action="inserir.php" method="POST">
        <input type="text" name="descricao" placeholder="Descrição da Tarefa" required>
        <input type="submit" value="Adicionar">
    </form>
    <br>

    <h2>Minhas Tarefas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tarefas WHERE usuario_id = $user_id ORDER BY data_criacao DESC";
            $result = $conn->query($sql);
            
            while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $linha['id']; ?></td>
                    <td><?php echo $linha['descricao']; ?></td>
                    <td><?php echo $linha['concluida'] ? "Concluída" : "Pendente"; ?></td>
                    <td>
                        <form action="alterar.php" method="POST">
                            <input type="hidden" name="id_tarefa" value="<?php echo $linha['id']; ?>">
                            <input type="hidden" name="status_atual" value="<?php echo $linha['concluida']; ?>">
                            <input type="submit" value="Alterar Status">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>