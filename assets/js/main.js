$(document).ready(function() {
    var menu = $('ul#navigation');
    if(menu.length){
        menu.slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '+',
            openedSymbol:'-'
        });
    };

    if($("#notificacao").length) {
        setTimeout(() => {
            $("#notificacao").fadeOut(500, function() {
                $("#notificacao").remove();
            });
        }, 3000)
    }
});