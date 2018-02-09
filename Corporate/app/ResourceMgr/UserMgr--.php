<?php

namespace App\ResourceMgr;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use App\Lib\HpStdResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserMgr {

    public function getUserList() {
        $users = DB::table(hp_tbl_users.' AS u')
//                ->join(hp_tbl_role_user.' AS ur','ur.user_id','u.id')
//                ->join(hp_tbl_roles.' AS r','r.id','ur.role_id')
                ->paginate(10);
        return $users;
    }

    public function StoreUser($request) {
        try {
            $resp = null;
            $input = $request->input();
            $validation = $this->validateForInsert($input, hp_tbl_users);
            if ($validation !== TRUE) { //check validation
                return $validation;
            }
            $input['password'] = Hash::make($input['password']); //encrypt input password
            if ($user = User::create($input)) {
                $user->attachRole($request->input('role')); // attach role
                $resp = HPStdResponse::InsertSuccess($user->id);
            } else {
                $resp = HPStdResponse::InsertFailed(hp_tbl_users);
            }
            return $resp; //return response
        } catch (Exception $ex) {
            return HpStdResponse::InsertError(hp_tbl_users, $ex);
        } catch (\Illuminate\Database\QueryException $qe) {
            return HPStdResponse::InsertError(hp_tbl_users, $qe);
        }
        return false;
    }
    public function validateForInsert($Input) {
        $validator = Validator::make($Input, [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|same:confirm-password',
                    'role' => 'required'
        ]);
        if ($validator->fails()) {
            return HPStdResponse::ValidationFailed("users", $validator);
        }
        return TRUE;
    }

}
