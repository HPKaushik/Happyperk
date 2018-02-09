<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title) ? $title : ''; ?></title>
        <meta charset="utf-8">
        <meta name="title" content="<?php echo isset($meta_title) ? $meta_title : ''; ?>">
        <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ''; ?>">   
        <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ''; ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('layouts/_inc/styles'); ?>
    </head>
    <body class="<?php echo isset($bodyclass) ? $bodyclass : ''; ?>">
        <div class="main-container">
            <?php $this->load->view('layouts/_inc/header'); ?>	
            <?php echo isset($content) ? $content : ''; ?>
            <?php $this->load->view('layouts/_inc/footer'); ?>	
        </div>
        <?php $this->load->view('layouts/_inc/scripts'); ?>
    </body>
</html>