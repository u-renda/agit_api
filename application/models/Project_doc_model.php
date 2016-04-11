<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project_doc_model extends CI_Model {

    var $table = 'project_doc';
    var $table_id = 'id_project_doc';
    
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
        if (isset($param['id_project_doc']) == TRUE)
        {
            $where += array('id_project_doc' => $param['id_project_doc']);
        }
        if (isset($param['title']) == TRUE)
        {
            $where += array($this->table.'.title' => $param['title']);
        }
        
        $this->db->select('id_project_doc, '.$this->table.'.id_project, title, category,
						  '.$this->table.'.description, url, '.$this->table.'.created_date,
						  '.$this->table.'.updated_date, project.name as project_name');
        $this->db->from($this->table);
        $this->db->join('project', $this->table.'.id_project = project.id_project');
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
        if (isset($param['category']) == TRUE)
		{
			$where += array('category' => $param['category']);
		}
		
        $this->db->select('id_project_doc, id_project, title, category, description, url,
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
        if (isset($param['id_project']) == TRUE)
		{
			$where += array('id_project' => $param['id_project']);
		}
        if (isset($param['category']) == TRUE)
		{
			$where += array('category' => $param['category']);
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