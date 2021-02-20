<?php

require_once './libraries/template.php';

class emprestimoController {
    private $template;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
    }

    public function index() {
        $this->template->render("lista_emprestimos.php");
    }

    public function adicionar() {
        $this->template->render("form_emprestimos.php");
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        if($id == NULL) {
            header("Location: " . SITE_URL . "emprestimo");
            exit();
        }

        $this->template->render("form_emprestimos.php");
    }
    
}