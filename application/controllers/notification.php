<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends CI_Controller{
	
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
			  
			

			 
    }
	function index()
	{
		$this->noteList();
	  	
	}
	
	function ReadNotice()
	{
		if($this->input->post('id') == 'readKrleMereYaar')
		{
			$this->Notificationmodel->NoteRead();
		  // $this->output->set_output('fdkhfjkd');	
		}
		
	}
	
	
	function noteList($limit=10)
	{
	    $data['title'] ='Notification List';
		$total = $this->Notificationmodel->totalNote();
		$limit = ($limit=='all')?$total:$limit;
		
		$this->Notificationmodel->NoteRead();
		$config = array();
        $config["base_url"] = site_url('notification/noteList/'.$limit);
        $config["total_rows"] = $total;
        $config["per_page"] = $limit;
        $config["uri_segment"] = 4;	
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$data['noteList'] = $this->Notificationmodel->noteList($limit, $page);
		$data["links"] = $this->pagination->create_links();
		
		$to = ($total < ($page+$limit))?$total:($page+$limit);
		$data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

		$this->load->view('notification/notification',$data);
		
	}
	
	
	function deleteNotice()
	{
		
		$id =  $this->input->post('id');
		$this->Notificationmodel->deleteNoteDB($id);
		
	}
	
	
}
?>