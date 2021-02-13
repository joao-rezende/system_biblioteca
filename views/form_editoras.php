<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Nova Editora</h2>
        </div>
    </div>
    <hr>
    <form action="<?php echo SITE_URL . "editora/salvar"; ?>">
        <div class="form-group row">
            <label for="editora" class="col-sm-2 col-form-label">Editora:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="editora" name="editora" placeholder="Editora">
            </div>
        </div>
        <div class="form-group row">
            <label for="cnpj" class="col-sm-2 col-form-label">CNPJ:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ">
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-6">
                <a href="<?php echo SITE_URL . "editora"; ?>" class="btn btn-danger"><span class="fa fa-remove"></span> Cancelar</a>
            </div>
            <div class="col-6 text-right">
                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Salvar</button>
            </div>
        </div>
    </form>
</div>