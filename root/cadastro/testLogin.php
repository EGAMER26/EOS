<?php 
  session_start();

// print_r($_REQUEST);

// verifica se tem dados no form para acessar
if(isset($_POST['submit'])&& !empty($_POST['email'])&& !empty($_POST['senha']))
{

  include_once('conexao1.php');
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // print_r(('Email: ' . $email));
  // print_r(('<br>'));
  // print_r(('Senha: ' . $senha));

  $sql = "SELECT * FROM  cadastro_usuario WHERE email = '$email' and senha = '$senha'";

  $result = $conexao->query($sql);

  // print_r($sql);
  // print_r($result);

  if(mysqli_num_rows($result) < 1)
  {
    echo "<script>";
    echo "alert('Email ou senha incorreto!');";
    echo "</script>";
    unset($_session['email']);
    unset($_session['senha']);
    echo "<script>";
    echo "window.open('http://localhost:8080/cadastro/login.php', '_self');";
    echo "</script>";
    // header('Location: login.php');
  }
  else { echo "<script>";
    echo "alert('Logado com sucesso!');";
    echo "</script>";
    echo "<script>";
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    echo "window.open('http://localhost:8080/cadastro/sistema.php', '_self');";
    echo "</script>";
    // header('Location: sistema.php');
  }

} 
// redireciona para o login caso não tenha
else
{
  header(('Location: login.php'));
}

?>