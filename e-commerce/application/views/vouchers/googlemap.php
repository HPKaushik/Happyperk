<style type="text/css">
#map {
height: 600px;
}
#store_location{
max-height: 845px;
overflow: auto;
height: 845px;
}

#store_location ul{
margin-left: -45px;
}
#store_location ul li {
border-left: 2px #653bc7 solid;
padding: 9px;
margin: 5px;
}
li.active {
background-color: #e4e4e4;
}
</style>
<!-- Reedem Location Picker  -->
<div class="modal fade"  id="RedeemlocationModal" role="dialog" style="display: none;">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content" style="max-height: 700px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
                <h4 class="modal-title text-center pull-left">Redeem Location</h4>
            </div>
            <div class="modal-body">
                   <div class="row">
                    <div class="col-md-9">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-3">
                    <div id="store_location">
                        <input name="search" id="txtSearch" class="form-control" placeholder="Search location">
                        <br><span id="no_of_location"></span>&nbsp;&nbsp;<b>Redemption locations</b><br><ul></ul></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Reedem Location Picker End -->
<script type="text/javascript">
     $('.open-dynamic-modal').click(function(){
        $('#OpenContentModal .modal-header h4').text('');
        $('#OpenContentModal .modal-body').text('');
        var cls =$(this).data('cls'); // class name
        // $("#OpenContentModal").on("shown.bs.modal", function () {
            var parent = $(this).parent().parent();
            var content = parent.find('.dynamic-modal-'+cls+' div').html();
            var header =  parent.find('.dynamic-modal-'+cls+' h4').contents().not($("dynamic-modal-"+cls).children()).text();
            header = header.replace('keyboard_arrow_right','');
            $('#OpenContentModal .modal-header h4').text(header);
            $('#OpenContentModal .modal-body').html(content);
        // });
    });
</script>
<?php if (is_model_loaded('brands_redeem_location_model')) { ?>
<!-- scripts for Map , Reeedem Location  -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7hUciRXtAEOC89fa5V5dX5UURppGTb4c&callback=initMap"
    async defer>
    </script>
<script>
    var map;
    var center;
    var marker;
        function initMap() {
            var list='';
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 12.903513010243165, lng: 77.58419394493103},
                zoom: 8
            });
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap'
            };
            // Display multiple markers on a map
            var infoWindow = new google.maps.InfoWindow(), marker, i;

            // Loop through our array of markers & place each one on the map
            var i = 0;
               <?php if (isset($voucher)) {
               $brandsloc = $this->brands_redeem_location_model->getResult('*', array('brand_id' => $voucher->brandid));
            foreach ($brandsloc as $inf) {
            ?>
                   // Multiple Markers
                var markers = [
                    ['<?php echo $inf->address; ?>', <?php echo $inf->latitude; ?>, <?php echo $inf->longitude; ?>]
                ];
                var position = new google.maps.LatLng(<?php echo $inf->latitude; ?>, <?php echo $inf->longitude; ?>);
                bounds.extend(position);
                
                marker = new google.maps.Marker({
                position: position,
                map: map,
                title: '<?php echo $inf->address; ?>'
                }); 


                // Allow each marker to have an info window
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                    }
                })(marker, i)); 

                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
                                  list +=  '<li><span><a href="javascript:void(0)" class="click_loc" data-lat="<?php echo $inf->latitude; ?>" data-long="<?php echo $inf->longitude; ?>"><?php echo $inf->address; ?></a></span></li>';
                    i++;
            <?php } ?>
              $('#no_of_location').html('<b><?php echo count($brandsloc); ?></b>');
              $('#store_location ul').html(list);
        <?php } ?>
        $('.click_loc').click(function () {
                initMap();
                $('.click_loc').removeClass('active');
                $('#store_location ul li').removeClass('active');
                $(this).parent().parent('li').addClass('active');
                var location_val = $(this).html();
                // init as new markrer 
                marker = new google.maps.Marker({
                    position:  new google.maps.LatLng($(this).data('lat'),$(this).data('long')),
                    map: map,
                    title: location_val,
                    icon: 'http://www.googlemapsmarkers.com/v1/009900/'
                }); 
                // Add animation 
                marker.setAnimation(google.maps.Animation.BOUNCE);
            });
        }

        $("#RedeemlocationModal ").on("shown.bs.modal", function () {
            initMap();
        });
        jQuery.expr[':'].contains = function(a, i, m) {
             return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };
        $('#txtSearch').keyup(function(){ 
            $('#store_location ul li').hide();
            $('#store_location ul li:contains('+$(this).val()+')').show();
        });
        function goBack() {
            window.history.back();
        }

        $(window).load(function () {
            // Animate loader off screen
            $("#loading_page").fadeOut("slow");
            ;
        });
</script>
<?php  } ?>