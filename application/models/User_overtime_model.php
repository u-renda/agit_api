<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_overtime_model extends CI_Model {

    var $table = 'user_overtime';
    var $table_id = 'id_user_overtime';
    
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
        if (isset($param['id_user_overtime']) == TRUE)
        {
            $where += array('id_user_overtime' => $param['id_user_overtime']);
        }
        
        $this->db->select('id_user_overtime, '.$this->table.'.id_project, '.$this->table.'.id_user,
						  '.$this->table.'.id_project_task, type, category,
						  '.$this->table.'.description, date, '.$this->table.'.status,
						  '.$this->table.'.created_date, '.$this->table.'.updated_date,
						  user.name as user_name, project.name as project_name,
						  project_task.name as project_task_name');
        $this->db->from($this->table);
        $this->db->join('user', $this->table.'.id_user = user.id_user');
        $this->db->join('project', $this->table.'.id_project = project.id_project');
        $this->db->join('project_task', $this->table.'.id_project_task = project_task.id_project_task');
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
        if (isset($param['id_project']) == TRUE)
		{
			$where += array('id_project' => $param['id_project']);
		}
        if (isset($param['type']) == TRUE)
		{
			$where += array('type' => $param['type']);
		}
        if (isset($param['category']) == TRUE)
		{
			$where += array('category' => $param['category']);
		}
        if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
		
        $this->db->select('id_user_overtime, id_project, id_user, id_project_task, type, category,
						  description, date, status, created_date, updated_date');
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
        if (isset($param['id_project']) == TRUE)
		{
			$where += array('id_project' => $param['id_project']);
		}
        if (isset($param['type']) == TRUE)
		{
			$where += array('type' => $param['type']);
		}
        if (isset($param['category']) == TRUE)
		{
			$where += array('category' => $param['category']);
		}
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