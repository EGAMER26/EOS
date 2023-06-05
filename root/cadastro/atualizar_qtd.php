<?php
session_start();
include 'conexao_banco_eos.php';

if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

if (isset($_POST['update'])) {
    $produtoId = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $preco_prod = $_POST['preco_produto'];
    $preco_final = $preco_prod * $quantidade;

    $atualizarSql = "UPDATE produtos SET qtd_produto = '$quantidade', preco_total = '$preco_final'  WHERE id_produto = '$produtoId'";
    $atualizarResultado = $conexao->query($atualizarSql);

    if ($atualizarResultado) {
        $emailUsuarioLogado = $_SESSION['email'];
        $query = "SELECT SUM(preco_total) AS preco_total_produtos FROM produtos WHERE id_usuario = '$emailUsuarioLogado'";

        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();

        $valorTotalProdutos = $row['preco_total_produtos'];
        $_SESSION['preco_total_produtos'] = $valorTotalProdutos;

        header('Location: listagem_carrinho.php');
    } else {
        echo "<script>";
        echo "alert('Erro ao atualizar o produto!');";
        echo "window.open('listagem_carrinho.php', '_self');";
        echo "</script>";
    }
}

$conexao->close();
?>
