<?php
include 'conexao_banco_eos.php';

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

if (isset($_POST['update'])) {
    $produtoId = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $preco_prod = $_POST['preco_produto'];
    $preco_final = $preco_prod * $quantidade;

    // Atualiza a quantidade no banco de dados
    $atualizarSql = "UPDATE produtos SET qtd_produto = '$quantidade', preco_produto = '$preco_final'  WHERE id_produto = '$produtoId'";
    $atualizarResultado = $conexao->query($atualizarSql);

    if ($atualizarResultado) {
        header('Location: listagem_carrinho.php');
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
