<?php
include 'conexao_banco_eos.php';
include 'sistema.php';


$id_usuario = $_POST['id_usuario'];
$nome_prod = $_POST['nome_produtoo'];
$preco_prod = $_POST['preco_produto'];
$qtd_prod = $_POST['quantidade_produto'];
$emailUsuarioLogado = $_SESSION['email'];

$preco_final = $preco_prod * $qtd_prod;


$sql = "SELECT * FROM produtos WHERE nome_produto='$nome_prod' && WHERE id_usuario = '$emailUsuarioLogado'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<script>";
    echo "alert('Produto já cadastrado!');";
    echo "window.open('http://localhost:8080/cadastro/sistema.php', '_self');";
    echo "</script>";
} else {
    $sql = "INSERT INTO produtos (id_usuario, nome_produto, preco_produto, qtd_produto) VALUES ('$id_usuario' ,'$nome_prod', '$preco_final', '$qtd_prod')";
    if (mysqli_query($conexao, $sql)) {
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
