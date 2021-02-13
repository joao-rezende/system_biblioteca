<?php
class Emprestimo{

    
    private $conn;
    
    private $codEmprestimo; //precisa?
    private $dataEmp;
    private $dataDev;
    private $codUsuario;
    private $codFuncResp;
    

    public function __construct() {
        
        $this->conn = new mysqli("localhost","root","cruzeiro13","biblioteca");
        
        if (mysqli_connect_errno()) {
        
            echo "Falha na conexao com o banco de dados (MySQL):" . mysqli_connect_error();
        
            exit;
        
        }
    }

    //busca geral
    public function consultarEmprestimos() {
       
        $sqlCliente = 'SELECT * from Emprestimo' ;

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;
        
        $this->conn->close();

    }
    
    //busca pelo cod
    public function consultarEmprestimo($codEmprestimo) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE cnpj='$cnpj'";

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;

        $this->conn->close();

    }
     
     //consulta pelo usuario
    public function consultarEmprUsuario($codUsuario) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE codUsuario ='$codUsuario'";

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;

        $this->conn->close();

    }
     
     public function consultarEmprPeriodo($dataEmp,$dataDev,) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE dataEmp ='$datEmp' AND dataDev = '$dataDev'";

        $resultado = $this->conn->query($sqlCliente);
        
        return $resultado;

        $this->conn->close();

    }

	//deleta com codigo
    public function deletar($codEmprestimo){

        $sqlCliente = "DELETE * FROM Emprestimo WHERE codEmprestimo ='$codEmprestimo'";

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
