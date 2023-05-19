<?php 

session_start();
unset($_session['email']);  
unset($_session['senha']);
header('Location: index.html');

?>