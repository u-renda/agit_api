<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Project_issue extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('project_issue_model', 'the_model');
    }
	
	function create_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id_project = filter($this->post('id_project'));
		$id_project_task = filter($this->post('id_project_task'));
		$id_user = filter(trim($this->post('id_user')));
		$id_issued = filter(trim($this->post('id_issued')));
		$status = filter(trim($this->post('status')));
		$category = filter(trim($this->post('category')));
		$description = filter(trim($this->post('description')));
		
		$data = array();
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
		
		if ($id_user == FALSE)
		{
			$data['id_user'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_issued == FALSE)
		{
			$data['id_issued'] = 'required';
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
		
		if (in_array($status, $this->config->item('default_project_issue_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($category, $this->config->item('default_project_issue_category')) == FALSE && $category == TRUE)
		{
			$data['category'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (get_user_info(array('id_user' => $id_issued)) == FALSE && $id_issued == TRUE)
		{
			$data['id_issued'] = 'wrong value';
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
			$param['id_project_task'] = $id_project_task;
			$param['id_user'] = $id_user;
			$param['id_issued'] = $id_issued;
			$param['category'] = $category;
			$param['description'] = $description;
			$param['status'] = $status;
			$param['end_date'] = '0000-00-00';
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
		
        $id = filter($this->post('id_project_issue'));
        
		$data = array();
        if ($id == FALSE)
		{
			$data['id_project_issue'] = 'required';
			$validation = "error";
			$code = 400;
		}
        
        if ($validation == "ok")
		{
            $query = $this->the_model->info(array('id_project_issue' => $id));
			
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
				$data['id_project_issue'] = 'not found';
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
		
		$id = filter($this->get('id_project_issue'));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project_issue'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			if ($id != '')
			{
				$param['id_project_issue'] = $id;
			}
			
			$query = $this->the_model->info($param);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				$user_issued = get_user_info(array('id_user' => $row->id_issued));
				
				$data = array(
					'id_project_issue' => $row->id_project_issue,
					'description' => $row->description,
					'category' => intval($row->category),
					'status' => intval($row->status),
					'end_date' => $row->end_date,
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date,
					'project' => array(
						'id_project' => $row->id_project,
						'name' => $row->project_name
					),
					'project_task' => array(
						'id_project_task' => $row->id_project_task,
						'name' => $row->project_task_name
					),
					'user' => array(
						'id_user' => $row->id_user,
						'name' => $row->user_name
					),
					'user_issued' => array(
						'id_issued' => $row->id_issued,
						'name' => $user_issued->name
					)
				);
				
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['id_project_issue'] = 'not found';
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
		$status = filter(trim($this->get('status')));
		$category = filter(trim($this->get('category')));
		$id_project = filter($this->get('id_project'));
		$id_issued = filter($this->get('id_issued'));
		
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
		
		if (in_array($order, $this->config->item('default_project_issue_order')) && ($order == TRUE))
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
		
		if (in_array($status, $this->config->item('default_project_issue_status')) && ($status == TRUE))
		{
			$status = $status;
		}
		
		if (in_array($category, $this->config->item('default_project_issue_category')) && ($category == TRUE))
		{
			$category = $category;
		}
		
		$param = array();
		$param2 = array();
		if ($status != '')
		{
			$param['status'] = $status;
			$param2['status'] = $status;
		}
		if ($category != '')
		{
			$param['category'] = $category;
			$param2['category'] = $category;
		}
		if ($id_issued != '')
		{
			$param['id_issued'] = $id_issued;
			$param2['id_issued'] = $id_issued;
		}
		if ($id_project != '')
		{
			$param['id_project'] = $id_project;
			$param2['id_project'] = $id_project;
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
					'id_project_issue' => $row->id_project_issue,
					'id_project' => $row->id_project,
					'id_project_task' => $row->id_project_task,
					'id_user' => $row->id_user,
					'id_issued' => $row->id_issued,
					'description' => $row->description,
					'category' => intval($row->category),
					'status' => intval($row->status),
					'end_date' => $row->end_date,
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
		
		$id = filter($this->post('id_project_issue'));
		$status = filter(trim($this->post('status')));
		$category = filter(trim($this->post('category')));
		$description = filter(trim($this->post('description')));
		$end_date = filter(trim($this->post('end_date')));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project_issue'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_project_issue_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($category, $this->config->item('default_project_issue_category')) == FALSE && $category == TRUE)
		{
			$data['category'] = 'wrong value';
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
			$query = $this->the_model->info(array('id_project_issue' => $id));
			
			if ($query->num_rows() > 0)
			{
				$param = array();
				if ($category == TRUE)
				{
					$param['category'] = $category;
				}
				if ($status == TRUE)
				{
					$param['status'] = $status;
				}
				if ($description == TRUE)
				{
					$param['description'] = $description;
				}
				if ($end_date == TRUE)
				{
					$param['end_date'] = $end_date;
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
				$data['id_project_issue'] = 'not found';
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
