<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project_user_model extends CI_Model {

    var $table = 'project_user';
    var $table_id = 'id_project_user';
    
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
        if (isset($param['id_project_user']) == TRUE)
        {
            $where += array('id_project_user' => $param['id_project_user']);
        }
        
        $this->db->select('id_project_user, '.$this->table.'.id_project, '.$this->table.'.id_user,
						  '.$this->table.'.id_job_role, '.$this->table.'.created_date,
						  '.$this->table.'.updated_date, project.name as project_name,
						  user.name as user_name, job_role.name as job_role_name');
        $this->db->from($this->table);
        $this->db->join('project', $this->table.'.id_project = project.id_project');
        $this->db->join('job_role', $this->table.'.id_job_role= job_role.id_job_role');
        $this->db->join('user', $this->table.'.id_user = user.id_user');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
		if (isset($param['id_project']) == TRUE)
		{
			$where += array('id_project' => $param['id_project']);
		}
		if (isset($param['id_user']) == TRUE)
		{
			$where += array('id_user' => $param['id_user']);
		}
		if (isset($param['group_by']) == TRUE)
		{
			$this->db->group_by($param['group_by']);
		}
		
        $this->db->select('id_project_user, id_project, id_user, id_job_role, created_date,
						  updated_date');
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
		if (isset($param['id_project']) == TRUE)
		{
			$where += array('id_project' => $param['id_project']);
		}
		if (isset($param['id_user']) == TRUE)
		{
			$where += array('id_user' => $param['id_user']);
		}
		if (isset($param['group_by']) == TRUE)
		{
			$this->db->group_by($param['group_by']);
		}
        
        $this->db->select($this->table_id);
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->count_all_results();
        return $query;
    }
}