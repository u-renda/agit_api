<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Project_doc extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('project_doc_model', 'the_model');
    }
	
	function create_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id_project = filter($this->post('id_project'));
		$title = filter(trim($this->post('title')));
		$category = filter(trim($this->post('category')));
		$description = filter(trim($this->post('description')));
		$url = filter(trim($this->post('url')));
		
		$data = array();
		if ($id_project == FALSE)
		{
			$data['id_project'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($title == FALSE)
		{
			$data['title'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($category == FALSE)
		{
			$data['category'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($url == FALSE)
		{
			$data['url'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_project_doc_title($title) == FALSE && $title == TRUE)
		{
			$data['title'] = 'already exist';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($category, $this->config->item('default_project_doc_category')) == FALSE && $category == TRUE)
		{
			$data['category'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			$param['id_project'] = $id_project;
			$param['title'] = $title;
			$param['category'] = $category;
			$param['description'] = $description;
			$param['url'] = $url;
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
		
        $id = filter($this->post('id_project_doc'));
        
		$data = array();
        if ($id == FALSE)
		{
			$data['id_project_doc'] = 'required';
			$validation = "error";
			$code = 400;
		}
        
        if ($validation == "ok")
		{
            $query = $this->the_model->info(array('id_project_doc' => $id));
			
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
				$data['id_project_doc'] = 'not found';
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
		
		$id = filter($this->get('id_project_doc'));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project_doc'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			if ($id != '')
			{
				$param['id_project_doc'] = $id;
			}
			
			$query = $this->the_model->info($param);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$data = array(
					'id_project_doc' => $row->id_project_doc,
					'title' => $row->title,
					'category' => intval($row->category),
					'description' => $row->description,
					'url' => $row->url,
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date,
					'project' => array(
						'id_project' => $row->id_project,
						'name' => $row->project_name
					)
				);
				
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['id_project_doc'] = 'not found';
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
		$category = filter($this->get('category'));
		
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
		
		if (in_array($order, $this->config->item('default_project_doc_order')) && ($order == TRUE))
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
		
		if (in_array($category, $this->config->item('default_project_doc_category')) && ($category == TRUE))
		{
			$category = $category;
		}
		
		$param = array();
		$param2 = array();
		if ($id_project != '')
		{
			$param['id_project'] = $id_project;
			$param2['id_project'] = $id_project;
		}
		if ($category != '')
		{
			$param['category'] = $category;
			$param2['category'] = $category;
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
					'id_project_doc' => $row->id_project_doc,
					'id_project' => $row->id_project,
					'title' => $row->title,
					'category' => intval($row->category),
					'description' => $row->description,
					'url' => $row->url,
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
		
		$id = filter($this->post('id_project_doc'));
		$title = filter(trim($this->post('title')));
		$category = filter(trim($this->post('category')));
		$description = filter(trim($this->post('description')));
		$url = filter(trim($this->post('url')));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_project_doc'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($category, $this->config->item('default_project_doc_category')) == FALSE && $category == TRUE)
		{
			$data['category'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$query = $this->the_model->info(array('id_project_doc' => $id));
			
			if ($query->num_rows() > 0)
			{
				$param = array();
				if ($title == TRUE)
				{
					$param['title'] = $title;
				}
				if ($category == TRUE)
				{
					$param['category'] = $category;
				}
				if ($description == TRUE)
				{
					$param['description'] = $description;
				}
				if ($url == TRUE)
				{
					$param['url'] = $url;
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
				$data['id_project_doc'] = 'not found';
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
