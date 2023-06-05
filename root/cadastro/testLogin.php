<?php 
  session_start();

if(isset($_POST['submit'])&& !empty($_POST['email'])&& !empty($_POST['senha']))
{

  include_once('conexao_banco_eos.php');
  $email = $_POST['email'];
  $senha = $_POST['senha'];


  $sql = "SELECT * FROM  cadastro_usuario WHERE email = '$email' and senha = '$senha'";

  $result = $conexao->query($sql);


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
  }
  else { echo "<script>";
    echo "alert('Logado com sucesso!');";
    echo "</script>";
    echo "<script>";
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    echo "window.open('http://localhost:8080/cadastro/sistema.php', '_self');";
    echo "</script>";
  }

} 
else
{
  header(('Location: login.php'));
}

?>