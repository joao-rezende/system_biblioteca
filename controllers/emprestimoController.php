<?php

require_once './libraries/template.php';
require_once './models/Livro.php';
require_once './models/Emprestimo.php';
require_once './models/LivrosEmprestimo.php';
require_once './models/Usuario.php';

class emprestimoController {
    private $template;
    private $livro;
    private $emprestimo;
    private $livrosEmprestimo;
    private $usuario;

    function __construct() {
        if(!isset($_SESSION['logado']) || !$_SESSION['logado']) {
            header("Location: " . SITE_URL . "inicio");
        }
        
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->livro = new Livro();
        $this->emprestimo = new Emprestimo();
        $this->livrosEmprestimo = new LivrosEmprestimo();
        $this->usuario = new Usuario();
    }

    public function index() {
        include('./helpers/formatacao.php');

        if(!empty($_SESSION['usuario'])) {
            $dados['emprestimos'] = $this->emprestimo->listarEmprUsuario($_SESSION['usuario']['codUsuario']);
        } else {
            $filtros = [];
            if(isset($_GET['atrasado']) && $_GET['atrasado'] === "1") {
                $filtros["atrasado"] = true;
            }
            if(isset($_GET['dataDev'])) {
                $filtros["dataDev"] = $_GET['dataDev'];
            }
            if(isset($_GET['usuario'])) {
                $filtros["codUsuario"] = $_GET['usuario'];
            }

            $dados['usuarios'] = $this->usuario->listar();

            $dados['emprestimos'] = $this->emprestimo->listar($filtros);
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

        $_SESSION['msgNotifSuccesso'] = "Reserva de livros feita com sucesso, vá até a biblioteca para retirar seus livros";
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

    private function validar_emprestimo($codEmprestimo) {
        if($codEmprestimo == NULL) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "emprestimo");
        }

        $emprestimo = $this->emprestimo->listarCod($codEmprestimo);
        
        if(empty($emprestimo)) {
            $_SESSION['msgNotifErro'] = "Empréstimo não encontrado";
            header("Location: " . SITE_URL . "emprestimo");
        }

        return $emprestimo;
    }
    
    public function iniciar_emprestimo() {
        $codEmprestimo = isset($_GET['id']) ? $_GET['id'] : NULL;

        $emprestimo = $this->validar_emprestimo($codEmprestimo);

        $nv_emprestimo = [
            "codFuncResp" => $_SESSION['funcionario']['codFunc'],
            "dataEmp" => date("Y-m-d"),
            "dataDev" => date('Y-m-d', strtotime('+14 day'))
        ];
        
        $this->emprestimo->atualizar($codEmprestimo, $nv_emprestimo);

        $_SESSION['msgNotifSuccesso'] = "Empréstimo iniciado com sucesso";
        header("Location: " . SITE_URL . "emprestimo");
    }

    public function confirmar_devolucao() {
        $codEmprestimo = isset($_GET['id']) ? $_GET['id'] : NULL;

        $emprestimo = $this->validar_emprestimo($codEmprestimo);

        $nv_emprestimo = [
            "finalizado" => 1,
            "codFuncFinalizado" => $_SESSION['funcionario']['codFunc'],
            "dataDevReal" => date("Y-m-d")
        ];
        
        $this->emprestimo->atualizar($codEmprestimo, $nv_emprestimo);

        $_SESSION['msgNotifSuccesso'] = "Empréstimo finalizado com sucesso";
        header("Location: " . SITE_URL . "emprestimo");
    }

    public function renovar() {
        $codEmprestimo = isset($_GET['id']) ? $_GET['id'] : NULL;

        $emprestimo = $this->validar_emprestimo($codEmprestimo);

        $nv_emprestimo = [
            "dataDev" => date('Y-m-d', strtotime('+14 day'))
        ];
        
        $this->emprestimo->atualizar($codEmprestimo, $nv_emprestimo);

        $_SESSION['msgNotifSuccesso'] = "Empréstimo renovado com sucesso";
        header("Location: " . SITE_URL . "emprestimo");
    }
}