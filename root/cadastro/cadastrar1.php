<?php 

$conn = new mysqli('127.0.0.1', 'root', 'usbw', 'banco_eos');

if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

$sql = "SELECT MAX(id) AS max_id FROM cadastro_usuario";
$result = $conn->query($sql);

if ($result === false) {
    die('Erro na consulta: ' . $conn->error);
}

$row = $result->fetch_assoc();
$last_id = $row['max_id'];

$next_id = $last_id + 1;

$nome = $_POST['txt_nome'];
$email = $_POST['txt_email'];
$senha = $_POST['txt_senha'];

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
    $sql = "INSERT INTO cadastro_usuario (id, nome, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $next_id, $nome, $email, $senha);
    if ($stmt->execute()) {
        echo "<script>";
        echo "alert('cadastrado com sucesso!');";
        echo "window.open('http://localhost:8080/cadastro/', '_self');";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Erro ao cadastrar o funcionário!');";
        echo "</script>";
    }
}

$conn->close();

?>
