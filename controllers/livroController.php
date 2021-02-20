<?php

require_once './libraries/template.php';
require_once './models/Livro.php';
require_once './models/Editora.php';

class livroController {
    private $template;
    private $livro;
    private $editora;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
        $this->livro = new Livro();
        $this->editora = new Editora();
    }

    public function index() {
        include('./helpers/formatacao.php');

        $dados['livros'] = $this->livro->listar();

        $this->template->render("lista_livros.php", $dados);
    }

    public function adicionar() {
        $dados['editoras'] = $this->editora->listar();

        $this->template->render("form_livros.php", $dados);
    }

    public function editar() {
        $codLivro = isset($_GET['id']) ? $_GET['id'] : NULL;

        if(empty($codLivro)) {
            $_SESSION['msgNotifErro'] = "Nenhum código foi enviado";
            header("Location: " . SITE_URL . "livro");
            return;
        }

        $dados['livro'] = $this->livro->listarCod($codLivro);
        
        if(empty($dados['livro'])) {
            $_SESSION['msgNotifErro'] = "Livro não encontrado";
            header("Location: " . SITE_URL . "livro");
            return;
        }

        $dados['editoras'] = $this->editora->listar();

        $this->template->render("form_livros.php", $dados);
    }

    public function salvar() {
        $livro = [
            "titulo" => $_POST['titulo'],
            "genero" => $_POST['genero'],
            "quantidade" => $_POST['quantidade'],
            "isbn" => $_POST['isbn'],
            "ano" => $_POST['ano'],
            "autor" => $_POST['autor'],
            "codEdit" => $_POST['codEdit']
        ];
        
        if(!empty($_FILES['capa']['tmp_name']) && is_integer(strpos($_FILES['capa']['type'], "image"))) {
            $dirUpload = '/var/www/system_biblioteca/uploads';
            $livro['capa'] = URL_BASE . "uploads/" . basename($_FILES['capa']['name']);
            $arquivo = DIR_UPLOAD . basename($_FILES['capa']['name']);
            move_uploaded_file($_FILES['capa']['tmp_name'], $arquivo);
        }

        if(!isset($_POST['cod_livro'])) {
            $codLivro = $this->livro->cadastrar($livro);

            $_SESSION['msgNotifSuccesso'] = "Livro cadastrado com sucesso";
        } else {
            $codEditora = $_POST['cod_livro'];

            $livroAtu = $this->livro->atualizar($codEditora, $livro);

            if(!$livroAtu) {
                $_SESSION['msgNotifErro'] = "Erro na atualização do livro";
                return;
            }

            $_SESSION['msgNotifSuccesso'] = "Livro atualizado com sucesso";
        }

        
        header("Location: " . SITE_URL . "livro");
    }
    
}