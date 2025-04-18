<?php

// id – INT(11) – AUTO_INCREMENT – PRIMARY KEY
// name – VARCHAR(100)
// email – VARCHAR(100)
// password – VARCHAR(100)

$db_host = 'localhost';
$db_name = 'api_rest_full';  
$db_user = 'root'; 
$db_pass = '';

// Criar conexão
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Verificar conexão
if ($connection->connect_error) {
    die("Conexão falhou: " . $connection->connect_error);
} 

//else {
//     echo "...........SUCCESS CONNECT...............";
// }

?>
