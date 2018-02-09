<?php

namespace App\ResourceMgr;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Lib\hp_utils;
use App\Models\Announcements;
use App\Lib\HpStdResponse;
use App\ResourceMgr\CommonMgr;
use Illuminate\Support\Facades\Validator;

class AnnouncementsMgr {

    public function getAllAnnouncements() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_announcements)
                ->where('corporate_id', $corporate_id)
                ->paginate(hp_page_count);
        return $resp;
    }

    public function getAnnouncementForEdit($id) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_announcements)->where('id', $id)->where('corporate_id', $corporate_id)->first();
        return $resp;
    }

    public function store($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateAnnouncements($input, hp_tbl_announcements);
            if ($validation !== TRUE)
                return $validation;

            $announce_model = new Announcements();
            $announce_model->fill($input);
            $announce_model->corporate_id = $corporate_id;
            $announce_model->user_id = Auth::user()->user_id;
            if ($request->hasfile('image')) {
                $image_upload = new CommonMgr();
                $image_upload->uploadSingleImage($request, $announce_model, 'image');
            }
            if ($announce_model->save()) {
                $announce_code = 'ANS' . str_pad($announce_model->id, 7, '0', STR_PAD_LEFT);

                if ($announce_model->update(['announcement_id' => $announce_code])) {
                    $resp = HpStdResponse::InsertSuccess($announce_model->id);
                }
            } else {
                $resp = HpStdResponse::InsertFailed(hp_tbl_announcements);
            }
            return $resp;
        } catch (Exception $ex) {
            return HpStdResponse::InsertError(hp_tbl_announcements, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            return HPStdResponse::InsertError(hp_tbl_announcements, $qe);
        }
        return false;
    }

    public function update($request, $id) {
        try {
            $resp = null;
            $input = $request->input();
            $image_upload = new CommonMgr();
//            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateAnnouncements($input, hp_tbl_announcements);
            if ($validation !== TRUE)
                return $validation;

            $announce_model = Announcements::find($id);
            $announce_model->fill($input);
            if ($request->hasfile('image')) {
                $image_upload->uploadSingleImage($request, $announce_model, 'image');
            }
            $image_upload->deleteImages($request, $announce_model, array('image'));

            if ($announce_model->save()) {
                $resp = HpStdResponse::UpdateSuccess($announce_model);
            } else {
                $resp = HpStdResponse::InsertFailed(hp_tbl_announcements);
            }
            return $resp;
        } catch (Exception $ex) {
            return HpStdResponse::UpdatetError(hp_tbl_announcements, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            return HPStdResponse::UpdateError(hp_tbl_announcements, $qe);
        }
        return false;
    }

    public function validateAnnouncements($Input) {
        $validator = Validator::make($Input, [
                    'name' => 'required',
                    'description' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("announcements", $validator);
        }
        return TRUE;
    }

}
