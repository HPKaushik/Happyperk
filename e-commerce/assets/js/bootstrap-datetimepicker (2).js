$(function(){	
	/* number increment */
	$('.qty-actions .inc').on('click', function(){
		var data = {};
		var _row_id = $(this).prev().attr('data-row-id');
		var qty = $(this).prev();
		
		data.rowid = _row_id;
		
		$val = $(qty).val();
		$max = $(qty).attr('max');
		
		if($max != ''){
			if($val < $max){
				$val++;
				data.qty = $val;
				update_cart(data);
			}else{
				$(qty).attr('title', 'Maximun no of coupons per user excceed...');
			}
		}else{
			$val++;
		}		
		$(qty).val($val);
	});
	
	/* number decrement */
	$('.qty-actions .dec').on('click', function(){
		var data = {};
		var _row_id = $(this).next().attr('data-row-id');
		var qty = $(this).next();
		
		data.rowid = _row_id;
		
		$val = $(qty).val();
		if($val > 1){
			$val--;		
			data.qty = $val;
			update_cart(data);	
			$(qty).val($val);
		}			
	});	
	
	/* remove to cart item */
	$('.removeCartItem').on('click', function(){ 
		
		var _row_id = $(this).parents('tr').find('input[type="hidden"]').val();
		
		//console.log(_row_id);
	
		$.ajax({
            url: base_url+'cart/remove/'+_row_id,
			dataType: 'json',
            success: function (res) {
				if(res.success == "1"){
					//location.href= base_url+res.redirectUrl;
					location.reload();
				}else{
					console.log('failure');
				}
            },
            /* beforeSend: function () {
                $('.loading').show();
            },
            complete: function () {
                $('.loading').hide();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR.status);
            },
            progress: function (e)
            {
                //$('#txtwating').waiting('done');
            }*/
        });
		
		return false;
	});
});

function update_cart(data){
	$.ajax({
		url: base_url+'cart/update_cart/',
		method: 'post',
		data: data,
		dataType: 'json',
		success: function (res) {
			if(res.success == "1"){
				$('.items-count').html(res.items_count);
				$('.items-totalPay').html(res.items_total_amount);
				$('.cashback_amount').html(res.cashback_amount);
				if(res.info && res.info != ''){
					$('.btn-wallet-pay').hide();
					$('.error-info').html(res.info);
					$('.error-info').show();
				}else{
					$('.error-info').hide();
					$('.btn-wallet-pay').show();
				}
			}else{
				console.log('failure');
			}
		},
		/* beforeSend: function () {
			$('.loading').show();
		},
		complete: function () {
			$('.loading').hide();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert(jqXHR.status);
		},
		progress: function (e)
		{
			//$('#txtwating').waiting('done');
		}*/
	});
}