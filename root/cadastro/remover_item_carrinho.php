<?php
include 'conexao_banco_eos.php';
session_start();

if (isset($_GET['produto_id'])) {
    $produtoId = $_GET['produto_id'];

    $removerSql = "DELETE FROM produtos WHERE id_produto = '$produtoId'";
    $removerResultado = $conexao->query($removerSql);

    if ($removerResultado) {
        $emailUsuarioLogado = $_SESSION['email'];
        $query = "SELECT SUM(preco_total) AS preco_total_produtos FROM produtos WHERE id_usuario = '$emailUsuarioLogado'";

        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();

        $valorTotalProdutos = $row['preco_total_produtos'];
        $_SESSION['preco_total_produtos'] = $valorTotalProdutos;
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

$conexao->close();
?>
