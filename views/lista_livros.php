<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Livros</h2>
        </div>
        <div class="col-6 text-right">
            <a href="<?php echo SITE_URL . "livro/adicionar"; ?>" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive"> 
                <table class="table table-hover table-sm">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Editora</th>
                            <th>Exemplares</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($livros as $livro) {
                            ?>
                            <tr>
                                <td><?= $livro['codLivro']; ?></td>
                                <td><?= $livro['titulo']; ?></td>
                                <td><?= $livro['editora']; ?></td>
                                <td><?= $livro['quantidade']; ?></td>
                                <td class="col-botao">
                                    <a href="<?php echo SITE_URL . "livro/editar?id=" . $livro['codLivro']; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-pencil"></span></a>
                                    <button data-url="<?php echo SITE_URL . "livro/excluir?id=" . $livro['codLivro']; ?>" type="button" class="btn btn-sm btn-link btn-excluir-livro text-danger line-1"><span class="fa fa-trash"></span></button>
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