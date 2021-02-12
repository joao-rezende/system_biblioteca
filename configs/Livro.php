<?php
class Livro{

    //conexão
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost","root","cruzeiro13","biblioteca");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
    }

    //Lista todos os Livros
    public function listar() {
        // Cria Query
        $sqlCliente = 'SELECT * from Livros' ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }
    //Lista Livros por código
    public function listarIsbn($isbn) {
        // Cria Query
        $sqlCliente = "SELECT * from Livros WHERE isbn='$isbn'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Lista quantidade de um certo Livros 
    public function listarQtd($isbn) {
        // Cria Query
        $sqlCliente = "SELECT quantidade from Livros WHERE isbn='$isbn'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Buscar um livro pelo título 
    public function buscarLivro($titulo) {
        // Cria Query
        $sqlCliente = "SELECT * from Livros WHERE titulo='$titulo'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Inserir Livros
    public function cadastrar($titulo, $genero, $quantidade, $isbn,$ano, $autores, $codEditora) {
        // Cria Query
        $sqlCliente = "INSERT INTO Livro(titulo, genero,quantidade,isbn,ano,autores,codEditora) 
                       values ('$titulo', '$genero', '$quantidade', '$isbn','$ano', '$autores', '$codEditora')" ;

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Deletar Editora por cod
    public function deletarLivro($codLivro){

        // Cria Query
        $sqlCliente = "DELETE * FROM Livros WHERE codLivro='$codLivro'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

}

?>