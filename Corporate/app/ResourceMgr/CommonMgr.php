<?php

namespace App\ResourceMgr;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CommonMgr {

    public function uploadSingleImage($request, $model, $field_name) {
        $file = $request->file($field_name);
        $name = 'annoumnts' . md5(trim(date('d m y h:i:s'))) . $file->getClientOriginalName();
        $model->$field_name = $name;
        Storage::disk('local')->put('public/' . $name, File::get($file));
        return TRUE;
    }
     public function deleteImages($request, $model, $images_array) {
        $delete_images = array('delete_image1', 'delete_image2', 'delete_image3');
        foreach ($delete_images as $key => $d) {
            if (isset($request->$d)) {
                $f_name = $images_array[$key];
                Storage::disk('local')->delete('public/' . $model->$f_name);
                $model->$f_name = '';
            }
        }
    }
    public function getAllBadges() {
        $resp = DB::table(hp_tbl_badges)->orderBy('title','asc')->get();
        return $resp;
    }

}
