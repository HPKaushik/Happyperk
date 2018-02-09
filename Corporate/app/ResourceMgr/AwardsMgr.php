<?php

namespace App\ResourceMgr;

use Illuminate\Support\Facades\DB;
use App\Lib\hp_utils;
use App\Models\Awards;
use Illuminate\Support\Facades\Validator;
use App\Lib\HpStdResponse;
use Illuminate\Support\Facades\Auth;

class AwardsMgr {

    public function getAllAwards() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_awards . ' AS a')
                ->leftjoin(hp_tbl_employees . ' AS e', 'e.user_id', 'a.user_id')
                ->where('a.corporate_id', $corporate_id)
                ->orderBy('a.created_at', 'desc')
                ->select('a.title', 'a.id', 'a.description', 'a.status', 'a.created_at', 'e.first_name', 'e.last_name')
                ->paginate(hp_page_count);
        return $resp;
    }

    public function getAwardEdit($request, $id) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_awards)->where('corporate_id', $corporate_id)->where('id', $id)->first();
        return $resp;
    }

    public function getActiveEmployees($request, $emp_id) {

        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_employees . ' AS e')
                        ->leftJoin(hp_tbl_corporate_departments . ' AS d', 'e.department_id', 'd.id')
                        ->select('e.*', 'd.department_name')
                        ->where(function ($query) use($request, $emp_id) {
                            if (!empty($request->emp_code)) {
                                $query->orWhere('e.emp_code', $request->emp_code);
                            }
                            if (!empty($request->emp_name)) {
                                $query->orWhere('e.first_name', 'LIKE', '%'.$request->emp_name.'%');
                                $query->orWhere('e.last_name', 'LIKE', '%'.$request->emp_name.'%');
                            }
                            if (!empty($request->emp_dep)) {
                                $query->orWhere('e.department_id', $request->emp_dep);
                            }
                            if (!empty($emp_id)) {
                                $query->Where('e.employee_id', $emp_id);
                            }
                        })
                        ->where('e.corporate_id', $corporate_id)->where('e.status', 1)->paginate(hp_page_count);
        return $resp;
    }

    public function store($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateAwards($input, hp_tbl_awards);
            if ($validation !== TRUE)
                return $validation;

            $award_model = new Awards();
            $award_model->fill($input);
            $award_model->corporate_id = $corporate_id;
            $award_model->user_id = Auth::user()->user_id;
            $award_model->badge_id = $input['badge'];
//            if ($request->hasfile('image')) {
//                $image_upload = new CommonMgr();
//                $image_upload->uploadSingleImage($request, $announce_model, 'image');
//            }
            if ($award_model->save()) {
                $resp = HpStdResponse::InsertSuccess($award_model->id);
            } else {
                $resp = HpStdResponse::InsertFailed(hp_tbl_awards);
            }
            return $resp;
        } catch (Exception $ex) {
            return HpStdResponse::InsertError(hp_tbl_awards, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            return HPStdResponse::InsertError(hp_tbl_awards, $qe);
        }
        return false;
    }

    public function update($request,$id) {
        try {
            $resp = null;
            $input = $request->input();
//            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateAwards($input, hp_tbl_awards);
            if ($validation !== TRUE)
                return $validation;

            $award_model = Awards::find($id);
            $award_model->fill($input);
//            $award_model->corporate_id = $corporate_id;
//            $award_model->user_id = Auth::user()->user_id;
            $award_model->badge_id = $input['badge'];
//            if ($request->hasfile('image')) {
//                $image_upload = new CommonMgr();
//                $image_upload->uploadSingleImage($request, $announce_model, 'image');
//            }
            if ($award_model->save()) {
                $resp = HpStdResponse::UpdateSuccess($award_model);
            } else {
                $resp = HpStdResponse::UpdateFailed(hp_tbl_awards);
            }
            return $resp;
        } catch (Exception $ex) {
            return HpStdResponse::UpdateError(hp_tbl_awards, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            return HPStdResponse::UpdateError(hp_tbl_awards, $qe);
        }
        return false;
    }

    public function validateAwards($Input) {
        $validator = Validator::make($Input, [
                    'employee' => 'required',
                    'badge' => 'required',
                    'title' => 'required',
                    'description' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("awards", $validator);
        }
        return TRUE;
    }

}
