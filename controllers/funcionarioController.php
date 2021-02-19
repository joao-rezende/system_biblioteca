<?php

require_once './libraries/template.php';
require_once './models/Funcionario.php';
require_once './models/Pessoa.php';

class funcionarioController {
    private $template;
    private $funcionario;
    private $pessoa;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->funcionario = new Funcionario();
        $this->pessoa = new Pessoa();
    }

    public function index() {  
        include('./helpers/formatacao.php');

        $dados['funcionarios'] = $this->funcionario->consultarFuncionarios();

        $this->template->render("lista_funcionarios.php", $dados);
    }

    public function adicionar() {
        $this->template->render("form_funcionarios.php");
    }

    public function salvar() {
        $pessoa = [
            "nome" => $_POST['nome'],
            "cpf" => preg_replace('/[^0-9]/', '', $_POST['cpf']),
            "logradouro" => $_POST['logradouro'],
            "bairro" => $_POST['bairro'],
            "cidade" => $_POST['cidade'],
            "estado" => $_POST['estado'],
            "cep" => preg_replace('/[^0-9]/', '', $_POST['cep']),
            "login" => $_POST['login'],
            "senha" => "biblioteca1234",
            "dataInclusao" => date("Y-m-d")
        ];

        $codPessoa = $this->pessoa->cadastrar($pessoa);

        $funcionario = [
            "salario" => $_POST['salario'],
            "dataInicio" => $_POST['data_inicio'],
            "codPessoa" => $codPessoa
        ];

        $codFunc = $this->funcionario->cadastrar($funcionario);

        $_SESSION['msgNotificacao'] = "Funcionário cadastrado com sucesso";
        
        header("Location: " . SITE_URL . "funcionario");
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