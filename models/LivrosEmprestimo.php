<?php
    // include_once("libraries/database.php");

    class LivrosEmprestimo{
        // conexão
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function cadastrar($dados){
            $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
            $valores = "'" . implode($dados, "', '") . "'";
    
            $sql = "INSERT INTO LivroEmp({$colunas}) values ({$valores})";            

            return $this->db->executar_query($sql);
        }

        public function deletar($codLivro, $codEmp){
            $sql = "DELETE FROM LivroEmp WHERE codLivro = $codLivro AND codEmprestimo = $codEmp";

            $this->db->executar_query($sql);                
            return true;
        }

    }
?>