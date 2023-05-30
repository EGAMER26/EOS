<?php
include 'conexao_banco_eos.php';

// Verifica se o parâmetro do ID do produto foi recebido
if (isset($_GET['produto_id'])) {
    $produtoId = $_GET['produto_id'];

    // Executa a consulta SQL para remover o produto pelo ID
    $removerSql = "DELETE FROM produtos WHERE id_produto = '$produtoId'";
    $removerResultado = $conexao->query($removerSql);

    if ($removerResultado) {
        echo "<script>";
        echo "alert('Produto removido!');";
        echo "window.open('listagem_carrinho.php', '_self');";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Erro ao remover o produto!');";
        echo "window.open('listagem_carrinho.php', '_self');";
        echo "</script>";
    }
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
