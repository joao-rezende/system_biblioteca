<?php

include_once("Mediator.php");
class Funcionario {

    private $db;
	
    public function __construct() {
        $this->db = new Database();
    }
        
    public function cadastrar($dados) {
        $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
        $valores = "'" . implode($dados, "', '") . "'";

        $sql = "INSERT INTO Funcionario({$colunas}) values ({$valores})";

        $ultimoId = $this->db->executar_query_ult_id($sql);
        
        return $ultimoId;
    }

    public function atualizar($codFunc, $dados) {
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

        $sql = "UPDATE Funcionario SET {$campos} WHERE codFunc = " . $codFunc;

        return $this->db->executar_query($sql);
    }
    
    public function consultarFuncionarios() {
        $sql = 'SELECT * FROM Funcionario
            JOIN Pessoa ON Pessoa.codPessoa = Funcionario.codPessoa' ;

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }
	
	//busca com cod
	public function consultarFuncionario($codFunc){
        $sql = "SELECT * FROM Funcionario 
            JOIN Pessoa ON Pessoa.codPessoa = Funcionario.codPessoa
            WHERE codFunc = '$codFunc'";

        $resultado = $this->db->retornar_dados($sql, TRUE);
        
        return $resultado;
    }

    public function listarCodPessoa($codPessoa) {
        $sql = "SELECT * FROM Funcionario
                        JOIN Pessoa ON Pessoa.codPessoa = Funcionario.codPessoa
                        WHERE Funcionario.codPessoa = '$codPessoa'";

        $resultado = $this->db->retornar_dados($sql, TRUE);

        return $resultado;
    }
   
	//busca com cpf
    public function consultarFuncionarioCpf($cpfFunc){
        
        $sqlCliente = "SELECT * from Funcionario WHERE FunCpf = '$cpfFunc'";

        $resultado = $this->db->executar_query($sqlCliente);
        
        return $resultado;
    

    }
    
    //exclui com cod
    public function excluirFuncionario($codFunc){
        $sqlCliente = "DELETE FROM Funcionario WHERE codFunc = '$codFunc'";

        $resultado = $this->db->executar_query($sqlCliente);
        
        return $resultado;
    }
    
    //exclui com cpf
    public function excluirFuncionarioCpf($cpfFunc){

        $sqlCliente = "DELETE * FROM Funcionario WHERE FunCpf = '$cpfFunc'";

        $resultado = $this->db->executar_query($sqlCliente);

    }

    // É feita uma solicitacao de emprestimo
    public function solicitacaoEmpr($codUsuario, $codLivro){
        return $this->codFunc;
    }

    // realiza emprestimo
    public function realizarEmp($codFunc){
        return true;
    }

}
?>