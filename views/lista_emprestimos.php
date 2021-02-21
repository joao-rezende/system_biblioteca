<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Empréstimos</h2>
        </div>
        <div class="col-6 text-right">
            <a href="<?php echo SITE_URL . "inicio/inicio"; ?>" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive"> 
                <table class="table table-hover table-sm">
                    <thead class="">
                        <tr>
                            <th>Finalizado</th>
                            <th>Usuário</th>
                            <?php
                            if(!empty($_SESSION['funcionario'])) {
                                ?>
                                <th>Funcionário</th>
                                <th>Data empréstimo</th>
                                <?php
                            }
                            ?>
                            <th>Prazo devolução</th>
                            <th>Data devolução</th>
                            <th>Livro(s)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($emprestimos as $emprestimo) {
                            ?>
                            <tr>
                                <td><span class="fa <?= $emprestimo['finalizado'] ? "fa-check text-success" : "fa-remove text-danger"; ?>"></span></td>
                                <?php
                                if(!empty($_SESSION['funcionario'])) {
                                    ?>
                                    <th><?= $emprestimo['nomeUsuario']; ?></th>
                                    <th><?= $emprestimo['nomeFunc'] ?? "-"; ?></th>
                                    <?php
                                }
                                ?>
                                <td><?= formatar_data($emprestimo['dataEmp']); ?></td>
                                <td><?= formatar_data($emprestimo['dataDev']); ?></td>
                                <td><?= $emprestimo['dataDevReal'] ? formatar_data($emprestimo['dataDevReal']) : "-"; ?></td>
                                <td><?= $emprestimo['livros']; ?></td>
                                <td class="col-botao">
                                    <?php
                                    if(!empty($_SESSION['funcionario']) && !$emprestimo['finalizado']) {
                                        ?>
                                        <a href="<?php echo SITE_URL . "emprestimo/confirmar_devolucao?id=" . $emprestimo['codEmprestimo']; ?>" class="btn btn-sm btn-link line-1" data-toggle="tooltip" data-container="body" title="Confirmar devolução"><span class="fa fa-check"></span></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>