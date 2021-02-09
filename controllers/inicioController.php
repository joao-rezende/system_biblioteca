<?php

require_once './libraries/template.php';

class inicioController {
    private $template;

    function __construct() {
        $this->template = new Template(BASE_PATH . "views/template/geral.php");
    }

    public function index() {
        require_once 'views/login.php';
    }

    public function inicio() {
        $this->template->render("inicio.php");
    }
    
}