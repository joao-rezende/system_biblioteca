$(document).ready(function() {
    var menu = $('ul#navigation');
    if(menu.length){
        menu.slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '+',
            openedSymbol:'-'
        });
    };
});