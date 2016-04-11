<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    var $table = 'user';
    var $table_id = 'id_user';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    function create($param)
    {
        $this->db->set($this->table_id, 'UUID_SHORT()', FALSE);
		$query = $this->db->insert($this->table, $param);
		return $query;
    }
    
    function delete($id)
    {
        $this->db->where($this->table_id, $id);
        $query = $this->db->delete($this->table);
        return $query;
    }
    
    function info($param)
    {
        $where = array();
        if (isset($param['id_user']) == TRUE)
        {
            $where += array('id_user' => $param['id_user']);
        }
        if (isset($param['name']) == TRUE)
        {
            $where += array($this->table.'.name' => $param['name']);
        }
        if (isset($param['username']) == TRUE)
        {
            $where += array('username' => $param['username']);
        }
        if (isset($param['email']) == TRUE)
        {
            $where += array('email' => $param['email']);
        }
        
        $this->db->select('id_user, '.$this->table.'.id_position, '.$this->table.'.id_company, email,
						  username, '.$this->table.'.name, role, nik, '.$this->table.'.status,
						  '.$this->table.'.created_date, '.$this->table.'.updated_date,
						  company.name as company_name, position.name as position_name');
        $this->db->from($this->table);
        $this->db->join('company', $this->table.'.id_company = company.id_company');
        $this->db->join('position', $this->table.'.id_position = position.id_position');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
        if (isset($param['id_company']) == TRUE)
		{
			$where += array('id_company' => $param['id_company']);
		}
        if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
        if (isset($param['role']) == TRUE)
		{
			$where += array('role' => $param['role']);
		}
		
        $this->db->select('id_user, id_position, id_company, email, username, name, role, nik,
						  status, created_date, updated_date');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by($param['order'], $param['sort']);
        $this->db->limit($param['limit'], $param['offset']);
        $query = $this->db->get();
        return $query;
    }
    
    function lists_count($param)
    {
        $where = array();
        if (isset($param['id_company']) == TRUE)
		{
			$where += array('id_company' => $param['id_company']);
		}
        if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
        if (isset($param['role']) == TRUE)
		{
			$where += array('role' => $param['role']);
		}
        
        $this->db->select($this->table_id);
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->count_all_results();
        return $query;
    }
    
    function update($id, $param)
    {
        $this->db->where($this->table_id, $id);
        $query = $this->db->update($this->table, $param);
        return $query;
    }
}