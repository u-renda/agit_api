<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    var $table = 'project';
    var $table_id = 'id_project';
    
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
        if (isset($param['id_project']) == TRUE)
        {
            $where += array('id_project' => $param['id_project']);
        }
        if (isset($param['name']) == TRUE)
        {
            $where += array($this->table.'.name' => $param['name']);
        }
        
        $this->db->select('id_project, '.$this->table.'.id_company, '.$this->table.'.id_project_type,
						  '.$this->table.'.name, requirement, '.$this->table.'.description, division,
						  department, '.$this->table.'.status, start_date, end_date, finished_date,
						  '.$this->table.'.created_date, '.$this->table.'.updated_date,
						  company.name as company_name, project_type.name as project_type_name');
        $this->db->from($this->table);
        $this->db->join('company', $this->table.'.id_company = company.id_company');
        $this->db->join('project_type', $this->table.'.id_project_type = project_type.id_project_type');
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
        if (isset($param['id_project_type']) == TRUE)
		{
			$where += array('id_project_type' => $param['id_project_type']);
		}
        if (isset($param['status']) == TRUE)
		{
			$where += array('status' => $param['status']);
		}
		
        $this->db->select('id_project, id_company, id_project_type, name, requirement, description,
						  division, department, status, start_date, end_date, finished_date,
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
        if (isset($param['id_company']) == TRUE)
		{
			$where += array('id_company' => $param['id_company']);
		}
        if (isset($param['id_project_type']) == TRUE)
		{
			$where += array('id_project_type' => $param['id_project_type']);
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