<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title) ? $title : 'Happyperks';  ?></title>
        <meta charset="utf-8">
        <meta name="title" content="<?php echo isset($meta_title) ? $meta_title : ''; ?>">
        <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ''; ?>">   
        <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ''; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('layouts/_inc/styles'); ?>
    </head>
    <body <?php echo isset($bodyclass) ? "class=".$bodyclass:'';?>>
	<div class="main-container"><?php echo isset($content)?$content:'';?>
	</div>
        <?php $this->load->view('layouts/_inc/scripts'); ?>
    </body>
</html>