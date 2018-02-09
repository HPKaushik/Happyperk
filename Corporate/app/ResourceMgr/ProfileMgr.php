<?php

namespace App\ResourceMgr;

use App\Models\Profile;
use App\Models\CorporateBankAccount;
use App\Models\CorporateLocations;
use App\Models\CorporateDepartments;
//use Illuminate\Http\Request;
use App\Lib\HpStdResponse;
use Illuminate\Support\Facades\DB;
use App\Lib\hp_utils;
use Illuminate\Support\Facades\Validator;

class ProfileMgr {

    public function getEditProfile($id) {
        $resp = DB::table(hp_tbl_corporates)->where('corporate_id', $id)->first();
        $resp->bank = DB::table(hp_tbl_corporate_bank_details)->where('corporate_id', $id)->first();
        return $resp;
    }

    public function getAllLocations() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_corporate_locations)->where('corporate_id', $corporate_id)->paginate(hp_page_count);
        return $resp;
    }

    public function getAllDepartments() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_corporate_departments)->where('corporate_id', $corporate_id)->paginate(hp_page_count);
        return $resp;
    }

    public function getAllTransactions() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_corporate_transactions)
                ->where('corporate_id', $corporate_id)
                ->where('transaction_type', 1)
                ->orderBy('created_at', 'desc')
