$(function(){
	$('.hotel-packages-list button').on('click', function(){
		$package_id = $(this).attr('data-package-id');
		
		$('.hotel-vouchers-list > div').each(function(){
			if($(this).attr('data-package-id') == $package_id){
				$(this).show("drop", {direction: "down"}, 500);
			}else{
				$(this).hide();
			}
		});
	});
});