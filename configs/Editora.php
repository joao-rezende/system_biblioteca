<?php
class Editora{

    //conexão
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost","root","cruzeiro13","biblioteca");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
    }

    //Lista todos as Editoras
    public function listar() {
        // Cria Query
        $sqlCliente = 'SELECT * from Editora' ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }
    //Lista Editoras por CNPJ
    public function listarCnpj($cnpj) {
        // Cria Query
        $sqlCliente = "SELECT * from Editora WHERE cnpj='$cnpj'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Inserir Editora
    public function cadastrar($nome, $cnpj) {
        // Cria Query
        $sqlCliente = "INSERT INTO Editora(nome,cnpj) values ('$nome', '$cnpj')" ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Deletar Editora por cnpj
    public function deletarEditora($cnpj){

        // Cria Query
        $sqlCliente = "DELETE * FROM Editora WHERE cnpj='$cnpj'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Deletar Editora por cod
    public function deletarCodEditora($cod){

        // Cria Query
        $sqlCliente = "DELETE * FROM Editora WHERE codEditora='$cod'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

}

?>