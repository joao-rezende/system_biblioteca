<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Funcionários</h2>
        </div>
        <div class="col-6 text-right">
            <a href="<?php echo SITE_URL . "funcionario/adicionar"; ?>" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive"> 
                <table class="table table-hover table-sm">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>login</th>
                            <th>Data início</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($funcionarios as $funcionario) {
                            ?>
                            <tr>
                                <td><?= $funcionario['codFunc']; ?></td>
                                <td><?= formatar_cpf($funcionario['cpf']); ?></td>
                                <td><?= $funcionario['nome']; ?></td>
                                <td><?= $funcionario['login']; ?></td>
                                <td><?= formatar_data($funcionario['dataInicio']); ?></td>
                                <td class="col-botao">
                                    <a href="<?php echo SITE_URL . "funcionario/editar?id=" . $funcionario['codFunc']; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-pencil"></span></a>
                                    <button data-url="<?php echo SITE_URL . "funcionario/excluir?id=" . $funcionario['codFunc']; ?>" type="button" class="btn btn-sm btn-link btn-excluir-func text-danger line-1"><span class="fa fa-trash"></span></button>
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