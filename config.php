<?php
// Configuração do banco de dados
define('DB_SERVER', 'db.multipass'); // Substitua 'localhost' pelo seu host, como 'db.multipass' se estiver correto
define('DB_USERNAME', 'phpcrud'); // Nome do usuário do banco
define('DB_PASSWORD', '123456'); // Senha do banco
define('DB_NAME', 'insumos_agricolas'); // Nome do banco de dados

// Tentativa de conexão ao banco de dados MySQL
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificação da conexão
if ($link === false) {
    die("ERRO: Não foi possível conectar ao banco de dados. Detalhes: " . mysqli_connect_error());
}

// Configuração para tratar erros de conexão
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Definindo o charset como UTF-8 para evitar problemas com acentos
if (!mysqli_set_charset($link, "utf8")) {
    die("ERRO: Não foi possível configurar o charset UTF-8. Detalhes: " . mysqli_error($link));
}
?>

