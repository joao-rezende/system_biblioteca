<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0">Novo Livro</h2>
        </div>
    </div>
    <hr>
    <form action="<?php echo SITE_URL . "livro/salvar"; ?>">
        <div class="form-group row">
            <label for="titulo" class="col-sm-2 col-form-label">Título:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
            </div>
        </div>
        <div class="form-group row">
            <label for="genero" class="col-sm-2 col-form-label">Gênero:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="genero" name="genero" placeholder="Gênero">
            </div>
        </div>
        <div class="form-group row">
            <label for="quantidade" class="col-sm-2 col-form-label">Exemplares:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Exemplares">
            </div>
        </div>
        <div class="form-group row">
            <label for="isbn" class="col-sm-2 col-form-label">ISBN:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN">
            </div>
        </div>
        <div class="form-group row">
            <label for="ano" class="col-sm-2 col-form-label">Ano:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano">
            </div>
        </div>
        <div class="form-group row">
            <label for="autores" class="col-sm-2 col-form-label">Autores:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="autores" name="autores" placeholder="Nome dos autores">
            </div>
        </div>
        <div class="form-group row">
            <label for="editora" class="col-sm-2 col-form-label">Editora:</label>
            <div class="col-sm-10">
                <select name="editora" id="editora" class="form-control">
                    <option value="">Escolha</option>
                    <option value="1">Editora 1</option>
                    <option value="2">Editora 2</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-6">
                <a href="<?php echo SITE_URL . "livro"; ?>" class="btn btn-danger"><span class="fa fa-remove"></span> Cancelar</a>
            </div>
            <div class="col-6 text-right">
                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Salvar</button>
            </div>
        </div>
    </form>
</div>