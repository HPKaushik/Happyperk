<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class uploadfile {

    var $CI;

    public function __construct($params = array()) {
        $this->CI = & get_instance();
        $this->CI->load->library('image_lib');
        $this->CI->load->helper('url');
        $this->CI->load->database();
    }

    public function do_upload($filename = '', $config = array()) {
        // prx($config);   
        $this->CI->load->library('upload', $config);

        if ($this->CI->upload->do_upload($filename)) {
            $data = array('upload_data' => array(
                'filename'=>$config['file_name']));
            // $configParamForCompress = array(
            //     // 'image_library' => 'gd2',
            //     'source_image' => $config['upload_path'] . $filename,
            //     // 'create_thumb' => TRUE,
            //     // 'maintain_ratio' => TRUE,
            //     'quality' => '60%',
            //     'width' => 200,
            //     'height' => 200,
            //     'new_image' => $config['upload_path'] . '/resized' . $filename,
            // );
            // $this->compressImage($configParamForCompress);
        } else {
            $data = array('error' => $this->CI->upload->display_errors());
        }
        return $data;
    }

    public function compressImage($configParam = array()) {
        $this->CI->image_lib->initialize($configParam);
        if (!$this->CI->image_lib->resize()) {
            echo $this->CI->image_lib->display_errors();
        }
        $this->CI->image_lib->clear();
    }

}
