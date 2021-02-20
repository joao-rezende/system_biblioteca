<?php

require_once './libraries/template.php';
require_once './models/Livro.php';

class emprestimoController {
    private $template;
    private $livro;
    private $emprestimos;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->livro = new Livro();
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

    public function adicionar_livro_reserva() {
        $codLivro = isset($_GET['id']) ? $_GET['id'] : NULL;

        if($codLivro == NULL) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "inicio/inicio");
            exit();
        }

        $livro = $this->livro->listarCod($codLivro);
        
        array_push($_SESSION['livros_reservados'], $livro);
        
        header("Location: " . SITE_URL . "inicio/inicio");
    }

    public function remover_livro_reserva() {
        $codLivro = isset($_GET['id']) ? $_GET['id'] : NULL;

        if($codLivro == NULL) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "inicio/inicio");
            exit();
        }
        
        foreach($_SESSION['livros_reservados'] as $indice => $livro) {
            if($livro["codLivro"] === $codLivro) {
                unset($_SESSION['livros_reservados'][$indice]);
            }
        }

        header("Location: " . SITE_URL . "inicio/inicio");
    }
    
    // Listar emprestimos
    public function listarEmprestimos(){
        $dados['livros'] = $this->emprestimos->consultarEmprestimos();

        $this->template->render("lista_emprestimos.php", $dados);
    }
}