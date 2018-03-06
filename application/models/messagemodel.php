<?php
class Messagemodel extends CI_Model
{
	
	function fetchUserList($search)
	{$data = array();
	
	if($search != '')
	{
	  $this->db->select('*');
	  $this->db->from('users');
	 
	  $this->db->like('contact_name',$search,'after');
	   $this->db->or_like('contact_email',$search,'after');
	  $this->db->where('active','Y');
	 
			
	  $query = $this->db->get();
	  if($query->num_rows >=1)
	  {
		  $i =0;
		  foreach($query->result() as $row)
		  {
			 
			  if($row->id ==$this->session->userdata('id')){continue;}
			  // User Type
				  if($row->user_type =='SA')
				  {
					 $userType = 'Super Admin';	  
				  }
				  else if($row->user_type =='A')
				  {
					  $userType = 'Admin';
				  }
				  else
				  {
					 $userType = 'Employee'; 
				  }
				  
				  // Company Conditions
				  
				  if($this->session->userdata('user_type') !='SA')
				  {
					  
					  if($this->session->userdata('user_type') == 'E')
					  {
						  if($row->user_type != 'SA')
						  {
							  if($row->user_type == 'E')
							  {
								if($this->session->userdata('cid') !=  $row->cid)
								{
									continue;
								}
								
								
							  } // Condition when a employee
							  else if($row->user_type == 'A')
							  {
								 $accesCompies =  explode(',',$row->accessComp);
								 if(!in_array($this->session->userdata('cid'),$accesCompies))
								 {
								  continue;	 
								 }
							  } // codition when a Admin
						  }  //condition not check when a super admin
					  } // Codition when a Employee Access
					  
					  if($this->session->userdata('user_type') == 'A')
					  {
						  if($row->user_type != 'SA')
						  {
						$adminComp = $this->Messagemodel->AdminCompanies();
						if(count($adminComp) >0)
							  {
								  if($row->user_type == 'E')
								  {
									  if(!in_array($row->cid,$adminComp))
										{
										  continue;	
										}
								  }
								  else if($row->user_type == 'A')
								  {
									  $accesCompies =  explode(',',$row->accessComp);
									  $givePermission = false;
								     foreach($adminComp as $cid)
									 {
										 if(in_array($cid,$accesCompies))
										 {
											 $givePermission = true;
											
										 }
									 }
									 
									 if($givePermission ==false)
									 {
									   continue;	 
									 }
								  }
							  }
						else
						     {
						       continue;	  
						     }
							  
							  
					 if($this->session->userdata('global_comp') !=''){
						  
						  
							if($row->user_type == 'E'){							
									
										if($row->cid !=$this->session->userdata('global_comp'))
										{
										continue;	
										}
							        }
							else if($row->user_type == 'A'){
								
								 $accesCompies =  explode(',',$row->accessComp);
								 if(!in_array($this->session->userdata('global_comp'),$accesCompies))
								 {
								  continue;	 
								 }
							}
							
					  } // When A global Company Select
							  
							  
						  } // condition not check when a super admin in list
						  
					  } // Codition when a Adminn Access				  
					  
				  } // End Codition Is not Super Admin
				  else
				  {
					  if($this->session->userdata('global_comp') !=''){
						  
						  
							if($row->user_type == 'E'){							
									
										if($row->cid !=$this->session->userdata('global_comp'))
										{
										continue;	
										}
							        }
							else if($row->user_type == 'A'){
								
								 $accesCompies =  explode(',',$row->accessComp);
								 if(!in_array($this->session->userdata('global_comp'),$accesCompies))
								 {
								  continue;	 
								 }
							}
							
					  } // When A global Company Select
					  
				  } // When A super Admin access
				  
				  $data[$i]['id'] = $row->id;
				  $data[$i]['name']= $row->contact_name;
				  $data[$i]['u_type'] = $userType;
				   $i++;
			  
		  }
		 
	  }
	   
	}
	
	if(count($data) ==0)
	{
		          $data[0]['id'] = '';
				  $data[0]['name']= 'No Result';
				  $data[0]['u_type'] = '';
	}
	 return $data;
	 
	  
	  
	}
	
	
	function AdminCompanies()
	{
	 $this->db->select('accessComp');
	 $this->db->from('users');
	 $this->db->where('id',$this->session->userdata('id'));
	 $query = $this->db->get();
	 
	 return explode(',',$query->row()->accessComp);
	}
	
