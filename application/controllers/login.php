<?php
class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		

	}
	
	
	function index()
	{
	 	
	  
	    $this->cookiesLogin();
		if($this->User->is_logged_in())
		{
			if($this->session->userdata('user_type') == 'E')
			{
			    redirect('dashboard');
			}
			else
			{
				redirect('dashboard');
			}
		}
		else
		{
			$this->form_validation->set_rules('username', 'lang:login_undername', 'callback_login_check');
    	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{
			    $data['title']=$this->lang->line('site_name').' :: ADMIN LOGIN :: ';
				$this->load->view('login/login', $data);
			}
			else
			{
				if($this->session->userdata('user_type') == 'E')
				{
				     redirect('dashboard');
				}
				else
				{
					redirect('dashboard');
				}
			}
		}
	

	}
	
	
	function login_check($username)
	{
		$password = sha1('WHAT_THE _HELL_IS_THIS'.sha1($this->input->post('password')));
		//$company = $this->input->post('company');
		//$selLang = $this->input->post("language");
		if($this->input->post('remember'))
		{
		   $this->input->set_cookie('EMS_Username', $username,3600*24);
		   $this->input->set_cookie('EMS_pass', $this->input->post('password'),3600*24);  	
				
		 	
		}
		if(!$this->User->login($username, $password))
		{
			$this->form_validation->set_message('login_check', 'INCORRECT DETAILS !!!');
			return false;
		}
		return true;		
	}
	
	
	private function cookiesLogin ()
	{
			if($this->session->userdata('id') ==true)
			{
				if($this->input->cookie('EMS_Username'))
				 {
					 
					if($this->User->login($this->input->cookie('EMS_Username'),sha1('WHAT_THE _HELL_IS_THIS'.sha1($this->input->cookie('EMS_pass'))) ))
					{
						if($this->session->userdata('user_type') == 'E')
						{
						redirect('dashboard');
						}
						else
						{
							redirect('dashboard');
						}
					}
				
				}
		
	       }
	}
	
	function ChangePass()
	{		
	    $data['title']=$this->lang->line('site_name').' :: CHANGE PASSWORD :: ';
		$this->load->view('login/change_pass',$data);		
	}
	
	function SavePass()
	{			
		if($this->User->get_tempinfo($this->input->post('user'), $this->input->post('opass')) == TRUE){
		$pass_data = array(
		'password' => md5($this->input->post('npass'))
		);
		if($this->User->ChgPass($this->input->post('user'), $pass_data)){
		 echo $return = 'Congrats !! You Can use New Password Now.';
		}
		else{
		echo $return = 'Sorry !! Unable to change password.';
		 }
		
	   }
	   else{
		   echo $return = 'Sorry !! You Entered Wrong Password.';
	   }
						
	}
	
	function logout()
	{
		$this->User->logout();
		// Load the library file
//$this->load->library('To_excel');

// Create database query
//$this->db->select('*');
//$this->db->where('id', '1');
//$query = $this->db->get('users');

// Create Excel file
//$this->to_excel->create_excel($query, 'filename');
	}
	
	function dashboard()
	{
		// print_r($this->session->all_userdata());
	$data['user_info'] = $this->User->get_logged_in_employee_info();
		
	  $data['title']=$this->lang->line('site_name').' :: DASHBOARD :: ';
	  $this->load->view('dashboard',$data);	
	}
	
public function timer(){	
 $time= date('H:i:s');
 echo $time; 
 }
 
 public function sign_in(){	
 session_start();	
 $data= $_SESSION['emp_id'];	
 $this->Adminmodel->sign_in($data);	
 }
public function sign_out(){	
 session_start();	
 $data= $_SESSION['emp_id'];
 
 $value=$this->db->query("select sign_out from user_attendance where user_id='".$data."' AND date='".date('Y-m-d')."'");
 $value1 = $value->row();
 if(empty($value1->sign_out)){
	$this->Adminmodel->sign_out($data);
	$get_time=$this->Adminmodel->work_time($data);
	
 }else{
	 echo "false";
 }
 // 
 //echo unix_to_human($get_time, TRUE);
// echo "hi".$get_time[0]['sign_in'];
//$diff=$get_time[0]['sign_in']-$get_time[0]['sign_out'];
//print_r($diff);
// $insert=$diff;
// $this->db->insert('working_hours',$insert);
 }
}
?>