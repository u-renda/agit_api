<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_project_group_model extends CI_Model {

    var $table = 'user_project_group';
    var $table_id = 'id_user_project_group';
    
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
        if (isset($param['id_user_project_group']) == TRUE)
        {
            $where += array('id_user_project_group' => $param['id_user_project_group']);
        }
        
        $this->db->select('id_user_project_group, '.$this->table.'.id_job_analyst,
						  '.$this->table.'.name, '.$this->table.'.description,
						  '.$this->table.'.status, '.$this->table.'.created_date,
						  '.$this->table.'.updated_date, job_analyst.name as job_analyst_name');
        $this->db->from($this->table);
        $this->db->join('job_analyst', $this->table.'.id_job_analyst = job_analyst.id_job_analyst');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
		if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
		
        $this->db->select('id_user_project_group, id_job_analyst, name, description, status,
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
		if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
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