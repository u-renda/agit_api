<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Project extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('project_model', 'the_model');
    }
	
	function create_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id_company = filter($this->post('id_company'));
		$id_project_type = filter($this->post('id_project_type'));
		$name = filter(trim($this->post('name')));
		$requirement = filter(trim($this->post('requirement')));
		$description = filter(trim($this->post('description')));
		$division = filter(trim($this->post('division')));
		$department = filter(trim($this->post('department')));
		$status = filter(trim($this->post('status')));
		$start_date = filter(trim($this->post('start_date')));
		$end_date = filter(trim($this->post('end_date')));
		
		$data = array();
		if ($id_company == FALSE)
		{
			$data['id_company'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_project_type == FALSE)
		{
			$data['id_project_type'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($name == FALSE)
		{
			$data['name'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($division == FALSE)
		{
			$data['division'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($department == FALSE)
		{
			$data['department'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($start_date == FALSE)
		{
			$data['start_date'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($end_date == FALSE)
		{
			$data['end_date'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_project_name($name) == FALSE && $name == TRUE)
		{
			$data['name'] = 'already exist';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_date_format($start_date) == FALSE && $start_date == TRUE)
		{
			$data['start_date'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_date_format($end_date) == FALSE && $end_date == TRUE)
		{
			$data['end_date'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_project_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			if ($status == FALSE)
			{
				$status = 2;
			}
			
			$param = array();
			$param['id_company'] = $id_company;
			$param['id_project_type'] = $id_project_type;
			$param['name'] = $name;
			$param['requirement'] = $requirement;
			$param['description'] = $description;
			$param['division'] = $division;
			$param['department'] = $department;
			$param['status'] = $status;
			$param['start_date'] = $start_date;
			$param['end_date'] = $end_date;
			$param['finished_date'] = '0000-00-00';
			$param['created_date'] = date('Y-m-d H:i:s');
			$param['updated_date'] = date('Y-m-d H:i:s');
			$query = $this->the_model->create($param);
			
			if ($query > 0)
			{
				$data['create'] = 'success';
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['create'] = 'failed';
				$validation = 'error';
				$code = 400;
			}
		}
		
		$rv = array();
		$rv['message'] = $validation;
		$rv['code'] = $code;
		$rv['result'] = $data;
		$this->benchmark->mark('code_end');
		$rv['load'] = $this->benchmark->elapsed_time('code_start', 'code_end') . ' seconds';
		$this->response($rv, $code);
	}
	
	function delete_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
        $id = filter($this->post('id_project'));
        
		$data = array();
        if ($id == FALSE)
		{
			$data['id_project'] = 'required';
			$validation = "error";
			$code = 400;
		}
        
        if ($validation == "ok")
		{
            $query = $this->the_model->info(array('id_project' => $id));
			
			if ($query->num_rows() > 0)
			{
                $delete = $this->the_model->delete($id);
				
				if ($delete > 0)
				{
					$data['delete'] = 'success';
					$validation = "ok";
					$code = 200;
				}
				else
				{
					$data['delete'] = 'failed';
					$validation = "error";
					$code = 400;
				}
			}
			else
			{
				$data['id_project'] = 'not found';
				$validation = "error";
				$code = 400;
			}
		}
		
		$rv = array();
		$rv['message'] = $validation;
		$rv['code'] = $code;
		$rv['result'] = $data;
		$this->benchmark->mark('code_end');
		$rv['load'] = $this->benchmark->elapsed_time('code_start', 'code_end') . ' seconds';
		$this->response($rv, $code);
	}
	
	function info_get()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id = filter($this->get('id_project'));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			if ($id != '')
			{
				$param['id_project'] = $id;
			}
			
			$query = $this->the_model->info($param);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$data = array(
					'id_project' => $row->id_project,
					'name' => $row->name,
					'requirement' => $row->requirement,
					'description' => $row->description,
					'division' => $row->division,
					'department' => $row->department,
					'status' => intval($row->status),
					'start_date' => $row->start_date,
					'end_date' => $row->end_date,
					'finished_date' => $row->finished_date,
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date,
					'company' => array(
						'id_company' => $row->id_company,
						'name' => $row->company_name
					),
					'project_type' => array(
						'id_project_type' => $row->id_project_type,
						'name' => $row->project_type_name
					)
				);
				
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['id_project'] = 'not found';
				$validation = 'error';
				$code = 400;
			}
		}
		
		$rv = array();
		$rv['message'] = $validation;
		$rv['code'] = $code;
		$rv['result'] = $data;
		$this->benchmark->mark('code_end');
		$rv['load'] = $this->benchmark->elapsed_time('code_start', 'code_end') . ' seconds';
		$this->response($rv, $code);
	}
	
	function lists_get()
	{
		$this->benchmark->mark('code_start');
		
		$offset = filter(trim(intval($this->get('offset'))));
		$limit = filter(trim(intval($this->get('limit'))));
		$order = filter(trim(strtolower($this->get('order'))));
		$sort = filter(trim(strtolower($this->get('sort'))));
		$id_company = filter($this->get('id_company'));
		$id_project_type = filter($this->get('id_project_type'));
		$status = filter(trim($this->get('status')));
		
		if ($limit == TRUE && $limit < 20)
		{
			$limit = $limit;
		}
		elseif ($limit == TRUE && in_array($this->rest->key, $this->config->item('allow_api_key')))
		{
			$limit = $limit;
		}
		else
		{
			$limit = 20;
		}
		
		if ($offset == TRUE)
		{
			$offset = $offset;
		}
		else
		{
			$offset = 0;
		}
		
		if (in_array($order, $this->config->item('default_project_order')) && ($order == TRUE))
		{
			$order = $order;
		}
		else
		{
			$order = 'created_date';
		}
		
		if (in_array($sort, $this->config->item('default_sort')) && ($sort == TRUE))
		{
			$sort = $sort;
		}
		else
		{
			$sort = 'desc';
		}
		
		if (in_array($status, $this->config->item('default_project_status')) && ($status == TRUE))
		{
			$status = $status;
		}
		
		$param = array();
		$param2 = array();
		if ($id_company != '')
		{
			$param['id_company'] = $id_company;
			$param2['id_company'] = $id_company;
		}
		if ($id_project_type != '')
		{
			$param['id_project_type'] = $id_project_type;
			$param2['id_project_type'] = $id_project_type;
		}
		if ($status != '')
		{
			$param['status'] = $status;
			$param2['status'] = $status;
		}
		
		$param['limit'] = $limit;
		$param['offset'] = $offset;
		$param['order'] = $order;
		$param['sort'] = $sort;
		
		$query = $this->the_model->lists($param);
		$total = $this->the_model->lists_count($param2);
		
		$data = array();
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = array(
					'id_project' => $row->id_project,
					'id_company' => $row->id_company,
					'id_project_type' => $row->id_project_type,
					'name' => $row->name,
					'requirement' => $row->requirement,
					'description' => $row->description,
					'division' => $row->division,
					'department' => $row->department,
					'status' => intval($row->status),
					'start_date' => $row->start_date,
					'end_date' => $row->end_date,
					'finished_date' => $row->finished_date,
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date
				);
			}
		}

		$rv = array();
		$rv['message'] = 'ok';
		$rv['code'] = 200;
		$rv['limit'] = intval($limit);
		$rv['offset'] = intval($offset);
		$rv['total'] = intval($total);
		$rv['count'] = count($data);
		$rv['result'] = $data;
		$this->benchmark->mark('code_end');
		$rv['load'] = $this->benchmark->elapsed_time('code_start', 'code_end') . ' seconds';
		$this->response($rv, $rv['code']);
	}
	
	function update_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id = filter($this->post('id_project'));
		$name = filter(trim($this->post('name')));
		$requirement = filter(trim($this->post('requirement')));
		$description = filter(trim($this->post('description')));
		$division = filter(trim($this->post('division')));
		$department = filter(trim($this->post('department')));
		$status = filter(trim($this->post('status')));
		$end_date = filter(trim($this->post('end_date')));
		$finished_date = filter(trim($this->post('finished_date')));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_project_name($name) == FALSE && $name == TRUE)
		{
			$data['name'] = 'already exist';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_date_format($finished_date) == FALSE && $finished_date == TRUE)
		{
			$data['finished_date'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_date_format($end_date) == FALSE && $end_date == TRUE)
		{
			$data['end_date'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_project_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$query = $this->the_model->info(array('id_project' => $id));
			
			if ($query->num_rows() > 0)
			{
				$param = array();
				if ($name == TRUE)
				{
					$param['name'] = $name;
				}
				if ($requirement == TRUE)
				{
					$param['requirement'] = $requirement;
				}
				if ($description == TRUE)
				{
					$param['description'] = $description;
				}
				if ($division == TRUE)
				{
					$param['division'] = $division;
				}
				if ($department == TRUE)
				{
					$param['department'] = $department;
				}
				if ($status == TRUE)
				{
					$param['status'] = $status;
				}
				if ($end_date == TRUE)
				{
					$param['end_date'] = $end_date;
				}
				if ($finished_date == TRUE)
				{
					$param['finished_date'] = $finished_date;
				}
				
				if ($param == TRUE)
				{
					$param['updated_date'] = date('Y-m-d H:i:s');
					$update = $this->the_model->update($id, $param);
					
					if ($update > 0)
					{
						$data['update'] = 'success';
						$validation = 'ok';
						$code = 200;
					}
				}
				else
				{
					$data['update'] = 'failed';
					$validation = 'error';
					$code = 400;
				}
			}
			else
			{
				$data['id_project'] = 'not found';
				$validation = 'error';
				$code = 400;
			}
		}
		
		$rv = array();
		$rv['message'] = $validation;
		$rv['code'] = $code;
		$rv['result'] = $data;
		$this->benchmark->mark('code_end');
		$rv['load'] = $this->benchmark->elapsed_time('code_start', 'code_end') . ' seconds';
		$this->response($rv, $code);
	}
}
