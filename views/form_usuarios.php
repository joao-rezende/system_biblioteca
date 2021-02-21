<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0"><?= (!isset($usuario)) ? "Novo usuário" : "Editar usuário"; ?></h2>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-senha">
                <span class="fa fa-refresh"></span>
                Alterar Senha
            </button>
        </div>
    </div>
    <hr>
    <form method="post" action="<?php echo SITE_URL . "usuario/salvar"; ?>">
        <?php
        if(isset($usuario))
        {
            ?>
            <input type="hidden" name="cod_pessoa" value="<?= $usuario['codPessoa']; ?>">
            <input type="hidden" name="cod_usuario" value="<?= $usuario['codUsuario']; ?>">
            <?php
        }
        ?>
        <div class="form-group row">
            <label for="cpf" class="col-sm-2 col-form-label">CPF:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?= isset($usuario) ? formatar_cpf($usuario['cpf']) : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= isset($usuario) ? $usuario['nome'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="login" class="col-sm-2 col-form-label">Login:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" value="<?= isset($usuario) ? $usuario['login'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="cep" class="col-sm-2 col-form-label">CEP:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?= isset($usuario) ? formatar_cep($usuario['cep']) : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="logradouro" class="col-sm-2 col-form-label">Logradouro:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro" value="<?= isset($usuario) ? $usuario['logradouro'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="numero" class="col-sm-2 col-form-label">Número:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="numero" name="numero" placeholder="Número" min="0" step="1" value="<?= isset($usuario) ? $usuario['numero'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="complemento" class="col-sm-2 col-form-label">Complemento:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="<?= isset($usuario) ? $usuario['complemento'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="bairro" class="col-sm-2 col-form-label">Bairro:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= isset($usuario) ? $usuario['bairro'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="cidade" class="col-sm-2 col-form-label">Cidade:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?= isset($usuario) ? $usuario['cidade'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" maxlength="2" value="<?= isset($usuario) ? $usuario['estado'] : ""; ?>">
            </div>
        </div>

        <?php 
        if(!isset($usuario)) {
            ?>
            <small class="text-warning"><span class="fa fa-info-circle"></span> Novos usuários são criados com a senha padrão "biblioteca1234"</small>
            <?php
        }
        ?>
        <hr>
        <div class="form-group row">
            <div class="col-6">
                <a href="<?php echo SITE_URL . "usuario"; ?>" class="btn btn-danger"><span class="fa fa-remove"></span> Cancelar</a>
            </div>
            <div class="col-6 text-right">
                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Salvar</button>
            </div>
        </div>
    </form>
</div>

<div id="modal-senha" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="senha" class="col-sm-4 col-form-label">Senha:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm-senha" class="col-sm-4 col-form-label">Confirmar senha:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="confirm-senha" name="confirm_senha" placeholder="Confirmar senha">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-6 text-left p-0 m-0">
                    <button type="button" class="btn btn-danger m-0" data-dismiss="modal"><span class="fa fa-remove"></span> Cancelar</button>
                </div>
                <div class="col-6 text-right p-0 m-0">
                    <button type="button" class="btn btn-success m-0"><span class="fa fa-save"></span> Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>