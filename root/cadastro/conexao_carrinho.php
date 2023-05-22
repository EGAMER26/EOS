<?php
$servidor="127.0.0.1";
$usuario="root";
$senha="usbw";
$banco="carrinho";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// if($conexao->connect_errno){
//     echo "erro";
// } else {
//     echo "success";

// }
?> 