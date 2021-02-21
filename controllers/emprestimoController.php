<?php

require_once './libraries/template.php';
require_once './models/Livro.php';
require_once './models/Emprestimo.php';
require_once './models/LivrosEmprestimo.php';

class emprestimoController {
    private $template;
    private $livro;
    private $emprestimo;
    private $livrosEmprestimo;

    function __construct() {
        if(!isset($_SESSION['logado']) || !$_SESSION['logado']) {
            header("Location: " . SITE_URL . "inicio");
        }
        
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->livro = new Livro();
        $this->emprestimo = new Emprestimo();
        $this->livrosEmprestimo = new LivrosEmprestimo();
    }

    public function index() {
        include('./helpers/formatacao.php');

        if(!empty($_SESSION['usuario'])) {
            $dados['emprestimos'] = $this->emprestimo->listarEmprUsuario($_SESSION['usuario']['codUsuario']);
        } else {
            $dados['emprestimos'] = $this->emprestimo->listar();
        }
        
        $this->template->render("lista_emprestimos.php", $dados);
    }

    public function adicionar() {

        $livros = $_SESSION['livros_reservados'];
        
        if(empty($livros)) {
            $_SESSION['msgNotifErro'] = "Nenhum livro foi reservado";
            header("Location: " . SITE_URL . "inicio/inicio");
        }

        $emprestimo = [
            "dataEmp" => date("Y-m-d"),
            "dataDev" => date('Y-m-d', strtotime('+14 day')),
            "codUsuario" => $_SESSION['usuario']['codUsuario'],
            "finalizado" => 0
        ];

        $codEmprestimo = $this->emprestimo->cadastrar($emprestimo);

        foreach($livros as $livro) {
            $livroEmp = [
                "codEmprestimo" => $codEmprestimo,
                "codLivro" => $livro['codLivro']
            ];

            $this->livrosEmprestimo->cadastrar($livroEmp);
        }

        $_SESSION['livros_reservados'] = [];

        $_SESSION['msgNotifSuccesso'] = "Empréstimo realizado com sucesso";
        header("Location: " . SITE_URL . "inicio/inicio");
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
    
    public function confirmar_devolucao() {
        $codEmprestimo = isset($_GET['id']) ? $_GET['id'] : NULL;

        if($codEmprestimo == NULL) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "emprestimo");
        }

        $emprestimo = $this->emprestimo->listarCod($codEmprestimo);
        
        if(empty($emprestimo)) {
            $_SESSION['msgNotifErro'] = "Empréstimo não encontrado";
            header("Location: " . SITE_URL . "emprestimo");
        }

        $nv_emprestimo = [
            "finalizado" => 1,
            "codFuncResp" => $_SESSION['funcionario']['codFunc'],
            "dataDevReal" => date("Y-m-d")
        ];
        
        $emprestimo = $this->emprestimo->atualizar($codEmprestimo, $nv_emprestimo);

        $_SESSION['msgNotifSuccesso'] = "Empréstimo realizado com sucesso";
        header("Location: " . SITE_URL . "emprestimo");
    }
}