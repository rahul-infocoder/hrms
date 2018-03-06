<?php
class Adminmodel extends CI_Model
{
	/* SAVING DATA */
	
	function compExists($id)
	{
		$this->db->from('company');
		$this->db->where('company.id', $id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	
	function existEmail($email,$id)
	{
		
		if(!$this->Adminmodel->empExists($id))
		{
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('contact_email',$email);
		
		$query = $this->db->get();
		if($query->num_rows() >=1)
			{
				return false;
				
			}
			else
			{
			return true;	
			}	
			
		}
		else
		{
			$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		$query = $query->row();
		$F_email = $query->contact_email;
		if($F_email== $email)
		{
		return true;	
		}
		else
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('contact_email',$email);
			
			$query = $this->db->get();
			if($query->num_rows() >=1)
				{
					return false;
					
				}
				else
				{
				return true;	
				}
			
		}
		
			
			
		}
	}
	function comNameExists($name,$id)
	{
		if(!$this->Adminmodel->compExists($id))
		{
			$this->db->select('*');
			$this->db->from('company');
			$this->db->where('name',$name);
			$query=$this->db->get();
			if($query->num_rows >=1)
			{
				return false;
			}
			return true;
			
		}
		else
		{
			$this->db->from('company');
		     $this->db->where('company.id', $id);
		     $query = $this->db->get();
			 $query = $query->row();
			 $Cname = $query->name;
			 if($Cname == $name)
			 {
				 return true;
				 
			}
			else 
			{
				$this->db->select('*');
			$this->db->from('company');
			$this->db->where('name',$name);
			$query=$this->db->get();
			if($query->num_rows >=1)
			{
				return false;
			}
			return true;
				
			}
			
		}
	}
	function saveCompany(&$cArray, $id=false)
	{	
		if (!$id or !$this->compExists($id))
		{
			if($this->db->insert('company', $cArray))
			{
				return true;
			}
			
			return false;
		}

		$this->db->where('id', $id);
		return $this->db->update('company', $cArray);

	}
	
	function empExists($id)
	{
		$this->db->from('users');
		$this->db->where('users.id', $id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
		function adminExists($id)
	      {
		$this->db->from('users');
		$this->db->where('users.id', $id);
		$this->db->where('users.user_type', 'A');
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	      }
	
	function saveEmployee(&$empArray, $id=false)
	{	
		if (!$id or !$this->empExists($id))
		{
			if($this->db->insert('users', $empArray))
			{
				 
				return true;
			}
			
			return false;
		}
		else
		{
         
	    $this->db->where('id', $id);
	    $this->db->update('users', $empArray);
	    return true;
		
		}

	}
	
	function viewUserPermission($efid)
	{
		if($this->session->userdata('id') == 'A')
		{
		$this->db->select('*');
		 $this->db->from('users');
		 $this->db->where('id',$this->session->userdata('id'));
		 $query = $this->db->get();
		 if($query->num_rows() == 1)
		 {
			 $query = $query->row();
			 $accComp = $query->accessComp;
			 $accComp = explode(',',$accComp);
			 
			 	 
			 
		 }
		} 
        
		 
		 $this->db->select('*');
		 $this->db->from('users');
		 $this->db->where('id',$efid);
		 $this->db->where('user_type','E');
		 $query2 = $this->db->get();
		 if($query2->num_rows() == 1)
		 {
			 $query2 = $query2->row();
			 $up_user_type = $query2->user_type;
			 $up_user_comp = $query2->cid;
			 $id2 = $query2->id;
			 $validId = true;
			 
		 }
		  else
		  {
			 $validId = false;
			 
			 }
			 if($validId == true)
			 {
				 if($up_user_type == 'E' && ($this->session->userdata('user_type') == 'SA' || $this->session->userdata('user_type') == 'A'))
				 {
					 /*Check Admin have permision to update this user*/
					 $InCompany =  false;
					 if($this->session->userdata('user_type') == 'A')
					 {
						 if(count($accComp) >0)
						 {
							for($i=0; $i<count($accComp); $i++) 
							{
							  if($up_user_comp == $accComp[$i])
							   {
								   $InCompany = true;
							   }	
							}
						 }
					 }
					 else
					 {
						 $InCompany = true;
					  }
					 /*End User Permission*/
					 
					 if($InCompany == true)
					 {
					 return true;	 
					 }
					 
					 
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
	function incExists($id)
	{
		$this->db->from('increments');
		$this->db->where('increments.id', $id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	function saveInc(&$incArray, $id=false, $empid, $inc)
	{	
		if (!$id or !$this->incExists($id))
		{
			if($this->db->insert('increments', $incArray))
			{
				//$nsal = $this->getEmpInfo($empid)->current_salary + ((($this->getEmpInfo($empid)->salary+$this->getEmpInfo($empid)->current_salary) * $inc) / 100);
				//$nsal = $this->getEmpInfo($empid)->current_salary + $inc;
				//$this->db->update('users', array('current_salary' => $nsal), array('id' => $empid));
				return true;
			}
			
			return false;
		}

		//$this->db->where('id', $id);
		//return $this->db->update('increments', $incArray);

	}
	
	/* SAVING DATA */
	
	/* View Data */
	function getAllEmployee($limit=50,$offset=0)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		
		$this->db->select('*, users.id as empid, users.active as u_active');	
		$this->db->from('users');
		
		$this->db->join('company','company.id = users.cid');
		if($this->session->userdata('user_type') != 'SA')
			{
		     $this->db->where("(".$condi.")");			
			
			
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
				
				$this->db->where('users.active','Y');	
		$this->db->order_by('users.contact_name','asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		return $query;
	}
	
	function TotalgetAllEmployee()
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		
		$this->db->select('*, users.id as empid, users.active as u_active,count(users.id) as TotalRow');	
		$this->db->from('users');
		
		$this->db->join('company','company.id = users.cid');
		if($this->session->userdata('user_type') != 'SA')
			{
		     $this->db->where("(".$condi.")");			
			
			
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
				
		$this->db->where('users.active','Y');		
		$this->db->order_by('users.contact_name','asc');
		$query = $this->db->get();
		
		return $query->row()->TotalRow;
	}
	
	
	function getAllEmployeeD($limit=50,$offset=0)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		
		$this->db->select('*, users.id as empid, users.active as u_active');	
		$this->db->from('users');
	
		
		$this->db->join('company','company.id = users.cid');
		
		if($this->session->userdata('user_type') != 'SA')
			{
		     $this->db->where("(".$condi.")");			
			
			
		}
		
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
					$this->db->where('users.active','N');
		$this->db->order_by('users.contact_name','asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		return $query;
	}
	
	function TotalgetAllEmployeeD()
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		
		$this->db->select('*, users.id as empid, users.active as u_active,count(users.id) as TotalRow');	
		$this->db->from('users');
		
		$this->db->join('company','company.id = users.cid');
		
		if($this->session->userdata('user_type') != 'SA')
			{
		     $this->db->where("(".$condi.")");			
			
			
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			$this->db->where('users.active','N');	
		$this->db->order_by('users.contact_name','asc');
		$query = $this->db->get();
		
		return $query->row()->TotalRow;
	}
	function adminUserList()
	{
		$list = array();
		
		$this->db->select('id,accessComp');
		$this->db->from('users');
		$this->db->where('user_type','A');
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			if($this->session->userdata('global_comp') ==''){
		    $list[] = $row->id;	
			}
			else
			{
			  $compay = explode(',',$row->accessComp);
			  if(in_array($this->session->userdata('global_comp'),$compay))
			  {
			     $list[] = $row->id;	  
			  }
			  else
			  {
			    continue;	  
			  }	
			}
		}
		
		return $list;
		
		
	}
	
	function getAdminAllEmployee($limit=1,$page=0)
	{		
	  $list = $this->Adminmodel->adminUserList();
		
		$this->db->select('*, users.id as empid, users.active as u_active');	
		$this->db->from('users');
		if(count($list) >0)
		{
		$this->db->where_in('id',$list);
		}
		else
		{
		  $this->db->where('user_type','NhiH');
		}
		$this->db->order_by('contact_name','asc');
         $this->db->limit($limit,$page);
				
		$query = $this->db->get();
		
		return $query;
	}	
	
	function totalAdmin()
	{
		$list = $this->Adminmodel->adminUserList();
		$this->db->select('id,count(users.id) as tTotal');	
		$this->db->from('users');
		    
		if(count($list) >0)
		{
		$this->db->where_in('id',$list);
		}
		else
		{
		  $this->db->where('user_type','NhiH');
		}			
		return $this->db->get()->row()->tTotal;
		
	}
	function getAllCompanies()
	{
		if($this->session->userdata('user_type') == 'A')
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
		if($this->session->userdata('user_type') != 'SA')
		{
		$this->db->where('company.active', 'Y');
		$this->db->where("(".$condi.")");
		}
		$this->db->order_by('name','asc');
		
		$query = $this->db->get();
		
		return $query;
	}
	function preSalary($id)
	{
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->where('emid',$id);
		$this->db->order_by('pay_date','desc');
	    $query = $this->db->get();
		foreach ($query->result() as $row)
       {
           return $row->pay_date;
		   break;
           
         }
		
		
	}

	function findEmpSlry($limit,$page)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		$this->db->select('*, users.id as emid');
		$this->db->from('users');
		$this->db->join('company','company.id= users.cid');
		$this->db->where('users.active','Y');
		$this->db->where('user_type','E');
		$this->db->where('company.active','Y');
		if($this->session->userdata('user_type') != 'SA')
		{
		$this->db->where("(".$condi.")");	
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
		$this->db->order_by('users.contact_name','asc');	
		$this->db->limit($limit,$page);
		return $query = $this->db->get();
		
	}
	
	function TotalSalaryRow()
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		$this->db->select('users.id , count(users.id) as tTotal');
		$this->db->from('users');
		$this->db->join('company','company.id= users.cid');
		$this->db->where('users.active','Y');
		$this->db->where('user_type','E');
		$this->db->where('company.active','Y');
		if($this->session->userdata('user_type') != 'SA')
		{
		$this->db->where("(".$condi.")");	
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
		
		return $query = $this->db->get()->row()->tTotal;
	}
	
	function numWeekdays( $start_ts, $end_ts, $day, $include_start_end = false ) {
		   $days=0;
			$day = strtolower( $day );
			$current_ts = $start_ts;
			// loop next $day until timestamp past $end_ts
			while( $current_ts < $end_ts ) {
		
				if( ( $current_ts = strtotime( 'next '.$day, $current_ts ) ) < $end_ts) {
					$days++;
				}
			}
		
			// include start/end days
			if ( $include_start_end ) {
				if ( strtolower( date( 'l', $start_ts ) ) == $day ) {
					$days++;
				}
				if ( strtolower( date( 'l', $end_ts ) ) == $day ) {
					$days++;
				}
			}   
		
			return (int)$days;

}
	
	function runMonthsalary($id)
	{
	 $this->db->select('*');
	 $this->db->from('salary');
	 $this->db->where('emid',$id);
	 $this->db->order_by('id','desc');
	$query = $this->db->get();
	if($query->num_rows >= 1)
		{
			foreach ($query->result() as $row)
			   {
				   return $row->pay_month;
				   break;
				   
				 }
			
			 
		}
		
	else
		{
			return $this->Adminmodel->EmpJoinMonth($id);
		}	
	 
	}
	
	function dueLeave($id)
	{
		$month = $this->Adminmodel->runMonthsalary($id);
		$this->db->select('*');
	    $this->db->from('salary');
	    $this->db->where('emid',$id);
		$this->db->where('pay_month',$month);
		$query = $this->db->get();
		$query = $query->row();
		return $query->due_leave;
		
		
	}

	function getEmpeSlryDate($id)
	{
		 $this->db->select('*');
	 $this->db->from('users');
	 $this->db->join('company','company.id = users.cid');
	 $this->db->where('users.id',$id);

	return $query = $this->db->get();
	
		
		
		
		
    }
	function getLeavesSpecificEmp($id)
	{
		
	
	$timezone = "Asia/Calcutta";
    if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	
		 
		
		/** Last salary Month And Year **/
		 $Lmonth = $this->Adminmodel->runMonthsalary($id);
		  
		/** End **/
		
		/**Complete last Salary date**/
		$Ldate = $Lmonth.'-'.'1';
		$salaryFrom = strtotime(date_format(new DateTime($Ldate),'d-m-Y'). " +1 month");
		
		$salaryTo = date('Y-m',$salaryFrom).'-'.date('t', $salaryFrom ); 
		$salaryTo = strtotime(date_format(new DateTime($salaryTo),'d-m-Y'));
	//echo date('d-m-Y',$salaryFrom).'<->'. date('d-m-Y',$salaryTo). '<br/>';
		
		$this->db->select('*, users.id as empid, SUM(leaves.fullday) as fulldays, SUM(leaves.halfday) as halfdays');	
		$this->db->from('leaves');
		$this->db->join('users','leaves.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('users.active', 'Y');
		$this->db->where('users.id', $id);
		$this->db->where('leaves.approved','Y');
		$this->db->where('leaves.leavefrom >=',$salaryFrom);
		$this->db->where('leaves.leavefrom <',$salaryTo);
		
		 $query = $this->db->get();
		
		return $query;
	}
	function removeSunday($id)
	{
		/** Last salary Month And Year **/
		 $Lmonth = $this->Adminmodel->runMonthsalary($id);
		  
		/** End **/
		
		/**Complete last Salary date**/
		$Ldate = $Lmonth.'-'.'1';
		$salaryFrom = strtotime(date_format(new DateTime($Ldate),'d-m-Y'). " +1 month");
		
		$salaryTo = date('Y-m',$salaryFrom).'-'.date('t', $salaryFrom ); 
		$salaryTo = strtotime(date_format(new DateTime($salaryTo),'d-m-Y'));
		
		$this->db->select('*, users.id as empid');	
		$this->db->from('leaves');
		$this->db->join('users','leaves.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		
		$this->db->where('users.active', 'Y');
		$this->db->where('users.id', $id);
		
		$this->db->where('leaves.approved','Y');
		$this->db->where('leaves.leavefrom >=',$salaryFrom);
		$this->db->where('leaves.leavefrom <',$salaryTo);
		
		$query = $this->db->get();
		$mothOutLeave=0;
		$sunday =0;
		if($query->num_rows()>0){
			
				foreach($query->result_array() as $row){
					//echo date('Y-m-d',$row['leaveto']) .'-' .date('Y-m-d',$row['leavefrom']) .'<br/>';
					//if($row['leaveto'] > $sa)
					$leaveto= strtotime(date('Y-m-d',$row['leaveto']).' +1 day');
					$leavefrom= strtotime(date('Y-m-d',$row['leavefrom']).' -1 day');
					
					$sunday = $sunday+ $this->Adminmodel->numWeekDays( $leavefrom, $leaveto, 'sunday', false );
					
					
				}
		
				
		}
		return $sunday;
		
	}
	
	
		function OverMonthSunday($id)
		{
			 /** Last salary Month And Year **/
		 $Lmonth = $this->Adminmodel->runMonthsalary($id);
		  
		/** End **/
		
		/**Complete last Salary date**/
		$Ldate = $Lmonth.'-'.'1';
		$salaryFrom = strtotime(date_format(new DateTime($Ldate),'d-m-Y'). " +1 month");
		
		$salaryTo = date('Y-m',$salaryFrom).'-'.date('t', $salaryFrom ); 
		$salaryTo = strtotime(date_format(new DateTime($salaryTo),'d-m-Y'));
			
			$this->db->select('*, users.id as empid');	
			$this->db->from('leaves');
			$this->db->join('users','leaves.empid = users.id');
			$this->db->join('company','company.id = users.cid');
			$this->db->where('users.active', 'Y');
			$this->db->where('users.id', $id);
			$this->db->where('leaves.approved','Y');
			$this->db->where('leaves.leavefrom >=',$salaryFrom);
			$this->db->where('leaves.leavefrom <',$salaryTo);
			
			$query = $this->db->get();
			$mothOutLeave=0;
			$sunday =0;
			if($query->num_rows()>0){
				
					foreach($query->result_array() as $row){
						//echo date('Y-m-d',$row['leaveto']) .'-' .date('Y-m-d',$row['leavefrom']) .'<br/>';
						$leaveto= strtotime(date('Y-m-d',$row['leaveto']).' +1 day');
						$leavefrom= strtotime(date('Y-m-d',$row['leavefrom']).' -1 day');
						
						
							if($row['leaveto'] > $salaryTo)
								{
									$salaryTo = strtotime(date('Y-m-d',$salaryTo).' +1 day');
								   $sunday =$this->Adminmodel->numWeekDays($salaryTo,$leaveto , 'sunday', false );
								}
						
					}
			
					
			}
			return $sunday;
		
	}
	
	function checkCrossLeave($id)
	{
/** Last salary Month And Year **/
		 $Lmonth = $this->Adminmodel->runMonthsalary($id);
		  
		/** End **/
		
		/**Complete last Salary date**/
		$Ldate = $Lmonth.'-'.'1';
		$salaryFrom = strtotime(date_format(new DateTime($Ldate),'d-m-Y'). " +1 month");
		
		$salaryTo = date('Y-m',$salaryFrom).'-'.date('t', $salaryFrom ); 
		$salaryTo = strtotime(date_format(new DateTime($salaryTo),'d-m-Y'));
		
		
		$this->db->select('*, users.id as empid');	
		$this->db->from('leaves');
		$this->db->join('users','leaves.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('users.active', 'Y');
		$this->db->where('users.id', $id);
		$this->db->where('leaves.approved','Y');
		$this->db->where('leaves.leavefrom >=',$salaryFrom);
		$this->db->where('leaves.leavefrom <',$salaryTo);
		
		$query = $this->db->get();
		$mothOutLeave=0;
		if($query->num_rows()>0){
				foreach($query->result_array() as $row){
				$leaveto= $row['leaveto'];
				if($leaveto > $salaryTo)
				{
					
				$diff = abs($leaveto -$salaryTo);
				return $days =floor($diff / (60*60*24));
				
					
				}
					
                //$data[$row['empid']]=$row['contact_name'];
              }
			
			
		}
		  
		  
		  	
	}
	function getMonthHolidays($m)
	{
		$this->db->select('*, SUM(holidays.no_of_days) as totalh');	
		$this->db->from('holidays');
		$this->db->where('MONTH(holidays.doh)', $m);
		$this->db->group_by('holidays.id');
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function getAllProjects()
	{
		$this->db->select('*');	
		$this->db->from('projects');
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function getAllIncrements()
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
		}
		$this->db->select('*, users.id as empid, increments.id as icnId');	
		$this->db->from('increments');
		$this->db->join('users','increments.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('users.user_type','E');
		if($this->session->userdata('user_type') == 'A')
		{
		$this->db->where("(".$condi.")");
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
		$this->db->order_by('increments.doi','desc');	
		$query = $this->db->get();
		
		return $query;
	}
	
	function getAllLeaveApps($limit,$page,$dateFrom,$dateTo)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
		}
		
		
		$this->db->select('*, users.id as empid, leaves.id as lid');	
		$this->db->from('leaves');
		$this->db->join('users','leaves.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		if($this->session->userdata('user_type') == 'A')
		{
		$this->db->where("(".$condi.")");
		}
		
		
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
		}
		
		if($dateFrom != 'all' || $dateTo != 'all')
		{
		   
		   
		   $this->db->where('leaves.leavefrom >=',$dateFrom);
		   $this->db->where('leaves.leavefrom <=',$dateTo);
	
	    }
		
			
		$this->db->limit($limit,$page);
		$this->db->order_by('leaves.id','desc');	
		$query = $this->db->get();
		
		return $query;
	}
	
	
	
	function getAllLeaveAppsTotal($dateFrom,$dateTo)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
		}
		
		
		$this->db->select('leaves.id, count(leaves.id) as tTotal');	
		$this->db->from('leaves');
		$this->db->join('users','leaves.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		if($this->session->userdata('user_type') == 'A')
		{
		$this->db->where("(".$condi.")");
		}
		
		
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
		}
		
		if($dateFrom != 'all' || $dateTo != 'all')
		{
		   
		   
		   $this->db->where('leaves.leavefrom >=',$dateFrom);
		   $this->db->where('leaves.leavefrom <=',$dateTo);
	
	    }
		
			
		return $this->db->get()->row()->tTotal;
	}
	
	function getAssignedProjects()
	{
		$this->db->select('*, users.id as empid');	
		$this->db->from('assign_project');
		$this->db->join('projects','assign_project.pid = projects.id');
		$this->db->join('users','assign_project.eid = users.id');
		$this->db->join('company','company.id = users.cid');
		$query = $this->db->get();
		
		return $query;
	}
	
	function getAttendance($limit,$page,$dateFrom,$dateTo,$today='Yes')
	{
		$condi= $this->Adminmodel->AdminAccesCondition();
		
		
		$this->db->select('*, users.id as empid');	
		$this->db->from('attendance');
		$this->db->join('users','attendance.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('users.active', 'Y');
		if($today =='Yes')
		{
		$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));
		}
		if($this->session->userdata('user_type') != 'SA')
		{
			if($condi ==true)
			{
		$this->db->where("(".$condi.")");
			}
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
		if($today != 'Yes')
		{	
	      if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('attendance.logindate >=',$dateFrom);
				 $this->db->where('attendance.logindate <=',$dateTo);
			}
			
		}
			
			
		$this->db->order_by('attendance.logindate','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		
		return $query;
	}
	
	
	
	function getTotalAttendance($dateFrom,$dateTo,$today='Yes')
	{
		$condi= $this->Adminmodel->AdminAccesCondition();
		
		
		$this->db->select('*, count(attendance.id) as tTotal');	
		$this->db->from('attendance');
		$this->db->join('users','attendance.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('users.active', 'Y');
		if($today =='Yes')
		{
		$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));
		}
		if($this->session->userdata('user_type') != 'SA')
		{
			if($condi ==true)
			{
		$this->db->where("(".$condi.")");
			}
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
		if($today != 'Yes')
		{	
	      if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('attendance.logindate >=',$dateFrom);
				 $this->db->where('attendance.logindate <=',$dateTo);
			}
			
		}
			
			
		
		
		return  $this->db->get()->row()->tTotal;
		
		
	}
	
	/* View Data */
	
	/* Editing Data */
	function getAdminInfo($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		
		//$this->db->where('user_type','A');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		
	}
	function getEmpInfo($id)
	{
		$this->db->select('*, users.active as uActive,users.id as emid,users.address as uaddress');	
		$this->db->from('users');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('users.id', $id);
		if($this->session->userdata('user_type') != 'SA')
		{
		$this->db->where('users.active', 'Y');
		}
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
		//Get empty base parent object, as $cid is NOT a customer
			$quote_obj=new stdClass();

			//Get all the fields from customers table
			$fields = $this->db->list_fields('users');

			foreach ($fields as $field)
			{
				$quote_obj->$field='';
			}

			return $quote_obj;
		}
	}
	
	function getCompInfo($id)
	{
		$this->db->select('*');	
		$this->db->from('company');
		$this->db->where('company.id', $id);
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $cid is NOT a customer
			$quote_obj=new stdClass();

			//Get all the fields from customers table
			$fields = $this->db->list_fields('company');

			foreach ($fields as $field)
			{
				$quote_obj->$field='';
			}

			return $quote_obj;
		}
	}
	
	function getAssignedProjectInfo($id)
	{
		$this->db->select('*, users.id as empid');	
		$this->db->from('assign_project');
		$this->db->join('projects','assign_project.pid = projects.id');
		$this->db->join('users','assign_project.eid = users.id');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('assign_project.id', $id);
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $cid is NOT a customer
			$quote_obj=new stdClass();

			//Get all the fields from customers table
			$fields = $this->db->list_fields('assign_project');

			foreach ($fields as $field)
			{
				$quote_obj->$field='';
			}

			return $quote_obj;
		}
	}
	
	function getProjectInfo($id)
	{
		$this->db->select('*');	
		$this->db->from('projects');
		$this->db->where('projects.id', $id);
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $cid is NOT a customer
			$quote_obj=new stdClass();

			//Get all the fields from customers table
			$fields = $this->db->list_fields('projects');

			foreach ($fields as $field)
			{
				$quote_obj->$field='';
			}

			return $quote_obj;
		}
	}
	
	function getIncrementInfo($id)
	{
		$this->db->select('*, users.id as empid');	
		$this->db->from('increments');
		$this->db->join('users','increments.empid = users.id');
		$this->db->join('company','company.id = users.cid');
		if($id != -1)
		{
		$this->db->where('increments.id', $id);
		}
		
		
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $cid is NOT a customer
			$quote_obj=new stdClass();

			//Get all the fields from customers table
			$fields = $this->db->list_fields('increments');

			foreach ($fields as $field)
			{
				$quote_obj->$field='';
			}

			return $quote_obj;
		}
	}
	/* Editing Data */
	function emp_name($eid){		$this->db->select('*');		$this->db->from('users');		$this->db->where('id',$eid);		$res=$this->db->get();		$res=$res->row();		return $res->contact_name;	}
	function getAllEmpList()
	{
		if($this->session->userdata('user_type') == 'A' || $this->session->userdata('user_type') == 'SA')
		{
			//$condi='';
			
			// $this->db->select('*');
			// $this->db->from('users');
			// $this->db->where('id',$this->session->userdata('id'));
			// $query2 = $this->db->get();
			// $query2 = $query2->row();
			
			 // $comnii = $query2->accessComp;	
			 
			// $comnii = explode(',',$comnii);
			// //print_r($comnii);exit;
			// if(count($comnii) >0 )
			// {
				// for($i=0; $i<count($comnii); $i++ )
				// {
					// $condi .= '`users`.`cid`='.$comnii[$i];
					
					// if($i+1 != count($comnii) )
					// {
						// $condi .= ' OR';
					// }
				// }
				
			// }
			
		
	    $this->db->select('*'); 
        $this->db->from('users');
		$this->db->where('active', 'Y');
		$this->db->where('user_type', 'E');
		$this->db->order_by('contact_name','asc');
		// if($this->session->userdata('user_type') == 'A')
		// {
		// $this->db->where("(".$condi.")");
		// }
		// if($this->session->userdata('global_comp') !=''){
			// $this->db->where('users.cid',$this->session->userdata('global_comp'));
			
		 // }
		}
		$query = $this->db->get();
		//print_r($query);exit;
		if($query->num_rows()>0){
		foreach($query->result_array() as $row){
            $data[$row['id']]=$row['contact_name'];
        }
		}
		else{
		$data['']='';	
		}
		return $data;	
	}
	
	function getAllProjectList()
	{    
	    $admin_where = $this->Adminmodel->AdminAccesPoject();
		
	    $this->db->select('*, clienproject.id as pID,clienproject.pName as ProName'); 
        $this->db->from('clienproject');
		$this->db->join('customers','customers.id=clienproject.clienId');
		$this->db->where('clienproject.status','R');
		if($this->session->userdata('user_type')== 'A')
		{
			if($admin_where)
			{
			$this->db->where('('.$admin_where.')');
			}
			
		}
	if($this->session->userdata('global_comp') !=''){
	        $this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
	
	     }
		$this->db->order_by('clienproject.pName','asc');
		$query = $this->db->get();
		if($query->num_rows()>0){
		foreach($query->result_array() as $row){
            $data[$row['pID']]=$row['ProName'];
        }
		}
		else{
		$data['']='';	
		}
		return $data;	
	}
	
	/* DELETION BEGIN */
	
	function delEmp($id)
	{	
		    $this->Adminmodel->delUsers($id);
			$this->Adminmodel->delworkReport($id);
			$this->Adminmodel->delAtten($id);
			$this->Adminmodel->delLeaves($id);
			$this->Adminmodel->delIncrement($id);
			$this->Adminmodel->delSalary($id);
			return true;
	}
	
	function delComp($id)
	{     
	
	 /*  $this->db->select('*');
	         $this->db->from('company');
			 $this->db->where('id',$id);
			 $query = $this->db->get();
			 if($query->num_rows ==1)
			 {
			    $query = $query->row();
				$active = $query->active;	 
			 }	
	
	         if($active == 'Y')
			 {
				if($this->db->update('company', array('active'=>'N'), array('id' => $id)))
				{
					return true;
				}
			 }
			 else
			 {
				 if($this->db->update('company', array('active'=>'Y'), array('id' => $id)))
				{
					return true;
				}
				 
			 }
			
			return false;*/
			
			$this->db->where('id',$id);
			$this->db->delete('company');
		$emp_list = $this->Adminmodel->listCompanyEmploye($id);
		if(count($emp_list) >0)
		{
			
			for($i=0; $i<count($emp_list); $i++)
			{ 
			
			/*Delete users list*/
			
			$this->Adminmodel->delUsers($emp_list[$i]);
			$this->Adminmodel->delworkReport($emp_list[$i]);
			$this->Adminmodel->delAtten($emp_list[$i]);
			$this->Adminmodel->delLeaves($emp_list[$i]);
			$this->Adminmodel->delIncrement($emp_list[$i]);
			$this->Adminmodel->delSalary($emp_list[$i]);
			/*End users List*/
			
			    	
			}
			
		}
			
			return true;
	}
	
	function delUsers($id)
	{
		 $this->db->where('id',$id);
		 $this->db->where('user_type !=','SA');
		 $this->db->delete('users');
		  
	}
	function delworkReport($id)
	{
	 $this->db->where('eid',$id);
	 $this->db->delete('work_reports');		
	}
	function delAtten($id)
	{
	 $this->db->where('empid',$id);
	 $this->db->delete('attendance');
	}
	function delIncrement($id)
	{
	 $this->db->where('empid',$id);
	 $this->db->delete('increments');
	}
	function delLeaves($id)
	{
	 $this->db->where('empid',$id);
	 $this->db->delete('leaves');
	}
	function delSalary($id)
	{
	 $this->db->where('emid',$id);
	 $this->db->delete('salary');
	}
	
	function listCompanyEmploye($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('cid',$id);
		
		$query = $this->db->get();
		if($query->num_rows >=1)
		{
		   foreach($query->result_array() as $row){
            $data[]=$row['id'];
                  
				   }	
		}
		else
		{
		$data = array();	
		}
		return $data;
		
	}
	
	/* DELETION END */
	function signinExists($id)
	{
		$this->db->from('attendance');
		$this->db->where('attendance.empid', $this->session->userdata('id'));
		$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	function saveSignin(&$signinArray, $id=false)
	{	
		if (!$id or !$this->signinExists($id))
		{
			if($this->db->insert('attendance', $signinArray))
			{
				return true;
			}
			
			return false;
		}

	}
	
	function signoutExists($id)
	{
		$this->db->from('attendance');
		$this->db->where('attendance.empid', $this->session->userdata('id'));
		$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));
		$this->db->where('attendance.signouttime !=', '');
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	function saveSignout(&$signoutArray, $id)
	{	
		if (!$id or !$this->signoutExists($id))
		{
			if($this->db->update('attendance', $signoutArray, array('empid' => $id, 'logindate' => strtotime(date('Y-m-d')))))
			{
				return true;
			}
			
			return false;
		}

	}
	
	function saveLeaveR(&$leaveArray, $id)
	{	
			if($this->db->insert('leaves', $leaveArray))
			{
				return true;
			}
			
			return false;

	}
	
	function togStatus($id, $status )
	{	
			if($this->db->update('leaves', array('approved' => $status), array('id'=>$id)))
			{
				return true;
			}
			
			return false;

	}
	
	
	function getAllPresence($id)
	{
		$this->db->select('*');	
		$this->db->from('attendance');
		$this->db->join('users','users.id = attendance.empid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('empid', $id);	
		$query = $this->db->get();
		
		return $query;
	}
	
	function getMyProject($id)
	{
		$this->db->select('*');	
		$this->db->from('assign_project');
		$this->db->join('projects','projects.id = assign_project.pid');
		$this->db->join('users','users.id = assign_project.eid');
		$this->db->where('assign_project.eid', $id);	
		$query = $this->db->get();
		
		return $query;
	}
	
	
	
	function savemyPDates(&$pArray, $id)
	{	
			if($this->db->update('assign_project', $pArray, array('id' => $id)))
			{
				return true;
			}
			
			return false;
		
	}
	
	function saveMyWork(&$wArray, $id)
	{	
			if($this->db->insert('work_reports', $wArray))
			{
				return true;
			}
			
			return false;

	}
	
	function getMyWorkReports($limit,$page,$dateFrom,$dateTo)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		$this->db->select('*, users.id as empid, work_reports.id as Wid');	
		$this->db->from('work_reports');
		$this->db->join('users','users.id = work_reports.eid');
		//$this->db->where('work_reports.reportdate',strtotime(date('Y-m-d')));
		
		
		if($this->session->userdata('user_type') != 'SA')
		{
		$this->db->where("(".$condi.")");
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
			
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('work_reports.reportdate >=',$dateFrom);
				 $this->db->where('work_reports.reportdate <=',$dateTo);
			}	
		//$this->db->where('work_reports.eid', $id);
		$this->db->order_by('work_reports.id','desc');
		$this->db->limit($limit,$page);	
		$query = $this->db->get();
		
		return $query;
	}
	
	
	function TotalgetMyWorkReports($dateFrom,$dateTo)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}
		$this->db->select('*, count(work_reports.id) as tottal');	
		$this->db->from('work_reports');
		$this->db->join('users','users.id = work_reports.eid');
		//$this->db->where('work_reports.reportdate',strtotime(date('Y-m-d')));
		
		
		if($this->session->userdata('user_type') != 'SA')
		{
		$this->db->where("(".$condi.")");
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
			if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('work_reports.reportdate >=',$dateFrom);
				 $this->db->where('work_reports.reportdate <=',$dateTo);
			}
		//$this->db->where('work_reports.eid', $id);
		$this->db->order_by('work_reports.id','desc');
		
		$query = $this->db->get();
		
		return $query->row()->tottal;
	}
	
	
	function get_emp_info($id)
	{
		$this->db->select('*, users.id as eid');
        $this->db->from('users');
		$this->db->join('company', 'company.id = users.cid');
		$this->db->where('users.id', $id);
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $cid is NOT a customer
			$quote_obj=new stdClass();

			//Get all the fields from customers table
			$fields = $this->db->list_fields('users');

			foreach ($fields as $field)
			{
				$quote_obj->$field='';
			}

			return $quote_obj;
		}
	}
	
