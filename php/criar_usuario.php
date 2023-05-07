<?php
include_once('./conexao.php');

// Obtém os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];

// Prepara e executa a query SQL para inserir o novo registro na tabela "usuarios"
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)");

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->bindParam(':tipo', $tipo);

// Executa a declaração SQL
if ($stmt->execute()) {
    $mensagem = "Registro inserido com sucesso.";
} else {
    $mensagem = "Erro ao inserir o registro: " . $stmt->errorInfo()[2];
}


// Cria um formulário oculto para enviar a mensagem por meio do método POST
echo '<form id="redirect-form" method="POST" action="/../html/admin/">';
echo '<input type="hidden" name="mensagem" value="' . $mensagem . '">';
echo '</form>';

// Envia a mensagem por meio do formulário oculto e redireciona para a página inicial
echo '<script>document.getElementById("redirect-form").submit();</script>';
?>