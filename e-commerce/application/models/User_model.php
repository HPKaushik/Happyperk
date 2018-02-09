<?php

class User_model extends Front_Model {

    function __construct() {
        date_default_timezone_set('Asia/Kolkata');
        $this->table = USER_TABLE;
        $this->primary_key = USER_TABLE . '.user_id';
    }

    public function check_loginForAdmin($wdata) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($wdata);
        $this->db->limit(1);
        $query = $this->db->get();
//        echo $this->db->last_query(); prx($query);
//        echo $query->num_rows();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check_loginForEmployee($wdata, $where_or = NULL) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($wdata);
        //$this->db->where('is_deleted != ' ,'1');
        if (isset($where_or))
            $this->db->where("( " . $where_or . " ) ");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check($wdata) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($wdata);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo($email = '', $pass = '', $group_id = '') {
        $query1 = USER_TABLE . '.*,' . EMPLOYEE_TABLE . '.*,';
        $this->db->select($query1);
        $where = EMPLOYEE_TABLE . ".user_id=" . USER_TABLE . ".user_id";
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->from(USER_TABLE);
        if ($email != '') {
            $this->db->where(USER_TABLE . '.email', $email);
        }
        if ($pass != '') {
            $this->db->where(USER_TABLE . '.password', $pass);
        }
        if ($group_id != '') {
            $this->db->where(USER_TABLE . '.group_id', $group_id);
        }
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }

    public function verifyCodeandDetails($vCode, $userId) {

        $this->db->from('hp_verifyUser')->where('vcode', $vCode)->where('user_id', $userId);
        $result = $this->db->get();
        if (count($result) > 0) {
            $updateVerify = $this->db->set('status', 'true')->where('vcode', $vCode)->where('user_id', $userId)->update('hp_verifyUser');
            $updateUser = $this->db->set('status', '1')->where('user_id', $userId)->update(USER_TABLE);

            return true;
        } else
            return false;
    }

    public function getUser($user_id) {
        if (isset($user_id)) {
            $user = $this->db->select('first_name,last_name')->where('user_id', $user_id)->get('hp_employee')->row_array();
            $username = $user['first_name'] . " " . $user['last_name'];
            return $username;
        }
        return FALSE;
    }

}

?>