$(window).load(function(){$("#loading_page").fadeOut("slow");;});$(function(){$('.hp_grid').masonry({percentPosition:true,itemSelector:'.hp-coupon-item',columnWidth:'.hp-coupon-item',gutter:10,stagger:10,});$("#banner-slider-demo-19").owlCarousel({lazyLoad:true,dots:false,stopOnHover:true,pagination:true,autoPlay:true,slideSpeed:300,paginationSpeed:500,singleItem:true,addClassActive:true,transitionStyle:"fade",responsiveClass:true,responsive:{0:{items:1,nav:true},600:{items:3,nav:false},1000:{items:5,nav:true,loop:false}
    }});});$(document).ready(function(){var ajaxRunning=false;$(window).scroll(function(){var base_url=$('#txtbaseurl').val();var is_last=$('.loader').data('is_last');var offset=$('.loader').data('offset');var awardoffset=$('.loader').data('awardoffset');var limit=$('.loader').data('limit');if(ajaxRunning==false&&$(window).scrollTop()===$(document).height()-$(window).height()&&is_last===0){ajaxRunning=true;setInterval(function(){},1000);$.ajax({type:'POST',url:base_url+'vouchers/getmore',dataType:"json",data:{is_last:is_last,offset:offset,limit:limit,awardoffset:awardoffset},beforeSend:function(event,xhr,settings){$('.loader').show();},success:function(response){$('.loader').hide();if(response.htmlcontent!=''){$('.loader').data('offset',response.offset);$('.loader').data('awardoffset',response.awardoffset);
    	// $('.hp_grid').append(response.htmlcontent);
    	$('.loader').data('is_last',response.is_last);
    	$(".hp_grid").append(response.htmlcontent).masonry('appended', response.htmlcontent, 'reloadItems');
    }},complete:function(){
    	ajaxRunning=false;
    	$('.hp_grid').masonry('layout');$('.hp_grid').masonry('reloadItems');}});$('.hp_grid').masonry('layout');$('.hp_grid').masonry('reloadItems');}else if(is_last===1){$('.hp_grid').masonry('layout');html='<div class="col-sm-12 text-center"><b><span class="font-18> No more items found.</span></b></div>';$('.last_div').html(html);}});});
$('html').click( function(){$('html').removeClass('nav-open');});
// $(window).resize(function(){location.reload();});


// $('.search-input-header').autocomplete({

//     minLength: 3, 
//     source: function (request, response)
//     {
//         $(this).addClass('input_loading');
//         // result = $.getJSON('vouchers/search',
//         //         {term: extractLast(request.term)}, response)
//                 $.post("search.php", request, response);
//     },
//     select: function (event, ui) {
//         $(this).removeClass('input_loading');
//         if ($('#user_id').length > 0) {
//             $('#user_id').val(ui.item.user_id);
//         }
//         if ($('#employee_id').length > 0)
//             $('#employee_id').val(ui.item.employee_id);
//     }
// });

$( ".search-input-header" ).autocomplete({ 
source: function (request, response) {
		// alert('e');
		    $.ajax({
			  type: "POST",
			  url:"vouchers/search",
			  data: $('.search-form').serialize(),
			  success: response,
			  dataType: 'json',
		      success: function( data ) {
           		 response($.map(data, function(item) {
		               return {
			                // name: item.name,
			                brandname: item.brandname,
			                categoryname: item.categoryname,
		               };
          	  },
          	  ));
           		  }
		});
  	},
   minLength : 	3,
      // open: function() {
      //   $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      // },
      // close: function() {
      //   $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      // },
  	 select: function(event, ui) { 
  		// console.log(JSON.stringify(ui.item));
  		$('.search-input-header').val(ui.item.brandname);
  	},
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	 return $( "<li>" )
	    .data( "ui-autocomplete-item", item )
	    .append( "<a>" + item.brandname +"	: <b class='font-18 theme-color text-capitalize'>"+ item.categoryname + "</b></a>" )
	    .appendTo( ul );
  	};