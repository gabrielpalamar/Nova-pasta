<?php
include_once('./conexao.php');

$nome = strtolower($_POST['nome']);
$senha = $_POST['senha'];

$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE LOWER(nome) = :nome AND senha = :senha');
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':senha', $senha);

$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($usuarios == null) {
    echo "Usuário não encontrado.";
} else {
    session_start();
    $_SESSION['usuario'] = $usuarios[0]['nome'];
    if ($usuarios[0]['tipo'] == 'administrador') {
        header('Location: /../../html/admin');
    }
    if ($usuarios[0]['tipo'] == 'professor') {
        header('Location: /../../html/prof');
    }
    if ($usuarios[0]['tipo'] == 'aluno') {
        header('Location: /../../html/aluno');
    }
}

?>