//                        ->select('transaction_code', 'credit_amount', 'begin_balance', 'end_balance', 'hp_ct.status', 'hp_ct.created_at')
                ->paginate(hp_page_count);
        return $resp;
    }

    public function getAllDesignations() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $des = DB::table(hp_tbl_corp_designation_map.' AS cd')
                ->join(hp_tbl_designations.' AS d','cd.designation_id','d.id')
                ->where('cd.corporate_id', $corporate_id);
        $except = $des->pluck('designation_id');
        $resp = DB::table(hp_tbl_designations)->whereNotIn('id',$except)->where('status', 1)->get();
        $resp->company_designations = $des->select('d.*','cd.corporate_id')->get();
        return $resp;
    }

    public function updateProfile($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateForUpdate($input, hp_tbl_corporates); //ctrl b
            if ($validation !== TRUE) { //check validation
                return $validation;
            }
            DB::beginTransaction();
//            DB::enableQueryLog(); // enabling logs leads to print the executed queries
            $profile_model = Profile::find($corporate_id);
            $profile_model->fill($input);
            $profile_model->company_established = date('Y-m-d', strtotime($input['company_established']));
//            if ($request->hasFile('logo'))
//                $this->uploadImage($request, $hotel_model, 'logo');
            if (isset($input['account_number'])) {
                $this->updateBankDetails($corporate_id, $input); // add or update bank account details
            }
            if ($profile_model->save()) {
                DB::commit();
                $resp = HpStdResponse::UpdateSuccess($profile_model);
            } else {
                DB::rollback();
                $resp = HpStdResponse::UpdateFailed(hp_tbl_corporates);
            }
//            return DB::getQueryLog();  //print the executed queries
            return $resp; //return response
        } catch (Exception $ex) {
            DB::rollback();
            return HpStdResponse::UpdateError(hp_tbl_corporates, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollback();
            return HpStdResponse::UpdateError(hp_tbl_corporates, $qe);
        }
        return false;
    }

    public function validateForUpdate($Input) {
        $validator = Validator::make($Input, [
                    'company_name' => 'required',
                    'short_name' => 'required',
                    'company_established' => 'required',
                    'address' => 'required',
                    'domain' => 'required',
                    'pan_number' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("corporates", $validator);
        }
        return TRUE;
    }

    public function validateLocationInsert($Input) {
        $validator = Validator::make($Input, [
                    'location_name' => 'required',
                    'pincode' => 'required',
                    'email' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'primary_contact' => 'required',
                    'telephone' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("corporate_locations", $validator);
        }
        return TRUE;
    }

    public function updateBankDetails($corporate_id, $input) {
        $load_bank_details = DB::table(hp_tbl_corporate_bank_details)->where('corporate_id', $corporate_id)->first();
        if (count($load_bank_details) > 0) {
            $u_bank_model = CorporateBankAccount::find($load_bank_details->id);
            $u_bank_model->fill($input);
            $u_bank_model->update();
        } else {
            $c_bank_model = new CorporateBankAccount();
            $c_bank_model->fill($input);
            $c_bank_model->corporate_id = $corporate_id;
            $c_bank_model->save();
        }
    }

    public function storeLocations($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateLocationInsert($input, hp_tbl_corporate_locations);
            if ($validation !== TRUE)
                return $validation;

            DB::beginTransaction();
            $location_model = new CorporateLocations();
            $location_model->fill($input);
            $location_model->corporate_id = $corporate_id;
            if ($location_model->save()) {
                DB::commit();
                $resp = HpStdResponse::InsertSuccess($location_model->id);
            } else {
                DB::rollback();
                $resp = HpStdResponse::InsertSuccess(hp_tbl_corporate_locations);
            }
            return $resp;
        } catch (Exception $ex) {
            DB::rollback();
            return HpStdResponse::InsertError(hp_tbl_corporate_locations, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollback();
            return HPStdResponse::InsertError(hp_tbl_corporate_locations, $qe);
        }
        return false;
    }

    public function updateLocations($request, $id) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateLocationInsert($input, hp_tbl_corporate_locations);
            if ($validation !== TRUE)
                return $validation;

            DB::beginTransaction();
            $location_model = CorporateLocations::find($id);
            $location_model->fill($input);
//            $location_model->corporate_id = $corporate_id;
            if ($location_model->save()) {
                DB::commit();
                $resp = HpStdResponse::UpdateSuccess($location_model);
            } else {
                DB::rollback();
                $resp = HpStdResponse::UpdateFailed(hp_tbl_corporate_locations);
            }
            return $resp;
        } catch (Exception $ex) {
            DB::rollback();
            return HpStdResponse::UpdateError(hp_tbl_corporate_locations, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollback();
            return HPStdResponse::UpdateError(hp_tbl_corporate_locations, $qe);
        }
        return false;
    }

    public function storeDepartments($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateDepartments($input, hp_tbl_corporate_departments);
            if ($validation !== TRUE)
                return $validation;

//            DB::beginTransaction();
            $dep_model = new CorporateDepartments();
            $dep_model->fill($input);
            $dep_model->corporate_id = $corporate_id;
            if ($dep_model->save()) {
//                DB::commit();
                $resp = HpStdResponse::InsertSuccess($dep_model->id);
            } else {
//                DB::rollback();
                $resp = HpStdResponse::InsertSuccess(hp_tbl_corporate_departments);
            }
            return $resp;
        } catch (Exception $ex) {
//            DB::rollback();
            return HpStdResponse::InsertError(hp_tbl_corporate_departments, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
//            DB::rollback();
            return HPStdResponse::InsertError(hp_tbl_corporate_departments, $qe);
        }
        return false;
    }

    public function updateDepartments($request, $id) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateDepartments($input, hp_tbl_corporate_departments);
            if ($validation !== TRUE)
                return $validation;

            DB::beginTransaction();
            $dep_model = CorporateDepartments::find($id);
            $dep_model->fill($input);
            if ($dep_model->save()) {
                DB::commit();
                $resp = HpStdResponse::UpdateSuccess($dep_model);
            } else {
                DB::rollback();
                $resp = HpStdResponse::UpdateFailed(hp_tbl_corporate_departments);
            }
            return $resp;
        } catch (Exception $ex) {
            DB::rollback();
            return HpStdResponse::UpdateError(hp_tbl_corporate_departments, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollback();
            return HPStdResponse::UpdateError(hp_tbl_corporate_departments, $qe);
        }
        return false;
    }

    public function storeDesignations($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateDesignations($input, hp_tbl_corporates);
            if ($validation !== TRUE)
                return $validation;

//            DB::beginTransaction();
            $designations = $input['designations'];
            $desig_model = Profile::find($corporate_id);

//            $dep_model->fill($input);
            if ($desig_model->Designations()->sync($designations, false)) {
//                DB::commit();
                $resp = HpStdResponse::UpdateSuccess($desig_model);
            } else {
//                DB::rollback();
                $resp = HpStdResponse::UpdateFailed(hp_tbl_corporates);
            }
            return $resp;
        } catch (Exception $ex) {
//            DB::rollback();
            return HpStdResponse::UpdateError(hp_tbl_corporates, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
//            DB::rollback();
            return HPStdResponse::UpdateError(hp_tbl_corporates, $qe);
        }
        return false;
    }

    public function validateDesignations($Input) {
        $validator = Validator::make($Input, [
                    'designations' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("corporate_designations", $validator);
        }
        return TRUE;
    }

    public function validateDepartments($Input) {
        $validator = Validator::make($Input, [
                    'department_name' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("corporate_departments", $validator);
        }
        return TRUE;
    }

    public function companyActivityLog() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_acitivityLog)
                ->where('corporate_id', $corporate_id)
                ->orderBy('created_at', 'desc')
                ->paginate(hp_page_count);
        return $resp;
    }

}
