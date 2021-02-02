<?php 

ini_set('display_errors', 1);

require_once 'configs/config.php';

$uri = $_SERVER['REQUEST_URI'];
$tamanho = mb_strlen("/system_biblioteca/index.php/");
$uri = substr($uri, $tamanho, mb_strlen($uri));
$uri = explode("/", $uri);

$classe = !empty($uri[0]) ? mb_strtolower($uri[0]) : "inicio";
$metodo = isset($uri[1]) ? mb_strtolower($uri[1]) : "index";

$classe .= 'Controller';

if(!file_exists('controllers/' . $classe . '.php')) {
    echo "ERRO 404 - Página não encontrada";
    exit(0);
}

require_once 'controllers/' . $classe . '.php';

$obj = new $classe();
$obj->$metodo();