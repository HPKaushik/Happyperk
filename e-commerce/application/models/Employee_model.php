<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends Front_Model {

    public $upload_path;

    function __construct() {
        parent::__construct();
        $this->table = EMPLOYEE_TABLE;
        $this->primary_key = EMPLOYEE_TABLE . '.employee_id';
        $this->upload_path = realpath(APPPATH . '../uploads/EmployeeExcel');
    }

    public function getEmployee($user_id = NULL, $select = NULL, $employee_id = NULL, $email = NULL, $where = NULL) {
        if (empty($select) || $select == NULL)
            $query = '*,' . USER_TABLE . '.*';
        else
            $query = $select . ',' . USER_TABLE . '.*';
        $this->db->select($query);
        $this->db->order_by(USER_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE . ' as e');
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = e.user_id');
        $this->db->join(CORPORATE_TABLE, CORPORATE_TABLE . '.corporate_id = e.corporate_id', 'left');
        $this->db->where('e.user_id', $user_id);
        if (!empty($employee_id) || $employee_id != NULL)
            $this->db->or_where(EMPLOYEE_TABLE . '.employee_id', $employee_id);
        if (!empty($user_id) || $user_id != '') {
            $this->db->where('e.user_id', $user_id);
        }
        if (!empty($email) || $email != '') {
            $this->db->where(USER_TABLE . '.email', $email);
        }
        if (!empty($where) || $where != '') {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Function: getEmployee_array 
     * @author Kaushik
     * @param int $user_id Pass user id
     * @return array for one record only
     * Date 7-11-2017
     */
    public function getEmployee_array($user_id = NULL, $select = NULL, $employee_id = NULL, $email = NULL) {
        if (empty($select) || $select == '') {
            $query = EMPLOYEE_TABLE . '.*,';
        } else {
            $query = $select . ',' . USER_TABLE . '.email,' . USER_TABLE . '.phone, ' . DEPARTMENT_TABLE . '.department_name, ' . CORPORATE_TABLE . '.company_name';
        }
        $this->db->select($query);
        $this->db->order_by(USER_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE . ' as e');
        $this->db->join(DEPARTMENT_TABLE, DEPARTMENT_TABLE . '.id = e.department_id', 'left');
        $this->db->join(CORPORATE_TABLE, CORPORATE_TABLE . '.corporate_id = e.corporate_id', 'left');
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = e.user_id', 'left');
        if (!empty($employee_id) || $employee_id != '') {
            $this->db->where('e.employee_id', $employee_id);
        }
        if (!empty($user_id) || $user_id != '') {
            $this->db->where('e.user_id', $user_id);
        }
        if (!empty($email) || $email != '') {
            $this->db->where(USER_TABLE . '.email', $email);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAllEmployee($corporate_id = '', $user_id = '') {
        $query = '*,' . USER_TABLE . '.*';
        $this->db->select($query);
        $this->db->order_by(EMPLOYEE_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
        if ($corporate_id != '') {
            $this->db->where(EMPLOYEE_TABLE . '.corporate_id', $corporate_id);
        }
        if ($user_id != '') {
            $this->db->where(EMPLOYEE_TABLE . '.user_id', $user_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     *  This function will be called for get Employee Other than user_id
     */

    public function getOtherEmployee($corporate_id = '', $user_id = '') {
        $query = '*,' . USER_TABLE . '.*';
        $this->db->select($query);
        $this->db->order_by(EMPLOYEE_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
        if ($corporate_id != '') {
            $this->db->where(EMPLOYEE_TABLE . '.corporate_id', $corporate_id);
        }
        if ($user_id != '') {
            $this->db->where(EMPLOYEE_TABLE . '.user_id', $user_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getEmployeesByCorporateId($corporate_id = '', $employee_id, $selects = '*,' . USER_TABLE . '.*') {
        $this->db->select($selects);
        $this->db->order_by(EMPLOYEE_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
        if ($corporate_id != '') {
            $this->db->where(EMPLOYEE_TABLE . '.corporate_id', $corporate_id);
        }
        if ($employee_id != '') {
            $this->db->where(EMPLOYEE_TABLE . '.employee_id', $employee_id);
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllEmployeeBySerach($corporate_id = '', $search = '', $filters = '', $start_with = '') {
        $query = 'usr.*';
        $query .= ', emp.*';
        $this->db->select($query);
        $this->db->from(EMPLOYEE_TABLE . ' as emp ,' . USER_TABLE . ' as usr');
        $this->db->where('emp.user_id = usr.user_id');
        //$this->db->join(USER_TABLE, 'usr.user_id = emp.user_id');
        $this->db->order_by('emp.user_id', 'DESC');


        if ($corporate_id != '') {
            $this->db->where('emp.corporate_id', $corporate_id);
        }
        if (!empty($search)) {
            $this->db->where("(emp_code LIKE '%" . $search . "%' OR concat(first_name,' ',last_name) LIKE '%" . $search . "%')");
        }
        if (!empty($start_with)) {
            $this->db->where('concat(first_name," ",last_name) LIKE \'' . $start_with . '%\'');
        }
        if (!empty($filters)) {

            if (!empty($filters['designations'])) {
                $this->db->join(EMP_CONFIG_DESIGNATION, 'emp.designation_id = ' . EMP_CONFIG_DESIGNATION . '.id', 'left');
                $this->db->where_in('emp.designation_id', $filters['designations']);
            }

            if (!empty($filters['locations'])) {
                $this->db->join(LOCATION_TABLE, 'emp.location_id = ' . LOCATION_TABLE . '.id', 'left');
                $this->db->where_in('emp.location_id', $filters['locations']);
            }

            if (!empty($filters['departments'])) {
                $this->db->join(DEPARTMENT_TABLE, 'emp.department_id = ' . DEPARTMENT_TABLE . '.id', 'left');
                $this->db->where_in('emp.department_id', $filters['departments']);
            }

            if (!empty($filters['status'])) {
                $this->db->where('emp.status', 0);
            } else {
                $this->db->where('emp.status', 1);
            }
        } else {
            //   $this->db->where('emp.status', 1);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function getEmployeeResult($corporate_id, $select, $serach_by, $q) {
        $this->db->where('corporate_id', $corporate_id);
        $this->db->select($select);
        $this->db->like($serach_by, $q);
        $query = $this->db->get(EMPLOYEE_TABLE);
        return $query->result();
    }

    function getEmployeeResultByNameorId($corporate_id, $select, $search) {
        $this->db->where('corporate_id', $corporate_id);
        $this->db->select($select);
        $this->db->where($search, null, false);
        $query = $this->db->get(EMPLOYEE_TABLE);
        return $query->result();
    }

    function get_auto_emp($corporate_id, $q, $user_id = null) {
        $query = '*,' . USER_TABLE . '.*';
        $this->db->like('first_name', $q, 'after');
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
        $this->db->where(EMPLOYEE_TABLE . '.corporate_id', $corporate_id);
        if (isset($user_id) && !empty($user_id)) {
            $this->db->where(EMPLOYEE_TABLE . '.user_id !=', $user_id);
        }
        $this->db->order_by(EMPLOYEE_TABLE . '.first_name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

//    public function getEmployeeProduct($user_id) {
//        $query = '*';
//        $this->db->select($query);
//        $this->db->from(EMPLOYEE_TABLE);
//        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
////        $this->db->join(CORPORATE_MARCHENT_TABLE, CORPORATE_MARCHENT_TABLE . '.marchent_id = ' . PRODUCT_TABLE . '.marchent_id','left');
//        $this->db->join(CORPORATE_MARCHENT_TABLE, CORPORATE_MARCHENT_TABLE . '.corporate_id = ' . EMPLOYEE_TABLE . '.corporate_id','left');
//        $this->db->where(EMPLOYEE_TABLE . '.user_id', $user_id);
//        $query = $this->db->get();
////        echo $this->db->last_query();die;
//        return $query->result();
//    }

    public function change_status_employee($corporate_id, $id, $data) {
        $this->db->where('corporate_id', $corporate_id);
        $this->db->where('user_id', $id);
        $this->db->update(EMPLOYEE_TABLE, $data);
        return true;
    }

    public function getAllSpocEmployee($corporate_id) {
        $query = USER_TABLE . '.email,' . USER_TABLE . '.user_id as employee_user_id,' . USER_TABLE . '.is_primary,' . EMPLOYEE_TABLE . '.emp_code,' . EMPLOYEE_TABLE . '.first_name,' . EMPLOYEE_TABLE . '.last_name,' . EMPLOYEE_TABLE . '.corporate_id,';
        $where = USER_TABLE . ".user_id=" . EMPLOYEE_TABLE . ".user_id";
        $this->db->select($query);
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->from(USER_TABLE);
        $this->db->where(EMPLOYEE_TABLE . '.corporate_id', $corporate_id);
        $this->db->where($where);
        $this->db->where(USER_TABLE . '.group_id', '3');
        $this->db->order_by(USER_TABLE . '.group_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

//SELECT hp_employee.*, hp_master_user.*
//FROM hp_employee, hp_master_user WHERE hp_employee.corporate_id = 185 AND hp_master_user.user_id = hp_employee.user_id ORDER BY hp_master_user.group_id ASC
}
