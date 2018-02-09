function goBack() {
window.history.back();
}
$(window).load(function () {
// Animate loader off screen
$("#loading_page").fadeOut("slow");
;
});

if ($('.hp-ans').length > 0) {
$('.hp-ans').click(function ()
{
    $('.hp-ansCont').toggleClass('hide show'); //Adds 'a', removes 'b' and vice versa
    if ($('.hp-ansCont.show').length > 0) {
        $('.hp-ans').css('background-color', '#FFF');
        $(".hp-ans img").attr("src", "<?php echo base_url(); ?>/assets/frontend/images/bell-purple.png");
    } else {
        $('.hp-ans').css('background-color', '#673AB7');
        $(".hp-ans img").attr("src", "<?php echo base_url(); ?>/assets/frontend/images/bell-white.png");
    }
});
}
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