<?php

namespace App\ResourceMgr;
use Illuminate\Http\Request;
use App\Lib\HpStdResponse;
use Illuminate\Support\Facades\DB;
//use App\Lib\hp_utils;
//use Illuminate\Support\Facades\Validator;

class VendorMgr {

    public function getAllVendors() {
        $vendors = DB::table(hp_tbl_vendors)->paginate(1);
        return $vendors;
    }
//public function getAll()
//{
//    $users = DB::table('users')->get();
//    
//	return $users;
//	# code...
//}
}