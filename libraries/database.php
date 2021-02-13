<?php 

class Database {

    private $conexao;
    
    public function __construct() {}

    private function conectar() {
        $this->conexao = new mysqli(HOST, USER, SENHA, BD);

        if (mysqli_connect_errno()) {
            echo "Falha ao tentar conectar ao MySQL: " . mysqli_connect_error();
            exit;
        }
    }

    public function executar_query($query) {
        $this->conectar();

        $resultado = $this->conexao->query($query);

        $this->conexao->close();

        return $resultado;
    }

    public function retornar_dados($query, $linha = FALSE) {
        try{
            $resultado_mysql = $this->executar_query($query);
        
            if(!$linha) {
                $dados = [];
                while($linha = $resultado_mysql->fetch_assoc()) {
                    $dados[] = $linha;
                }
            } else {
                $dados = $resultado_mysql->fetch_assoc();
            }
            return $dados;
        }catch(Exception $e){
            echo "ERRO: [database.php / retornar_dados] -> ";
            echo $e->getMessage() ;
            throw new Exception($e->getMessage());
        }
    }

}