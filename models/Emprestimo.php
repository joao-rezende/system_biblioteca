<?php

include_once("Mediator.php");
class Emprestimo{

    
    private $db;
    
    private $codEmprestimo;
    private $dataEmp;
    private $dataDev;
    private $codUsuario;
    private $codFuncResp;
    private $finalizado;
    

    public function __construct() {
        $this->db = new Database();
    }

    //Inserir usuário
    public function cadastrar($dados) {
        $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
        $valores = "'" . implode($dados, "', '") . "'";

        $sql = "INSERT INTO Emprestimo({$colunas}) values ({$valores})";

        $ultimoId = $this->db->executar_query_ult_id($sql);
        
        return $ultimoId;
    }

    public function atualizar($codEmprestimo, $dados) {
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

        $sql = "UPDATE Emprestimo SET {$campos} WHERE codEmprestimo = " . $codEmprestimo;

        return $this->db->executar_query($sql);
    }

    //Lista todos os usuários
    public function listar($filtros = []) {
        $where = "";
        $clausula = " WHERE ";

        if(isset($filtros['atrasado']) && $filtros['atrasado']) {
            $where .= $clausula . " finalizado = 0 AND dataDev < '" . date("Y-m-d") . "'";
            $clausula = " AND ";
        }

        if(!empty($filtros['dataDev'])) {
            $where .= $clausula . " dataDev = '" . $filtros['dataDev'] . "'";
            $clausula = " AND ";
        }

        if(!empty($filtros['codUsuario'])) {
            $where .= $clausula . " codUsuario = " . $filtros['codUsuario'];
            $clausula = " AND ";
        }

        // Cria Query
        $sql = "SELECT Emprestimo.*, PessoaFuncInicio.nome as nomeFuncInicio, PessoaFuncDev.nome as nomeFuncDev, PessoaUsuario.nome as nomeUsuario, GROUP_CONCAT(Livro.titulo) as livros FROM Emprestimo
                NATURAL JOIN Usuario
                LEFT JOIN Pessoa as PessoaUsuario ON PessoaUsuario.codPessoa = Usuario.codPessoa 
                LEFT JOIN Funcionario as FuncInicio ON FuncInicio.codFunc = Emprestimo.codFuncResp
                LEFT JOIN Pessoa as PessoaFuncInicio ON PessoaFuncInicio.codPessoa = FuncInicio.codPessoa
                LEFT JOIN Funcionario as FuncDev ON FuncDev.codFunc = Emprestimo.codFuncFinalizado
                LEFT JOIN Pessoa as PessoaFuncDev ON PessoaFuncDev.codPessoa = FuncDev.codPessoa
                NATURAL JOIN LivroEmp
                NATURAL JOIN Livro
                $where
                GROUP BY Emprestimo.codEmprestimo, Usuario.codUsuario, PessoaUsuario.codPessoa, FuncInicio.codFunc, PessoaFuncInicio.codPessoa, FuncDev.codFunc, PessoaFuncDev.codPessoa";

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }
    
    public function listarCod($codEmprestimo) {
        // Cria Query
        $sql = "SELECT * FROM Emprestimo WHERE codEmprestimo='$codEmprestimo'";

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }

    //Lista todos os usuários
    public function listarEmprUsuario($codUsuario) {
        // Cria Query
        $sql = "SELECT Emprestimo.*, PessoaFuncInicio.nome as nomeFuncInicio, PessoaFuncDev.nome as nomeFuncDev, PessoaUsuario.nome as nomeUsuario, GROUP_CONCAT(Livro.titulo) as livros FROM Emprestimo
                NATURAL JOIN Usuario
                LEFT JOIN Pessoa as PessoaUsuario ON PessoaUsuario.codPessoa = Usuario.codPessoa 
                LEFT JOIN Funcionario as FuncInicio ON FuncInicio.codFunc = Emprestimo.codFuncResp
                LEFT JOIN Pessoa as PessoaFuncInicio ON PessoaFuncInicio.codPessoa = FuncInicio.codPessoa
                LEFT JOIN Funcionario as FuncDev ON FuncDev.codFunc = Emprestimo.codFuncFinalizado
                LEFT JOIN Pessoa as PessoaFuncDev ON PessoaFuncDev.codPessoa = FuncDev.codPessoa
                NATURAL JOIN LivroEmp
                NATURAL JOIN Livro
                WHERE Emprestimo.codUsuario = $codUsuario
                GROUP BY Emprestimo.codEmprestimo, Usuario.codUsuario, PessoaUsuario.codPessoa, FuncInicio.codFunc, PessoaFuncInicio.codPessoa, FuncDev.codFunc, PessoaFuncDev.codPessoa";

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }

    
     public function consultarEmprPeriodo($dataEmp,$dataDev) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE dataEmp ='$dataEmp' AND dataDev = '$dataDev'";

        $resultado = $this->db->executar_query($sqlCliente);
        
        return $resultado;


    }

	//deleta com codigo
    public function deletar($codEmprestimo){

        $sqlCliente = "DELETE * FROM Emprestimo WHERE codEmprestimo ='$codEmprestimo'";

        $resultado = $this->db->executar_query($sqlCliente);
    }

    // finaliza um emprestimo
    public function finalizarEmprestimo($codUsuario, $codFunc, $dataEmp, $dataDev){
        $sql = "INSERT INTO Emprestimo VALUES($dataEmp, $dataDev, $codUsuario, $codFunc, 0)";

        $resultado = $this->db->executar_query($sql);
    }
   
}
?>
