<?php
class Reportcomment extends CI_Model
{
  function saveComment($arry)
  {
     if($this->db->insert('workreportcomment',$arry))
	 {
	    return true;	 
	 }
	 	  
  }	
	
	
	function fetchreportComm($repId)
	{
	  $this->db->select('*');
	  $this->db->from('workreportcomment');
	  $this->db->where('reportId',$repId);
	  $this->db->order_by('dateTime','asc');
	  return $this->db->get();	
	}
	
	
	function reportCommentIdList($repId)
	{
		$list = array();
		$this->db->select('whois');
	  $this->db->from('workreportcomment');
	  $this->db->where('reportId',$repId);
	  $this->db->order_by('dateTime','asc');
	 $query = $this->db->get();
	 
	 foreach($query->result() as $row)
	 {
	    $list[] = $row->whois; 
	 }
	 
	 return $list;	
	}
	
	function reportDetails($repId)
	{
		$this->db->select('*, users.id as uId,work_reports.id as workId');
		$this->db->from('work_reports');
		$this->db->where('work_reports.id',$repId);
		$this->db->join('users','users.id = work_reports.eid');
		return $this->db->get()->row();
		
	}
	
}?>