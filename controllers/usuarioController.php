<?php

require_once './libraries/template.php';

class usuarioController {
    private $template;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
    }

    public function index() {
        $this->template->render("lista_usuarios.php");
    }

    public function adicionar() {
        $this->template->render("form_usuarios.php");
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        if($id == NULL) {
            header("Location: " . SITE_URL . "usuario");
            exit();
        }

        $this->template->render("form_usuarios.php");
    }
    
}