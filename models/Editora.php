<?php
class Editora{

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Inserir usuário
    public function cadastrar($dados) {
        $colunas = "`" . implode(array_keys($dados), "`, `") . "`";
        $valores = "'" . implode($dados, "', '") . "'";

        $sql = "INSERT INTO Editora({$colunas}) values ({$valores})";

        $ultimoId = $this->db->executar_query_ult_id($sql);
        
        return $ultimoId;
    }

    public function atualizar($codEditora, $dados) {
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

        $sql = "UPDATE Editora SET {$campos} WHERE codEditora = " . $codEditora;

        return $this->db->executar_query($sql);
    }

    //Lista todos os usuários
    public function listar() {
        // Cria Query
        $sql = 'SELECT * FROM Editora';

        $resultado = $this->db->retornar_dados($sql);
        
        return $resultado;
    }

    //Lista todos os usuários
    public function listarCod($codEditora) {
        // Cria Query
        $sql = "SELECT * FROM Editora WHERE codEditora = '$codEditora'";

        $resultado = $this->db->retornar_dados($sql, TRUE);
        
        return $resultado;
    }

    //Deletar Editora por cod
    public function deletarEditoraCod($cod){
        $sql = "DELETE FROM Editora WHERE codEditora = '$cod'";

        return $this->db->executar_query($sql);
    }

}

?>