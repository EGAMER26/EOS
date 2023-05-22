<?php
include 'conexao_carrinho.php';

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Consulta SQL para obter os dados do carrinho
$sql = "SELECT * FROM produtos";

// Executa a consulta
$resultado = $conexao->query($sql);

// Verifica se a consulta foi executada com sucesso
if ($resultado) {
    ?>
    <html>
        <head>
            <!-- <link rel="stylesheet" href="style.css"> -->
        </head>
        <body>
            <center>
                <table style="width:900px;">
                    <tr>
                        <th>PRODUTO</th>
                        <th>PRECO</th>
                        <th>QUANTIDADE</th>
                        <th>AÇÃO</th>
                    </tr>
                    <?php
                    while ($linha = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td align="center"><?php echo $linha['nome_produto']; ?></td>
                            <td align="center"><?php echo $linha['preco_produto']; ?></td>
                            <td align="center">
                                <form method="POST" action="atualizar_qtd.php">
                                    <input type="number" name="quantidade" value="<?php echo $linha['qtd_produto']; ?>" min="1" step="1">
                                    <input type="submit" value="Atualizar" name="update" id="update">
                                </form>
                            </td>
                            <td align="center">
                                <a href="remover_produto.php?produto_id=<?php echo $linha['id']; ?>">Remover</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <button><a href="http://localhost:8080/cadastro/sistema.php">SAIR</a></button>
            </center>
        </body>
    </html>
    <?php
} else {
    echo "Erro ao obter os dados do carrinho: " . $conexao->error;
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
