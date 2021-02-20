<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            <h2 class="titulo m-0"><?= (!isset($livro)) ? "Novo livro" : "Editar livro"; ?></h2>
        </div>
    </div>
    <hr>
    <form action="<?php echo SITE_URL . "livro/salvar"; ?>" method="POST" enctype='multipart/form-data'>
        <?php
        if(isset($livro))
        {
            ?>
            <input type="hidden" name="cod_livro" value="<?= $livro['codLivro']; ?>">
            <?php
        }
        ?>
        <div class="form-group row">
            <label for="titulo" class="col-sm-2 col-form-label">Título:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="<?= isset($livro) ? $livro['titulo'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="genero" class="col-sm-2 col-form-label">Gênero:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="genero" name="genero" placeholder="Gênero" value="<?= isset($livro) ? $livro['genero'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="quantidade" class="col-sm-2 col-form-label">Exemplares:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Exemplares" value="<?= isset($livro) ? $livro['quantidade'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="isbn" class="col-sm-2 col-form-label">ISBN:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" value="<?= isset($livro) ? $livro['isbn'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="ano" class="col-sm-2 col-form-label">Ano:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano" value="<?= isset($livro) ? $livro['ano'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="autor" class="col-sm-2 col-form-label">Autores:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="autor" name="autor" placeholder="Nome dos autores" value="<?= isset($livro) ? $livro['autor'] : ""; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="codEdit" class="col-sm-2 col-form-label">Editora:</label>
            <div class="col-sm-10">
                <select name="codEdit" id="codEdit" class="form-control">
                    <option value="">Escolha</option>
                    <?php 
                    foreach($editoras as $editora) {
                        ?>
                        <option value="<?php echo $editora['codEditora']; ?>" <?= isset($livro) && $livro['codEdit'] == $editora['codEditora'] ? "selected" : ""; ?>><?php echo $editora['nome']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="capa" class="col-sm-2 col-form-label">Capa:</label>
            <div class="col-sm-10 text-center">
                <div id="capa-salva">
                    <?php
                    $classe = "";
                    $name = "";
                    if(isset($livro) && !empty($livro['capa'])) {
                        $classe = "hidden";
                        $name = "capa";
                        ?>
                            <div style="height: 200px; 
                                background-image: url('<?= $livro['capa']; ?>');
                                background-position: center center;
                                background-size: contain;
                                background-repeat: no-repeat"></div>
                            <button id="btn-alterar-capa" class="btn default" type="button"><span class="fa fa-refresh"></span> Alterar capa</button>
                        <?php
                    }
                    ?>
                </div>
                <input  type="file" class="form-control <?= $classe; ?>" id="capa" name="<?= $name; ?>" accept="image/*">
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