<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_company_name'))
{
    function check_company_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('company_model');
        
		$query = $CI->company_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_date_format'))
{
	function check_date_format($date)
	{
		if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
		{
			if (checkdate($parts[2],$parts[3],$parts[1]))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
		  return false;
		}
	}
}

if ( ! function_exists('check_job_analyst_name'))
{
    function check_job_analyst_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('job_analyst_model');
        
		$query = $CI->job_analyst_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_job_role_name'))
{
    function check_job_role_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('job_role_model');
        
		$query = $CI->job_role_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_po_name_name'))
{
    function check_po_name_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('po_name_model');
        
		$query = $CI->po_name_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_position_name'))
{
    function check_position_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('position_model');
        
		$query = $CI->position_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_project_doc_title'))
{
    function check_project_doc_title($title)
	{
        $CI =& get_instance();
        $CI->load->model('project_doc_model');
        
		$query = $CI->project_doc_model->info(array('title' => $title));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_project_name'))
{
    function check_project_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('project_model');
        
		$query = $CI->project_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_project_type_name'))
{
    function check_project_type_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('project_type_model');
        
		$query = $CI->project_type_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_user_email'))
{
    function check_user_email($email)
	{
        $CI =& get_instance();
        $CI->load->model('user_model');
        
		$query = $CI->user_model->info(array('email' => $email));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_user_name'))
{
    function check_user_name($name)
	{
        $CI =& get_instance();
        $CI->load->model('user_model');
        
		$query = $CI->user_model->info(array('name' => $name));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('check_user_username'))
{
    function check_user_username($username)
	{
        $CI =& get_instance();
        $CI->load->model('user_model');
        
		$query = $CI->user_model->info(array('username' => $username));
		
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}

if ( ! function_exists('filter'))
{
    function filter($param)
    {
        $CI =& get_instance();

        $result = $CI->db->escape_str($param);
        return $result;
    }
}

if ( ! function_exists('get_user_info'))
{
	function get_user_info($param)
	{
		$CI =& get_instance();
        $CI->load->model('user_model');
        
		$query = $CI->user_model->info($param);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}
}

if ( ! function_exists('valid_email'))
{
	function valid_email($email)
	{
		if ( !preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email) )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}