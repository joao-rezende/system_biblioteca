<?php
    class Mediator{

        public function __construct(){}

        public function concluirEmprestimo($codUsuario, $codLivro, $dataEmp, $dataDev){
            $f = new Funcionario();

            $codFunc = $f->solicitacaoEmpr($codUsuario, $codLivro);
            if($f->realizarEmp($codFunc)){
                $e = new Emprestimo();
                $e->finalizarEmprestimo($codUsuario, $codFunc, $dataEmp, $dataDev);
            }else{
                echo "Não foi possível concluir o empréstimo";
            }

        }
    }

?>