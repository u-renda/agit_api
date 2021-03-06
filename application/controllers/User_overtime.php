<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class User_overtime extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user_overtime_model', 'the_model');
    }
	
	function create_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id_user = filter($this->post('id_user'));
		$id_project = filter($this->post('id_project'));
		$id_project_task = filter($this->post('id_project_task'));
		$type = filter(trim($this->post('type')));
		$category = filter(trim($this->post('category')));
		$description = filter(trim($this->post('description')));
		$date = filter(trim($this->post('date')));
		$status = filter(trim($this->post('status')));
		
		$data = array();
		if ($id_user == FALSE)
		{
			$data['id_user'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_project == FALSE)
		{
			$data['id_project'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_project_task == FALSE)
		{
			$data['id_project_task'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($type == FALSE)
		{
			$data['type'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($category == FALSE)
		{
			$data['category'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($description == FALSE)
		{
			$data['description'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($date == FALSE)
		{
			$data['date'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($type, $this->config->item('default_user_overtime_type')) == FALSE && $type == TRUE)
		{
			$data['type'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($category, $this->config->item('default_user_overtime_category')) == FALSE && $category == TRUE)
		{
			$data['category'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_user_overtime_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_date_format($date) == FALSE && $date == TRUE)
		{
			$data['date'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			if ($status == FALSE)
			{
				$status = 1;
			}
			
			$param = array();
			$param['id_user'] = $id_user;
			$param['id_project'] = $id_project;
			$param['id_project_task'] = $id_project_task;
			$param['type'] = $type;
			$param['category'] = $category;
			$param['description'] = $description;
			$param['date'] = $date;
			$param['status'] = $status;
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
		
        $id = filter($this->post('id_user_overtime'));
        
		$data = array();
        if ($id == FALSE)
		{
			$data['id_user_overtime'] = 'required';
			$validation = "error";
			$code = 400;
		}
        
        if ($validation == "ok")
		{
            $query = $this->the_model->info(array('id_user_overtime' => $id));
			
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
				$data['id_user_overtime'] = 'not found';
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
		
		$id = filter($this->get('id_user_overtime'));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_user_overtime'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			if ($id != '')
			{
				$param['id_user_overtime'] = $id;
			}
			
			$query = $this->the_model->info($param);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$data = array(
					'id_user_overtime' => $row->id_user_overtime,
					'type' => intval($row->type),
					'category' => intval($row->category),
					'status' => intval($row->status),
					'description' => $row->description,
					'date' => $row->date,
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date,
					'user' => array(
						'id_user' => $row->id_user,
						'name' => $row->user_name
					),
					'project' => array(
						'id_project' => $row->id_project,
						'name' => $row->project_name
					),
					'project_task' => array(
						'id_project_task' => $row->id_project_task,
						'name' => $row->project_task_name
					)
				);
				
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['id_user_overtime'] = 'not found';
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
		$id_user = filter($this->get('id_user'));
		$id_project = filter($this->get('id_compalined'));
		$type = filter(trim($this->get('type')));
		$category = filter(trim($this->get('category')));
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
		
		if (in_array($order, $this->config->item('default_user_overtime_order')) && ($order == TRUE))
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
		
		if (in_array($type, $this->config->item('default_user_overtime_type')) && ($type == TRUE))
		{
			$type = $type;
		}
		
		if (in_array($category, $this->config->item('default_user_overtime_category')) && ($category == TRUE))
		{
			$category = $category;
		}
		
		if (in_array($status, $this->config->item('default_user_overtime_status')) && ($status == TRUE))
		{
			$status = $status;
		}
		
		$param = array();
		$param2 = array();
		if ($id_user != '')
		{
			$param['id_user'] = $id_user;
			$param2['id_user'] = $id_user;
		}
		if ($id_project != '')
		{
			$param['id_project'] = $id_project;
			$param2['id_project'] = $id_project;
		}
		if ($type != '')
		{
			$param['type'] = $type;
			$param2['type'] = $type;
		}
		if ($category != '')
		{
			$param['category'] = $category;
			$param2['category'] = $category;
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
					'id_user_overtime' => $row->id_user_overtime,
					'id_user' => $row->id_user,
					'id_project' => $row->id_project,
					'id_project_task' => $row->id_project_task,
					'type' => intval($row->type),
					'category' => intval($row->category),
					'status' => intval($row->status),
					'description' => $row->description,
					'date' => $row->date,
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
		
		$id = filter($this->post('id_user_overtime'));
		$type = filter(trim($this->post('type')));
		$category = filter(trim($this->post('category')));
		$description = filter(trim($this->post('description')));
		$date = filter(trim($this->post('date')));
		$status = filter(trim($this->post('status')));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_user_overtime'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($type, $this->config->item('default_user_overtime_type')) == FALSE && $type == TRUE)
		{
			$data['type'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($category, $this->config->item('default_user_overtime_category')) == FALSE && $category == TRUE)
		{
			$data['category'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_user_overtime_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_date_format($date) == FALSE && $date == TRUE)
		{
			$data['date'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$query = $this->the_model->info(array('id_user_overtime' => $id));
			
			if ($query->num_rows() > 0)
			{
				$param = array();
				if ($type == TRUE)
				{
					$param['type'] = $type;
				}
				if ($category == TRUE)
				{
					$param['category'] = $category;
				}
				if ($description == TRUE)
				{
					$param['description'] = $description;
				}
				if ($date == TRUE)
				{
					$param['date'] = $date;
				}
				if ($status == TRUE)
				{
					$param['status'] = $status;
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
				$data['id_user_overtime'] = 'not found';
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
