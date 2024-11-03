<?php
/* Credenciais do banco de dados. Supondo que você esteja executando o MySQL
   com a configuração padrão (usuário 'root' sem senha) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'insumos_agricolas');

/* Tentativa de conexão ao banco de dados MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificação da conexão
if($link === false){
    die("ERRO: Não foi possível conectar. " . mysqli_connect_error());
}
?>
