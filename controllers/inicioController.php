<?php

require_once './libraries/template.php';
require_once './models/Livro.php';
require_once './models/Pessoa.php';
require_once './models/Funcionario.php';
require_once './models/Usuario.php';

class inicioController {
    private $template;
    private $livro;
    private $pessoa;
    private $funcionario;
    private $usuario;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->livro = new Livro();
        $this->pessoa = new Pessoa();
        $this->funcionario = new Funcionario();
        $this->usuario = new Usuario();
    }

    public function index() {
        require_once 'views/login.php';
    }

    public function logar() {
        $pessoa = $this->pessoa->logar($_POST['login'], $_POST['senha']);

        if(empty($pessoa)) {
            $_SESSION['erroLogin'] = "Usuário e/ou senha inválidos";
            header("Location: " . SITE_URL . "inicio");
            return;
        }
        
        $_SESSION['usuario'] = $this->usuario->listarCodPessoa($pessoa['codPessoa']);
        $_SESSION['funcionario'] = $this->funcionario->listarCodPessoa($pessoa['codPessoa']);

        if(empty($_SESSION['usuario']) && empty($_SESSION['funcionario'])) {
            $_SESSION['erroLogin'] = "Usuário e/ou senha inválidos";
            header("Location: " . SITE_URL . "inicio");
            return;
        }

        $_SESSION['logado'] = TRUE;
        
        if(!empty($_SESSION['usuario'])) {
            header("Location: " . SITE_URL . "inicio/inicio");
        } else {
            header("Location: " . SITE_URL . "emprestimo");
        }
    }

    public function inicio() {
        if(!isset($_SESSION['logado']) || !$_SESSION['logado']) {
            header("Location: " . SITE_URL . "inicio");
        }
        
        if(!isset($_SESSION['livros_reservados'])) {
            $_SESSION['livros_reservados'] = array();
        }

        $dados['livros'] = $this->livro->listar();
        $this->template->render("inicio.php", $dados);
    }

    public function sair() {
        session_destroy();        

        header("Location: " . SITE_URL . "inicio");
    }
    
}