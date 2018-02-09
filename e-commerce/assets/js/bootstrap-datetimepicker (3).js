$(function(){
	
	/* $("#updateForm").validate({
        submitHandler: function (form) {
            //this runs when the form validated successfully
            checkout('updateForm');
            return false; //submit it the form
        },
        rules: {
            first_name: {required: true},
            last_name: {required: true},
            email: {required: true},
            mobile: {required: true}
        },
        messages: {
            first_name: {required: "First Name is required"
            },
            last_name: {required: "Last Name is required"
            },
            email: {required: "Email is required"
            },
            mobile: {required: "Mobile No. is required"
            },
        }
    }); */
		
	$('.buy-actions .btn').on('click', function(){
		$('#updateForm').submit();		
		return false;
	});
});