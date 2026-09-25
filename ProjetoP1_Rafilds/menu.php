<?php
include_once './conexao.php';
session_start();

// Autenticação do Usuário
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
    <title>Minhas Tarefas</title>
</head>
<body>
    <h1>Usuário logado: <?php echo $_SESSION['nome']; ?></h1>
    <div>
        <a href="menu.php">Home</a> | 
        <a href="logout.php">Sair</a>
    </div>
    <hr>

    <h2>Adicionar Nova Tarefa</h2>
    <!-- CREATE (Inserção na Tabela de Escolha) -->
    <form action="inserir.php" method="POST">
        <label>Descrição:</label>
        <input type="text" name="descricao" required size="40">
        <input type="submit" value="Adicionar">
    </form>
    <br>

    <h2>Minhas Tarefas (Consulta)</h2>
    <!-- READ (Consulta dos Dados na Tabela de Escolha) -->
    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color: #eee;">
                <th>ID</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tarefas WHERE usuario_id = $user_id ORDER BY id ASC";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
                    <tr>
                        <td><?php echo $linha['id']; ?></td>
                        <td><?php echo $linha['descricao']; ?></td>
                        <td><?php echo $linha['concluida'] ? "Concluída" : "Pendente"; ?></td>
                        <td>
                            <!-- Ação de UPDATE (Alterar) -->
                            <a href="editar.php?id=<?php echo $linha['id']; ?>">Editar</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>Nenhuma tarefa encontrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>