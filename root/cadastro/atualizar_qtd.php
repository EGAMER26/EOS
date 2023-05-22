<?php
include_once ('conexao_carrinho.php');
include_once  ('sistema.php');
include_once  ('listagem_carrinho.php');

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Verifica se as variáveis foram enviadas corretamente
if (isset($_POST['nome_produto']) && isset($_POST['quantidade'])) { 
    // Obtém os valores do formulário
    $nome_produto = $_POST['nome_produto'];
    $quantidade = $_POST['quantidade'];

    // Atualiza a quantidade no banco de dados
    $atualizarSql = "UPDATE produtos SET qtd_produto = '$quantidade' WHERE nome_produto = '$nome_produto'";
    $atualizarResultado = $conexao->query($atualizarSql);

    if ($atualizarResultado) {
        echo "<script>";
        echo "alert('Produto atualizado!');";
        echo "window.open('http://localhost:8080/cadastro/listagem_carrinho.php', '_self');";
        echo "</script>";
    } else {
        // Ocorreu um erro ao atualizar a quantidade
        echo "<script>";
        echo "alert('Produto não atualizado!');";
        echo "window.open('http://localhost:8080/cadastro/listagem_carrinho.php', '_self');";
        echo "</script>". $conexao->error;
    }
} else {
    // Variáveis não foram enviadas corretamente
    echo "Dados inválidos!";
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
