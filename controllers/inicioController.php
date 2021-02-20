<?php

require_once './libraries/template.php';
require_once './models/Livro.php';

class inicioController {
    private $template;
    private $livro;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->livro = new Livro();
    }

    public function index() {
        require_once 'views/login.php';
    }

    public function inicio() {
        if(!isset($_SESSION['livros_reservados'])) {
            $_SESSION['livros_reservados'] = array();
        }

        $dados['livros'] = $this->livro->listar();
        $this->template->render("inicio.php", $dados);
    }
    
}