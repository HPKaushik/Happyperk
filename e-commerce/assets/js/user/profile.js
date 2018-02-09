
$( window ).load(function() {
var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js';
document.head.appendChild(script);

var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js';
document.head.appendChild(script);
});

$(document).ready(function () {


$('.table.table-striped.table-responsive').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
    //for open wallet tab
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#") + 1);
    if (activeTab != '') {
//            location.reload(true);
        $('a[href="#' + activeTab + '"]').tab('show');
    }
//end 

    $('#joining_date').datetimepicker({viewMode: 'days', format: 'YYYY-DD-MM'});
    $('#dob').datetimepicker({viewMode: 'days', format: 'YYYY-DD-MM'});
    var owl = $("#owl-demo");
    owl.owlCarousel({
        loop: true,
        margin: 9,
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
    });
    // Custom Navigation Events
    $(".next").click(function () {
        owl.trigger('owl.next');
    })
    $(".prev").click(function () {
        owl.trigger('owl.prev');
    })
    $(".play").click(function () {
        owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
    })
    $(".stop").click(function () {
        owl.trigger('owl.stop');
    })
});
$('.empname').autocomplete({

    minLength: 0, source: function (request, response)
    {
        $(this).addClass('input_loading');
        result = $.getJSON('getEmployee',
                {term: extractLast(request.term)}, response)
    },
    select: function (event, ui) {
        $(this).removeClass('input_loading');
        if ($('#user_id').length > 0) {
            $('#user_id').val(ui.item.user_id);
        }
        if ($('#employee_id').length > 0)
            $('#employee_id').val(ui.item.employee_id);
    }
});
function extractLast(term) {
    return split(term).pop();
}
function split(val) {
    return val.split(/,\s*/);
}


$(document).ready(function () {


    $("#SendMoneyInfoForm").validate({
        // submitHandler: function () {
        //     moneySubmit('SendMoneyInfoForm');
        //     return false; //submit it the form
        // },
        rules: {empname: {required: true},
            amount: {required: true, number: true},
        },
        messages: {empname: {required: "Employee Name is required."},
            amount: {required: "Amount is required.", number: "Amount must be numeric."},
        },
    });
//     function moneySubmit(id) {
//         var url = $('#txtbaseurl').val() + 'user/dosend';
//         var form = $('#' + id);
//         $.ajax({
//             type: "POST",
//             url: url,
//             data: form.serialize(),
//             dataType: 'json',
//             success: function (response) {
// //                alert(response);
//                 if (response == '1') {
//                     $('#_send_money_otp_popup').modal('show');
//                     $('#_send_money_popup').modal('hide');
//                 } else {
//                     alert('Something is wrong, please try again.')
//                 }
//             }
//         });
//     }
    $("#otpForm").validate({
        rules: {otp: {required: true, number: true}
        },
        messages: {otp: {required: "OTP is required."}
        },
    });
    $("#AddLoadMoney").validate({
        rules: {loadamount: {required: true, number: true}, },
        messages: {loadamount: {required: "Amount is required.", number: "Amount must be numeric."}, },
    });
    $("#update_personal_profile_form").validate({
        rules: {password: {required: true}, },
        messages: {password: {required: "Password is required"}, },
    });
    $("#update_professional_profile_form").validate({
        rules: {password: {required: true}, },
        messages: {password: {required: "Password is required"}, },
    });
    $("#update_other_profile_form").validate({
        rules: {password: {required: true}, },
        messages: {password: {required: "Password is required"}, },
    });
});
$('#amount').on('keyup', function () {
    var danger = 'alert-danger';
    var success = 'alert-success';
    var balance = parseInt($('#wallet_amount').val());
    var t_amount = parseInt($(this).val());
    if (t_amount > balance) {
        $('#sendalertmsg').addClass(danger);
        $('#moneysend').attr('disabled', true);
        $('#sendalertmsg').css("margin", "-12px 0px 0px 8px");
        $('#sendalertmsg').html("Sorry! You dont have enough balance").show();
    } else
    {
        $('#sendalertmsg').hide();
        $('#moneysend').attr('disabled', false);
    }
});
$("#profileImageForm").validate({

    rules: {
        profilepic: {required: true}
    },
    messages: {
        profilepic: {required: "Profile image is required"}
    }
});

