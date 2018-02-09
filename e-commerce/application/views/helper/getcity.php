<option value=""> Select City </option>
<?php
if (!empty($cityin)) {
    foreach ($cityin as $city) {?>
        <option value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
        <?php
    }
}
?>