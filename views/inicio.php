<div class="container inicio">
    <div class="row">
        <?php
        foreach($livros as $livro)
        {
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="unico_livro">
                    <div class="capa" style="background-image: url(<?= !empty($livro['capa']) ? $livro['capa'] : (URL_BASE . "assets/img/capa_padrao.png"); ?>" alt="Capa livro: <?= $livro['titulo']; ?>">
                    </div>
                    <div class="livro_info d-flex">
                        <div class="exemplares">
                            <p><span><?= $livro['qtdDisponivel']; ?></span> <br>
                                <small>Disponíveis</small></p>
                        </div>
                        <div class="descricao">
                            <h4><?= $livro['titulo']; ?></h4>
                            <h6><?= $livro['editora']; ?></h4>
                            <a class="read_more" href="<?php echo SITE_URL . "emprestimo/adicionar_livro_reserva?id=" . $livro['codLivro']; ?>">Reservar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        
        }
        ?>
    </div>
</div>