<?php
include_once './conexao.php';
session_start();

if (isset($_POST['id_tarefa']) && isset($_SESSION['user_id'])) {
    $id_tarefa = $_POST['id_tarefa'];
    $status_atual = $_POST['status_atual'];
    
    $novo_status = ($status_atual == 0) ? 1 : 0; 
    $user_id = $_SESSION['user_id'];
    
    $sql = "UPDATE tarefas SET concluida = $novo_status WHERE id = $id_tarefa AND usuario_id = $user_id";
    $conn->query($sql);
}

header("Location: menu.php");
exit;
?>