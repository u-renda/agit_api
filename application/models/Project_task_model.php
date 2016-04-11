<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project_task_model extends CI_Model {

    var $table = 'project_task';
    var $table_id = 'id_project_task';
    
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
        if (isset($param['id_project_task']) == TRUE)
        {
            $where += array('id_project_task' => $param['id_project_task']);
        }
        
        $this->db->select('id_project_task, '.$this->table.'.id_project, '.$this->table.'.id_user,
						  '.$this->table.'.name, '.$this->table.'.status, group_task,
						  '.$this->table.'.start_date, '.$this->table.'.end_date,
						  '.$this->table.'.finished_date, '.$this->table.'.created_date,
						  '.$this->table.'.updated_date, project.name as project_name,
						  user.name as user_name');
        $this->db->from($this->table);
        $this->db->join('project', $this->table.'.id_project = project.id_project');
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
        if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
        if (isset($param['group_task']) == TRUE)
		{
			$where += array('group_task' => $param['group_task']);
		}
		
        $this->db->select('id_project_task, id_project, id_user, name, status, group_task, start_date,
						  end_date, finished_date, created_date, updated_date');
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
        if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
        if (isset($param['group_task']) == TRUE)
		{
			$where += array('group_task' => $param['group_task']);
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