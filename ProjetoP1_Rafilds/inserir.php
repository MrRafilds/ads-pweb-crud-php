<?php
include_once './conexao.php';
session_start();

if (isset($_POST['descricao']) && isset($_SESSION['user_id'])) {
    $descricao = $_POST['descricao'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tarefas (descricao, usuario_id) VALUES ('$descricao', $user_id)";
    $conn->query($sql);
}

header("Location: menu.php");
exit;
?>