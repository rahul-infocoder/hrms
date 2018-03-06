<?php
class Notificationmodel extends CI_Model
{
	function addNote($arr)
	{
		if($this->db->insert('notification',$arr))
		{
			$this->load->helper('email_helper');
			$subject = strip_tags(html_entity_decode($arr['msg']));
			if(send_email($this->idToEmail($arr['to']),$subject,'<a href="http://ems.speedupseo.com">click here to view complete details</a>'))
			{
			return true;	
			}
			else{
			
		    return true;
			}
		}
	}
	
	function totalNote()
	{
	  $this->db->select('*,count(id) as RowNo');
	  $this->db->from('notification');
	  $this->db->where('to',$this->session->userdata('id'));	
	  $query = $this->db->get();	  
	  return $query->row()->RowNo;
	  
	}
	
	function unReadNote()
	{
	  $this->db->select('*,count(id) as RowNo');
	  $this->db->from('notification');
	  $this->db->where('status','U');
	  $this->db->where('to',$this->session->userdata('id'));	
	  $query = $this->db->get();
	  
	  return $query->row()->RowNo;
	  
	}
	
	function readNote()
	{
	  $this->db->select('*,count(id) as RowNo');
	  $this->db->from('notification');
	  $this->db->where('status','R');
	  $this->db->where('to',$this->session->userdata('id'));	
	  $query = $this->db->get();
	  
	  return $query->row()->RowNo;
	  
	}
	
	function deleteNoteDB($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('notification'))
		{
		  return true;	
		}
	}
	
	function noteList($len=5,$start=0)
	{
	  $this->db->select('*');
	  $this->db->from('notification');
	  //$this->db->where('status','U');
	  $this->db->where('to',$this->session->userdata('id'));
	  $this->db->order_by('id','DESC');
	   $this->db->order_by('status','DESC');
	  $this->db->limit($len,$start);	
	  return $this->db->get();
		
	}
	
	function FindSuperAdmin()
	{
		$data = array();
		$i =0;
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('user_type','SA');
	    $query =$this->db->get();
		foreach($query->result() as $row)
		{
			$data[$i] = $row->id;
			$i++;
			
		}
			return $data; 	
	}
	
	function userCompany()
	{
	  $this->db->select('cid');
	  $this->db->from('users');
	  $this->db->where('id',$this->session->userdata('id'));
	  $query = $this->db->get();
	  
	  return $query->row()->cid;	
	}
	function FindAdmin()
	{
		$data = array();
		$i =0;
		$comId = $this->userCompany();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','A');
		$this->db->where('active','Y');
		$query = $this->db->get();
		if($query->num_rows >= 1)
		{
			foreach($query->result() as $row)
			{
				$accesList = explode(',',$row->accessComp);
				foreach($accesList as $value)
				{
				   if($comId == $value)
				   {
					 $data[$i] = $row->id;
					 $i++;   
				   }	
				}
				
			}
		}
		
		
		return $data;
		
	}
	
	function task()
	{
	  $this->db->select('*,count(id) as noRow');
	  $this->db->from('assign_project');
	  $this->db->where('eid',$this->session->userdata('id'));
	  $this->db->where('status','W');	
	  $query = $this->db->get();
	  return $query->row()->noRow;
	}
	
	function taskDetail()
	{
	  $this->db->select('*');
	  $this->db->from('assign_project');
	  $this->db->join('clienproject','clienproject.id = assign_project.pid');
	  $this->db->where('assign_project.eid',$this->session->userdata('id'));
	  $this->db->where('assign_project.status','W');	
	  $this->db->order_by('assign_project.id','DESC');
	 return $this->db->get();
	 
	}
	
	function leaveInfo($id)
	{
		$this->db->select('empid');
		$this->db->from('leaves');
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		return $query->row()->empid;
		
	}
	
	
	function resignToEmp($id)
	{
		$this->db->select('eid');
		$this->db->from('resign');
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		return $query->row()->eid;
		
	}
	
	function assignToEmp($id)
		{
		  $this->db->select('eid');
		  $this->db->from('assign_project');
		  $this->db->where('id',$id);
		  $query = $this->db->get();
		  
		  return $query->row()->eid;	
		}
		
		
		function NoteRead()
		{
		   $this->db->where('to',$this->session->userdata('id'));
		   $this->db->update('notification', array('status'=>'R'));	
		}
		
	  function idToEmail($id)
	  {
	   $this->db->select('contact_email');
	   $this->db->from('users');
	   $this->db->where('id',$id);
	   
	   $query = $this->db->get();
	   return $query->row()->contact_email;
	   	  
	  }
	
	
}
?>