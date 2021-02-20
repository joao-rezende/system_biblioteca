<?php

require_once './libraries/template.php';
require_once './models/Editora.php';

class editoraController {
    private $template;
    private $editora;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->editora = new Editora();
    }

    public function index() {
        include('./helpers/formatacao.php');

        $dados['editoras'] = $this->editora->listar();

        $this->template->render("lista_editoras.php", $dados);
    }

    public function adicionar() {
        $this->template->render("form_editoras.php");
    }

    public function editar() {
        $codEditora = isset($_GET['id']) ? $_GET['id'] : NULL;

        if(empty($codEditora)) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "editora");
            return;
        }

        $dados['editora'] = $this->editora->listarCod($codEditora);
        
        if(empty($dados['editora'])) {
            $_SESSION['msgNotifErro'] = "Editora não encontrado";
            header("Location: " . SITE_URL . "editora");
            return;
        }
        include('./helpers/formatacao.php');

        $this->template->render("form_editoras.php", $dados);
    }

    public function salvar() {
        $editora = [
            "cnpj" => preg_replace('/[^0-9]/', '', $_POST['cnpj']),
            "nome" => $_POST['editora']
        ];

        if(!isset($_POST['cod_editora'])) {
            $codPessoa = $this->editora->cadastrar($editora);

            $_SESSION['msgNotifSuccesso'] = "Editora cadastrada com sucesso";
        } else {
            $codEditora = $_POST['cod_editora'];

            $editoraAtu = $this->editora->atualizar($codEditora, $editora);

            if(!$editoraAtu) {
                $_SESSION['msgNotifErro'] = "Erro na atualização da editora";
                return;
            }

            $_SESSION['msgNotifSuccesso'] = "Editora atualizada com sucesso";
        }

        
        header("Location: " . SITE_URL . "editora");
    }

    public function excluir() {
        $codEditora = isset($_GET['id']) ? $_GET['id'] : NULL;

        if(empty($codEditora)) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "editora");
            return;
        }

        $dados['editora'] = $this->editora->listarCod($codEditora);
        
        if(empty($dados['editora'])) {
            $_SESSION['msgNotifErro'] = "Editora não encontrado";
            header("Location: " . SITE_URL . "editora");
            return;
        }
        
        $this->editora->deletarEditoraCod($codEditora);
        $_SESSION['msgNotifSuccesso'] = "Editora excluído com sucesso";
        header("Location: " . SITE_URL . "editora");
    }
    
}