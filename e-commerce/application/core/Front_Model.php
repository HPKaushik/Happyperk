<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front_Model extends CI_Model {

    public $table;
    public $primary_key;

    function __construct() {
        parent::__construct();
    }

    function getCount($where) {
        $this->db->where($where);
        return $this->db->count_all_results($this->table);
    }

    function getfromurl($url_slug) {
        
    }

    /*     * *************************

     *

     * function to check if the exists

     * 

     * @param       email (assoc array)

     * @return      bool

     * 

     */

    public function isExists($data) {
        $select_query = $this->db->get_where($this->table, $data);
        if ($select_query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isRecordExist($data, $prkey) {
        $select_query = $this->db->where($data)->get($this->table);
        if ($select_query->num_rows() > 0) {
            $data = $select_query->row_array();
            return $data[$prkey];
        } else {
            return FALSE;
        }
    }

    /*     * **********************

     * 

     * Retrieves a single record

     * 

     * @param       primary key 

     * @return      records or false

     * 

     */

    public function getById($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return array();
    }

    public function getallRow() {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    function getsomeRow($where = array()) {
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    function getnotRows($table) {
        $this->db->where('user_group_id !=', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    /*     * **********************

     * 

     * get all (or) selected data from a table

     * 

     * @param       fields, where(assoc array) 

     * @return      records or false

     * 

     */

    public function getRow($select = '', $wdata = '', $join = array(), $order_by = '', $order = 'DESC', $limit = NULL, $offset = NULL) {
        if ($select != '') {
            $this->db->select($select);
        }
        if (!empty($join)) {
            foreach ($join as $table => $joinOn) {
                $this->db->join($table, $joinOn);
            }
        }
        if ($wdata != '') {
            $this->db->where($wdata);
        }
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($limit != '') {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getResult($select = '', $wdata = '', $limit = '', $offset = 0, $order_by = '', $order = 'DESC', $join = array(), $group_by = '', $group = 'DESC') {
        //echo $select, $wdata, $limit , $offset, $order_by , $order,$join ;die;
        if ($select != '') {
            $this->db->select($select);
        }
        if (!empty($join)) {
            foreach ($join as $table => $joinOn) {
                $this->db->join($table, $joinOn);
            }
        }
        if ($wdata != '') {
            $this->db->where($wdata);
        }
        if ($limit != '') {
            $this->db->limit($limit, $offset);
        }
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($group_by != '') {
            $this->db->group_by($group_by, $group);
        }
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {

            return $query->result();
        } else {
            return array();
        }
    }

    /*     * ********************

     *

     * inserts a record of data to the table

     * 

     * @param       data(assoc array)

     * @return      insert id or false

     * 

     * 

     */

    public function insert($data) {
        //print_r($data);die;
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function insert_batch($data) {
        //print_r($data);die;
        $this->db->insert_batch($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return FALSE;
        }
    }

    /*     * **********************

     *

     * updates records to the table

     * 

     * @param       updated data (assoc array), where(assoc array)

     * @return      bool

     * 

     */

    public function update($update_data, $where) {
        // print_r($where);die;
        // print_r('update : '.$update_data.'| where : '.$where.'   dfsa');die;
        $this->db->where($where);
        $query = $this->db->update($this->table, $update_data);
        // echo $this->db->last_query();exit;
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************

     * 

     * deletes a record from a table.

     * 

     * @param       primary key

     * @return      bool

     * 

     */

    public function deleteById($id) {
        $this->db->where($this->primary_key, $id);
        if ($this->db->delete($this->table)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteWhere($wdata) {
        $this->db->where($wdata);
        if ($this->db->delete($this->table)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function softDeleteById($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->update($this->table, array('is_deleted' => 1));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isApproved($ids, $val) {
        if (!is_array($ids)) {
            $ids = array($ids);
        }
        $this->db->where_in($this->primary_key, $ids);
        $this->db->set('is_approved', $val);
        $query = $this->db->update($this->table);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************

     *

     * deletes more than one record from table

     * 

     * @param       delete data (assoc array), where(assoc array)

     * @return      bool

     * 

     */

    public function deleteRow($where) {
        $this->db->where($where);
        $query = $this->db->delete($this->table);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************

     *

     * get pagination records from table

     * 

     * @param       limit       specifies the records per page

     * @param       offset      specifies the start of the record in next page

     * @param       where       specifies the condition (if any)

     * @return      array       list of records that satisfied the condition, total row count        

     * 

     */

    public function getPaginationRecords($select, $limit, $offset, $where, $order_by = '', $order = 'DESC', $join = array()) {
        $this->db->select($select);
        if (!empty($join)) {
            foreach ($join as $table => $joinOn) {
                $this->db->join($table, $joinOn);
            }
        }
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        $query = $this->db->get($this->table);
        //echo $this->db->last_query(); die;
        $ret['rows'] = $query->result();
        $this->db->where($where);
        $q = $this->db->select('COUNT(*) as count', FALSE)->from($this->table);
        if (!empty($join)) {
            foreach ($join as $table => $joinOn) {
                $this->db->join($table, $joinOn);
            }
        }
        $tmp = $q->get()->result();
        $ret['num_rows'] = $tmp[0]->count;
        //echo $this->db->last_query();
        return $ret;
    }

    // function sendMail($to, $subject = '', $uname = '', $msg = '') {
    //     //$msg = $this->load->view('email/confirm_mail',$email_data,true);
    //     // echo $to.':'.$subject.':'.$uname.':'.$msg; die;
    //     $config = array(
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'smtp.zoho.com',
    //         'smtp_port' => 465,
    //         'smtp_user' => 'kaushik.t@happyperks.com',
    //         'smtp_pass' => 'happyperks',
    //         'mailtype' => 'html',
    //         'charset' => 'iso-8859-1'
    //     );


    //     $this->load->library('email', $config);
    //     $this->email->set_newline("\r\n");
    //     $this->email->initialize($config);
    //     $this->email->from('kaushik.t@happyperks.com', 'Kaushik');
    //     $this->email->to($to);
    //     $this->email->subject($subject);
    //     $this->email->message($msg);
    //     $result = $this->email->send();
    //     print_r($this->email->print_debugger());
    //     //exit; 
    //     return $result;
    // }

}

//End of MY_Model.php