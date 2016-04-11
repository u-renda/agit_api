<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_complaint_model extends CI_Model {

    var $table = 'user_complaint';
    var $table_id = 'id_user_complaint';
    
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
        if (isset($param['id_user_complaint']) == TRUE)
        {
            $where += array('id_user_complaint' => $param['id_user_complaint']);
        }
        
        $this->db->select('id_user_complaint, '.$this->table.'.id_user, id_complained,
						  '.$this->table.'.name, type, description,'.$this->table.'.created_date,
						  '.$this->table.'.updated_date, user.name as user_name');
        $this->db->from($this->table);
        $this->db->join('user', $this->table.'.id_user = user.id_user');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
        if (isset($param['id_user']) == TRUE)
		{
			$where += array('id_user' => $param['id_user']);
		}
        if (isset($param['id_complained']) == TRUE)
		{
			$where += array('id_complained' => $param['id_complained']);
		}
        if (isset($param['type']) == TRUE)
		{
			$where += array('type' => $param['type']);
		}
		
        $this->db->select('id_user_complaint, id_user, id_complained, name, type, description,
						  created_date, updated_date');
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
        if (isset($param['id_user']) == TRUE)
		{
			$where += array('id_user' => $param['id_user']);
		}
        if (isset($param['id_complained']) == TRUE)
		{
			$where += array('id_complained' => $param['id_complained']);
		}
        if (isset($param['type']) == TRUE)
		{
			$where += array('type' => $param['type']);
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