	function saveMsg($arr)
	{
		$this->db->insert('inbox',$arr);	
	
	}
	
	function saveSent($arr)
	{
		$this->db->insert('sent',$arr);
	}
	
	
	function ViewSentList($limit,$start,$day,$month,$year)
	{
		$filter = explode('//',$this->messageFilter($day,$month,$year));
		$dateFilterTo = $filter[1];
		$dateFilterFrom =$filter[0];

		
	  $this->db->select('*, sent.id as sentId');
	  $this->db->from('sent');
	  $this->db->where('msg_from',$this->session->userdata('id'));
	  
	  if($dateFilterTo !='')
	  {
	    $this->db->where('date >=',$dateFilterFrom);	
		$this->db->where('date <=',$dateFilterTo);	   
	  }
	  $this->db->order_by('id','desc');
	  $this->db->limit($limit, $start);
	  return $this->db->get();
	}
	
	function ViewInboxList($limit,$start,$day,$month,$year)
	{
		$filter = explode('//',$this->messageFilter($day,$month,$year));
		$dateFilterTo = $filter[1];
		$dateFilterFrom =$filter[0];
	  $this->db->select('*,inbox.id as inId');
	  $this->db->from('inbox');
	  $this->db->join('users','users.id=inbox.msg_from');
	  $this->db->where('inbox.msg_to',$this->session->userdata('id'));
	  if($this->session->userdata('global_comp') !=''){
		$this->db->where('users.cid',$this->session->userdata('global_comp'));  
	  }
	   if($dateFilterTo !='')
	  {
	    $this->db->where('inbox.date >=',$dateFilterFrom);	
		$this->db->where('inbox.date <=',$dateFilterTo);	   
	  }
	  $this->db->order_by('inbox.id','desc');
	  $this->db->limit($limit, $start);
	  return $this->db->get();
	}
	
	
	function FindName($id)
	{
		$this->db->select('contact_name');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row()->contact_name;
		
	}
	
	function TotalSent($day,$month,$year)
	{
		$filter = explode('//',$this->messageFilter($day,$month,$year));
		$dateFilterTo = $filter[1];
		$dateFilterFrom =$filter[0];
		
		
	  $this->db->select('*, count(id) as rowNo');
	  $this->db->from('sent');
	   $this->db->where('msg_from',$this->session->userdata('id'));
		   if($dateFilterTo !='')
		  {
			$this->db->where('date >=',$dateFilterFrom);	
			$this->db->where('date <=',$dateFilterTo);	   
		  }
	   $query = $this->db->get();
	   
	   return $query->row()->rowNo;	
	}
	
	function TotalInbox($day,$month,$year)
	{
		$filter = explode('//',$this->messageFilter($day,$month,$year));
		$dateFilterTo = $filter[1];
		$dateFilterFrom =$filter[0];
		
	  $this->db->select('*, count(id) as rowNo');
	  $this->db->from('inbox');
	   $this->db->where('msg_to',$this->session->userdata('id'));
	   $query = $this->db->get();
	    if($dateFilterTo !='')
		  {
			$this->db->where('date >=',$dateFilterFrom);	
			$this->db->where('date <=',$dateFilterTo);	   
		  }
	   return $query->row()->rowNo;	
	}
	
	
	