function read(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

//change password
$("#changePassword").validate({
    rules: {
        old_password: {required: true},
        new_password: {required: true},
        confirm_password: {required: true, equalTo: "#new_password"}
    },
    messages: {
        old_password: {required: "Old Password is required"},
        new_password: {required: "New Password is required"},
        confirm_password: {required: "Enter Confirm Password Same as New Password"}
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent()).wrap('<div/>');
        element.parent().css('margin-bottom', '0px');
    },
});
// for add new address
$(document).on('change', '.stateadd', function (e) {
    //$('#txtstatename').val($("#cmbState option:selected").text());
    var base_url = $("#txtbaseurl").val();
    var id = $(this).val();
//        alert(id);
    $('.cityadd').append('<option selected="selected">--Loading city--</option>');
    $('.cityadd').attr('disabled', 'disabled');
    $.ajax({
        type: 'POST',
        url: base_url + 'user/address/getcity',
        data: 'state=' + id,
        success: function (response) {
//                    alert(response);
            $('.cityadd option[value!="0"]').remove();
            $('.cityadd').append(response);
            $('.cityadd').removeAttr('disabled');
            //$('#txtstatename').val($('#cmbState option:selected').text());
        },
        progress: function (e)
        {
            $('#lcimg').css('display', '');
        }
    });

});

jQuery.validator.addMethod("phoneno", function (phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
}, "<br />Please specify a valid phone number");
$("#addressFrom").validate({
    rules: {
        full_name: {required: true},
        mobileno: {required: true, number: true, phoneno: true},
        full_address: {required: true},
        pincode: {required: true, number: true},
        add_state: {required: true},
        add_city: {required: true}
    },
    messages: {
        full_name: {required: "Name is required"},
        mobileno: {required: "Mobile No. is required"},
        full_address: {required: "Address is required"},
        pincode: {required: "Pincode is required"},
        add_state: {required: "State is required"},
        add_city: {required: "City is required"}
    }
});

$(document).on('click', '.fa-pencil', function (e) {
    var id = $(this).attr('id');
    $('#textedit').append('Edit Address');
    $('#textadd').remove();
    var base_url = $("#txtbaseurl").val();
    $.ajax({
        type: "POST",
        url: base_url + 'user/address/edit',
        data: {id: id},
        success: function (response) {
//            alert(response);
            response = $.parseJSON(response);
            $('#full_name').val(response['name']);
            $('#mobileno').val(response['mobile_no']);
            $('#full_address').val(response['address']);
            $('#pincode').val(response['pincode']);
            $('#address_ids').val(response['id']);
            $("#add_state option[value=" + response['state_id'] + "]").prop("selected", true);
            $("#add_city").append('<option value=' + response['city_id'] + '>' + response['city_name'] + '</option>').prop("selected", true);
            $('#_add_address_popup').modal();
        }
    });

});

function deleteAddress(id)
{
    if (!confirm('Are you sure? you want to delete this Address'))
        return false;
    var id1 = id;
    var base_url = $("#txtbaseurl").val();
    $.ajax({
        type: "post",
        url: base_url + "user/address/delete",
        data: {id1},
        success: function (responseData) {
//                alert(responseData);
            location.reload();
        },
        error: function (jqXHR) {
            console.log(errorThrown);
        }
    })

}

$(document).on('keypress', '.onumeric', function (ev) {
    if (ev.which != 8 && ev.which != 0 && (ev.which < 48 || ev.which > 57)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});
//end address