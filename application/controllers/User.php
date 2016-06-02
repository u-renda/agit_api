<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user_model', 'the_model');
    }
	
	function create_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$id_company = filter($this->post('id_company'));
		$id_position = filter($this->post('id_position'));
		$id_po_name = filter($this->post('id_po_name'));
		$id_user_project_group = filter($this->post('id_user_project_group'));
		$name = filter(trim($this->post('name')));
		$email = filter(trim(strtolower($this->post('email'))));
		$username = filter(trim(strtolower($this->post('username'))));
		$password = filter(trim($this->post('password')));
		$role = filter(trim($this->post('role')));
		$status = filter(trim($this->post('status')));
		$nik = filter(trim($this->post('nik')));
		$photo = filter(trim($this->post('photo')));
		
		$data = array();
		if ($id_company == FALSE)
		{
			$data['id_company'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_position == FALSE)
		{
			$data['id_position'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_po_name == FALSE)
		{
			$data['id_po_name'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($id_user_project_group == FALSE)
		{
			$data['id_user_project_group'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($name == FALSE)
		{
			$data['name'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($email == FALSE)
		{
			$data['email'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($username == FALSE)
		{
			$data['username'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($password == FALSE)
		{
			$data['password'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($role == FALSE)
		{
			$data['role'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (valid_email($email) == FALSE && $email == TRUE)
		{
			$data['email'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_user_name($name) == FALSE && $name == TRUE)
		{
			$data['name'] = 'already exist';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_user_username($username) == FALSE && $username == TRUE)
		{
			$data['username'] = 'already exist';
			$validation = 'error';
			$code = 400;
		}
		
		if (check_user_email($email) == FALSE && $email == TRUE)
		{
			$data['email'] = 'already exist';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_user_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($role, $this->config->item('default_user_role')) == FALSE && $role == TRUE)
		{
			$data['role'] = 'wrong value';
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
			$param['id_position'] = $id_position;
			$param['id_po_name'] = $id_po_name;
			$param['id_user_project_group'] = $id_user_project_group;
			$param['name'] = $name;
			$param['email'] = $email;
			$param['username'] = $username;
			$param['password'] = md5($password);
			$param['role'] = $role;
			$param['status'] = $status;
			$param['nik'] = $nik;
			$param['photo'] = $photo;
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
		
        $id = filter($this->post('id_user'));
        
		$data = array();
        if ($id == FALSE)
		{
			$data['id_user'] = 'required';
			$validation = "error";
			$code = 400;
		}
        
        if ($validation == "ok")
		{
            $query = $this->the_model->info(array('id_user' => $id));
			
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
				$data['id_user'] = 'not found';
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
		
		$id = filter($this->get('id_user'));
		$username = filter(trim($this->get('username')));
		$name = filter(trim($this->get('name')));
		$email = filter(strtolower(trim($this->get('email'))));
		
		$data = array();
		if ($id == FALSE && $username == FALSE && $name == FALSE && $email == FALSE)
		{
			$data['id_user'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$param = array();
			if ($id != '')
			{
				$param['id_user'] = $id;
			}
			elseif ($username != '')
			{
				$param['username'] = $username;
			}
			elseif ($name != '')
			{
				$param['name'] = $name;
			}
			else
			{
				$param['email'] = $email;
			}
			
			$query = $this->the_model->info($param);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$data = array(
					'id_user' => $row->id_user,
					'email' => $row->email,
					'username' => $row->username,
					'name' => $row->name,
					'role' => intval($row->role),
					'nik' => $row->nik,
					'photo' => $row->photo,
					'status' => intval($row->status),
					'created_date' => $row->created_date,
					'updated_date' => $row->updated_date,
					'company' => array(
						'id_company' => $row->id_company,
						'name' => $row->company_name
					),
					'position' => array(
						'id_position' => $row->id_position,
						'name' => $row->position_name
					),
					'po_name' => array(
						'id_po_name' => $row->id_po_name,
						'name' => $row->po_name_name
					),
					'user_project_group' => array(
						'id_user_project_group' => $row->id_user_project_group,
						'name' => $row->user_project_group_name,
						'description' => $row->user_project_group_description
					)
				);
				
				$validation = 'ok';
				$code = 200;
			}
			else
			{
				$data['id_user'] = 'not found';
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
		$status = filter(trim($this->get('status')));
		$role = filter(trim($this->get('role')));
		
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
		
		if (in_array($order, $this->config->item('default_user_order')) && ($order == TRUE))
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
		
		if (in_array($status, $this->config->item('default_user_status')) && ($status == TRUE))
		{
			$status = $status;
		}
		
		if (in_array($role, $this->config->item('default_user_role')) && ($role == TRUE))
		{
			$role = $role;
		}
		
		$param = array();
		$param2 = array();
		if ($id_company != '')
		{
			$param['id_company'] = $id_company;
			$param2['id_company'] = $id_company;
		}
		if ($role != '')
		{
			$param['role'] = $role;
			$param2['role'] = $role;
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
					'id_user' => $row->id_user,
					'id_company' => $row->id_company,
					'id_position' => $row->id_position,
					'id_po_name' => $row->id_po_name,
					'id_user_project_group' => $row->id_user_project_group,
					'email' => $row->email,
					'username' => $row->username,
					'name' => $row->name,
					'role' => intval($row->role),
					'nik' => $row->nik,
					'photo' => $row->photo,
					'status' => intval($row->status),
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
		
		$id = filter($this->post('id_user'));
		$name = filter(trim($this->post('name')));
		$email = filter(trim(strtolower($this->post('email'))));
		$username = filter(trim(strtolower($this->post('username'))));
		$password = filter(trim($this->post('password')));
		$role = filter(trim($this->post('role')));
		$status = filter(trim($this->post('status')));
		$nik = filter(trim($this->post('nik')));
		$photo = filter(trim($this->post('photo')));
		
		$data = array();
		if ($id == FALSE)
		{
			$data['id_user'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if (valid_email($email) == FALSE && $email == TRUE)
		{
			$data['email'] = 'wrong format';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($status, $this->config->item('default_user_status')) == FALSE && $status == TRUE)
		{
			$data['status'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if (in_array($role, $this->config->item('default_user_role')) == FALSE && $role == TRUE)
		{
			$data['role'] = 'wrong value';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$query = $this->the_model->info(array('id_user' => $id));
			
			if ($query->num_rows() > 0)
			{
				$param = array();
				if ($name == TRUE)
				{
					$param['name'] = $name;
				}
				if ($email == TRUE)
				{
					$param['email'] = $email;
				}
				if ($username == TRUE)
				{
					$param['username'] = $username;
				}
				if ($password == TRUE)
				{
					$param['password'] = md5($password);
				}
				if ($role == TRUE)
				{
					$param['role'] = $role;
				}
				if ($status == TRUE)
				{
					$param['status'] = $status;
				}
				if ($nik == TRUE)
				{
					$param['nik'] = $nik;
				}
				if ($photo == TRUE)
				{
					$param['photo'] = $photo;
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
				$data['id_user'] = 'not found';
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
	
	// Dipakai untuk login karena butuh username & password (required) 
	function valid_post()
	{
		$this->benchmark->mark('code_start');
		$validation = 'ok';
		
		$username = filter(trim(strtolower($this->post('username'))));
		$password = filter(trim($this->post('password')));
		
		$data = array();
		if ($username == FALSE)
		{
			$data['username'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($password == FALSE)
		{
			$data['password'] = 'required';
			$validation = 'error';
			$code = 400;
		}
		
		if ($validation == 'ok')
		{
			$query = $this->the_model->info(array('username' => $username));
			
			if ($query->num_rows() > 0)
			{
				$check_pass = $query->row()->password;
				$pass = md5($password);
				
				if ($check_pass == $pass)
				{
					$data['valid'] = 'yes!';
					$validation = 'ok';
					$code = 200;
				}
				else
				{
					$data['valid'] = 'no!';
					$validation = 'error';
					$code = 400;
				}
			}
			else
			{
				$data['username'] = 'not found';
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
