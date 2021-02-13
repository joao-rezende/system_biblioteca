<?php
    // include_once("libraries/database.php");

    class LivrosEmprestimo{
        // conexão
        private $conn;

        public function __construct(){
            $this->conn = new Database();
        }

        public function cadastrarEmprestimo($codLivro, $codEmp){
            $sql = "INSERT INTO LivroEmp(codEmprestimo, codLivro) VALUES ($codEmp, $codLivro)";
            
            $this->conn->executar_query($sql);
        }

        public function deletar($codLivro, $codEmp){
            $sql = "DELETE FROM LivroEmp WHERE codLivro = $codLivro AND codEmprestimo = $codEmp";

            $this->conn->executar_query($sql);                return true;
            
        }

    }
?>