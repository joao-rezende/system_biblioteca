<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Editoras</h2>
        </div>
        <div class="col-6 text-right">
            <a href="<?php echo SITE_URL . "editora/adicionar"; ?>" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive"> 
                <table class="table table-hover table-sm">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Editora</th>
                            <th>CNPJ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($editoras as $editora) {
                            ?>
                            <tr>
                                <td><?= $editora['codEditora']; ?></td>
                                <td><?= $editora['nome']; ?></td>
                                <td><?= formatar_cnpj($editora['cnpj']); ?></td>
                                <td class="col-botao">
                                    <a href="<?php echo SITE_URL . "editora/editar?id=" . $editora['codEditora']; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-pencil"></span></a>
                                    <button data-url="<?php echo SITE_URL . "editora/excluir?id=" . $editora['codEditora']; ?>" type="button" class="btn btn-sm btn-link btn-excluir-editora text-danger line-1"><span class="fa fa-trash"></span></button>
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