<?php
session_start();
include_once('./conexao.php');

date_default_timezone_set('America/Sao_Paulo');
$data_atual = strtotime(date('Y-m-d'));

// Definir as variáveis com os dados enviados pelo formulário
$data = $_POST['dataDoEvento'];
$titulo = $_POST['tituloDoEvento'];
$descricao = $_POST['descricaoDoEvento'];
$criado_por = $_SESSION['usuario'];

// Validar os dados recebidos
if (!$data || !$titulo || !$descricao || !$criado_por) {
    // Algum campo obrigatório está vazio
    die('Por favor, preencha todos os campos.');
}

list($ano, $mes, $dia) = explode('-', $data);

if (strtotime($data) <= $data_atual) {
    // data do evento é anterior à data atual
    echo '<script>alert("A data do evento deve ser maior ou igual à data atual."); window.history.back();</script>';
    die();
}

// Preparar e executar a query SQL para inserir o novo evento
$stmt = $pdo->prepare('INSERT INTO eventos (ano, mes, dia, titulo, descricao, criado_por) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->execute([$ano, $mes, $dia, $titulo, $descricao, $criado_por]);

// Verificar se o evento foi inserido com sucesso
if ($stmt->rowCount() > 0) {
    // Evento cadastrado com sucesso
    echo '<script>alert("Evento cadastrado com sucesso!"); window.history.back();</script>';
} else {
    // Ocorreu um erro ao cadastrar o evento
    echo '<script>alert("Ocorreu um erro ao cadastrar o evento. Tente novamente mais tarde."); window.history.back();</script>';
}
?>
