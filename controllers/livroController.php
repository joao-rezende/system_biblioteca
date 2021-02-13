<?php

require_once './libraries/template.php';

class livroController {
    private $template;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
    }

    public function index() {
        $this->template->render("lista_livros.php");
    }

    public function adicionar() {
        $this->template->render("form_livros.php");
    }

    public function editar() {
        $this->template->render("form_livros.php");
    }
    
}