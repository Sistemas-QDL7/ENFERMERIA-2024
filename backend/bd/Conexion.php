<?php
if (!isset($_SESSION)) {
    session_start();
}

// Verificar si las constantes ya están definidas antes de definirlas
if (!defined('dbhost')) {
    define('dbhost', 'localhost');
}

if (!defined('dbuser')) {
    define('dbuser', 'root');
}

if (!defined('dbpass')) {
    define('dbpass', '');
}

if (!defined('dbname')) {
    define('dbname', 'citas_medicas');
}

// Conectando a la base de datos
try {
    $connect = new PDO("mysql:host=" . dbhost . ";dbname=" . dbname, dbuser, dbpass);
    $connect->query("set names utf8;");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
