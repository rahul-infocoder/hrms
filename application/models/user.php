<?php
class User extends CI_Model
{
	/*
	Attempts to login employee and set session. Returns boolean based on outcome.
	*/
	function login($username, $password)
	{
		session_start();
		$where = '((password="'.$password .'") AND (contact_email="'.$username.'" OR userName="'.$username.'"))';
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($where);
		$this->db->where('active','Y');
		$query = $this->db->get();
		
		//$query = $this->db->get_where('users', array('contact_email' => $username, 'password'=>$password,'active'=>'Y'), 1);
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			//print_r($row);exit;
			if($row->image == "")
			{
			$pro_Img_url = "blank.jpg";	
			}
			else
			{
				$pro_Img_url =$row->image;
				
		    }
			
			$this->session->set_userdata('id', $row->id);
			$this->session->set_userdata('user_type', $row->user_type);
			$this->session->set_userdata('cid', $row->cid);
			$this->session->set_userdata('profileImg',$pro_Img_url);
			$this->session->set_userdata('global_comp','');
			$_SESSION['emp_id']=$row->id; 
			return true;
		}
		return false;
	}
	
	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	function logout()
	{
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
	
    redirect('login');
	}
	
	/*
	Determins if a employee is logged in
	*/
	function is_logged_in()
	{
		return $this->session->userdata('id')!=false;
	}
	
	/*
	Gets information about the currently logged in employee.
	*/
	function get_logged_in_employee_info()
	{
		if($this->is_logged_in())
		{
			return $this->get_info($this->session->userdata('id'));
		}
		
		return false;
	}
	
	function get_tempinfo($ouser, $opass)
	{
		$query = $this->db->get_where('contactinfo', array('username' => $ouser, 'password' => sha1($opass)));
		
		if ($query->num_rows() ==1)
		{
			return true;
		}
		return false;
	}
	
	function ChgPass($ouser, &$pass_data)
	{
		$this->db->where('username', $ouser);
		$this->db->update('contactinfo',$pass_data);
		return true;
	}
		
	/*
	Gets information about a particular employee
	*/
	function get_info($id)
	{
		$this->db->from('users');	
		$this->db->where('users.id', $id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		
		else
		{
		
			$person_obj=parent::get_info(-1);
			
			//Get all the fields from users table
			$fields = $this->db->list_fields('users');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}
	
	function getCompanies()
	{

     if($this->session->userdata('user_type') =='A')
		{
			$condi='';
			
		$this->db->select('*');
			$this->db->from('users');
			$this->db->where('id',$this->session->userdata('id'));
			$query2 = $this->db->get();
			$query2 = $query2->row();
			
			
			 $comnii = $query2->accessComp;	
			$comnii = explode(',',$comnii);
		if(count($comnii) >0 )
			{
				for($i=0; $i<count($comnii); $i++ )
				{
					$condi .= '`id`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
			
		}

	    $this->db->select('*'); 
        $this->db->from('company');
		if($this->session->userdata('user_type') =='A')
		{
			$this->db->where("(".$condi.")");
		 	$this->db->where('active','Y');
		}
		
		
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows()>0){
		foreach($query->result_array() as $row){
            $data[$row['id']]=$row['name'];
        }
		}
		else{
		$data['']='';	
		}
		return $data;	
	}



function getACompanies()
	{

     if($this->session->userdata('user_type') =='A')
		{
			$condi='';
			
		$this->db->select('*');
			$this->db->from('users');
			$this->db->where('id',$this->session->userdata('id'));
			$query2 = $this->db->get();
			$query2 = $query2->row();
			
			
			 $comnii = $query2->accessComp;	
			$comnii = explode(',',$comnii);
		if(count($comnii) >0 )
			{
				for($i=0; $i<count($comnii); $i++ )
				{
					$condi .= '`id`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
			
		}

	    $this->db->select('*'); 
        $this->db->from('company');
		$this->db->where('active','Y');
		if($this->session->userdata('user_type') =='A')
		{
			$this->db->where("(".$condi.")");
		 	
		}
		
		
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows()>0){
		foreach($query->result_array() as $row){
            $data[$row['id']]=$row['name'];
        }
		}
		else{
		$data['']='';	
		}
		return $data;	
	}
	
	function userNameCheck($uname)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('userName',$uname);
		
		$this->db->where('id !=',$this->session->userdata('id'));
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return false;
			
		}
		
		else
		{
		return true;	
		}
		
		
		
	}
	
	
	function birthDay()
	{
		 $admin_where = $this->Adminmodel->AdminAccesCondition();
		$list = array();
		$i =0;
		$todayDate  = date('m-d');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.user_type','E');
		if($this->session->userdata('user_type')== 'A')
		{
			if($admin_where)
			{
			$this->db->where('('.$admin_where.')');
			}
			
		}
		if($this->session->userdata('user_type')== 'E')
		{
			$this->db->where('users.cid',$this->session->userdata('cid'));
		}
		if($this->session->userdata('global_comp') !=''){
	        $this->db->where('users.cid',$this->session->userdata('global_comp'));
	
	     }
		$query =  $this->db->get();
		foreach($query->result() as $row)
		{
		    	$dob = date('m-d',$row->dob);
				if($todayDate == $dob)
				{
				   $list[$i]['id'] = $row->id;
				   $list[$i]['name'] = $row->contact_name;	
				}
		}
		
		return $list;
		
		
	}
	
	
	function companyLogo()
	{
		$globalId = $this->session->userdata('global_comp');	
		  $userType =$this->session->userdata('user_type');
		
		
		if($globalId =='')
	{
		
		  if($userType =='A')
		  {
			  if($adminaccess = $this->Adminmodel->AdminAccessCompany())
			  {
				  $this->db->select('logo');
				 $this->db->from('company');
				 $this->db->where('id',$adminaccess[0]);
				 $query = $this->db->get();
				 if($query->num_rows() >0)
				 {
					 $query = $query->row();
					 if($query->logo !='' || $query->logo !=null )
					 {
					   return 'upload/profileimages/'.$query->logo;	 
					  }
					  else
					  {
						return 'images/infoseek_logo.png';   
					  }
				 }
				 else
				 {
					//return 'images/default-company_logo.png'; 					return 'images/infoseek_logo.png';
				 }
			  }
			  else
			  {
					return 'images/infoseek_logo.png';   
			  }
			  
		  }
		  else if($userType == 'E')
		  {
			 $cid=  $this->session->userdata('cid');
			 $this->db->select('logo');
			 $this->db->from('company');
			 $this->db->where('id',$cid);
			 $query = $this->db->get();
			 if($query->num_rows() >0)
			 {
				 $query = $query->row();
				 if($query->logo !='' || $query->logo !=null )
				 {
				   return 'upload/profileimages/'.$query->logo;	 
				  }
				  else
				  {
					return 'images/infoseek_logo.png';   
				  }
			 }
			 else
			 {
				return 'images/infoseek_logo.png'; 
			 }
		  }
		  
		  else if($userType=='SA')
		  {
			  return 'images/infoseek_logo.png';
		  }
			
			
	}
	
	else
	{
		  
			 $this->db->select('logo');
			 $this->db->from('company');
			 $this->db->where('id',$globalId);
			 $query = $this->db->get();
			 if($query->num_rows() >0)
			 {
				 $query = $query->row();
				 if($query->logo !='' || $query->logo !=null )
				 {
				   return 'upload/profileimages/'.$query->logo;	 
				  }
				  else
				  {
					return 'images/infoseek_logo.png';   
				  }
			 }
			 else
			 {
				return 'images/infoseek_logo.png'; 
			 }
	}
	
}


	function countreportComment($reportId)
		{
          $this->db->select('id, count(id) as totalC');
		  $this->db->from('workreportcomment');
		  $this->db->where('reportId',$reportId);
		 return $this->db->get()->row()->totalC;
		}
		
		
		function nameForReport($id)
		{
		  $this->db->select('contact_name');
		  $this->db->from('users');
		  $this->db->where('id',$id);
		  return $this->db->get()->row()->contact_name;
		}



}
?>