<?php

require_once './libraries/template.php';
require_once './models/Usuario.php';
require_once './models/Pessoa.php';

class usuarioController {
    private $template;
    private $pessoa;
    private $usuario;

    function __construct() {
        if(!isset($_SESSION['logado']) || !$_SESSION['logado']) {
            header("Location: " . SITE_URL . "inicio");
        }
        
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->pessoa = new Pessoa();
        $this->usuario = new Usuario();
    }

    public function index() {
        include('./helpers/formatacao.php');

        $dados['usuarios'] = $this->usuario->listar();

        $this->template->render("lista_usuarios.php", $dados);
    }

    public function adicionar() {
        $this->template->render("form_usuarios.php");
    }

    public function editar() {
        $codUsuario = isset($_GET['id']) ? $_GET['id'] : NULL;

        if(empty($codUsuario)) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "usuario");
            return;
        }

        $dados['usuario'] = $this->usuario->listarCod($codUsuario);
        
        if(empty($dados['usuario'])) {
            $_SESSION['msgNotifErro'] = "Usuário não encontrado";
            header("Location: " . SITE_URL . "usuario");
            return;
        }
        include('./helpers/formatacao.php');

        $this->template->render("form_usuarios.php", $dados);
    }

    public function salvar() {
        $pessoa = [
            "cpf" => preg_replace('/[^0-9]/', '', $_POST['cpf']),
            "nome" => $_POST['nome'],
            "login" => $_POST['login'],
            "cep" => preg_replace('/[^0-9]/', '', $_POST['cep']),
            "logradouro" => $_POST['logradouro'],
            "numero" => !empty($_POST['numero']) ? $_POST['numero'] : NULL,
            "complemento" => $_POST['complemento'],
            "bairro" => $_POST['bairro'],
            "cidade" => $_POST['cidade'],
            "estado" => $_POST['estado']
        ];

        if(!isset($_POST['cod_usuario'])) {
            $pessoa ["senha"] = "biblioteca1234";
            $pessoa["dataInclusao"] = date("Y-m-d");

            $codPessoa = $this->pessoa->cadastrar($pessoa);

            $usuario["codPessoa"] = $codPessoa;

            $codUsuario = $this->usuario->cadastrar($usuario);

            $_SESSION['msgNotifSuccesso'] = "Usuário cadastrado com sucesso";
        } else {
            $codPessoa = $_POST['cod_pessoa'];
            $codUsuario = $_POST['cod_usuario'];

            $pessoaAtu = $this->pessoa->atualizar($codPessoa, $pessoa);

            if(!$pessoaAtu) {
                $_SESSION['msgNotifErro'] = "Erro na atualização da Pessoa";
                return;
            }

            $_SESSION['msgNotifSuccesso'] = "Usuário atualizado com sucesso";
        }

        
        header("Location: " . SITE_URL . "usuario");
    }

    public function excluir() {
        $codUsuario = isset($_GET['id']) ? $_GET['id'] : NULL;

        if(empty($codUsuario)) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "usuario");
            return;
        }

        $dados['usuario'] = $this->usuario->listarCod($codUsuario);
        
        if(empty($dados['usuario'])) {
            $_SESSION['msgNotifErro'] = "Usuário não encontrado";
            header("Location: " . SITE_URL . "usuario");
            return;
        }
        
        $this->usuario->deletarUsuarioCod($codUsuario);
        $_SESSION['msgNotifSuccesso'] = "Usuário excluído com sucesso";
        header("Location: " . SITE_URL . "usuario");
    }
    
}