<?php

namespace App\Lib;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class hp_utils {

    public static function CollectionToArray_ForDropDown(\Illuminate\Support\Collection $col) {

        try {
            $aCol = [];

            foreach ($col as $k => $item) {
                $aCol[$item->id] = $item->name;
            }

            return $aCol;
        } catch (ErrorException $e) {
            
        } catch (Exception $e2) {
            
        }
        return [];
    }

    public static function getCurrentUserCorporateId() {
        if (Auth::check()) {
            $curr_user_id = Auth::user()->user_id;
            $get_corporate_id = DB::table(hp_tbl_employees)->where('user_id', $curr_user_id)->first();
            return $get_corporate_id->corporate_id;
        }
    }

    public static function getAllStates() {
        $states = DB::table(hp_tbl_states)->orderBy('state_name', 'asc')->pluck('state_name', 'state_id');
        return $states;
    }

    public static function getAllCities() {
        $cities = DB::table(hp_tbl_cities)->orderBy('city_name', 'asc')->pluck('city_name', 'city_id');
        return $cities;
    }

    public static function getActiveDepartments() {
        $corporate_id = self::getCurrentUserCorporateId();
        $deptmnts = DB::table(hp_tbl_corporate_departments)->where('corporate_id', $corporate_id)
                        ->where('status', 'active')->orderBy('department_name', 'asc')->pluck('department_name', 'id');
        return $deptmnts;
    }

    public static function getCompanyLocations() {
        $corporate_id = self::getCurrentUserCorporateId();
        $locations = DB::table(hp_tbl_corporate_locations)->where('corporate_id', $corporate_id)->orderBy('location_name', 'asc')->pluck('location_name', 'id');
        return $locations;
    }

    public static function getCorporateDesignations() {
        $corporate_id = self::getCurrentUserCorporateId();
        $resp = DB::table(hp_tbl_corp_designation_map)->where('corporate_id',$corporate_id)->pluck('designation_id');
        $design = DB::table(hp_tbl_designations)->whereIn('id',$resp)->pluck('name','id');
        return $design;
    }

}
