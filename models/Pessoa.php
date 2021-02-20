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
        $sql = "SELECT * FROM Pessoa WHERE cpf = '$cpf'";

        $resultado = $this->conn->retornar_dados($sql, TRUE);
        
        return $resultado;
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