<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class customemail  {
	
	
	var $CI;

    function __construct()
    {
        // Assign by reference with "&" so we don't create a copy
        $this->CI =& get_instance();
    }
	
	public function Email($msg,$title,$to,$subject)
			  {
				  
					  $config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'hitesh.speedupseo@gmail.com', // change it to yours
					'smtp_pass' => '9286711809', // change it to yours
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
	
				$message = 'jhdf jdhf dhjfhjdg';
				//$this->load->library('email');
				$this->CI->load->library('email');
				
                 
				$this->CI->email->initialize($config);
				$this->CI->email->set_newline("\r\n");
				$this->CI->email->from('SpeedUpSeo Admin'); // change it to yours
				$this->CI->email->to($to);// change it to yours
			$this->CI->email->subject($subject);
			   // $this->email->message($message);
			   $data['msg'] = $message;
			   $data['title'] = $title;
			   $data['status'] = $title;
				  $email = $this->CI->load->view('email/email', $data, TRUE);
	 
				   $this->CI->email->message( $email );
	
				if($this->CI->email->send()){
					echo 'Email sent.';
				}
				else{
					show_error($this->CI->email->print_debugger());
				}
				
			
				  
				  
		 }
		 
		
		 
		 
		
}


















?>