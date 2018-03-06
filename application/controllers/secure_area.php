<?php
class Secure_area extends CI_Controller 
{
	/*
	Controllers that are considered secure extend Secure_area.
	*/
	
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
}

?>