<?php

require_once './libraries/template.php';
require_once './models/Emprestimo.php';

class emprestimoController {
    private $template;
    private $emprestimos;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->emprestimos = new Emprestimo();
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
    
    // Listar emprestimos
    public function listarEmprestimos(){
        $dados['livros'] = $this->emprestimos->consultarEmprestimos();

        $this->template->render("lista_emprestimos.php", $dados);
    }
}