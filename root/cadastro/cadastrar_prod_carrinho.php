<?php
  session_start();

include 'conexao_banco_eos.php';
include 'sistema.php';


$id_usuario = $_POST['id_usuario'];
$nome_prod = $_POST['nome_produtoo'];
$preco_prod = $_POST['preco_produto'];
$preco_prod_total = $_POST['preco_total'];
$qtd_prod = $_POST['quantidade_produto'];

$email_logado = $_SESSION['email'];

$preco_final = $preco_prod * $qtd_prod;


$sql = "SELECT * FROM produtos WHERE nome_produto='$nome_prod' AND id_usuario = '$email_logado'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<script>";
    echo "alert('Produto já cadastrado!');";
    echo "window.open('http://localhost:8080/cadastro/sistema.php', '_self');";
    echo "</script>";
} else {
    $sql = "INSERT INTO produtos (id_usuario, nome_produto, preco_produto, qtd_produto, preco_total) VALUES ('$id_usuario' ,'$nome_prod', '$preco_final', '$qtd_prod', '$preco_prod_total')";
    if (mysqli_query($conexao, $sql)) {
        $email_logado = $_SESSION['email'];
        $query = "SELECT SUM(preco_total) AS preco_total_produtos FROM produtos WHERE id_usuario = '$email_logado'";

        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();

        $valorTotalProdutos = $row['preco_total_produtos'];
        $_SESSION['preco_total_produtos'] = $valorTotalProdutos;
        echo "<script>";
        echo "alert('Produto cadastrado!');";
        echo "window.open('http://localhost:8080/cadastro/listagem_carrinho.php', '_self');";
        echo "</script>";
    } else {
        echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
?>
