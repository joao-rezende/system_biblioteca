$("#modal-alerta").on("hidden.bs.modal", function() {
    $("#modal-alerta .modal-body").text("");
    $("#modal-alerta .modal-footer .text-left").html("");
    $("#modal-alerta .modal-footer .text-right").html("");
});

function modalAlerta(msg) {
    $("#modal-alerta .modal-body").text(msg);

    const $btnOk = $("<button></button>", {class: "btn btn-primary m-0", "data-dismiss": "modal"})
                    .append($("<span></span>", {class: "fa fa-check"}))
                    .append(" OK");
    
    $("#modal-alerta .modal-footer .text-right").append($btnOk);

    $("#modal-alerta").modal("show");
}

function modalConfimar(msg, callback) {
    $("#modal-alerta .modal-body").text(msg);

    const $btnNao = $("<button></button>", {id: "btn-nao", class: "btn btn-danger m-0", "data-dismiss": "modal"})
                    .append($("<span></span>", {class: "fa fa-remove"}))
                    .append(" Não");

    $("#modal-alerta .modal-footer .text-left").append($btnNao);

    const $btnSim = $("<button></button>", {id: "btn-sim", class: "btn btn-success m-0", "data-dismiss": "modal"})
                    .append($("<span></span>", {class: "fa fa-check"}))
                    .append(" Sim");

    $("#modal-alerta .modal-footer .text-right").append($btnSim);

    $("#btn-sim").on("click", function() {
        callback(true);
    });

    $("#btn-nao").on("click", function() {
        callback(false);
    });

    $("#modal-alerta").modal("show");
}

$(document).ready(function() {
    var menu = $('ul#navigation');
    if(menu.length){
        menu.slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '+',
            openedSymbol:'-'
        });
    };

    if($(".notificacao").length) {
        setTimeout(() => {
            $(".notificacao").fadeOut(500, function() {
                $(".notificacao").remove();
            });
        }, 3000)
    }

    $(".btn-excluir-func").on("click", function() {
        const $btn = $(this);
        modalConfimar("Deseja excluir o funcionário?", function(excluir) {
            if(excluir) {
                window.location.href = $btn.data("url");
            }
        });
    });

    $(".btn-excluir-usuario").on("click", function() {
        const $btn = $(this);
        modalConfimar("Deseja excluir o usuário?", function(excluir) {
            if(excluir) {
                window.location.href = $btn.data("url");
            }
        });
    });
    
    $(".btn-excluir-editora").on("click", function() {
        const $btn = $(this);
        modalConfimar("Deseja excluir a editora?", function(excluir) {
            if(excluir) {
                window.location.href = $btn.data("url");
            }
        });
    });
    
    $(".btn-excluir-livro").on("click", function() {
        const $btn = $(this);
        modalConfimar("Deseja excluir o Livro?", function(excluir) {
            if(excluir) {
                window.location.href = $btn.data("url");
            }
        });
    });

    $("#btn-alterar-capa").on("click", function() {
        $("#capa-salva").remove();
        $("#capa").removeClass("hidden");
        $("#capa").attr("name", "capa");
    });

    $(".livros-reservados .btn-excluir").on("click", function() {
        window.location.href = $(this).data("url");
    });
});