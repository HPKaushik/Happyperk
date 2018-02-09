$(window).load(function () {
    // Animate loader off screen
    $("#loading_page").fadeOut("slow");
    ;
});
$(function () {
    $('.hp_grid').masonry({
        percentPosition: true,
        itemSelector: '.hp-coupon-item',
        columnWidth: '.hp-coupon-item',
        gutter: 20,
        stagger: 30,
    });

    $("#banner-slider-demo-19").owlCarousel({
        lazyLoad: true,
        dots: false,
        stopOnHover: true,
        pagination: true,
        autoPlay: true,
        slideSpeed: 300,
        paginationSpeed: 500,
        singleItem: true,
        addClassActive: true,
        transitionStyle: "fade",
    });


});
$(document).ready(function () {
    var ajaxRunning = false;
    $(window).scroll(function () {
        var base_url = $('#txtbaseurl').val();
        var is_last = $('.loader').data('is_last');
        var offset = $('.loader').data('offset');
        var awardoffset = $('.loader').data('awardoffset');
        var limit = $('.loader').data('limit');
        if (ajaxRunning == false && $(window).scrollTop() === $(document).height() - $(window).height() && is_last === 0) {
            ajaxRunning = true;
            setInterval(function () { }, 1000);
            $.ajax({
                type: 'POST',
                url: base_url + 'vouchers/getmore',
                dataType: "json",
                data: {
                    is_last: is_last,
                    offset: offset,
                    limit: limit,
                    awardoffset: awardoffset
                },
                beforeSend: function (event, xhr, settings) {
                    $('.loader').show();
                },
                success: function (response) {
                    $('.loader').hide();
                    if (response.htmlcontent != '') {
                        $('.loader').data('offset', response.offset);
                        $('.loader').data('awardoffset', response.awardoffset);
                        $('.hp_grid').append(response.htmlcontent);
                        $('.loader').data('is_last', response.is_last);
                        $('.hp_grid').masonry('layout');
                        $('.hp_grid').masonry('reloadItems');
                    }

                }, complete: function () {
                    ajaxRunning = false;
                    $('.hp_grid').masonry('layout');
                    $('.hp_grid').masonry('reloadItems');
                }
            });
            $('.hp_grid').masonry('layout');
            $('.hp_grid').masonry('reloadItems');
        } else if (is_last === 1) {
            $('.hp_grid').masonry('layout');
            html = '<div class="col-sm-12 text-center"><b><span> No more items found.</span></b></div>';
            $('.last_div').html(html);
        }
    });
});