	function projectExists($id)
	{
		$this->db->from('projects');
		$this->db->where('projects.id', $id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	function saveProj(&$pArray, $id=false)
	{	
		if (!$id or !$this->projectExists($id))
		{
			if($this->db->insert('projects', $pArray))
			{
				return true;
			}
			
			return false;
		}

		$this->db->where('id', $id);
		return $this->db->update('projects', $pArray);

	}
	
	function assignIt(&$fArray, $id)
	{	
			if($this->db->insert('assign_project', $fArray))
			{
				return true;
			}
			
			return false;

	}
	
	function Assignprojects(){
	// function Assignprojects($limit=50,$offset=0,$dateFrom,$dateTo,$status){   $admin_where = $this->Adminmodel->AdminAccesCondition();
		// $this->db->select('*, assign_project.status as assStatus');	
		// $this->db->from('assign_project');		
		// $this->db->join('clienproject','clienproject.id = assign_project.pid');
		// $this->db->join('users','users.id = assign_project.eid');
		// $this->db->join('company','company.id = users.cid');
		// if($this->session->userdata('user_type')== 'A')
		// {
			// if($admin_where)
			// {
			// $this->db->where('('.$admin_where.')');
			// }
			
		// }
		// if($this->session->userdata('global_comp') !=''){
	        // $this->db->where('users.cid',$this->session->userdata('global_comp'));
	
	     // }
		 
		 // if(($dateFrom !='all') || ($dateTo != 'all'))
			// {
				 // $this->db->where('assign_project.esdatefrom >=',$dateFrom);
				 // $this->db->where('assign_project.esdatefrom <=',$dateTo);
			// }
			
	    // if($status !='all')
		// {
			// $this->db->where('assign_project.status',$status);
		// }		
		
		// $this->db->order_by('assign_project.id','DESC');
		// $this->db->limit($limit,$offset);
		// $query = $this->db->get();
		
		// return $query;
		$this->db->select('*');		$this->db->from('assign_project');		$res=$this->db->get();		$res=$res->result_array();		return $res;
		
	}	
	
	function TotalAssignprojects($dateFrom,$dateTo,$status)
	{   $admin_where = $this->Adminmodel->AdminAccesCondition();
		$this->db->select('*, assign_project.status as assStatus, count(assign_project.id) as totalRow');	
		$this->db->from('assign_project');		
		$this->db->join('clienproject','clienproject.id = assign_project.pid');
		$this->db->join('users','users.id = assign_project.eid');
		$this->db->join('company','company.id = users.cid');
		if($this->session->userdata('user_type')== 'A')
		{
			if($admin_where)
			{
			$this->db->where('('.$admin_where.')');
			}
			
		}
		if($this->session->userdata('global_comp') !=''){
	        $this->db->where('users.cid',$this->session->userdata('global_comp'));
	
	     }
		 if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('assign_project.esdatefrom >=',$dateFrom);
				 $this->db->where('assign_project.esdatefrom <=',$dateTo);
			}
			
	    if($status !='all')
		{
			$this->db->where('assign_project.status',$status);
		}
		
	
		
		$query = $this->db->get();
		
		return $query->row()->totalRow;
		
		
	}
	
	
	function CompleteProjectRequestModule($limit=50,$offset=0)
	{
		$admin_where = $this->Adminmodel->AdminAccesCondition();
		$this->db->select('*, assign_project.status as assStatus,assign_project.id as AssignId');	
		$this->db->from('assign_project');
		$this->db->join('clienproject','clienproject.id = assign_project.pid');
		$this->db->join('users','users.id = assign_project.eid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('assign_project.completeReq','Y');	
		$this->db->where('assign_project.status !=','C');	
		if($this->session->userdata('user_type')== 'A')
		{
			if($admin_where)
			{
			$this->db->where('('.$admin_where.')');
			}
			
		}
		if($this->session->userdata('global_comp') !=''){
	        $this->db->where('users.cid',$this->session->userdata('global_comp'));
	
	     }
		 $this->db->limit($limit,$offset);
		$query = $this->db->get();		
		return $query;
		
		
	}
	
	function TotalCompleteProjectRequestModule()
	{
		$admin_where = $this->Adminmodel->AdminAccesCondition();
		$this->db->select('*, assign_project.status as assStatus,assign_project.id as AssignId,count(assign_project.id) as TotalRow');	
		$this->db->from('assign_project');
		$this->db->join('clienproject','clienproject.id = assign_project.pid');
		$this->db->join('users','users.id = assign_project.eid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('assign_project.completeReq','Y');	
		$this->db->where('assign_project.status !=','C');	
		if($this->session->userdata('user_type')== 'A')
		{
			if($admin_where)
			{
			$this->db->where('('.$admin_where.')');
			}
			
		}
		if($this->session->userdata('global_comp') !=''){
	        $this->db->where('users.cid',$this->session->userdata('global_comp'));
	
	     }
		$query = $this->db->get();		
		return $query->row()->TotalRow;
		
		
	}
	
	function salarySlipEmp($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
		
	}
	function SalaryCompany($id)
	{
	    $this->db->select('*');
		$this->db->from('company');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();	
	}
		
		
	function savesalary($salary)
	{
		if($this->db->insert('salary', $salary))
			{
				return true;
			}
			
			return false;
	}	
	
	function salarydetails($month='all',$limit='all',$page=0)
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}

		
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('users','users.id = salary.emid');
		$this->db->join('company','company.id= users.cid');
		$this->db->where('salary.start','N');
		if($this->session->userdata('user_type') != 'SA')
		{
			$this->db->where("(".$condi.")");
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
			if($month != 'all')
			{
				
				$this->db->where('salary.pay_month',$month);
				
			}
			if($limit != 'all')
			{
		$this->db->limit($limit,$page);
			}
		return $this->db->get();
	}
	
	
	
	
	function salarydetailsSap($id,$month)
	{
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('users','users.id = salary.emid');
		$this->db->join('company','company.id= users.cid');
		$this->db->where('salary.emid',$id);
		$this->db->where('salary.pay_month',$month);
		return $this->db->get();
	}
	
	function salarydetailsTotal($month='all')
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}

		
		$this->db->select('*,count(salary.id) as total');
		$this->db->from('salary');
		$this->db->join('users','users.id = salary.emid');
		$this->db->join('company','company.id= users.cid');
		$this->db->where('salary.start','N');
		if($this->session->userdata('user_type') != 'SA')
		{
			$this->db->where("(".$condi.")");
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
			if($month != 'all')
			{
				
				$this->db->where('salary.pay_month',$month);
				
			}
		
		return $this->db->get()->row()->total;
	}
	
	
	function salaryamountTotal($month='all')
	{
		if($this->session->userdata('user_type') == 'A')
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
					$condi .= '`users`.`cid`='.$comnii[$i];
					if($i+1 != count($comnii) )
					{
						$condi .= ' OR';
					}
				}
				
			}
			
		}

		
		$this->db->select('*,sum(salary.amount) as total');
		$this->db->from('salary');
		$this->db->join('users','users.id = salary.emid');
		$this->db->join('company','company.id= users.cid');
		$this->db->where('salary.start','N');
		if($this->session->userdata('user_type') != 'SA')
		{
			$this->db->where("(".$condi.")");
		}
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			
			if($month != 'all')
			{
				
				$this->db->where('salary.pay_month',$month);
				
			}
		
		return $this->db->get()->row()->total;
	}
	
	function adminName($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
		
	}
		
	
	function getAEmployeeInCompany($cid)
	{
		$this->db->select('*, count(id) as AempNo');
		$this->db->from('users');
		$this->db->where('cid',$cid);
		$this->db->where('user_type','E');
		$this->db->where('active','Y');
		return $this->db->get();
		
	}
	function getDEmployeeInCompany($cid)
	{
		$this->db->select('*, count(id) as DempNo');
		$this->db->from('users');
		$this->db->where('cid',$cid);
		$this->db->where('user_type','E');
		$this->db->where('active','N');
		return $this->db->get();
		
	}	
	
	function salarySlipAdminAccess($id)
	{
	 $this->db->select('*');
	 $this->db->from('users');
	 $this->db->where('id',$id);
	 $query = $this->db->get();
	 if($query->num_rows == 1)
	 {
		 $query = $query->row();
		 
		 $cid = $query->cid;
		 $this->load->model('User', 'User');
		 $cList =  $this->User->getACompanies();
		 foreach(array_keys($cList) as $key)
					{
						if($key == $cid)
						{
						return true;	
						}
						
					}
		 
	  }
	  else
	  {
	     return false;	  
	  }
	 
	 	
	}
	
	
	
	
	function saveBonusData($bonusArray)
	{
		if($this->db->insert('bonus', $bonusArray))
			{
				return true;
			}
			
			return false;
		
		
	}
	function viewBonus()
	{
		$condi = $this->AdminAccesCondition();
		
		$this->db->select('*, bonus.id as bid, bonus.date as bonusDate');
		$this->db->from('bonus');
		$this->db->join('users','users.id= bonus.empid');
		$this->db->order_by('bonus.id','desc');
		//$this->db->group_by('bonus.month');
		if($this->session->userdata('user_type') != 'SA')
		{
			$this->db->where('users.active', 'Y');
			if($condi == true)
			{
			$this->db->where("(".$condi.")");
			}
		}
		
		return $query= $this->db->get();
		
		
	}
	
	function viewInsentive($limit,$page,$dateFrom,$dateTo)
	{
		$condi = $this->AdminAccesCondition();
		
		$this->db->select('*, insentive.id as bid');
		$this->db->from('insentive');
		$this->db->join('users','users.id= insentive.empid');
		$this->db->order_by('insentive.id','desc');
		//$this->db->group_by('bonus.month');
		if($this->session->userdata('user_type') != 'SA')
		{
			$this->db->where('users.active', 'Y');
			if($condi == true)
			{
			$this->db->where("(".$condi.")");
			}
		}
		
		
		if($dateFrom != 'all' || $dateTo != 'all')
		{
		   
		   
		   $this->db->where('insentive.date >=',$dateFrom);
		   $this->db->where('insentive.date <=',$dateTo);
	
	    }
		
		$this->db->limit($limit,$page);
		$this->db->order_by('insentive.date','desc');
		return $query= $this->db->get();
		
		
	}
	function InsentiveTotal($dateFrom,$dateTo)
	{
		$condi = $this->AdminAccesCondition();
		
		$this->db->select('*, count(insentive.id) as Ttotal');
		$this->db->from('insentive');
		$this->db->join('users','users.id= insentive.empid');
		$this->db->order_by('insentive.id','desc');
		//$this->db->group_by('bonus.month');
		if($this->session->userdata('user_type') != 'SA')
		{
			$this->db->where('users.active', 'Y');
			if($condi == true)
			{
			$this->db->where("(".$condi.")");
			}
		}
		
		
		if($dateFrom != 'all' || $dateTo != 'all')
		{
		   
		   
		   $this->db->where('insentive.date >=',$dateFrom);
		   $this->db->where('insentive.date <=',$dateTo);
	
	    }
		
		
		return $query= $this->db->get()->row()->Ttotal;
		
		
	}
	
	function FindBonus($month,$id)
	{
	  $this->db->select('*, sum(amount) as bonusA');
	  $this->db->from('bonus');
	  $this->db->where('month',$month);
	  $this->db->where('empid',$id);	
	 $query= $this->db->get();
	 if($query->num_rows() >= 1)
	 {
	   return $query= $query->row()->bonusA;
	 }
	 else
	 {
		 return 0;
	 }
	
 	}
	
	function Findinsentive($month,$id)
	{
	  $this->db->select('*, sum(amount) as insentiveA');
	  $this->db->from('insentive');
	  $this->db->where('month',$month);
	  $this->db->where('empid',$id);	
	  $query= $this->db->get();
		 if($query->num_rows() >= 1)
		 {
		   return $query= $query->row()->insentiveA;
		 }
		 else
		 {
			 return 0;
		 }
	
 	}
	
	
	function incrementfilter($date)
	{
		$from = strtotime($date);
		$to = strtotime(date('Y-m-t',$from));
		$this->db->select('*');
		$this->db->from('increments');
		$this->db->join('users','users.id = increments.empid');
		$this->db->where('increments.doi >=',$from);
		$this->db->where('increments.doi <=',$to);		
		return $this->db->get();
		
	}
	
	function bonusfilter($date)
	{
		$from = strtotime($date);
		$to = strtotime(date('Y-m-t',$from));
		$this->db->select('* , sum(bonus.amount) as Tamount');
		$this->db->from('bonus');
		$this->db->join('users','users.id= bonus.empid');
		$this->db->where('bonus.date >=',$from);
		$this->db->where('bonus.date <=',$to);	
		$this->db->group_by('bonus.month');	
		return $this->db->get();
		
		
		/*$this->db->select('*, sum(bonus.amount) as Tamount');
		$this->db->from('bonus');
		$this->db->join('users','users.id= bonus.empid');
		$this->db->order_by('bonus.id','desc');
		$this->db->group_by('bonus.month');
		return $query= $this->db->get();*/
		
	}
	
	function incrementAdd($id)
	{
		
		
				   		
						$inDate = $this->Adminmodel->runMonthsalary($id).'-01';
						$from = strtotime(date_format(new DateTime($inDate),'Y-m-d'). " +1 month");
				        $to = strtotime(date('Y-m-t',$from));
						$inc =0;
						/*Find This month Increment */
						 if($this->Adminmodel->findIncreament($id,$to))
						 {
							 $inc= $this->Adminmodel->findIncreament($id,$to);
						  }
						  /*End*/
						return $inc;
						 
		
	}
	
	
	function findIncreament($id,$till)
		{
			$this->db->select('*, sum(increment) as IncValue');
			$this->db->from('increments');
			$this->db->where('empid',$id);
			//$this->db->where('added','N');
			//$this->db->where('doi >=',$from);
			$this->db->where('doi <=',$till);
			$query = $this->db->get();
			if($query->num_rows() >=1)
			{
				$query = $query->row();
			 return $query->IncValue;
			}
			else
			{
			return false;	
			}
			
			
			
			
		}
		
		
		function delBonus($id)
		{
			
						
			
			$this->db->where('id',$id);
			$this->db->delete('bonus');
			return true;
			
	    }
	
	
	function Vreport($id)
	{
		$this->db->select('*');
		$this->db->from('work_reports');
		$this->db->join('users','users.id = work_reports.eid');
		$this->db->where('work_reports.id',$id);
		 $query = $this->db->get();
		 if($query->num_rows() ==1)
		 {
		return $query = $query->row();
		 }
		 else
		 {
			 return false;
			}
		
		
		
	}
	
    function viewResignDetails($limit,$page,$dateFrom,$dateTo)
	{
		$condition = $this->AdminAccesCondition();
		$this->db->select('*, resign.id as rid, users.id as Empid');
		$this->db->from('resign');
		$this->db->join('users','users.id=resign.eid');
		if($condition == true)
		{
	      $this->db->where("(".$condition.")");
		}
		
		if(($dateFrom !='all') || ($dateTo != 'all'))
		{
			 $this->db->where('resign.sendDate >=',$dateFrom);
			 $this->db->where('resign.sendDate <=',$dateTo);
		}	
		$this->db->order_by('resign.status','desc');
		$this->db->order_by('resign.senddate','asc');
		
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
			$this->db->limit($limit,$page);
		
		return $this->db->get();
		
	}
	
	function TotalResignLatter($dateFrom,$dateTo)
	{
	  $condition = $this->AdminAccesCondition();
		$this->db->select('resign.id, count(resign.id) as tTotal');
		$this->db->from('resign');
		$this->db->join('users','users.id=resign.eid');
		if($condition == true)
		{
	      $this->db->where("(".$condition.")");
		}
		$this->db->order_by('resign.status','desc');
		$this->db->order_by('resign.senddate','asc');
		
		if(($dateFrom !='all') || ($dateTo != 'all'))
		{
			 $this->db->where('resign.sendDate >=',$dateFrom);
			 $this->db->where('resign.sendDate <=',$dateTo);
		}	
		
		if($this->session->userdata('global_comp') !=''){
			$this->db->where('users.cid',$this->session->userdata('global_comp'));
			
			}
		
		return $this->db->get()->row()->tTotal;	
	}
	
	function ResignUpdate($id,$array)
	
	{
		$this->db->where('id', $id);
		return $this->db->update('resign', $array);
		 
		 
	}
	
	function ResignToEmployee($id)
	{
		$this->db->select('*');
		$this->db->from('resign');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$query = $query->row();
		
		return $query->eid;
	
	}
	
	function DisableEmployee($id)
	{
		$eid = $this->ResignToEmployee($id);
		
		$this->db->where('id', $eid);
		return $this->db->update('users', array('active'=>'N'));
		//$q
		
	}
	function DeleteResign($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('resign');
	}
    
	
	function AdminAccessCompany()
	{
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$this->session->userdata('id'));
		$this->db->where('user_type','A');
		$query = $this->db->get();
		
		if($query->num_rows() >=1)
		{
			$query = $query->row();
			
			 $accesComp = $query->accessComp;
			 if($accesComp !='' || $accesComp != null)
			 {
				 return explode(',',$accesComp);
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
	
	function getUserTableInfo($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
		
	}
	function resignUrlPermission($id)
	{
		if($this->AdminAccessCompany())
		{
			$accesComp = $this->AdminAccessCompany();
			$eid = $this->ResignToEmployee($id);
			$cid = $this->getUserTableInfo($eid)->cid;
			
			for($i=0; $i<count($accesComp); $i++)
			{
			     if($cid == $accesComp[$i])
				 {
				  return true;	 
				 }	
			}
			
			return false;
		
			
		}
		else
		{
			return false;
			
		}
		
	}
	
	
	function AdminAccesCondition()
	{
					
							$condi='';
							
							$this->db->select('*');
							$this->db->from('users');
							$this->db->where('id',$this->session->userdata('id'));
							$this->db->where('user_type','A');
							
							$query2 = $this->db->get();
							
							if($query2->num_rows() >=1)
							{
									$query2 = $query2->row();
									
									
									 $comnii = $query2->accessComp;	
									$comnii = explode(',',$comnii);
									
									if(count($comnii) >0 )
									{
										for($i=0; $i<count($comnii); $i++ )
										{
											$condi .= '`users`.`cid`='.$comnii[$i];
											if($i+1 != count($comnii) )
											{
												$condi .= ' OR';
											}
										}
										
									}
							}
							
							
							
						if($condi != '')
						{
							return $condi;
						}
						else
						{
						return false;	
						}

	}
	
	function saveDocuments($Darray)
	{
		if($this->db->insert('document', $Darray))
			{
				return true;
			}
		
	}
	
	function getDocument($id)
	{
		$this->db->select('*');
		$this->db->from('document');
		$this->db->where('emid',$id);
		$query = $this->db->get();
		if($query->num_rows() >=1)
		{
		  return $query;	
		}
		else
		{
		return false;	
		}
		
		
	}
	
	
		function delDocument($id)
		{
			$this->db->where('id',$id);
			return $this->db->delete('document');
			
			}


		function delInc($id)
		{
			$this->db->where('id',$id);
				return $this->db->delete('increments');
		}


		function IncToEid($id)
		{
			$this->db->select('*');
			$this->db->from('increments');
			$this->db->where('id',$id);
			
			$query = $this->db->get();
			if($query->num_rows >=1)
			{
				$query = $query->row();
				
				return $query->empid;
			}
			else
			{
				return false;
			}
			
			
		}
		
		function bonusToEid($id)
		{
			$this->db->select('*');
			$this->db->from('bonus');
			$this->db->where('id',$id);
			
			$query = $this->db->get();
			if($query->num_rows >=1)
			{
				$query = $query->row();
				
				return $query->empid;
			}
			else
			{
				return false;
			}
			
			
		}
		
		function IncrementUrlPermission($id)
		{
			if($this->AdminAccessCompany())
		     {
				$accesComp = $this->AdminAccessCompany();
				$eid = $this->IncToEid($id);
				$cid = $this->getUserTableInfo($eid)->cid;
				
				for($i=0; $i<count($accesComp); $i++)
				{
					 if($cid == $accesComp[$i])
					 {
					  return true;	 
					 }	
				}
				
				return false;
			
			
		    }
			else
			{
				return false;
				
			}
			
		}



			function BonusUrlPermission($id)
					{
						if($this->AdminAccessCompany())
						 {
							$accesComp = $this->AdminAccessCompany();
							$eid = $this->bonusToEid($id);
							$cid = $this->getUserTableInfo($eid)->cid;
							
							for($i=0; $i<count($accesComp); $i++)
							{
								 if($cid == $accesComp[$i])
								 {
								  return true;	 
								 }	
							}
							
							return false;
						
						
						}
						else
						{
							return false;
							
						}
						
					}
					
	
	function getCompanyEmp ($cid)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('cid',$cid);
		$this->db->where('active','Y');
		$this->db->where('user_type','E');
		$query = $this->db->get();
		if($query->num_rows() >=1)
	    {
			$data = array();
			foreach($query->result_array() as $row){
				$data[$row['id']]=$row['contact_name'];
				
			}
			return $data;
		}
		else
		{
			return false;
		}
	}
	
	function AssignSave($ary)
	{
		
		if($this->db->insert('assign_project',$ary))
		{
		return true;
		}
		
		
		
	}
	
	
	function ProjecjComplete($arr,$id)
	{
		$this->db->where('id',$id);
		if($this->db->update('assign_project',$arr))
		{
		return true;	
		}
		
	}
	
	
	function CompanyProject($cid,$status)
	 {
		 $this->db->select('*, count(clienproject.id) as NoProject');
		 $this->db->from('clienproject');
		 $this->db->join('customers','customers.id = clienproject.clienId');
		 $this->db->where('customers.bycompany',$cid);
		 $this->db->where('clienproject.status',$status);
		 
		 $query = $this->db->get();
		 
		 return $query->row()->NoProject;
		
	 }
	 
	 function saveInsentiveData($arr)
     {
		 
	     if($this->db->insert('insentive',$arr))
		 {
		   return true;	 
		 }	 
	 }
	
	
	
	function InsentiveToEid($id)
	{
	   $this->db->select('empid');
	   $this->db->from('insentive');	
	   $this->db->where('id',$id);
	   $query = $this->db->get();
	   
	   return $query->row()->empid;
	}
	
	function InsentiveUrlPermission($id)
					{
						if($this->AdminAccessCompany())
						 {
							$accesComp = $this->AdminAccessCompany();
							$eid = $this->InsentiveToEid($id);
							$cid = $this->getUserTableInfo($eid)->cid;
							
							for($i=0; $i<count($accesComp); $i++)
							{
								 if($cid == $accesComp[$i])
								 {
								  return true;	 
								 }	
							}
							
							return false;
						
						
						}
						else
						{
							return false;
							
						}
						
					}
					
	function delInsentive($id)
		{
			
						
			
			$this->db->where('id',$id);
			if($this->db->delete('insentive'))
			{
			return true;
			}
			else
			{
			 return false;	
			}
			
	    }
		
		function AssignFilter($date,$status,$r)
		{
			if($status !='' )
			{	
				if($status =='Y')
				{
					$from = $date.'-01-01';
					$from = strtotime(date('Y-m-d',strtotime($from)));
					$to = $date.'-12-31';
					$to = strtotime(date('Y-m-d',strtotime($to)));	
				}
				else if($status =='MY' || $status =='M' )
				{
					$from = $date.'-01';
					$to = $date.'-31';
					$to = strtotime(date('Y-m-d',strtotime($to)));	
					$from = strtotime(date('Y-m-d',strtotime($from)));
					
					
				}
				
			}
			
					$this->db->select('*, assign_project.status as assStatus');	
					$this->db->from('assign_project');	
					$this->db->join('clienproject','clienproject.id = assign_project.pid');
					$this->db->join('users','users.id = assign_project.eid');
					$this->db->join('company','company.id = users.cid');
		            if($status !='' )
					{
					 $this->db->where('assign_project.esdatefrom >=',$from);
					 $this->db->where('assign_project.esdatefrom <=',$to);
					}
					if($r !='')
					 {
						 $this->db->where('assign_project.status',$r);
					  }
					$this->db->limit('50','0');
					return $this->db->get();  
			
		}
		
		function AdminAutho($pageId)
		{
		  if($this->session->userdata('user_type') =='A')
		  {
			  $this->db->select('adminAutho');
			  $this->db->from('users');
			  $this->db->where('id',$this->session->userdata('id'));
			  $query = $this->db->get();
			  $authori = $query->row()->adminAutho;
			  $authori = explode(',',$authori);
			  if(count($authori)>0)
			  {
				  if(in_array($pageId,$authori))
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
		  
		  else
		  {
			  return true;
		  }	
		}
		
	
	function AuthoUrl()
	{
		      $this->db->select('adminAutho');
			  $this->db->from('users');
			  $this->db->where('id',$this->session->userdata('id'));
			  $query = $this->db->get();
			  $authori = $query->row()->adminAutho;
			  
			  return explode(',',$authori);
	 }
	 
	 function AuthoUrlbyId($id)
	{
		      $this->db->select('adminAutho');
			  $this->db->from('users');
			  $this->db->where('id',$id);
			  $query = $this->db->get();
			  $authori = $query->row()->adminAutho;
			  
			  return explode(',',$authori);
	 }
	 
	 function resignDate($id)
	 {
	   $this->db->select('dateResign');
	   $this->db->from('resign');
	   $this->db->where('eid',$id);
	   $this->db->where('status','R');
	   $query = $this->db->get();
	   if($query->num_rows() >0)
	   {
		   
		   return date('d-M-Y',$query->row()->dateResign);
	   }
	   else
	   {
		 return 'NotAccordingToSystem';   
	   }
	   	 
     }
	
	
	function employeeCode($cid)
	{
		$this->db->select('max(employeeCode) as maxi');
		$this->db->from('users');
		$this->db->where('cid',$cid);
		$query = $this->db->get();
		return ($query->row()->maxi+1);
		
	}
	
	
	function AdminAccesPoject()
	{
					
							$condi='';
							
							$this->db->select('*');
							$this->db->from('users');
							$this->db->where('id',$this->session->userdata('id'));
							$this->db->where('user_type','A');
							
							$query2 = $this->db->get();
							
							if($query2->num_rows() >=1)
							{
									$query2 = $query2->row();
									
									
									 $comnii = $query2->accessComp;	
									$comnii = explode(',',$comnii);
									
									if(count($comnii) >0 )
									{
										for($i=0; $i<count($comnii); $i++ )
										{
											$condi .= '`customers`.`bycompany`='.$comnii[$i];
											if($i+1 != count($comnii) )
											{
												$condi .= ' OR';
											}
										}
										
									}
							}
							
							
							
						if($condi != '')
						{
							return $condi;
						}
						else
						{
						return false;	
						}

	}
	
	function findHolidayOfMonth($id,$cid)
	{
		$holidayList = array();
		$month = $this->Adminmodel->runMonthsalary($id);
	  $firstDate = strtotime(date('Y-m-d',strtotime(date('Y-m-d',strtotime($month.'-01')).'+1 month')));
	  
	   $lastDate =	strtotime(date('Y-m-t',$firstDate));
	   $this->db->select('*');
	   $this->db->from('holidays');
	  $this->db->where('date >=',$firstDate);
	   $this->db->where('date <=',$lastDate);
	   $this->db->where('day !=','Sun');
	   $this->db->where('cid',$cid);
	   $query = $this->db->get();
	   foreach($query->result() as $row)
	   {
		   $holidayList[] = $row->date;   
	   }
	   return $holidayList;
	}
	
	
	function leaveInholiday($id,$cid)
	{
		
		$lastholi = $this->Adminmodel->leaveInHolidayNextMonth($id,$cid);
		
				$no = $lastholi;
		  
		  
		$holidayList =   $this->Adminmodel->findHolidayOfMonth($id,$cid);
		
	  $month = $this->Adminmodel->runMonthsalary($id);
	  $firstDate = strtotime(date('Y-m-d',strtotime(date('Y-m-d',strtotime($month.'-01')).'+1 month')));
	  $lastDate =	strtotime(date('Y-m-t',$firstDate));
		$this->db->select('*');
		$this->db->from('leaves');
	    $this->db->where('leavefrom >=',$firstDate);
	    $this->db->where('leavefrom <=',$lastDate);
	    $this->db->where('empid',$id);
		$this->db->where('fullday >',0);
		$this->db->where('approved','Y');
		
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			$leaveFrom = $row->leavefrom;
			$leaveTo  = ($row->leaveto >=$lastDate)?$lastDate:$row->leaveto;
			
			$date = date('Y-m-d',$leaveFrom);
			$days = (($leaveTo-$leaveFrom)/86400)+1;
			for($i=0; $i<$days; $i++)
			{
				$ondate = strtotime($date);
				if(in_array($ondate,$holidayList))
				{
				  $no++;	
				}
				$date = $date.'+1 day';
				
			}
			
			
			
		}
		return $no;
		
		
	}
	
	function leaveInHolidayNextMonth($id,$cid)
	{
		$no =0;
		$holidayList =   $this->Adminmodel->findHolidayOfMonth($id,$cid);
		$month = $this->Adminmodel->runMonthsalary($id);
		
		/*Current Month Date*/
		$firstDate = strtotime(date('Y-m-d',strtotime(date('Y-m-d',strtotime($month.'-01')).'+1 month')));
	    $lastDate =	strtotime(date('Y-m-t',$firstDate));
		/*End */
		$this->db->select('*');
		$this->db->from('leaves');
		$this->db->where('leavefrom <',$firstDate);
		$this->db->where('leaveto >=',$firstDate);
		/*$this->db->where('leaveto <=',$lastDate);*/
		$this->db->where('empid',$id);
		$this->db->where('fullday >',0);
		$this->db->where('approved','Y');
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			//$leaveFrom = $row->leavefrom;
			
			/*$lastDayOfMonth = strtotime(date('Y-m-t',$leaveFrom));*/
			
			$leaveTo  = ($row->leaveto >=$lastDate)?$lastDate:$row->leaveto;
			
			$date = date('Y-m-d',$firstDate);
			$days = (($leaveTo-$firstDate)/86400)+1;
			
			for($i=0; $i<$days; $i++)
			{
				$ondate = strtotime($date);
				if(in_array($ondate,$holidayList))
				{
				  $no++;	
				}
			
				$date = $date.'+1 day';
			
				
			
			}
			
			return $no;
			
		}
		//return $no;
	}
	
	
	function employeeLeave($id)
	{
		$no = $this->Adminmodel->employeeLeaveBefore($id);
		$month = $this->Adminmodel->runMonthsalary($id);  // format 2014-01(Y-m)
		
		/*Current Month Date*/
		$firstDate = strtotime(date('Y-m-d',strtotime(date('Y-m-d',strtotime($month.'-01')).'+1 month')));
	    $lastDate =	strtotime(date('Y-m-t',$firstDate));
		/*End */
		$this->db->select('*');
		$this->db->from('leaves');
	    $this->db->where('leavefrom >=',$firstDate);
	    $this->db->where('leavefrom <=',$lastDate);
	    $this->db->where('empid',$id);
		$this->db->where('fullday >',0);
		$this->db->where('approved','Y');
		
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			$sunday =0;
			$leaveFrom = $row->leavefrom;
			$leaveTo  = ($row->leaveto >=$lastDate)?$lastDate:$row->leaveto;
			$date = date('Y-m-d',$leaveFrom);
			$days = (($leaveTo-$leaveFrom)/86400)+1;
			for($i=0; $i<$days; $i++)
			{
				$ondate = strtotime($date);
				
				if(date('D',$ondate)=='Sun')
				{
				  $sunday++;	
				}
				
				$date = $date.'+1 day';
				
			}
			$no = $no + ($days-$sunday);
			
		}
		return $no;
		
	}
	
	function employeeLeaveBefore($id)
	{
		$no = 0;
		$month = $this->Adminmodel->runMonthsalary($id);  // format 2014-01(Y-m)
		
		/*Current Month Date*/
		$firstDate = strtotime(date('Y-m-d',strtotime(date('Y-m-d',strtotime($month.'-01')).'+1 month')));
	    $lastDate =	strtotime(date('Y-m-t',$firstDate));
		/*End */
		$this->db->select('*');
		$this->db->from('leaves');
	    $this->db->where('leavefrom <',$firstDate);
		$this->db->where('leaveto >=',$firstDate);
	    $this->db->where('empid',$id);
		$this->db->where('fullday >',0);
		$this->db->where('approved','Y');
		
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			$sunday =0;
			$leaveTo  = ($row->leaveto >=$lastDate)?$lastDate:$row->leaveto;
			
			$date = date('Y-m-d',$firstDate);
			$days = (($leaveTo-$firstDate)/86400)+1;
			
			for($i=0; $i<$days; $i++)
			{
				$ondate = strtotime($date);
				
				if(date('D',$ondate)=='Sun')
				{
				  $sunday++;	
				}
				
				$date = $date.'+1 day';
				
			}
			$no = $no + ($days-$sunday);
			
		}
		return $no;
		
	}
	
	
	
	function employeSalayD($id)
	{
	 	$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('users','users.id= salary.emid');
		$this->db->where('salary.emid',$id);
		$this->db->where('salary.start','N');
		
		return $this->db->get();	
	}
	
     function EmpJoinMonth($id)
	 {
	   $this->db->select('doj');
	   $this->db->from('users');
	   $this->db->where('id',$id);
	   $date = $this->db->get()->row()->doj;
	   
	   $m = strtotime(date('Y-m-d',$date) .' -1 month');
	   return date('Y-m',$m);
	   	 
	 }
	 
	 function sign_in($data){
		 $insert=array(
		 "user_id"=> $data,
		 "sign_in"=> strtotime(date('Y-m-d H:i:s')),
		 "date" => date('Y-m-d')
		 );
		 
		 $res=$this->db->insert('user_attendance',$insert);
		 //echo $this->db->last_query();exit;
		return($res);
	 }
	 function sign_out($data){
		 $update=array("sign_t"=>"signout",
		 "sign_out"=> strtotime(date('Y-m-d H:i:s'))
		 );
		 $this->db->where('user_id',$data);
		 $this->db->where('date',date('Y-m-d'));
		$res=$this->db->update('user_attendance',$update);
		 return $res;
	 }
	 function work_time($data){
		 $this->db->select('sign_in,sign_out');
		 $this->db->from('user_attendance');
		 $this->db->where('user_id',$data);
		 $this->db->where('date',date('Y-m-d'));
		 $date =$this->db->get();
		 $date =$date->result_array();
		 //return $date;
		 //print_r(date("Y-m-d H:i:s",$date[0]['sign_out']))."<br>";
		//echo  strtotime($date[0]['sign_out']);exit;
		$minutes= round(abs($date[0]['sign_out'] - $date[0]['sign_in']) / 60,2). " minute";
	   //$from_time=strtotime(date('Y-m-d H:i:s'),$date[0]['sign_out'])."<br>";
		//echo //$to_time=strtotime(date('Y-m-d H:i:s'),$date[0]['sign_in']);
		//$diff=round(abs($from_time - $to_time) / 60,2). " minute";
		//print_r($diff);exit;
		//print_r($diff);exit;
		 $update=array("working_minutes"=>$minutes);
		 $this->db->where('user_id',$data);
		 $this->db->where('date',date('Y-m-d'));
		 $res=$this->db->update('user_attendance',$update);
		 return $res;
		//return($date);
		 // $date=$date->row();
		 // $to_time = strtotime(date('Y-m-d H:i:s',$date));
		 // print_r($to_time);exit;
		 // $this->db->select('sign_out');
		 // $this->db->from('user_attendance');
		 // $this->db->where('user_id',$data);
		 // $date1 =$this->db->get();
		 // $date1=$date->row();
		// $from_time = strtotime(date('Y-m-d H:i:s',$date1));
	 // return round(abs($to_time - $from_time) / 60,2). " minute";
	 }
	 function AdminInfo()
	{
		$this->db->select('*');
		$this->db->from('add_user');
		$query = $this->db->get();
		return $query->result_array();
		}
		function userStatus(){
		$role=$this->input->post('role');
		$userType=$this->input->post('roll');
		//print_r($role);print_r($userType);exit;
		$this->db->select('*');
		$this->db->from('add_user');
		$this->db->where_in('id',$role);
		$query = $this->db->get()->result_array();
		// $last=$this->db->last_query();
		// print_r($last);
		return $query;
		}
		public function updateUserRoles($data) {
			$role=$this->input->post('role');
			$userType=$this->input->post('roll');
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where_in('cid',$role);
			$query2 = $this->db->get();
			if($query2->num_rows() > 0)
			{
				//print_r($query2->num_rows());exit;
				$update=array("user_type"=>$userType);				
				$this->db->where_in('cid',$role);
				$this->db->update("users",$update);
				// $last=$this->db->last_query();
				// print_r($last);exit;
			}else{
				foreach($data as $multidata){
				$insert= [
					"cid"=>$multidata['id'],
					"contact_name"=>$multidata['Name'],
					"employeeCode"=>$multidata['Emp_id'],
					"designation"=>$multidata['Designation'],
					"contact_email"=>$multidata['Email_id'],
					"password"=>$multidata['Password'],
					"plain"=>$multidata['Password'],
					"emergency_number"=>$multidata['Emergency_Number'],
					"dob"=>$multidata['Date_of_Birth'],
					"doj"=>$multidata['Joining_Date'],
					"department"=>$multidata['Department'],
					"gender"=>$multidata['Gender'],
					"phone_num"=>$multidata['Contact_No'],
					"address"=>$multidata['Address'],
					"user_type"=>$userType
					];
				$this->db->insert("users",$insert);
			}
			}
			
		
		
		}
	// public function newUser(){
		// if(user_type = ""){
			// $insert=array("user_type"=>)
		// }
	// }
}
?>