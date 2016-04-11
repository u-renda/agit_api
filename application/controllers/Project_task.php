<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Project_task extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('project_task_model', 'the_model');
    }
	
	function create_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id_project = filter($this->post('id_project'));
		$id_user = filter($this->post('id_user'));
		$name = filter(trim($this->post('name')));
		$status = filter(trim($this->post('status')));
		$group_task = filter(trim($this->post('group_task')));
		$start_date = filter(trim($this->post('start_date')));
		$end_date = filter(trim($this->post('end_date')));
		
		$data = array();
		if ($id_project == FALSE)
		{
			$data['id_project'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_user == FALSE)
		{
			$data['id_user'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($name == FALSE)
		{
			$data['name'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($group_task == FALSE)
		{
			$data['group_task'] = 'required';
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
		
		if (in_array($group_task, $this->config->item('default_project_task_group_task')) == FALSE && $group_task == TRUE)
		{
			$data['group_task'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_project_task_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
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
		
		if ($validation == 'ok')
		{
			if ($status == FALSE)
			{
				$status = 2;
			}
			
			$param = array();
			$param['id_project'] = $id_project;
			$param['id_user'] = $id_user;
			$param['name'] = $name;
			$param['status'] = $status;
			$param['group_task'] = $group_task;
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
		
        $id = filter($this->post('id_project_task'));
        
		$data = array();
        if ($id == FALSE)
		{
			$data['id_project_task'] = 'required';
			$validation = "error";
			$code = 400;
		}
        
        if ($validation == "ok")
		{
            $query = $this->the_model->info(array('id_project_task' => $id));
			
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
				$data['id_project_task'] = 'not found';
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
		
		$id = filter($this->get('id_project_task'));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project_task'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			if ($id != '')
			{
				$param['id_project_task'] = $id;
			}
			
			$query = $this->the_model->info($param);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$data = array(
					'id_project_task' => $row->id_project_task,
					'name' => $row->name,
					'status' => intval($row->status),
					'group_task' => intval($row->group_task),
					'start_date' => $row->start_date,
					'end_date' => $row->end_date,
					'finished_date' => $row->finished_date,
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date,
					'project' => array(
						'id_project' => $row->id_project,
						'name' => $row->project_name
					),
					'user' => array(
						'id_user' => $row->id_user,
						'name' => $row->user_name
					)
				);
				
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['id_project_task'] = 'not found';
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
		$id_project = filter($this->get('id_project'));
		$id_user = filter($this->get('id_user'));
		$status = filter($this->get('status'));
		$group_task = filter($this->get('group_task'));
		
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
		
		if (in_array($order, $this->config->item('default_project_task_order')) && ($order == TRUE))
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
		
		if (in_array($status, $this->config->item('default_project_task_status')) && ($status == TRUE))
		{
			$status = $status;
		}
		
		if (in_array($group_task, $this->config->item('default_project_task_group_task')) && ($group_task == TRUE))
		{
			$group_task = $group_task;
		}
		
		$param = array();
		$param2 = array();
		if ($id_project != '')
		{
			$param['id_project'] = $id_project;
			$param2['id_project'] = $id_project;
		}
		if ($id_user != '')
		{
			$param['id_user'] = $id_user;
			$param2['id_user'] = $id_user;
		}
		if ($status != '')
		{
			$param['status'] = $status;
			$param2['status'] = $status;
		}
		if ($group_task != '')
		{
			$param['group_task'] = $group_task;
			$param2['group_task'] = $group_task;
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
					'id_project_task' => $row->id_project_task,
					'id_project' => $row->id_project,
					'id_user' => $row->id_user,
					'name' => $row->name,
					'status' => intval($row->status),
					'group_task' => intval($row->group_task),
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
		
		$id = filter($this->post('id_project_task'));
		$name = filter(trim($this->post('name')));
		$status = filter(trim($this->post('status')));
		$group_task = filter(trim($this->post('group_task')));
		$finished_date = filter(trim($this->post('finished_date')));
		$end_date = filter(trim($this->post('end_date')));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project_task'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($group_task, $this->config->item('default_project_task_group_task')) == FALSE && $group_task == TRUE)
		{
			$data['group_task'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_project_task_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
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
		
		if ($validation == 'ok')
		{
			$query = $this->the_model->info(array('id_project_task' => $id));
			
			if ($query->num_rows() > 0)
			{
				$param = array();
				if ($name == TRUE)
				{
					$param['name'] = $name;
				}
				if ($status == TRUE)
				{
					$param['status'] = $status;
				}
				if ($group_task == TRUE)
				{
					$param['group_task'] = $group_task;
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
				$data['id_project_task'] = 'not found';
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
