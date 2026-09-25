<?php
include_once './conexao.php';
session_start();

if (isset($_POST['id_tarefa']) && isset($_SESSION['user_id'])) {
    $id_tarefa = $_POST['id_tarefa'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE tarefas SET descricao = '$descricao', concluida = $status WHERE id = $id_tarefa AND usuario_id = $user_id";
    $conn->query($sql);
}

header("Location: menu.php");
exit;
?>