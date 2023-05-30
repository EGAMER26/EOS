<?php
include 'conexao_banco_eos.php';

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

if (isset($_POST['update'])) {
    $produtoId = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Atualiza a quantidade no banco de dados
    $atualizarSql = "UPDATE produtos SET qtd_produto = '$quantidade' WHERE id_produto = '$produtoId'";
    $atualizarResultado = $conexao->query($atualizarSql);

    if ($atualizarResultado) {
        echo "<script>";
        echo "alert('Produto atualizado!');";
        echo "window.open('listagem_carrinho.php', '_self');";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Erro ao atualizar o produto!');";
        echo "window.open('listagem_carrinho.php', '_self');";
        echo "</script>";
    }
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
