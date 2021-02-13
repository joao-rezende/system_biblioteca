<?php
class Emprestimo{

    
    private $conn;
    
    private $codEmprestimo; //precisa?
    private $dataEmp;
    private $dataDev;
    private $codUsuario;
    private $codFuncResp;
    

    public function __construct() {
        
        $this->conn = new Database();
        
    }

    //busca geral
    public function consultarEmprestimos() {
       
        $sqlCliente = 'SELECT * from Emprestimo' ;

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;

    }
    
    //busca pelo cod
    public function consultarEmprestimo($codEmprestimo) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE cnpj='$cnpj'";

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;

    }
     
     //consulta pelo usuario
    public function consultarEmprUsuario($codUsuario) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE codUsuario ='$codUsuario'";

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;


    }
     
     public function consultarEmprPeriodo($dataEmp,$dataDev,) {
       
        $sqlCliente = "SELECT * from Emprestimo WHERE dataEmp ='$dataEmp' AND dataDev = '$dataDev'";

        $resultado = $this->conn->executar_query($sqlCliente);
        
        return $resultado;


    }

	//deleta com codigo
    public function deletar($codEmprestimo){

        $sqlCliente = "DELETE * FROM Emprestimo WHERE codEmprestimo ='$codEmprestimo'";

        $resultado = $this->conn->executar_query($sqlCliente);
        

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
