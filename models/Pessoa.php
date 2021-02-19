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

    //Lista todas as pessoas
    public function listar() {
        // Cria Query
        $sqlCliente = 'SELECT * from Pessoa' ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Lista Pessoas por CPF
    public function listarCpf($cpf) {
        // Cria Query
        $sqlCliente = "SELECT * from Pessoa WHERE usuCpf='$cpf'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Insere uma nova Pessoa
    // public function cadastrar($nome,$cpf,$logradouro,$bairro,$cidade,$estado,$cep,$login,$senha,$dataInclusao,$dataUltAcesso) {
    //     // Cria Query
    //     $sqlCliente = "INSERT INTO Pessoa (nome,cpf,logradouro,bairro,cidade,estado,cep,login,senha,dataInclusao,dataUltAcesso)
    //                     VALUES ('$nome','$cpf','$logradouro','$bairro','$cidade','$estado','$cep','$login','$senha','$dataInclusao','$dataUltAcesso')";

    //     $resultado = $this->conn->query($sqlCliente);
        
    //     // Retorna o Objeto da Query
    //     //return $resultado;
        
    //     // Fecha a conexão
    //     $this->conn->close();

    // }
    
    //Deleta Pessoa por cpf
    public function deletarPessoaCpf($cpf){

            // Cria Query
            $sqlCliente = "DELETE * FROM Pessoa WHERE cpf='$cpf'";
    
            $resultado = $this->conn->query($sqlCliente);
            
            // Fecha a conexão
            $this->conn->close();
    
    }

}

?>