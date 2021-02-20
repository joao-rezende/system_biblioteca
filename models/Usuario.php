<?php
include_once("Mediator.php");

class Usuario{

    //conexão
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Inserir usuário
    public function cadastrar($dados) {
        $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
        $valores = "'" . implode($dados, "', '") . "'";

        $sql = "INSERT INTO Usuario({$colunas}) values ({$valores})";

        $ultimoId = $this->db->executar_query_ult_id($sql);
        
        return $ultimoId;
    }

    //Lista todos os usuários
    public function listar() {
        // Cria Query
        $sql = 'SELECT * FROM Usuario
                JOIN Pessoa ON Pessoa.codPessoa = Usuario.codPessoa' ;

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }

    //Lista usuários por CPF
    public function listarCpf($cpf) {
        // Cria Query
        $sqlCliente = "SELECT * FROM Usuario
                        JOIN Pessoa ON Pessoa.codPessoa = Usuario.codPessoa
                        WHERE usuCpf='$cpf'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Retorna o Objeto da Query
        return $resultado;
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Listar usuários por código
    public function listarCod($cod) {
        // Cria Query
        $sql = "SELECT * FROM Usuario
                JOIN Pessoa ON Pessoa.codPessoa = Usuario.codPessoa
                WHERE codUsuario = '$cod'";

        $resultado = $this->db->retornar_dados($sql, TRUE);
        
        // Retorna o Objeto da Query
        return $resultado;
    }

    //Deletar usuário por cpf
    public function deletarUsuarioCpf($cpf) {

        // Cria Query
        $sqlCliente = "DELETE * FROM Usuario WHERE cpf='$cpf'";

        $resultado = $this->conn->query($sqlCliente);
        
        // Fecha a conexão
        $this->conn->close();

    }

    //Deletar usuário por cod
    public function deletarUsuarioCod($cod) {
        // Cria Query
        $sql = "DELETE FROM Usuario WHERE codUsuario = '$cod'";

        $resultado = $this->db->executar_query($sql);
        
        return $resultado;
    }

    public function solicitarEmprestimo($codUsuario, $codLivro, $dataEmp, $dataDev){
        $mediator = New Mediator();

        $codUsuario = $this->codUsuario;

        $mediator->concluirEmprestimo($codUsuario, $codLivro, $dataEmp, $dataDev);

    }
}

?>