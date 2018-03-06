<?php

class Employee extends CI_Model
{	function getProjectUpdate($emp_id)	{		$query1 = $this->db->query("SELECT add_project.*, assign_project.* FROM add_project INNER JOIN assign_project ON add_project.id = assign_project.pid WHERE assign_project.eid=".$emp_id);		return $query1->result_array();	}	
	function signinExists()
	{
		$this->db->from('attendance');
		$this->db->where('attendance.empid', $this->session->userdata('id'));
		$this->db->where('attendance.signouttime', null);
		$query = $this->db->get();
		
		if ($query->num_rows()>=1)
		{
			
			return false;
		}
		else
		{
		 return true;	
		}
	}
	
	function saveSignin($signinArray)
	{	
		if ($this->signinExists())
		{
			if($this->db->insert('attendance', $signinArray))
			{
				return true;
			}
			
			
		}
		else
		{
			$this->session->set_flashdata('failed','You had missed the last Sign Out. Please do Sign Out for New Sign In.');
			return false;
			/*$signRemark = "<b class='remak'>Sign In Remark:</b> " .$this->getRemarkPreSignIn($this->session->userdata('id')) ."<br/><b class='remak'>Sign Out Remark:</b> "
			.'Sorry! I Had Not Done Signout Yesterday.';
											$signoutArray = array(
											'signouttime' => strtotime('-1 day',strtotime(date('Y-m-d'))),
											'remark'=> $signRemark
											);
			$this->db->update('attendance', $signoutArray, array('empid' => $this->session->userdata('id'), 'logindate' => strtotime('-1 day', strtotime(date('Y-m-d')))));
			
		    $this->session->set_flashdata('success', 'You Had Not Done Signout Yesterday That Why I Have Filled Your Data, Now You Can Sign in Today. ');
			return false;*/
			
		}


	}
	
	function signoutExists()
	{
		$this->db->from('attendance');
		$this->db->where('attendance.empid', $this->session->userdata('id'));
		$this->db->where('attendance.signouttime', null);
		$query = $this->db->get();
		
		if ($query->num_rows()==1)
		{
		return true;	
		}
		else
		{
		return false;	
		}
	}
	
