$(document).ready(function () {
    jQuery.validator.addMethod("phoneno", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
    }, "Please specify a valid phone number");


    // for mobile recharge
    $("#formMobileRecharge").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return mobileRecharge('formMobileRecharge');
            return false; //submit it the form
        },
        rules: {
            mobilerechargeno: {required: true, phoneno: true},
            operatorname: {required: true},
            mobilerechargeamount: {required: true, number: true}
        },
        messages: {
            mobilerechargeno: {required: "Mobile Number is required",
            },
            operatorname: {required: "Operator Name is required",
            },
            mobilerechargeamount: {required: "Amount is required",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function mobileRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end

    //for landline recharge
    $("#landlineRechargeForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return landlineRecharge('landlineRechargeForm');
            return false; //submit it the form
        },
        rules: {
            mobilerechargeno: {required: true, phoneno: true},
            operatorname: {required: true},
            regioncircle: {required: true},
            mobilerechargeamount: {required: true, number: true}
        },
        messages: {
            mobilerechargeno: {required: "Landline Number is required",
            },
            operatorname: {required: "Operator Name is required",
            },
            regioncircle: {required: "Operator Circle is required",
            },
            mobilerechargeamount: {required: "Amount is required",
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname' && type == 'regioncircle')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function landlineRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end

    //for boardband recharge
    $("#broadbandRechargeForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return boardbandRecharge('broadbandRechargeForm');
            return false; //submit it the form
        },
        rules: {
            mobilerechargeno: {required: true, phoneno: true},
            operatorname: {required: true},
            mobilerechargeamount: {required: true, number: true},
            broadband_package: {required: true},
            broadband_userid: {required: true}
        },
        messages: {
            mobilerechargeno: {required: "Mobile Number is required",
            },
            operatorname: {required: "Operator Name is required",
            },
            mobilerechargeamount: {required: "Amount is required",
            },
            broadband_package: {required: "Package is required",
            },
            broadband_userid: {required: "User Id is required",
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function boardbandRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end

    //for datacard recharge
    $("#datacardRechargeForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return datacardRecharge('datacardRechargeForm');
            return false; //submit it the form
        },
        rules: {
            mobilerechargeno: {required: true, phoneno: true},
            operatorname: {required: true},
            mobilerechargeamount: {required: true, number: true}
        },
        messages: {
            mobilerechargeno: {required: "Data Card Number is required",
            },
            operatorname: {required: "Operator Name is required",
            },
            mobilerechargeamount: {required: "Amount is required",
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function datacardRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end

    //for DTH recharge
    $("#dthRechargeForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return dthRecharge('dthRechargeForm');
            return false; //submit it the form
        },
        rules: {
            subscribe_id: {required: true},
            operatorname: {required: true},
            mobilerechargeamount: {required: true, number: true}
        },
        messages: {
            subscribe_id: {required: "Subscribe Id is required",
            },
            operatorname: {required: "Operator Name is required",
            },
            mobilerechargeamount: {required: "Amount is required",
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function dthRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end

    //for electricity bill recharge
    $("#electricityRechargeForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return electricityRecharge('electricityRechargeForm');
            return false; //submit it the form
        },
        rules: {
//            mobilerechargeno: {required: true, phoneno: true},
            operatorname: {required: true},
            account_no: {required: true},
            confirm_account_no: {required: true, equalTo: "#account_no"},
            mobilerechargeamount: {required: true, number: true}
        },
        messages: {
//            mobilerechargeno: {required: "Mobile Number is required",
//            },
            operatorname: {required: "Operator Name is required",
            },
            account_no: {required: "Account Number is required",
            },
            confirm_account_no: {required: "Enter Confirm Account Number Same as Account Number",
            },
            mobilerechargeamount: {required: "Amount is required",
            },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function electricityRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end

    //for gas bill recharge
    $("#gasbillRechargeForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            return gasbillRecharge('gasbillRechargeForm');
            return false; //submit it the form
        },
        rules: {
            mobilerechargeno: {required: true, phoneno: true},
            operatorname: {required: true},
            mobilerechargeamount: {required: true, number: true}
        },
        messages: {
            mobilerechargeno: {required: "Delivery Person's Mobile No. is required",
            },
            operatorname: {required: "Operator Name is required",
            },
            mobilerechargeamount: {required: "Amount is required",
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var type = $(element).attr("name");
            if (type == 'operatorname')
            {
                error.insertAfter(element).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            } else
            {
                error.insertAfter(element.parent().parent()).wrap('<div/>');
                element.parent().css('margin-bottom', '0px');
                error.parent().css('color', 'red');
                error.parent().css('font-size', '13px');
            }
        },
    });
    function gasbillRecharge(id)
    {
        var txtbaseurl = $('#txtbaseurl').val();
        var form = $('#' + id);
        $(form).attr('action', txtbaseurl + "cart/recharges");
        return true;
    }
    //end
});
$(function () {
    $("#mobilerechargeno").on('keyup', function (event) {
        event.preventDefault();
        var mobilenoval = $("#mobilerechargeno").val();
        mobilenoval = mobilenoval.replace(/\D/g, '');
        var mobilenolen = mobilenoval.length;
        if (mobilenolen <= 9) {
            $("#operatorname").val(0);
            $("#regioncircle").val(0);
        } else if (mobilenolen == 10) {
            getoperator_circle(mobilenoval);
        }
    });
});

function isNumberKeyRCV(B) {
    var A = (B.which) ? B.which : event.keyCode;
    if (A > 31 && (A < 48 || A > 57)) {
        return false
    }
}
function getoperator_circle(mobilenoval) {
    ajaxrunnig = false;
    var txtbaseurl = $('#txtbaseurl').val();
    if(!ajaxrunnig) { 
         ajaxRunning = true;
    $.ajax({
        type: "GET",
        url: txtbaseurl + "api/get_operator_info",
        data: "phone=" + mobilenoval,
        dataType: 'json',
        async: false,
        success: function (msg) {
                JSON.stringify(msg);
                if (msg.ResponseCode == '0') {
                    $("#operatorname").val(msg.OperatorAlias);
                    $("#operator").val(msg.Operator);
                    $("#region").val(msg.Region);
                    $("#showplansbutton").removeClass('hide');
                    $("#regioncircle").val(msg.RegionAlias);
                } else {
                    alert('somethinfg is wrong, please try again.');
                }
            // });
        },
        complete: function () {
                    ajaxRunning = false;
                }
    });
}
}

function openpopup() {
    var txtbaseurl = $('#txtbaseurl').val();
    var operators = $("#operator").val();
    var regions = $("#region").val();
    $.ajax({
        type: "GET",
        url: txtbaseurl + "api/get_recharge_plan",
        data: {operator: operators, region: regions},
        dataType: 'json',
        async: false,
        success: function (msg) {
            $('#planModal').show();
            $('#showoperator').append('<option value>' + operators + '</option>');
            $('#showregion').append('<option value>' + regions + '</option>');
            var items = '<table class="table table-hover table-mc-light-blue"><thead><tr><th>Detail</th><th>Validity (days)</th><th>Amount (Rs.)</th><th>Pick</th></tr></thead>';
            $.each(msg, function (i, val) { //val.Address
                items += "<tbody><tr><td>" + ['Rs.7.77 Talktime'] + "</td><td>" + ['Unlimited'] + "</td><td>" + ['10'] + "</td><td><input type='checkbox' value='10'></td></tr></tbody>";
            });
            items += "</table>";
            $('#rData').html(items);
            var checks = $(":checkbox");
            checks.on('click', function () {
                var string = checks.filter(":checked").map(function (i, v) {
                    return this.value;
                }).get().join(" ");
                $('#mobilerechargeamount').val(string);
                $('#planModal').hide();
            });
        }
    });
}
