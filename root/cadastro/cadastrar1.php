<?php 

// conecta ao banco de dados
$conn = new mysqli('127.0.0.1', 'root', 'usbw', 'usuarios');

// verifica se houve erro na conexão
if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

// busca o último ID utilizado
$sql = "SELECT MAX(id) AS max_id FROM cadastro_usuario";
$result = $conn->query($sql);

// verifica se houve erro na consulta
if ($result === false) {
    die('Erro na consulta: ' . $conn->error);
}

// obtém o último ID utilizado
$row = $result->fetch_assoc();
$last_id = $row['max_id'];

// define o próximo ID
$next_id = $last_id + 1;

// obtém os dados do formulário
$nome = $_POST['txt_nome'];
$email = $_POST['txt_email'];
$senha = $_POST['txt_senha'];

// verifica se o email já existe
$mailVerification = "SELECT * FROM cadastro_usuario WHERE email = ?";
$stmt = $conn->prepare($mailVerification);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>";
    echo "alert('Email já cadastrado!');";
    echo "window.open('http://localhost:8080/cadastro/', '_self');";
    echo "</script>";
} else {
    // insere o novo usuário
    $sql = "INSERT INTO cadastro_usuario (id, nome, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $next_id, $nome, $email, $senha);
    if ($stmt->execute()) {
        echo "<script>";
        echo "alert('Funcionário cadastrado!');";
        echo "window.open('http://localhost:8080/cadastro/', '_self');";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Erro ao cadastrar o funcionário!');";
        echo "</script>";
    }
}

// fecha a conexão com o banco de dados
$conn->close();

?>
