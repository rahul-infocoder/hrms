<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Workreportcomment extends CI_Controller{
	
	function __construct()
    {
					parent::__construct();
							
						
			$this->load->model('User');
		if(!$this->User->is_logged_in())
		{
			redirect('login');
		}
		
		
		//load up global data
		$this->lang->load('common', $this->session->userdata('lang'));
		$this->lang->load('certificates', $this->session->userdata('lang'));
		$data['user_info'] = $this->User->get_logged_in_employee_info();
		$this->load->vars($data);
			  
			
    $this->load->model('Reportcomment');
			 
    }
	
	function index()
	{}
	
	function saveWorkComment()
	{
		//echo 'fdf';
		
		$comment = $this->input->post('reportComment');
		$reportId = $this->input->post('reportId');
		$redirect = $this->input->post('redirectTourl');
		
		$arr = array(
		             'reportId'=>$reportId,
					 'whois'=>$this->session->userdata('id'),
					 'comment'=>$comment,
					 'date'=>strtotime(date('Y-m-d')),
					 'dateTime'=>strtotime(date('Y-m-d h:i:s A'))
		            );
					
				if($this->Reportcomment->saveComment($arr))
				{
					$this->notiIfEmployee($reportId);
					$this->notiIfAdmin($reportId);
				  $this->session->set_flashdata('success', 'Comment has Done.');	
				  
				}
				
				else
				{
					 $this->session->set_flashdata('failed', 'Error.');
			
				}
				
				header('Location: '.$redirect);
		
	}
	
	
	private function notiIfEmployee($reportId)
	{
		$link = site_url('admin/reporPopup/'.$reportId);
		// find report comment Id 
		$sId =$this->session->userdata('id');
		if($this->session->userdata('user_type') == 'E')
		{
	 $lreadyList =	$this->Reportcomment->reportCommentIdList($reportId);
	 
	 //report Details 
	 $reportDetails =	$this->Reportcomment->reportDetails($reportId);
	 
	 $reportName =  ($reportDetails->eid == $sId)?'Your':$reportDetails->contact_name;
		
		        $admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(15,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
						
						
					$noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin(),$lreadyList);
					$noteToList = array_unique($noteToList);
					$myId = 	array_search($sId,$noteToList);
						if(!is_null($myId))
						{
						  unset($noteToList[$myId]);	
						}
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				          $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has commented on '. $reportName . ' '. date('d-M-y',$reportDetails->reportdate).' report.',
									'date' =>$noteDate,
									'link'=>$link						
							     	);
									$this->Notificationmodel->addNote($note);
						}
						
		}
	}
	
	
	private function notiIfAdmin($reportId)
	{
		$link = 'admin/reporPopup/'.$reportId;
		if($this->session->userdata('user_type') != 'E')
		{
			$sId =$this->session->userdata('id');
			$lreadyList =	$this->Reportcomment->reportCommentIdList($reportId);
			$reportDetails =	$this->Reportcomment->reportDetails($reportId);
			 $reportName =  ($reportDetails->eid == $sId)?'Your':$reportDetails->contact_name;
			array_push($lreadyList,$reportDetails->eid);
			
			$noteToList  = array_unique($lreadyList);

			
		$myId = 	array_search($sId,$noteToList);
		if(!is_null($myId))
		{
		  unset($noteToList[$myId]);	
		}
		
		
			$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
			foreach($noteToList as $value)
						{
				          $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has commented on '. $reportName . ' '. date('d-M-y',$reportDetails->reportdate).' report.',
									'date' =>$noteDate,
									'link'=>$link						
							     	);
									$this->Notificationmodel->addNote($note);
						}
		}
	}
	
	
}