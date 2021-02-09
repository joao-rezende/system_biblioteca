<?php
class Usuario{

    //conexão
    private $conn;

    //atributos
    private $codUsuario;
    private $cpf;

    public function __construct() {
        $this->conn = new mysqli("localhost","root","cruzeiro13","biblioteca");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
    }

    //Lista todos os usuários
    public function listar() {
        // Cria Query
        $sqlCliente = 'SELECT * from Usuario' ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->con->close();

    }
    //Lista usuários por CPF
    public function listarCpf($cpf) {
        // Cria Query
        $sqlCliente = "SELECT * from Usuario WHERE usuCpf='$cpf'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->con->close();

    }

    //Listar usuários por código
    public function listarCod($cod) {
        // Cria Query
        $sqlCliente = "SELECT * from Usuario WHERE codUsuario='$cod'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->con->close();

    }


    //Inserir usuário
    public function cadastrar($cpf) {
        // Cria Query
        $sqlCliente = "INSERT INTO Usuario(Usucpf) values ('$cpf')" ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->con->close();

    }

    //Deletar usuário por cpf
    public function deletarUsuarioCpf($cpf){

        // Cria Query
        $sqlCliente = "DELETE * FROM Usuario WHERE cpf='$cpf'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Deletar usuário por cod
    public function deletarUsuarioCod($cod){

        // Cria Query
        $sqlCliente = "DELETE * FROM Usuario WHERE codUsuario='$cod'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

}

?>