	function ViewSent($id)
	{
		$this->db->select('*');
		$this->db->from('sent');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function ViewInbox($id)
	{
		$this->db->select('*');
		$this->db->from('inbox');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	
	function readMessaeg($id)
	{
		$this->db->where('id',$id);
		if($this->db->update('inbox',array('status'=>'R')))
		{
		  return true;	
		}
	}
	
	function unReadMsg()
	{
	  $this->db->select('*, count(id) as rowCount');
	  $this->db->from('inbox');
	  $this->db->where('status','U');	
	  $this->db->where('msg_to',$this->session->userdata('id'));
	  $query = $this->db->get();
	  return $query->row()->rowCount;
	  
	}
	
	function unReadList()
	{
	  $this->db->select('*, inbox.id as msgId,users.id as uId');
	  $this->db->from('inbox');
	  $this->db->where('inbox.msg_to',$this->session->userdata('id'));
	  $this->db->join('users','users.id = inbox.msg_from');
	  
	  $this->db->where('inbox.status','U');
	  $this->db->order_by('inbox.id','desc');
	  $this->db->limit(10,0);	 
	  return $this->db->get();	
	}
	
	function delete_msg_db($id)
	{
	  $this->db->where('id',$id);
	  if($this->db->delete('inbox'))
	  {
	    return true;	  
	  }	
	}
	
	
	function delete_sent_db($id)
	{
	  $this->db->where('id',$id);
	  if($this->db->delete('sent'))
	  {
	    return true;	  
	  }	
	}
	
	
	
	function messageFilter($day,$month,$year)
	{
	// Year Month
		$dateFilterFrom ='';
		$dateFilterTo = '';
		if($day =='new' && $month !='new' && $year !='new')
		{
			$dateFilterFrom = $year.'-'.$month.'-01';		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			$dateFilterTo = $year.'-'.$month.'-'.date('t',$dateFilterFrom);
			$dateFilterTo = strtotime($dateFilterTo);
			
		}
		// Day Month
		else if($day !='new' && $month !='new' && $year =='new')
		{
			$dateFilterFrom = date('Y').'-'.$month.'-'.$day;		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			$dateFilterTo = date('Y').'-'.$month.'-'.date('t',$dateFilterFrom);
			$dateFilterTo = strtotime($dateFilterTo);
			
		}
		// Day Year
		else if($day !='new' && $month =='new' && $year !='new')
		{
			$dateFilterFrom = $year.'-'.date('m').'-'.$day;		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			$dateFilterTo = $year.'-'.date('m').'-'.$day.' 11:59:59 PM';
			$dateFilterTo = strtotime($dateFilterTo);
			
		}
		
		// Day Month Year 
		
		else if($day !='new' && $month !='new' && $year !='new')
		{
			$dateFilterFrom = $year.'-'.$month.'-'.$day;		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			$dateFilterTo = $year.'-'.$month.'-'.$day.' 11:59:59 PM';
			$dateFilterTo = strtotime($dateFilterTo);
		}
		
		// Only Year
		else if($day =='new' && $month =='new' && $year !='new')
		{
			$dateFilterFrom = $year.'-01-01';		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			$dateFilterTo = $year.'-01-01';
			$dateFilterTo = strtotime($dateFilterTo);
			
		}
		// Only Month
		else if($day =='new' && $month !='new' && $year =='new')
		{
			$dateFilterFrom = date('Y').'-'.$month.'-01';		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			$dateFilterTo = date('Y').'-'.$month.'-'.date('t',$dateFilterFrom);
			$dateFilterTo = strtotime($dateFilterTo);
		}
	    // oNLY DAy
		else if($day !='new' && $month =='new' && $year =='new')
		{
			$dateFilterFrom = date('Y-m').'-'.$day;		
			$dateFilterFrom = strtotime($dateFilterFrom);			
			
			$dateFilterTo = date('Y-m').'-'.$day.' 11:59:59 PM';
			$dateFilterTo = strtotime($dateFilterTo);
		}
		
		
		return ($dateFilterFrom.'//'.$dateFilterTo);	
	}
	
	
	function companyEmployeeList($cid)
     {
			 $list = array();
			 $this->db->select('*');
			 $this->db->from('users');
			 $this->db->where('cid',$cid);
			 $query = $this->db->get();
			 foreach($query->result() as $row)
			 {
				 $list[] = $row->id;
			 }
		 return $list;
	 }
	
}
	?>