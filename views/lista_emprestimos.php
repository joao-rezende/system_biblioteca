<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Empréstimos</h2>
        </div>
        <div class="col-6 text-right">
            <?php
            if(!empty($_SESSION['usuario'])) {
                ?>
                <a href="<?php echo SITE_URL . "inicio/inicio"; ?>" class="btn btn-success"><span class="fa fa-plus"></span> Adicionar</a>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    if(!empty($_SESSION['funcionario'])) {
        ?>
        <form action="<?php echo SITE_URL . "emprestimo"; ?>">
            <div class="row mb-3">
                <div class="col-12">
                    <input type="checkbox" name="atrasado" id="atrasado" value="1" <?= (isset($_GET['atrasado']) && $_GET['atrasado'] === "1") ? "checked" : "" ?>>
                    <label for="atrasado" class="control-label">Atrasados</label>
                </div>
                <div class="col">
                    <label for="prazo-devolucao" class="control-label">Prazo de devolução</label>
                    <input id="prazo-devolucao" name="dataDev" type="date" class="form-control" placeholder="Prazo de devolução" value="<?= isset($_GET['dataDev']) ? $_GET['dataDev'] : "" ?>">
                </div>
                <div class="col">
                    <label for="usuario" class="control-label">Usuário</label>
                    <select name="usuario" id="usuario" class="form-control">
                        <option value="">Todos</option>
                        <?php
                        foreach($usuarios as $usuario)
                        {
                            ?>
                            <option value="<?= $usuario['codUsuario']; ?>"><?= $usuario['nome']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col" style="margin-top: 29px;">
                    <button class="btn btn-primary btn-block"><span class="fa fa-filter"></span> Filtrar</button>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive"> 
                <table class="table table-hover table-sm">
                    <thead class="">
                        <tr>
                            <th>Finalizado</th>
                            <th>Livro(s)</th>
                            <?php
                            if(!empty($_SESSION['funcionario'])) {
                                ?>
                                <th>Usuário</th>
                                <th>Funcionário início</th>
                                <th>Funcionário devolução</th>
                                <?php
                            }
                            ?>
                            <th>Data empréstimo</th>
                            <th>Prazo devolução</th>
                            <th>Data devolução</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($emprestimos as $emprestimo) {
                            ?>
                            <tr>
                                <td><span class="fa <?= $emprestimo['finalizado'] ? "fa-check text-success" : "fa-remove text-danger"; ?>"></span></td>
                                <td><?= $emprestimo['livros']; ?></td>
                                <?php
                                if(!empty($_SESSION['funcionario'])) {
                                    ?>
                                    <th><?= $emprestimo['nomeUsuario']; ?></th>
                                    <th><?= $emprestimo['nomeFuncInicio'] ?? "-"; ?></th>
                                    <th><?= $emprestimo['nomeFuncDev'] ?? "-"; ?></th>
                                    <?php
                                }
                                ?>
                                <td><?= $emprestimo['dataEmp'] ? formatar_data($emprestimo['dataEmp']) : "-"; ?></td>
                                <td><?= $emprestimo['dataDev'] ? formatar_data($emprestimo['dataDev']) : "-"; ?></td>
                                <td><?= $emprestimo['dataDevReal'] ? formatar_data($emprestimo['dataDevReal']) : "-"; ?></td>
                                <td class="col-botao">
                                    <?php
                                    if(!empty($_SESSION['funcionario']) && !$emprestimo['finalizado'] && $emprestimo['dataEmp']) {
                                        ?>
                                        <a href="<?php echo SITE_URL . "emprestimo/confirmar_devolucao?id=" . $emprestimo['codEmprestimo']; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-check"></span> Confirmar devolução</a>
                                        <?php
                                    } else if(!empty($_SESSION['funcionario']) && !$emprestimo['finalizado']) {
                                        ?>
                                        <a href="<?php echo SITE_URL . "emprestimo/iniciar_emprestimo?id=" . $emprestimo['codEmprestimo']; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-play"></span> Iniciar empréstimo</a>
                                        <?php
                                    } else if(!empty($_SESSION['usuario']) && !$emprestimo['finalizado'] && $emprestimo['dataEmp']) {
                                        ?>
                                        <a href="<?php echo SITE_URL . "emprestimo/renovar?id=" . $emprestimo['codEmprestimo']; ?>" class="btn btn-sm btn-link line-1"><span class="fa fa-refresh"></span> Renovar</a>
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