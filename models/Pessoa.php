<?php
class Pessoa{

    //conexão
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cadastrar($dados) {
        $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
        $valores = "'" . implode($dados, "', '") . "'";

        $sql = "INSERT INTO Pessoa({$colunas}) values ({$valores})";

        $ultimoId = $this->db->executar_query_ult_id($sql);
        
        return $ultimoId;
    }

    public function atualizar($codPessoa, $dados) {
        $campos = "";
        foreach($dados as $indice => $dado) {
            if(!empty($campos)) {
                $campos .= ", ";
            }
            $campos .= "`" . $indice . "` = ";
            if($dado === NULL) {
                $campos .= "NULL";
            } else {
                $campos .= "'" . $dado . "'";
            }
            
        }

        $sql = "UPDATE Pessoa SET {$campos} WHERE codPessoa = " . $codPessoa;

        return $this->db->executar_query($sql);
    }

    //Lista todas as pessoas
    public function listar() {
        // Cria Query
        $sql = 'SELECT * from Pessoa' ;

        $resultado = $this->conn->query($sql);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Lista Pessoas por CPF
    public function listarCpf($cpf) {
        // Cria Query
        $sql = "SELECT * FROM Pessoa WHERE cpf = '$cpf'";

        $resultado = $this->conn->retornar_dados($sql, TRUE);
        
        return $resultado;
    }

    //Deleta Pessoa por cpf
    public function excluir($codPessoa){
        $sql = "DELETE FROM Pessoa WHERE codPessoa = '$codPessoa'";

        return $this->db->executar_query($sql);
    }

    public function logar($login, $senha) {
        $sql = "SELECT * FROM Pessoa WHERE login LIKE '$login' AND senha LIKE '$senha'";

        $resultado = $this->db->retornar_dados($sql, TRUE);

        return $resultado;
    }

}

?>