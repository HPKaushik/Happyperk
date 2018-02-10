function goBack() {
window.history.back();
}
$(window).load(function () {
// Animate loader off screen
$("#loading_page").fadeOut("slow");
;
});


mobile_menu_visible = 0;
$(document).ready(function () {
$(document).on('click', '.navbar-toggle', function () {
    $toggle = $(this);
    if (mobile_menu_visible == 1) {
        $('html').removeClass('nav-open');
        $('.close-layer').remove();
        setTimeout(function () {
            $toggle.removeClass('toggled');
        }, 400);
        mobile_menu_visible = 0;
    } else {
        setTimeout(function () {
            $toggle.addClass('toggled');
        }, 430);
        div = '<div id = "bodyClick"></div>';
        $(div).appendTo('body').click(function () {
            $('html').removeClass('nav-open');
            mobile_menu_visible = 0;
            setTimeout(function () {
                $toggle.removeClass('toggled');
                $('#bodyClick').remove();
            }, 550);
        });
        $('html').addClass('nav-open');
        mobile_menu_visible = 1;
    }
});
});