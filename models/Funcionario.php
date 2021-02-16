<?php

include_once("Mediator.php");
class Funcionario{

    private $conn;

	private $codFunc; //precisa?
    private $cpfFunc;
    private $salario;
	private $dataInicio;
	
    public function __construct() {
        
        $this->conn = new Database();
        
    }

        
    public function cadastrar($cpfFunc,$salario,$dataIni) {
        
        $sqlCliente = "INSERT INTO Funcionario(salario,dataInicio,funCpf) values ('$salario','$dataIni','$cpfFunc')" ;

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;

    }
    
   
    public function consultarFuncionarios() {
        
        $sqlCliente = 'SELECT * from Funcionario' ;

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;
       

    }
	
	//busca com cod
	public function consultarFuncionario($codFunc){
        
        $sqlCliente = "SELECT * from Funcionario WHERE codFunc = '$codFunc'";

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;


    }
   
	//busca com cpf
    public function consultarFuncionarioCpf($cpfFunc){
        
        $sqlCliente = "SELECT * from Funcionario WHERE FunCpf = '$cpfFunc'";

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;
    

    }
    
    //exclui com cod
    public function excluirFuncionario($codFunc){

        $sqlCliente = "DELETE * FROM Funcionario WHERE codFunc = '$codFunc'";

        $resultado = $this->conn->executar_query($sqlCliente);


    }
    
    //exclui com cpf
    public function excluirFuncionarioCpf($cpfFunc){

        $sqlCliente = "DELETE * FROM Funcionario WHERE FunCpf = '$cpfFunc'";

        $resultado = $this->conn->executar_query($sqlCliente);

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

<!--
<head>
	<title>sem título</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.37.1" />
</head>

<body>
	
</body>

</html>
-->