	function saveSignout($signoutArray)
	{	
		if ($this->signoutExists())
		{
			
			
			
			if($this->db->update('attendance', $signoutArray, array('empid' => $this->session->userdata('id'), 'logindate' => strtotime(date('Y-m-d')))))
			{
				return true;
			}		
		}
		else
		{
		$this->session->set_flashdata('failed', 'You Have Not Completed Your Attendance Query. or Your are not sign In.');
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
	function checkLeave($from,$status)
	{
	
		$today = strtotime(date('m/d/Y'));
		
		$this->db->select('*');
		$this->db->from('leaves');
		$this->db->where('empid',$this->session->userdata('id'));
		$this->db->where('leavefrom <=',$from);
		$this->db->where('leaveto >=',$from );
		//$this->db->where('approved','Y');
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			$this->session->set_flashdata('failed', 'Your have already take leaves between these date');
			return false;
			
			
			
		}
		else
		{
			if($from == $today && $status == 'F')
			{
					$this->db->select('*');
					$this->db->from('attendance');
					$this->db->where('attendance.empid', $this->session->userdata('id'));
					$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));	
					$query = $this->db->get();
					if($query->num_rows() >= 1)
					{
						$this->session->set_flashdata('failed', 'you already signed in on '.  date('d-M-Y') .' choose next date for leave');
						return false;
						
						
						
					}
					else
					{
					 return true;	
					}
			}
			else
			{
		
		return true;
			}
		}
		
	}
	
	function checkWorkreport()
	{
		
			
			$this->db->select('*');
			$this->db->from('work_reports');
			$this->db->where('work_reports.eid',$this->session->userdata('id'));
			$this->db->where('work_reports.reportdate',strtotime(date('Y-m-d')));
			$query = $this->db->get();
			if($query->num_rows() >=1)
			{
				return true;
			}
			else
			{
				$this->session->set_flashdata('failed', 'You have not submitted the Daily Report.');
				return false;
				
			}		
	
		
		
	}
	function getRemarkSignIn($id)
	{
		
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('attendance.empid', $this->session->userdata('id'));
		$this->db->where('attendance.signouttime', null);
		$query = $this->db->get();
	
		if($query->num_rows()==1)
		{
			$row = $query->row();
			return $row->remark;
		}
		
		
		
		return false;
		
	}
	function getRemarkPreSignIn($id)
	{
		
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('attendance.empid', $this->session->userdata('id'));
		$this->db->where('attendance.logindate', strtotime('-1 day', strtotime(date('Y-m-d'))));
		$this->db->where('attendance.signouttime', null);
		$query = $this->db->get();
	
		if($query->num_rows()==1)
		{
			$row = $query->row();
			return $row->remark;
		}
		
		
		
		
	}
	
	function getAllLeavesEmp($limit,$page,$dateFrom,$dateTo)
	{
		$this->db->select('*');	
		$this->db->from('leaves');
		$this->db->join('users','users.id = leaves.empid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('empid', $this->session->userdata('id'));
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
	
	function getAllLeavesEmpTotal($dateFrom,$dateTo)
	{
		$this->db->select('*, count(leaves.id) as tTotal');	
		$this->db->from('leaves');
		$this->db->join('users','users.id = leaves.empid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('empid', $this->session->userdata('id'));
		if($dateFrom != 'all' || $dateTo != 'all')
		{
		   
		   
		   $this->db->where('leaves.leavefrom >=',$dateFrom);
		   $this->db->where('leaves.leavefrom <=',$dateTo);
	
	    }
		
			
		
		return  $this->db->get()->row()->tTotal;
		
	}
	
	
	function getAllPresence($limit,$page,$dateFrom,$dateTo,$today='Yes')
	{
		$this->db->select('*');	
		$this->db->from('attendance');
		$this->db->join('users','users.id = attendance.empid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('empid', $this->session->userdata('id'));
		if($today =='Yes')
		{
		$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));
		}
		if($today != 'Yes')
		{	
	      if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('attendance.logindate >=',$dateFrom);
				 $this->db->where('attendance.logindate <=',$dateTo);
			}
			
		}
		
		$this->db->order_by('logindate','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		
		return $query;
	}
	
	function getAllPresenceTotal($dateFrom,$dateTo,$today='Yes')
	{
		$this->db->select('*, count(attendance.id) as tTotal');	
		$this->db->from('attendance');
		$this->db->join('users','users.id = attendance.empid');
		$this->db->join('company','company.id = users.cid');
		$this->db->where('empid', $this->session->userdata('id'));
		if($today =='Yes')
		{
		$this->db->where('attendance.logindate', strtotime(date('Y-m-d')));
		}
		if($today != 'Yes')
		{	
	      if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('attendance.logindate >=',$dateFrom);
				 $this->db->where('attendance.logindate <=',$dateTo);
			}
			
		}
		
		$this->db->order_by('logindate','desc');
	return $this->db->get()->row()->tTotal;
		
	}
	
	function getMyProject($id)
	{
		$this->db->select('*, assign_project.status as assStatus,assign_project.id as AssignId');	
		$this->db->from('assign_project');
		$this->db->join('clienproject','clienproject.id = assign_project.pid');
		$this->db->join('users','users.id = assign_project.eid');
		$this->db->where('assign_project.eid', $id);
		$this->db->where('assign_project.status','W');
		$this->db->order_by('assign_project.id','desc');
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_project_info($id)
	{
		$this->db->select('*, clienproject.id as pid,assign_project.status as aStatus');	
		$this->db->from('assign_project');
		$this->db->where('assign_project.id', $id);
		$this->db->join('clienproject','clienproject.id = assign_project.pid');
		/*$this->db->join('users','users.id = assign_project.eid');*/
		
		
		return $this->db->get()->row();

		
	}
	
	function savemyPDates(&$pArray, $id)
	{	
			if($this->db->update('assign_project', $pArray, array('id' => $id)))
			{
				return true;
			}
			
			return false;
		
	}
	function checkTodayWorkReport($id)
	{
		$this->db->select('*');	
		$this->db->from('work_reports');
		$this->db->where('eid', $id);
		$this->db->where('reportdate', strtotime(date('Y-m-d')));
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			
			return true;
			
		}
		else
		{
		return false;	
		}
		
	}
	function saveMyWork($wArray)
	{	
	   if($this->signoutExists())
	   {
			if($this->db->insert('work_reports', $wArray))
			{
				return true;
			}
			
			return false;
	   }
	   else
	   {
		$this->session->set_flashdata('failed', 'Please Make Sure You Have Done Sign In.');
		return false;
	   }
	}
	
	function getMyWorkReports($limit,$page,$dateFrom,$dateTo)
	{
		$ids = $this->workAccess();
	
		$this->db->select('*, work_reports.id as Wid ');	
		$this->db->from('work_reports');
		$this->db->join('users','users.id = work_reports.eid');
		$this->db->where_in('work_reports.eid',$ids);
		$this->db->where('users.active', 'Y');	
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('work_reports.reportdate >=',$dateFrom);
				 $this->db->where('work_reports.reportdate <=',$dateTo);
			}
			
		$this->db->order_by('work_reports.id','desc');
		
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		
		return $query;
	}
	
	function getTotalReport($dateFrom,$dateTo)
	{
		$ids = $this->workAccess();
	
		$this->db->select('*, count(work_reports.id) as tTotal');	
		$this->db->from('work_reports');
		$this->db->join('users','users.id = work_reports.eid');
		$this->db->where_in('work_reports.eid',$ids);
		$this->db->where('users.active', 'Y');	
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('work_reports.reportdate >=',$dateFrom);
				 $this->db->where('work_reports.reportdate <=',$dateTo);
			}
			
		$this->db->order_by('work_reports.id','desc');	
	
		$query = $this->db->get();		
		return $query->row()->tTotal;
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
	
	
	
	
	
	
	function AceesList($id=-1,$cid)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','E');
		$this->db->where('active','Y');
		$this->db->where('cid',$cid);
		if($id != -1)
		{
			$this->db->where('id !=', $id);
		}
		$this->db->order_by('contact_name','ASC');
		$query = $this->db->get();
		if($query->num_rows() >=1)
		{
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
	
	function AccessFor($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$query = $query->row();
		
		return $query->reportAccess;
		
		
	}
	
	
	function workAccess()
	{
		 $id =$this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','E');
		$this->db->where('id !=',$id );
		$query = $this->db->get();
		$data = array();
		$data[] =$id;
		foreach($query->result_array() as $row){
			
				
				$Aids = $row['reportAccess'];
				$Aids = explode(',',$Aids);
				
				
					
					for($i=0; $i<count($Aids); $i++)
					{
						if($id == $Aids[$i])
						{
						$data[] = $row['id'];
						}
						
					}
					
				
				
				
		
		}
		return $data;
		
	}
	
	
	function saveResignLetter($resignArray)
	{
		if($this->db->insert('resign', $resignArray))
			{
				return true;
			}
			
		
	}
	
	
	function viewResignDetails()
	{
		$this->db->select('*');
		$this->db->from('resign');
		$this->db->where('eid',$this->session->userdata('id'));
		return $this->db->get();
		
	}
	
	function findUncompleteAttan()
	{
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('empid',$this->session->userdata('id'));
		$this->db->where('signouttime',null);
		$this->db->where('logindate !=',strtotime(date('Y-m-d')));
		
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
	
	function OldSignUrlSecure($date)
	{
		
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('empid',$this->session->userdata('id'));
		$this->db->where('logindate',$date);
		$this->db->where('signouttime',null);
		$query = $this->db->get();
		
		if($query->num_rows() >=1)
		{
		  return true;	
		}
		else
		{
			return false;
		}
		
		
		
	}
	 function saveOldSignOut($date,$arr,$id)
	 {
		 if($this->OldSignUrlSecure($date))
		 {
		 
	    	$this->db->where('logindate',$date);
			$this->db->where('empid',$this->session->userdata('id')); 
			$this->db->update('attendance', $arr);
			$this->session->set_flashdata('success', 'Your Sign Out Complete');
			return true;
			
		 }
		 else
		 {
			 $this->session->set_flashdata('failed', 'You can not update.');
		     return false;	 
		 }
		 
	 }
	 
	 function myCurrentProject()
	 {
	  $this->db->select('*,assign_project.id as assId');
	  $this->db->from('assign_project');
	  $this->db->join('clienproject','clienproject.id=assign_project.pid');
	  $this->db->join('users','users.id=assign_project.eid');
	  $this->db->where('users.id',$this->session->userdata('id'));
	  $this->db->where('assign_project.status','A');	  
	  return $this->db->get();
	  	 
	 }
	 
	 function myCompleteProject()
	 {
		 $this->db->select('* ,assign_project.id as assId');
	  $this->db->from('assign_project');
	  $this->db->join('clienproject','clienproject.id=assign_project.pid');
	  $this->db->join('users','users.id=assign_project.eid');
	   $this->db->where('users.id',$this->session->userdata('id'));
	  $this->db->where('assign_project.status','C');
	  
	  return $this->db->get();
	 }
	 
	  function myRejectProject()
	  {
		$this->db->select('*,assign_project.id as AssignId');
	  $this->db->from('assign_project');
	  $this->db->join('clienproject','clienproject.id=assign_project.pid');
	  $this->db->join('users','users.id=assign_project.eid');
	   $this->db->where('users.id',$this->session->userdata('id'));
	  $this->db->where('assign_project.status','R');	  
	  return $this->db->get();
	  }
			
		
		
		function AssignUrlSecurity($id)
		{
			$this->db->select('*');
			$this->db->from('assign_project');
			$this->db->where('id',$id);			
			$query = $this->db->get();
			if($query->num_rows() ==1)
			{
				$query = $query->row();
				$Eid = $query->eid;
				if($Eid == $this->session->userdata('id'))
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
		
		
		function AssignAccept($arr,$id)
		{
			if($this->AssignUrlSecurity($id))
			{
				$this->db->where('id',$id);
				$this->db->update('assign_project',$arr);
				return true;
			}
			else
			{
			return false;	
			}
			
		}
		function AssignUrlSecurityForComplete($id)
		{
			$this->db->select('*');
			$this->db->from('assign_project');
			$this->db->where('id',$id);
			$this->db->where('status','A');
			$this->db->where('completeReq','N');			
			$query = $this->db->get();
			if($query->num_rows() ==1)
			{
				$query = $query->row();
				$Eid = $query->eid;
				if($Eid == $this->session->userdata('id'))
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
		function AssignCompleteRequest($id)
		{
			if($this->AssignUrlSecurityForComplete($id))
			{
				$this->db->where('id',$id);
				$this->db->update('assign_project',array('completeReq'=>'Y'));
				return true;
			}
			
			else
			{
			  return false;	
		    }
		}
		
		function assignToProId($id)
		{
		  $this->db->select('pid');
		  $this->db->from('assign_project');
		  $this->db->where('id',$id);
		  $query = $this->db->get();
		  
		  return $query->row()->pid;	
		}
		
		function viewHoliday($year)
		{
		  $this->db->select('*');
		  $this->db->from('holidays');
		  $this->db->where('cid',$this->session->userdata('cid'));	
		  if($year != -1)
		  {
			  $startDate = strtotime($year.'-01-01');
			  $endDate = strtotime($year.'-12-31');
			  $this->db->where('date >=',$startDate);
			  $this->db->where('date <=',$endDate);		      	  
		  }
		  else
		  {
		      $startDate = strtotime(date('Y').'-01-01');
			  $endDate = strtotime(date('Y').'-12-31');
			  $this->db->where('date >=',$startDate);
			  $this->db->where('date <=',$endDate);	  
		  }
		  
		  $this->db->order_by('date','asc');
		  return $this->db->get();
		  
		}
				// public function getProjectUpdate($id)				// {			// echo $id;			// //echo "SELECT add_project.*, assign_project.* FROM add_project INNER JOIN assign_project ON add_project.id = assign_project.pid WHERE assign_project.eid=".$id; exit;						// //$data = $this->db->query()					// }
		
	
		
}
?>