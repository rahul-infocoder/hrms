<?php
class Holidaymodel extends CI_Model
{
	
	function addholiday($ary)
	{
	  if($this->db->insert('holidays',$ary))
	  {
	    return true;	  
	  }
	}
	
	function holidayExits($cid,$date)
	{
	   $this->db->select('*');
	   $this->db->from('holidays');
	   $this->db->where('cid',$cid);
	   $this->db->where('date',$date);
	   $query = $this->db->get();
	   if($query->num_rows() >0)
	   {
		   return false;  
	   }
	   else
	   {
		  return true; 
	   }	
	}
	function viewHoliday($year)
	{
		$adminCompany = $this->adminCompany();
		$this->db->select('*');
		$this->db->from('holidays');
			
		if($adminCompany)
		{
			if(count($adminCompany)>0)
			{
			
			  $this->db->where_in('cid',$adminCompany);
			}
			else
			{
			  $this->db->where('cid','0');	
			}
		}
		if($this->session->userdata('global_comp') !=''){
			
			$this->db->where('cid',$this->session->userdata('global_comp'));
			
		}		
		
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
		
		return $this->db->get();
		
	}
	
	function adminCompany()
	{
	  if($this->session->userdata('user_type')== 'A')
		{
			$list = array();
		  $this->db->select('*');
		  $this->db->from('users');
		  $this->db->where('id',$this->session->userdata('id'));
		  $query = $this->db->get();
		  
		  if($query->num_rows() >0)
		  {
			  $comany = explode(',',$query->row()->accessComp);
			  foreach($comany as $row)
			  {
			    $list[] = $row;	  
			  }
		  }
		  
		  return $list;
		 
		}
		else
		{
		  return false;	
		}
	}
	
	
	function holidayDelete($id)
	{
	  $this->db->where('id',$id);
	 if( $this->db->delete('holidays'))
	 {
	   return true;	 
	 }	
	}
	
	
	
}?>