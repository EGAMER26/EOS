<?php
include 'conexao_carrinho.php';
include 'sistema.php';
include 'listagem_carrinho';

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Verifica se as variáveis foram enviadas corretamente
if (isset($_POST['nome_produto']) && isset($_POST['qtd_produto'])) {
    // Obtém os valores do formulário
    $nome_produto = $_POST['nome_produto'];
    $quantidade = $_POST['quantidade'];

    // Atualiza a quantidade no banco de dados
    $atualizarSql = "UPDATE produtos SET qtd_produto = '$quantidade' WHERE nome_produto = '$nome_produto'";
    $atualizarResultado = $conexao->query($atualizarSql);

    if ($atualizarResultado) {
        // Atualização bem-sucedida
        echo "Quantidade atualizada com sucesso!";
    } else {
        // Ocorreu um erro ao atualizar a quantidade
        echo "Erro ao atualizar a quantidade: " . $conexao->error;
    }
} else {
    // Variáveis não foram enviadas corretamente
    echo "Dados inválidos!";
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
