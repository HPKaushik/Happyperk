<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Pekeepa API Encryption Class
 */

class Imageupload {

    function upload_file($param = null) {

        $CI = & get_instance();

        $config['upload_path'] = './assets/uploads/';

        $config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|jpeg|pdf|doc|docx';

        $config['max_size'] = 1024 * 90;

        // $config['image_resize'] = FALSE;
        $config['image_resize'] = '';

        $config['resize_width'] = 200;

        $config['resize_height'] = 200;

        if ($param) {

            $config = $param + $config;
        }
        // prx($config);
        $CI->load->library('upload');

        $CI->upload->initialize($config);

        if (!empty($config['file_name']))
            $file_Status = $CI->upload->do_upload($config['file_name']);
        else
            $file_Status = $CI->upload->do_upload();

        if (!$file_Status) {

            return array('STATUS' => FALSE, 'FILE_ERROR' => $CI->upload->display_errors());
        } else {

            $uplaod_data = $CI->upload->data();

            // if(empty($param['resize_width'])&&empty($param['resize_height'])){
            //      // $original_height = $uplaod_data['image_height']; 
            //      // $original_width =  $uplaod_data['image_width']; 
            //         $config['resize_width']=175; 
            //         $config['resize_height']=150;
            //  } 

            $upload_file = explode('.', $uplaod_data['file_name']);

            if ($config['image_resize'] && in_array($upload_file[1], array('gif', 'jpeg', 'jpg', 'png', 'bmp', 'jpe'))) {

                $param2 = array(
                    'source_image' => $config['source_image'] . $uplaod_data['file_name'],
                    'new_image' => $config['new_image'] . $uplaod_data['file_name'],
                    'create_thumb' => FALSE,
                    'maintain_ratio' => TRUE,
                    'width' => $config['resize_width'],
                    'height' => $config['resize_height'],
                );

                image_resize($param2);
            }

            if (empty($config['image_resize']) && in_array($upload_file[1], array('gif', 'jpeg', 'jpg', 'png', 'bmp', 'jpe'))) {

                $param3 = array(
                    'file_name' => $uplaod_data['file_name'],
                    // 'source_image' => $config['source_image'] . $uplaod_data['file_name'],
                    // 'new_image' => $config['new_image'] . $uplaod_data['file_name'],
                    'maintain_ratio' => 0,
                    'width' => $config['resize_width'],
                    'height' => $config['resize_height'],);

                create_frontend_thumbnail($param3);
            }

            return array('STATUS' => TRUE, 'UPLOAD_DATA' => $uplaod_data);
        }
    }

    function image_resize($param = null) {

        $CI = & get_instance();

        $CI->load->library('image_lib');

        $CI->image_lib->clear();

        $config['image_library'] = 'gd2';

        $config['source_image'] = './assets/uploads/';

        $config['new_image'] = './assets/uploads/';

        $config['create_thumb'] = FALSE;

        $config['maintain_ratio'] = FALSE;

        $config['width'] = 150;

        $config['height'] = 150;

        if ($param) {

            $config = $param + $config;
        }

        $CI->image_lib->initialize($config);

        if (!$CI->image_lib->resize()) {

            //return array('STATUS'=>TRUE,'MESSAGE'=>$CI->image_lib->display_errors());

            die($CI->image_lib->display_errors());
        } else {

            return array('STATUS' => TRUE, 'MESSAGE' => 'Image resized.');
        }
    }

}
?>