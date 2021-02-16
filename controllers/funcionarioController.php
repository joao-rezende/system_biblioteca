<?php

require_once './libraries/template.php';

class funcionarioController {
    private $template;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
    }

    public function index() {
        $this->template->render("lista_funcionarios.php");
    }

    public function adicionar() {
        $this->template->render("form_funcionarios.php");
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        if($id == NULL) {
            header("Location: " . SITE_URL . "funcionario");
            exit();
        }

        $this->template->render("form_funcionarios.php");
    }
    
}