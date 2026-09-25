<?php
include_once './conexao.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: menu.php");
    exit;
}

$id_tarefa = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tarefas WHERE id = $id_tarefa AND usuario_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: menu.php");
    exit;
}

$tarefa = mysqli_fetch_assoc($result);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
</head>
<body>
    <h2>Alterar Tarefa #<?php echo $tarefa['id']; ?></h2>

    <!-- UPDATE (Alteração na Tabela de Escolha) -->
    <form action="salvar_edicao.php" method="POST">
        <input type="hidden" name="id_tarefa" value="<?php echo $tarefa['id']; ?>">

        <label>Descrição:</label><br>
        <input type="text" name="descricao" value="<?php echo $tarefa['descricao']; ?>" required size="50"><br><br>

        <label>Status da Tarefa:</label><br>
        <select name="status">
            <option value="0" <?php if($tarefa['concluida'] == 0) echo 'selected'; ?>>Pendente</option>
            <option value="1" <?php if($tarefa['concluida'] == 1) echo 'selected'; ?>>Concluída</option>
        </select><br><br>

        <input type="submit" value="Salvar Alteração">
    </form>
    <br>
    <a href="menu.php">Voltar</a>
</body>
</html>