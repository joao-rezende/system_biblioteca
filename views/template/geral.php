<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>System Biblioteca</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo URL_BASE . "assets/img/favicon.png"; ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/owl.carousel.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/magnific-popup.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/font-awesome.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/themify-icons.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/nice-select.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/flaticon.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/gijgo.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/animate.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/slick.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/slicknav.css"; ?>">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/hus/css/style.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL_BASE . "assets/css/estilo.css"; ?>">
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="<?php echo SITE_URL; ?>">
                                    <h3>S<small>ystem</small> B<small>iblioteca</small></h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <?php
                                        if($_SESSION['usuario']) {
                                            ?>
                                            <li><a href="<?php echo SITE_URL . "inicio/inicio"; ?>">Home</a></li>
                                            <?php
                                        }
                                        if(!empty($_SESSION['funcionario'])) {
                                            ?>
                                            <li><a href="<?php echo SITE_URL . "emprestimo"; ?>">Empréstimos</a></li>
                                            <li><a href="#">Cadastros</a>
                                                <ul class="submenu">
                                                    <li><a href="<?php echo SITE_URL . "editora"; ?>">Editoras</a></li>
                                                    <li><a href="<?php echo SITE_URL . "livro"; ?>">Livros</a></li>
                                                    <li><a href="<?php echo SITE_URL . "usuario"; ?>">Usuários</a></li>
                                                    <li><a href="<?php echo SITE_URL . "funcionario"; ?>">Funcionários</a></li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if(!empty($_SESSION['usuario'])) {
                                            ?>
                                            <li class="emprestimo pull-right">
                                                <a id="novo-emprestimo" href="#">
                                                    <?php 
                                                    if(count($_SESSION['livros_reservados']) > 0)
                                                    {
                                                        ?>
                                                        <span class="badge badge-danger"><?= count($_SESSION['livros_reservados']); ?></span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="circulo">
                                                        <span class="fa fa-book">
                                                    </div>
                                                </a>

                                                <ul class="submenu">
                                                    <?php 
                                                    foreach($_SESSION['livros_reservados'] as $livro)
                                                    {
                                                        ?>
                                                        <li class="livros-reservados">
                                                            <div class="conteudo-submenu">
                                                                <span class="titulo"><?= $livro['titulo']; ?></span>
                                                                <span data-url="<?php echo SITE_URL . "emprestimo/remover_livro_reserva?id=" . $livro['codLivro']; ?>" class="btn-excluir fa fa-trash text-danger"></span>
                                                                <div class="miniatura-capa" style="background-image: url(<?= !empty($livro['capa']) ? $livro['capa'] : (URL_BASE . "assets/img/capa_padrao.png"); ?>);" alt=""></div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>

                                                    <?php 
                                                    if(count($_SESSION['livros_reservados']) === 0)
                                                    {
                                                        ?>
                                                        <li>Nenhum livro reservado</li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li>
                                                        <a type="button" href="<?php echo SITE_URL . "emprestimo/adicionar"; ?>" class="btn btn-laranja btn-block">Finalizar</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li class="usuario pull-right">
                                            <a id="editar-usuario" href="#">
                                                <div class="circulo">
                                                    <span class="fa fa-user">
                                                </div>
                                            </a>

                                            <ul class="submenu">
                                                <?php 
                                                if(!empty($_SESSION['funcionario'])) {
                                                    $url_meus_dados =  SITE_URL . "funcionario/editar?id=" . $_SESSION['funcionario']['codFunc'];
                                                } else if(!empty($_SESSION['usuario'])) {
                                                    $url_meus_dados =  SITE_URL . "usuario/editar?id=" . $_SESSION['usuario']['codUsuario'];
                                                }
                                                ?>
                                                <li><a href="<?= $url_meus_dados; ?>">Meus Dados</a></li>
                                                <?php
                                                if($_SESSION['usuario']) {
                                                    ?>
                                                    <li><a href="<?php echo SITE_URL . "emprestimo"; ?>">Meus empréstimos</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="<?php echo SITE_URL . "inicio/sair"; ?>">Sair</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- slider_area_start -->
    <div id="conteudo-template">
        <?php echo $conteudo; ?>
    </div>
    <!-- slider_area_end -->

    
    <div class="footer footer_bg_1">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="copy_right">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados | Este template foi produzido por <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?php echo SITE_URL; ?>">
                            <h2>S<small>ystem</small> B<small>iblioteca</small></h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-alerta" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <div class="col-6 text-left p-0 m-0">
                        
                    </div>
                    <div class="col-6 text-right p-0 m-0">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    if(!empty($_SESSION['msgNotifSuccesso'])) {
        ?>
        <div class="toast fade show notificacao" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; right: 20px; top: 40px; z-index: 9999;">
            <div class="toast-header">
                <span class="fa fa-check-circle text-success" style="font-size: 17px;"></span>
                <strong class="ml-1 mr-auto">Successo</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?php echo $_SESSION['msgNotifSuccesso']; ?>
            </div>
        </div>
        <?php
        $_SESSION['msgNotifSuccesso'] = NULL;
    } 
    ?>

    <?php 
    if(!empty($_SESSION['msgNotifErro'])) {
        ?>
        <div class="toast fade show notificacao" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; right: 20px; top: 40px; z-index: 9999;">
            <div class="toast-header">
                <span class="fa fa-exclamation-triangle text-danger" style="font-size: 17px;"></span>
                <strong class="ml-1 mr-auto">Erro</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?php echo $_SESSION['msgNotifErro']; ?>
            </div>
        </div>
        <?php
        $_SESSION['msgNotifErro'] = NULL;
    } 
    ?>
        
    <!-- JS here -->
    <script src="<?php echo URL_BASE . "assets/hus/js/vendor/modernizr-3.5.0.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/vendor/jquery-1.12.4.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/popper.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/bootstrap.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/owl.carousel.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/isotope.pkgd.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/ajax-form.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/waypoints.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.counterup.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/imagesloaded.pkgd.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/scrollIt.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.scrollUp.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/wow.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/nice-select.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.slicknav.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.magnific-popup.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/plugins.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/gijgo.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/slick.min.js"; ?>"></script>



    <!--contact js-->
    <script src="<?php echo URL_BASE . "assets/hus/js/contact.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.ajaxchimp.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.form.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/jquery.validate.min.js"; ?>"></script>
    <script src="<?php echo URL_BASE . "assets/hus/js/mail-script.js"; ?>"></script>

    <script src="<?php echo URL_BASE . "assets/js/main.js"; ?>"></script>
</body>

</html>