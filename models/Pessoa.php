<?php
class Pessoa{

    //conexão
    private $conn;

    public function __construct() {
       $this->conn = new mysqli("localhost","root","cruzeiro13","biblioteca");
        
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
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
    public function cadastrar($nome,$cpf,$logradouro,$bairro,$cidade,$estado,$cep,$login,$senha,$dataInclusao,$dataUltAcesso) {
        // Cria Query
        $sqlCliente = "INSERT INTO Pessoa (nome,cpf,logradouro,bairro,cidade,estado,cep,login,senha,dataInclusao,dataUltAcesso)
                        VALUES ('$nome','$cpf','$logradouro','$bairro','$cidade','$estado','$cep','$login','$senha','$dataInclusao','$dataUltAcesso')";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        //return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }
    
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