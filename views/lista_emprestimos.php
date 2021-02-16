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
                            <th>Data empréstimo</th>
                            <th>Data devolução</th>
                            <th>Livro(s)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="fa fa-check text-success"></span></td>
                            <td>15/02/2021</td>
                            <td>22/02/2021</td>
                            <td>A quarta capa, A quinta capa, A terceira capa</td>
                            <td class="col-botao">
                                <a href="<?php echo SITE_URL . "funcionario/editar?id=1"; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>