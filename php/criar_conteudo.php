<?php
session_start();
include_once('./conexao.php');

// $nome = $_POST['nome'];
// Recupera os valores do formulário
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo']; // Conteúdo do CKEditor 5
$nome = $_SESSION['usuario'];
$materia = $_POST['materia'];

// Insere os valores no banco de dados
$stmt = $pdo->prepare("INSERT INTO conteudos (titulo, conteudo, nome, materia) VALUES (:titulo, :conteudo, :nome, :materia)");
$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':conteudo', $conteudo);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':materia', $materia);

if ($stmt->execute()) {
    $mensagem = "Conteudo criado com sucesso.";
} else {
    $mensagem = "Erro ao criar conteudo: " . $stmt->errorInfo()[2];
}

// Cria um formulário oculto para enviar a mensagem por meio do método POST
echo '<form id="redirect-form" method="POST" action="/html/prof/">';
echo '<input type="hidden" name="mensagem" value="' . $mensagem . '">';
echo '</form>';

// Envia a mensagem por meio do formulário oculto e redireciona para a página inicial
echo '<script>document.getElementById("redirect-form").submit();</script>';
?>