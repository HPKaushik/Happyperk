<?php header('Access-Control-Allow-Origin: *');?>
<script src="<?php echo JSURL ?>/jquery.min.js"></script>
<script src="<?php echo JSURL ?>/jquery-ui.min.js"></script>
<script src="<?php echo JSURL ?>/mui.js"></script>
<script src="<?php echo JSURL ?>/jquery.validate.js"></script>
<script src="<?php echo JSURL ?>/select2.full.js"></script>
<script src="<?php echo JSURL ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo JSURL ?>/dataTables.material.min.js"></script>
<script src="<?php echo JSURL ?>/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="<?php echo JSURL ?>/common.js"></script>

<?php echo (isset($_scripts)) ? $_scripts : ""; ?>

<!-- Location Picker start -->
<div id="LocationPickerModal" class="modal fade hp-available-locations" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
                <h4 class="modal-title text-center">Pick Your City</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <ul class="nav hp-locations-list">
                        <?php $selectedLocation = get_session_var('user_location');
                        if (isset($locations) && !empty($locations)) :
                            foreach ($locations as $location): ?>
                            <li>
                            <a class="<?php echo (!empty($selectedLocation) && $selectedLocation['id'] == $location->id) ? 'selected' : ''; ?>" href="<?php echo base_url() . 'change_location/' . $location->id; ?>">
                            <img src="<?php echo LARAVEL_IMAGE_PATH.$location->image; ?>" class="img-responsive"/>
                            <span><?php echo $location->name; ?></span>
                            </a>
                            </li>
                            <?php endforeach;?>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Location Picker  End -->
<?php if(isset($googlemap) && !empty($googlemap)) 
echo $googlemap; ?>

<script type="text/javascript">

</script>