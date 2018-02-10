$(function () {

    /* number increment */
    $('.qty-container .inc').on('click', function () {
        $(this).attr('title', '');
        $val = $('#quantity').val();
        $max = $('#quantity').data('max');

        if ($max != '') {
            if ($val < $max) {
                $val++;
            } else {
                if ($('.qty-container .excceed').length == 0) {
                    $('.qty-container').append('<small class="excceed">Maximun no of coupons per user excceed</small>');
                }
            }
        } else {
            $val++;
        }
        $('#quantity').val($val);
    });

    /* number decrement */
    $('.qty-container .dec').on('click', function () {
        $val = $('#quantity').val();
        if ($val > 1) {
            $val--;
            $('#quantity').val($val);
        }
    });

    /* Tabs Navigation*/
    $('.deal-tabs li').on('click', function () {

        var tabs = $('.deal-tabs li');
        var id = $(this).attr('data-t');

        $.each(tabs, function (k, v) {
            $(v).removeClass('active');
        });

        $(this).addClass('active');

        /*Tab Content*/
        var tab_content = $('.tab-content');

        $.each(tab_content, function (k, v) {
            $(v).removeClass('active').addClass('hidden');
        });

        $(id).removeClass('hidden').addClass('active');
    });


    $("#add_to_cart").validate({
        rules: {empname: {required: true},
            amount: {required: true, number: true},
        },
        messages: {empname: {required: "Employee Name is required."},
            amount: {required: "Amount is required.", number: "Amount must be numeric."},
        },
    });

    /* Add to cart */

    // $('.addtocart').on('click', function (e) {
    //     var data = $('.deal-details-inner :input').serialize();
    //     base_url = $('#base_url').val();
    //     $.ajax({
    //         url: base_url + 'cart/add',
    //         type: 'POST',
    //         data: data,
    //         dataType: 'json',
    //         success: function (res) {
    //             if (res.success == "1") {
    //                 location.href = base_url + res.redirectUrl;
    //             } else {
    //                 console.log('failure');
    //             }
    //         },
    //     });

    //     return false;
    // });
});