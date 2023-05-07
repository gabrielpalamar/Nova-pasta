<?php
if (isset($_POST['BTEnvia'])) {
    session_start();
    include('./conexao.php');

    //busca email do usuário $aluno
    $stmt = $pdo->prepare('SELECT email FROM usuarios WHERE nome = :usuario');
    $stmt->bindValue(':usuario', $_SESSION['usuario']);
    $stmt->execute();
    $aluno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //busca email do professor $professor
    $stmt = $pdo->prepare('SELECT email FROM usuarios WHERE nome = :prof');
    $stmt->bindValue(':prof', $_POST['prof']);
    $stmt->execute();
    $professor = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nome = $_SESSION['usuario'];
    $email = $aluno[0]['email'];
    $mensagem = $_POST['mensagem'];

    $remetente = "noreply@ananique.kinghost.net";

    //Configurações do email
    $destinatario = $professor[0]['email'];
    $replyTo = $remetente;
    $assunto = "Contato Plataforma SPEC";

    //Monta Mensagem
    $conteudo = "Nome = $nome \n";
    $conteudo .= "Email = {$aluno[0]['email']} \n";
    $conteudo .= "Mensagem = $mensagem \n";

    $headers = implode("\n", array("From: $remetente", "Reply-To: $replyTo", "Return-Path: $remetente", "MIME-Version: 1.0", "X-Priority: 3", "Content-Type: text/html; charset=UTF-8"));

    //Enviando o email 
    if (mail($professor[0]['email'], $assunto, nl2br($conteudo), $headers)) {
        echo "E-Mail enviado com sucesso!<br>";
    } else {
        echo "Falha no envio do E-Mail!<br>";
    }
}
?>