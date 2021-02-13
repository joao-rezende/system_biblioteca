<?php
class Funcionario{

    private $conn;

	private $codFunc; //precisa?
    private $cpfFunc;
    private $salario;
	private $dataInicio;
	
    public function __construct() {
        
        $this->conn = new mysqli("localhost","root","cruzeiro13","biblioteca");
        
        if (mysqli_connect_errno()) {
            
            echo "Falha na conexao com o banco de dados (MySQL): " . mysqli_connect_error();
            exit;
        }
    }

        
    public function cadastrar($cpfFunc,$salario,$dataIni) {
        
        $sqlCliente = "INSERT INTO Funcionario(salario,dataInicio,funCpf) values ('$salario','$dataInicio','$cpfFunc')" ;

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;
        
        $this->con->close();

    }
    
   
    public function consultarFuncionarios() {
        
        $sqlCliente = 'SELECT * from Funcionario' ;

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;
        
        $this->con->close();

    }
	
	//busca com cod
	public function consultarFuncionario($codFunc){
        
        $sqlCliente = "SELECT * from Funcionario WHERE codFunc = '$codFunc'";

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;
        
        $this->con->close();

    }
   
	//busca com cpf
    public function consultarFuncionarioCpf($cpfFunc){
        
        $sqlCliente = "SELECT * from Funcionario WHERE FunCpf = '$cpfFunc'";

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;
        
        $this->con->close();

    }
    
    //exclui com cod
    public function excluirFuncionario($codFunc){

        $sqlCliente = "DELETE * FROM Funcionario WHERE codFunc = '$codFunc'";

        $resultado = $this->conn->query($sqlCliente);
        
        $this->conn->close();

    }
    
    //exclui com cpf
    public function excluirFuncionarioCpf($cpfFunc){

        $sqlCliente = "DELETE * FROM Funcionario WHERE FunCpf = '$cpfFunc'";

        $resultado = $this->conn->query($sqlCliente);
        
        $this->conn->close();

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
