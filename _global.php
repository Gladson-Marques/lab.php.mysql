<?php
/*
Define a tabela de caracteres para UTF-8
Evita problemas de acentuação
*/
header("Content-type: text/html; charset=utf-8");

// Configurações globais do site
$site = [
    "sitename" => "Olá Mundo",              // Usado na tag <title>
    "title" => "Olá Mundo",                 // Usado na tag <header>
    "slogan" => "De volta às fronteiras",   // Usado na tag <header>
    "logo" => "logo01.png",                 // Usado na tag <header>
    "mysql_hostname" => "localhost",        // Servidor do banco de dados MySQL
    "mysql_username" => "root",             // Nome do usuário do MySQL para o app
    "mysql_password" => "",                 // Senha do usuário do MySQL para o app
    "mysql_database" => "helloword"         // Nome do banco de dados do MySQL para o app
];

// Debug: exibe os valores de "$site". (comente)
// print_r($site);
// exit();

/*
Conexão com o MySQL usando a bilbioteca MySQLi.
Referência: https://www.w3schools.com/php/php_mysql_connect.asp
*/
$conn = new mysqli(
    $site["mysql_hostname"],
    $site["mysql_username"],
    $site["mysql_password"],
    $site["mysql_database"]
);
