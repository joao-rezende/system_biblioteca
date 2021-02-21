<?php
class Livro{

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Inserir usuário
    public function cadastrar($dados) {
        $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
        $valores = "'" . implode($dados, "', '") . "'";

        $sql = "INSERT INTO Livro({$colunas}) values ({$valores})";

        $ultimoId = $this->db->executar_query_ult_id($sql);
        
        return $ultimoId;
    }

    public function atualizar($codLivro, $dados) {
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

        $sql = "UPDATE Livro SET {$campos} WHERE codLivro = " . $codLivro;

        return $this->db->executar_query($sql);
    }

    //Lista todos os usuários
    public function listar() {
        // Cria Query
        $sql = 'SELECT Livro.*, Editora.nome as editora, 
                Livro.quantidade - (SELECT COUNT(LivroEmp.codLivro) FROM Emprestimo NATURAL JOIN LivroEmp WHERE finalizado = FALSE AND dataEmp IS NOT NULL AND LivroEmp.codLivro = Livro.codLivro) as qtdDisponivel 
                FROM Livro 
                JOIN Editora ON Editora.codEditora = Livro.codEdit
                GROUP BY Livro.codLivro, Editora.codEditora';

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }

    //Lista Livros por código
    public function listarCod($codLivro) {
        $sql = "SELECT * from Livro WHERE codLivro = '$codLivro'";

        $resultado = $this->db->retornar_dados($sql, TRUE);
        
        return $resultado;
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