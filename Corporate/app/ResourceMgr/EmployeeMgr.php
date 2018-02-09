<?php

namespace App\ResourceMgr;

use App\Lib\hp_utils;
use Illuminate\Support\Facades\DB;
use App\Lib\HpStdResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Employee;

class EmployeeMgr {

    public function getAllEmployees($request) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_employees . ' AS e')
                        ->leftJoin(hp_tbl_corporate_departments . ' AS d', 'e.department_id', 'd.id')
                        ->select('e.*', 'd.department_name')
                        ->where(function ($query) use($request) {
                            if (!empty($request->emp_code)) {
                                $query->orWhere('e.emp_code', $request->emp_code);
                            }
                            if (!empty($request->emp_name)) {
                                $query->orWhere('e.first_name', 'LIKE', '%' . $request->emp_name . '%');
                                $query->orWhere('e.last_name', 'LIKE', '%' . $request->emp_name . '%');
                            }
                            if (!empty($request->emp_dep)) {
                                $query->orWhere('e.department_id', $request->emp_dep);
                            }
                        })
                        ->where('e.corporate_id', $corporate_id)->where('e.status', 1)->paginate(hp_page_count);
        return $resp;
    }

    public function getEmployeeUserId($id) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_employees)->where('employee_id', $id)->where('corporate_id', $corporate_id)->first();
        return $resp->user_id;
    }

    public function getAllEmployeeTransfers() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_corporate_transactions . ' AS t')
                ->leftjoin(hp_tbl_employees . ' AS e', 'e.employee_id', 't.employee_id')
                ->where('t.corporate_id', $corporate_id)
                ->where('t.transaction_type', 2)
                ->orderBy('t.created_at', 'desc')
                ->select('t.transaction_code', 'e.first_name', 'e.last_name', 't.credit_amount', 't.begin_balance', 't.end_balance', 't.status', 't.created_at', 'e.emp_code')
                ->paginate(hp_page_count);
        return $resp;
    }

    public function getEmployeeForEdit($id) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_employees . ' AS e')
                ->join(hp_tbl_users . ' AS u', 'e.user_id', 'u.user_id')
                ->where('e.corporate_id', $corporate_id)
                ->where('e.employee_id', $id)
                ->select('e.employee_id', 'u.email', 'u.phone', 'e.first_name', 'e.last_name', 'e.dob', 'e.emp_code', 'e.joining_date', 'e.department_id', 'e.location_id','e.designation_id')
                ->first();
        return $resp;
    }

    public function store($request) {
        try {
            $resp = null;
            $input = $request->input();
            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $validation = $this->validateForInsert($input, hp_tbl_employees);
            if ($validation !== TRUE)
                return $validation;

            DB::beginTransaction();
            $user_model = new User();
            $user_model->email = $input['email'];
            $user_model->phone = $input['phone'];
            $auth_pwd = $this->random_str(15);
            $user_model->password = bcrypt($auth_pwd);
            $user_model->group_id = 4;
            if ($user_model->save()) {
                $emp_model = new Employee();
                $emp_model->fill($input);
                $emp_model->user_id = $user_model->user_id;
                $emp_model->corporate_id = $corporate_id;
                $emp_model->emp_code = $input['employee_code'];
                $emp_model->location_id = $input['location'];
                $emp_model->department_id = $input['department'];
                $emp_model->designation_id = $input['designation'];
                if ($input['date_of_birth'])
                    $emp_model->dob = date('Y-m-d', strtotime($input['date_of_birth']));

                if ($emp_model->save()) {
                    DB::commit();
                    $resp = HpStdResponse::InsertSuccess($emp_model->id);
                } else {
                    DB::rollback();
                    $resp = HpStdResponse::InsertFailed(hp_tbl_employees);
                }
            } else {
                DB::rollback();
                $resp = HpStdResponse::InsertFailed(hp_tbl_users);
            }
            return $resp;
        } catch (Exception $ex) {
            DB::rollback();
            return HpStdResponse::InsertError(hp_tbl_users, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollback();
            return HPStdResponse::InsertError(hp_tbl_users, $qe);
        }
        return false;
    }

    public function update($request, $id) {
        try {
            $resp = null;
            $input = $request->input();
//            $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
            $user_id_ = $this->getEmployeeUserId($id);
            $validation = $this->validateForUpdate($input, $user_id_, hp_tbl_employees);
            if ($validation !== TRUE)
                return $validation;

            DB::beginTransaction();

            $user_model = User::find($user_id_);
            $user_model->email = $input['email'];
            $user_model->phone = $input['phone'];
//            $auth_pwd = $this->random_str(15);
//            $user_model->password = MD5($auth_pwd);
//            $user_model->group_id = 4;
            if ($user_model->save()) {
                $emp_model = Employee::find($id);
                $emp_model->fill($input);
//                $emp_model->user_id = $user_model->user_id;
//                $emp_model->corporate_id = $corporate_id;
                $emp_model->emp_code = $input['employee_code'];
                $emp_model->location_id = $input['location'];
                $emp_model->department_id = $input['department'];
                $emp_model->designation_id = $input['designation'];
                if ($input['date_of_birth'])
                    $emp_model->dob = date('Y-m-d', strtotime($input['date_of_birth']));

                if ($emp_model->save()) {
                    DB::commit();
                    $resp = HpStdResponse::UpdateSuccess($emp_model);
                } else {
                    DB::rollback();
                    $resp = HpStdResponse::UpdateFailed(hp_tbl_employees);
                }
            } else {
                DB::rollback();
                $resp = HpStdResponse::UpdateFailed(hp_tbl_users);
            }
            return $resp;
        } catch (Exception $ex) {
            DB::rollback();
            return HpStdResponse::UpdateError(hp_tbl_users, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollback();
            return HPStdResponse::UpdateError(hp_tbl_users, $qe);
        }
        return false;
    }

    public function validateForInsert($Input) {
        $validator = Validator::make($Input, [
                    'email' => 'required|email|unique:hp_master_user,email',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone' => 'required|unique:hp_master_user,phone',
                    'employee_code' => 'required',
                    'joining_date' => 'required',
                    'department' => 'required',
                    'designation' => 'required',
                    'location' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("employees", $validator);
        }
        return TRUE;
    }

    public function validateForUpdate($Input, $user_id) {
        $validator = Validator::make($Input, [
                    'email' => 'required|email|unique:hp_master_user,email,' . $user_id . ',user_id',
//                    'email' => 'required|email|unique:hp_master_user,email',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone' => 'required|unique:hp_master_user,phone,' . $user_id . ',user_id',
                    'employee_code' => 'required',
                    'joining_date' => 'required',
                    'department' => 'required',
                    'designation' => 'required',
                    'location' => 'required',
        ]);
        if ($validator->fails()) {
            return HpStdResponse::ValidationFailed("employees", $validator);
        }
        return TRUE;
    }

    public function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&**()') {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

}
