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

    public function editar() {
        $codFunc = isset($_GET['id']) ? $_GET['id'] : NULL;

        if(empty($codFunc)) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "funcionario");
            return;
        }

        $dados['funcionario'] = $this->funcionario->consultarFuncionario($codFunc);
        
        if(empty($dados['funcionario'])) {
            $_SESSION['msgNotifErro'] = "Funcionário não encontrado";
            header("Location: " . SITE_URL . "funcionario");
            return;
        }
        include('./helpers/formatacao.php');

        $this->template->render("form_funcionarios.php", $dados);
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

        $funcionario = [
            "salario" => $_POST['salario'],
            "dataInicio" => $_POST['data_inicio'],
        ];

        if(!isset($_POST['cod_func'])) {
            $pessoa ["senha"] = "biblioteca1234";
            $pessoa["dataInclusao"] = date("Y-m-d");

            $codPessoa = $this->pessoa->cadastrar($pessoa);

            $funcionario["codPessoa"] = $codPessoa;

            $codFunc = $this->funcionario->cadastrar($funcionario);

            $_SESSION['msgNotifSuccesso'] = "Funcionário cadastrado com sucesso";
        } else {
            $codPessoa = $_POST['cod_pessoa'];
            $codFunc = $_POST['cod_func'];

            $pessoaAtu = $this->pessoa->atualizar($codPessoa, $pessoa);

            if(!$pessoaAtu) {
                $_SESSION['msgNotifErro'] = "Erro na atualização da Pessoa";
                return;
            }

            $funcAtu = $this->funcionario->atualizar($codFunc, $funcionario);

            if(!$funcAtu) {
                $_SESSION['msgNotifErro'] = "Erro na atualização do funcionário";
                return;
            }

            $_SESSION['msgNotifSuccesso'] = "Funcionário atualizado com sucesso";
        }

        
        header("Location: " . SITE_URL . "funcionario");
    }
    
}