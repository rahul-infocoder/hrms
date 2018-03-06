<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once ("secure_area.php");
class Employees extends secure_area{
	public function __construct()    {  
		
		parent::__construct();		
		$this->load->model('Add_Project_Model');    
		}
	public function index()
	{

	
	}
	
	function signIn()
	{
		if($this->session->userdata('user_type') == 'E')
		    {
	          $data['signinData'] = $this->Employee->get_emp_info($this->session->userdata('id'));
	         $data['title']=$this->lang->line('site_name').' :: SIGN IN :: ';
	          $this->load->view("employee/signin", $data);
		 }
		else
		{
			
			 redirect('admin/noaccess');
		}
		
	
	}
	
	function saveSignin()
	{
		if($this->session->userdata('user_type') == 'E')
		    {
					
						$signinArray = array(
						'empid'=>$this->session->userdata('id'),
						'logindate'=>strtotime(date('Y-m-d')),
						'signintime'=>strtotime(date('Y-m-d h:i:s A')),
						'remark'=>$this->input->post('remark'),
						'month'=>date('Y-m')
						);
						
						if($this->Employee->saveSignin($signinArray))
						{
							//New Establishment
							  
							$this->session->set_flashdata('success', 'You Are Now Signed In.');
							
						$admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(17,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
						
						
					$noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				        $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has signed in.',
									'date' =>$noteDate,
									'link' =>'admin/viewAttendance/'							
							     	);
									$this->Notificationmodel->addNote($note);
						}	
							
							redirect('employees/viewAllPresence');
							
							
						}
						else//failure
						{	
						//$this->session->set_flashdata('failed', 'You are already signin today.');
						redirect('employees/signIn');
						}
					
		
		
			}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
		
	}
	function signOut()
	{
		if($this->session->userdata('user_type') == 'E')
		    {
	$data['signoutData'] = $this->Employee->get_emp_info($this->session->userdata('id'));
	$data['title']=$this->lang->line('site_name').' :: SIGN OUT :: ';
	$this->load->view("employee/signout", $data);	
	}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
	
	}
	function saveSignout($id)
	{  if($this->session->userdata('user_type') == 'E')
		    {
				
				if($this->Employee->checkWorkreport())
				{
						
										$signRemark = "<b class='remak'>Sign In Remark:</b> " .$this->Employee->getRemarkSignIn($this->session->userdata('id')) ."<br/><b class='remak'>Sign Out Remark:</b> ".$this->input->post('remark');
											$signoutArray = array(
											'signouttime' => strtotime(date('Y-m-d h:i:s A')),
											'remark'=> $signRemark
											);   
											
									if($this->Employee->saveSignout($signoutArray, $id))
									   {
										     
												$this->session->set_flashdata('success', 'You Are Now Signed Out.');
												$admnList = $this->Notificationmodel->FindAdmin();
												$admnReal = array();
												foreach($admnList as $key=>$adn)
												{
												  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
												  if(in_array(17,$adminUrl))
												  {
													 //unset($admnList[$key]);
													 $admnReal[] =$adn;	  
												  }
												}
												
												
											$noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
												$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
												$noteDate = strtotime(date('Y-m-d h:i:s A'));
												
												foreach($noteToList as $value)
												{
												$note = array(
															'to' =>$value,
															'msg' => '<b>'.$senderName .'</b> has signed Out.',
															'date' =>$noteDate,
															'link' =>'admin/viewAttendance/'							
															);
															$this->Notificationmodel->addNote($note);
												}	
												
												redirect('employees/viewAllPresence');
												
										}
										else//failure
										{	
										
										
									    redirect('employees/signOut');
										}
							
								
				}
				else
				{
					redirect('employees/signOut');
				}
							
				
			
		
		}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
		
	}
	
	function reqLeave()
	{
		if($this->session->userdata('user_type') == 'E')
		    {
		$id = $this->session->userdata('id');
	$data['empData'] = $this->Employee->get_emp_info($id);
	$data['title']=$this->lang->line('site_name').' :: REQUEST LEAVE :: ';
	$this->load->view("employee/reqleave", $data);
	
	
	
		}
			else
			{
				
				 redirect('admin/noaccess');
			}
	
	}

	function saveLeaveReq($id)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
				
	        $LeaveS = $this->input->post('LeaveS');
	        $this->form_validation->set_rules('LeaveS', 'Leave Status', 'required');
			  if($LeaveS == 'H')
		     {
			$this->form_validation->set_rules('LeaveT', 'leave Leave Time', 'required');
			 }
			 $this->form_validation->set_rules('leavefrom', 'Leave From' , 'required');
			  if($LeaveS == 'F')
		     {
			 $this->form_validation->set_rules('leaveto', 'Leave To' , 'required');
			 }
    	  $this->form_validation->set_rules('reason', 'Reason' , 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			
			if($this->form_validation->run() == false)
			{
	          // return false;
	          $this->reqLeave();
			}
			else
			{
		
		
	/*	if(!(strtotime($this->input->post('leavefrom')) >= strtotime(date('m/d/Y'))))
		         {
					 
				   $this->session->set_flashdata('failed', 'Your have select a worng date');
				   redirect('employees/viewAllLeaves');	
				   //return false; 
                 }*/
			 
		
		if($LeaveS == 'F')
		{
		
		$leaveArray = array(
		'empid' => $id,
		'leavefrom' => strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom')))),
		'leaveto' => strtotime(date('Y-m-d', strtotime($this->input->post('leaveto')))),
		'fullday' => (strtotime(date('Y-m-d', strtotime($this->input->post('leaveto')))) - strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom'))))) / 86400+1,
		'reason' => $this->input->post('reason'),
		'sendDate'=>strtotime(date('Y-m-d'))
		);		
		if(!(strtotime($this->input->post('leaveto')) >= strtotime($this->input->post('leavefrom'))))
		{
					 
				   $this->session->set_flashdata('failed', 'Your have select a worng date');
				   redirect('employees/viewAllLeaves');	
				   //return false; 
                 }
		
		
		
		}
		else if($LeaveS == 'H')
		{
			$leaveArray = array(
			'empid' => $id,
		    'leavefrom' => strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom')))),
		    'leaveto' => strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom')))),
		  'halfday' => (strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom')))) - strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom'))))) / 86400+1,
		'reason' => $this->input->post('reason'),
		'time'=> $this->input->post('LeaveT'),
		'sendDate'=>strtotime(date('Y-m-d'))	
			);
		}
		
		
		
		
		  if($this->Employee->checkLeave(strtotime($this->input->post('leavefrom')),$LeaveS))
			{
					if($this->Employee->saveLeaveR($leaveArray, $id))
					{
						
						  
						$this->session->set_flashdata('success', 'Leave Request Has Been Sent.');
						
						$admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(29,$adminUrl) || in_array(30,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
						
					    $noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				        $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has sent a leave request.',
									'date' =>$noteDate,
									'link'=>'admin/viewLeaveApps'							
							     	);
									$this->Notificationmodel->addNote($note);
						}
																	
						
						
						redirect('employees/viewAllLeaves');
                      
						
						
					}
					else//failure
					{	
					$this->session->set_flashdata('failed', 'There is some problem in saving data.');
					redirect('establishment');
					}
				}
				else
					{
						
					
						redirect('employees/viewAllLeaves');
					}
		      
			
			}
			
			
		
		}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
	} 
	
	function viewAllLeaves($month='all',$year='all',$limit=50)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
				
				$dateFilter = $this->monthYear($month,$year);
			     $dateFrom = $dateFilter[0];
			      $dateTo = $dateFilter[1];
			
			
			       $totalRow = $this->Employee->getAllLeavesEmpTotal($dateFrom,$dateTo);
			          $limit = ($limit=='all')?$totalRow:$limit;
			
				$config = array();
				$config["base_url"] = site_url('employees/viewAllLeaves/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $totalRow;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
				
				
				$data['leaveData'] = $this->Employee->getAllLeavesEmp($limit,$page,$dateFrom,$dateTo);
				$data['title']=$this->lang->line('site_name').' :: EDIT MY ESTABLISHMENT :: ';
				$this->load->view("employee/viewAllLeaves", $data);
	      }
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	
	private function monthYear($month,$year)
	{
		
		if(($month != 'all') && ($year !='all'))
		{
		   $dateFrom = strtotime(date($year.'-'.$month.'-01'));
		   $dateTo = strtotime(date('Y-m-t',$dateFrom));	
		}
		else if(($month =='all') && ($year !='all'))
		{
		   $dateFrom = strtotime(date($year.'-01-01'));
		   $dateTo = strtotime(date($year.'12-31'));	
		}
		else if(($month !='all') && ($year =='all'))
		{
		   $dateFrom = strtotime(date('Y').'-'.$month.'-01');
		    $dateTo = strtotime(date('Y-m-t',$dateFrom));		
		}
		else 
		{
		  $dateFrom = 'all';
		  $dateTo = 'all';	
		}
		
		return array($dateFrom,$dateTo);
	}
	
	
	function viewAllPresence($day='all',$month='all',$year='all',$limit=50,$today='Yes')
	{
		if($this->session->userdata('user_type') == 'E')
		    {
				
				if(($day != 'all') && ($month != 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-'.$month.'-'.$day);
					$dateTo = strtotime($year.'-'.$month.'-'.$day);
					
				}
				else if(($day == 'all') && ($month != 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-'.$month.'-1');
					$dateTo = strtotime(date('Y-m-t',$dateFrom));
				}
				else if(($day == 'all') && ($month == 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-01-01');
					$dateTo = strtotime($year.'-12-31');
					
				}			
				
				else if(($day != 'all') && ($month == 'all') & ($year == 'all'))
				{
					$dateFrom = strtotime(date('Y-m').'-'.$day);
					$dateTo = strtotime(date('Y-m').'-'.$day);
				}
				else if(($day != 'all') && ($month != 'all') & ($year == 'all'))
				{
					$dateFrom = strtotime(date('Y').'-'.$month.'-'.$day);
					$dateTo = strtotime(date('Y').'-'.$month.'-'.$day);
					
				}
				
				else if(($day != 'all') && ($month == 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-'.date('m').'-'.$day);
					$dateTo = strtotime($year.'-'.date('m').'-'.$day);
					
				}
				
				else if(($day == 'all') && ($month != 'all') & ($year == 'all'))
				{
					$dateFrom = strtotime(date('Y').'-'.$month.'-01');
					$dateTo = strtotime(date('Y-m-t',$dateFrom));
					
				}		
						
								
				else
				{
					$dateFrom ='all';
					$dateTo = 'all';
				}
			
			   $total = $this->Employee->getAllPresenceTotal($dateFrom,$dateTo,$today);
				$limit = ($limit=='all')?$total:$limit;
				
				$config = array();
				$config["base_url"] = site_url('employees/viewAllPresence/'.$day.'/'.$month.'/'.$year.'/'.$limit.'/'.$today);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 8; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
				$data["links"] = $this->pagination->create_links();	
				
				$data['totalRow'] = $total;
				
				
	          $data['presenceData'] = $this->Employee->getAllPresence($limit,$page,$dateFrom,$dateTo,$today);
	          $data['title']=$this->lang->line('site_name').' :: VIEW MY ATTENDANCE :: ';
	          $this->load->view("employee/viewPresesnce", $data);
	   }
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	
	function attenFilter()
	{
		if($this->session->userdata('user_type') == 'E')
		    {
		$m = $this->input->post('month');
		$y = $this->input->post('year');
		$date = $y.'-'.$m;
	$data['presenceData'] = $this->Employee->getAllPresence($this->session->userdata('id'),$date);
	$data['title']=$this->lang->line('site_name').' :: VIEW MY ATTENDANCE :: ';
	$this->load->view("employee/viewPresesnce", $data);
	}
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	
	
	function viewmyNewProjects()
	{		
		if($this->session->userdata('user_type') == 'E'){						
		$data['pdata'] = $this->Employee->getProjectUpdate($this->session->userdata('id'));				
		$data['title']=$this->lang->line('site_name').' :: MY PROJECTS :: ';		
		$this->load->view("employee/viewMyProjects", $data);			
		}else {			
		redirect('admin/noaccess');			
		}
	}
	public function project_details($id){
		if($this->session->userdata('user_type') == 'E'){	
		$id=$id;
		$data['id']=$id;
		$data['proData']=$this->Add_Project_Model->decribe_project($id);
		$data['eid'] = $this->session->userdata('id');
		$value=$this->db->query("select * from start_time where eid='".$data['eid']."' AND pid='".$data['id']."'");
		$value = $value->row();
		//print_r($value->pause);
		
		if(!empty($value)){
			$str_time = $value->pause;
			$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
			sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
			$data['time_seconds'] = $hours * 3600 + $minutes * 60 + $seconds;
		}else{
			$data['time_seconds']= 5;
		}
		//print_r($time_seconds);
		$data['title']=$this->lang->line('site_name').' :: PROJECT DETAILS :: ';
	  $this->load->view('employee/project_details',$data);	
	}else {	
	redirect('admin/noaccess');			
		}
	}
	public function inputpausetime(){
		$data['pid']=$_POST['pid'];
		$data['time']= $_POST['time'];
		$data['eid']=$this->session->userdata('id');
		$this->Add_Project_Model->inputpausetime($data);
		$this->Add_Project_Model->project_time($data);
		
	}
	public function startTime(){
		$data['pid'] = $_POST['pid'];
		$data['time'] = $_POST['time'];
		$data['eid'] = $this->session->userdata('id');
		$value=$this->db->query("select * from start_time where eid='".$data['eid']."' AND pid='".$data['pid']."'");
		$value1 = $value->row();
		if(!empty($value1)){
			$this->Add_Project_Model->updatestartTime($data);
		}else{
			$this->Add_Project_Model->startTime($data);
		}
		
	}
	public function sendMail(){
		$data['pid']=$_POST['pid'];
		$data['eid']=$this->session->userdata('id');
		$user_mail=$this->db->query("select contact_email from users where id='".$data['eid']."'");
		$user_mail= $user_mail->result_array();
		$admin_mail= $this->db->query("select contact_email from users where user_type='SA'");
		$admin_mail=$admin_mail->result_array();
		$admin_email=$admin_mail[0]['contact_email'];
		$user_email=$user_mail[0]['contact_email'];
		$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'mail.supremecluster.com',
				'smtp_port' => 25,
				'smtp_user' => 'testing@hrms.infoseeksoftwaresystems.com',
				'smtp_pass' => 'uslRVcH198',
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
			);
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

			//Email content
			$htmlContent = '<h1>Your time is finished.</h1>';
			$htmlContent .= '<p>Now, you are working on extended time.</p>';

			$this->email->to($admin_email);
			$this->email->cc($user_email);
			$this->email->from('testing@hrms.infoseeksoftwaresystems.com','MyWebsite');
			$this->email->subject('How to send email via SMTP server in CodeIgniter');
			$this->email->message($htmlContent);

			//Send email
			$bad=$this->email->send();
			if('1' == $bad){ 
			echo "success";
			}
				}
	function projectDetail($id)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
	$data['mpData'] = $this->Employee->get_project_info($id);
	$data['title']=$this->lang->line('site_name').' :: ASSIGN DATE SLOT :: ';
	$this->load->view("employee/assignProjectDate", $data);
	}
		else
		{
			 redirect('admin/noaccess');
		}
	}
	
	function sendWorkReport($id)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
		
	$data['wData'] = $this->Employee->get_emp_info($id);
	$data['title']=$this->lang->line('site_name').' :: SEND WORK REPORT :: ';
	$this->load->view("employee/workReportForm", $data);
	}
		else
		{
			
			 redirect('admin/noaccess');
		}
	
	}
	
	function saveMyProjectDates($id)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
		$pArray = array(
		'esdatefrom' => strtotime(date('Y-m-d', strtotime($this->input->post('datefrom')))),
		'esdateto' => strtotime(date('Y-m-d', strtotime($this->input->post('dateto')))),
		'remarks' => $this->input->post('remarks'),
		'status' => 'M'
		);
		
		if($this->Employee->savemyPDates($pArray, $id))
		{
			//New Establishment
			if($id==-1)
			{   
		    $this->session->set_flashdata('success', 'Your Project Date Has Been Marked.');
			redirect('employees/viewmyProjects');
			}
			else //previous Establishment
			{
			$this->session->set_flashdata('success', 'Your Project Date Has Been Marked.');
			redirect('employees/viewmyProjects');
			}
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('employees/viewmyProjects');
		}
		}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
	}
	
	function saveMyReport($id)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
		
		
	
		 $upload_conf = array(
            'upload_path'   => realpath('upload/report/'),
            'allowed_types' => '*',
            'max_size'      => '30000',
            );
    
	
	     $this->load->library('upload');
     
		
        $this->upload->initialize( $upload_conf );
    
        // Change $_FILES to new vars and loop them
        foreach($_FILES['file'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;   
            }
        }
        // Unset the useless one ;)
        unset($_FILES['file']);
    
        // Put each errors and upload data to an array
        $error = array();
        $success = array();
        $Fname = array();
        // main action to upload each file
        foreach($_FILES as $field_name => $file)
        {
			
            if ( ! $this->upload->do_upload($field_name))
            {
                // if upload fail, grab error 
                $error['upload'][] = $this->upload->display_errors();
            }
            else
            {
                // otherwise, put the upload datas here.
                // if you want to use database, put insert query in this loop
                $upload_data = $this->upload->data();
				
			$Fname[]=	$this->upload->file_name;
                
                
            }
        }

    
	$wArray = array(
		'eid'=>$this->session->userdata('id'),
		'reportdate' => strtotime(date('Y-m-d')),
		'report' => $this->input->post('report'),
		'month' =>date('Y-m'),
		'files'=> implode("/", $Fname)
		);
		
			
		
		

		
		
			if($this->Employee->saveMyWork($wArray))
			{
				  
				$this->session->set_flashdata('success', 'Your Work Report sent and saved.');
				redirect('employees/viewMyReport');
				
				
			}
			else//failure
			{	
			//$this->session->set_flashdata('failed', 'There is some problem in saving data.');
			redirect('employees/viewMyReport');
			}
		}
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	
	function viewMyReport($day='all',$month='all',$year='all',$limit=50)
	{
		if($this->session->userdata('user_type') == 'E')
		    {
				
				if(($day != 'all') && ($month != 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-'.$month.'-'.$day);
					$dateTo = strtotime($year.'-'.$month.'-'.$day);
					
				}
				else if(($day == 'all') && ($month != 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-'.$month.'-1');
					$dateTo = strtotime(date('Y-m-t',$dateFrom));
				}
				else if(($day == 'all') && ($month == 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-01-01');
					$dateTo = strtotime($year.'-12-31');
					
				}			
				
				else if(($day != 'all') && ($month == 'all') & ($year == 'all'))
				{
					$dateFrom = strtotime(date('Y-m').'-'.$day);
					$dateTo = strtotime(date('Y-m').'-'.$day);
				}
				else if(($day != 'all') && ($month != 'all') & ($year == 'all'))
				{
					$dateFrom = strtotime(date('Y').'-'.$month.'-'.$day);
					$dateTo = strtotime(date('Y').'-'.$month.'-'.$day);
					
				}
				
				else if(($day != 'all') && ($month == 'all') & ($year != 'all'))
				{
					$dateFrom = strtotime($year.'-'.date('m').'-'.$day);
					$dateTo = strtotime($year.'-'.date('m').'-'.$day);
					
				}
				
				else if(($day == 'all') && ($month != 'all') & ($year == 'all'))
				{
					$dateFrom = strtotime(date('Y').'-'.$month.'-01');
					$dateTo = strtotime(date('Y-m-t',$dateFrom));
					
				}		
						
								
				else
				{
					$dateFrom ='all';
					$dateTo = 'all';
				}
				
				$total = $this->Employee->getTotalReport($dateFrom,$dateTo);
				$limit = ($limit=='all')?$total:$limit;
				
				$config = array();
				$config["base_url"] = site_url('employees/viewMyReport/'.$day.'/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 7; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
				$data["links"] = $this->pagination->create_links();				
		
	           $data['wData'] = $this->Employee->getMyWorkReports($limit,$page,$dateFrom,$dateTo);
	           $data['title']=$this->lang->line('site_name').' :: MY WORK REPORTS :: ';
	           $this->load->view("employee/viewMyWorks", $data);
	        }
		else
		{
			
			 redirect('admin/noaccess');
		}
	
	}
	
	
	
		
		
		function resignLetter()
		{
			    $id = $this->session->userdata('id');
	            $data['empData'] = $this->Employee->get_emp_info($id);
			    $data['title']=$this->lang->line('site_name').' :: RESIGNATION FORM:: ';
				$this->load->view("employee/ResignationForm", $data);
			
		}
		
		function viewResign()
		{
			    $data['ReData'] = $this->Employee->viewResignDetails();
			    $data['title']=$this->lang->line('site_name').' :: RESIGNATION STATUS :: ';
				$this->load->view("employee/viewResign", $data);
			
		}
		
		function saveResign()
		{
			$config = array(
               array(
                     'field'   => 'resignDate',
                     'label'   => 'Resign Date',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'reason',
                     'label'   => 'Resign Reason',
                     'rules'   => 'required'
                  )
				  );
				  
				  
			$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == false)
			{
				$this->resignLetter();
				
			}
			
			else
			{
				$resignDate = date('Y-m-d',strtotime($this->input->post('resignDate')));
				
				$resignArray = array(
				           'eid' => $this->session->userdata('id'),
						   'reason' => $this->input->post('reason'),
						   'sendDate' => strtotime(date('Y-m-d')),
						   'dateResign' => strtotime($resignDate)
				 
				        );
				
				if($this->Employee->saveResignLetter($resignArray))
				{
					$admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(30,$adminUrl) || in_array(31,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
					
					
					
					
					$noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				        $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> Has Sent Resign Request.',
									'date' =>$noteDate,
									'link'=>'admin/resignApplication'							
							     	);
									$this->Notificationmodel->addNote($note);
						}
					$this->session->set_flashdata('success', 'Your Resignation Letter Has Been Sent');
				    redirect('employees/viewResign');
					
				}
				else
				{
					$this->session->set_flashdata('failed', 'Some Database Error');
				    redirect('employees/viewResign');
					
				}
			}
			
		}
		
		function uncompleteAttandance()
		{
			if($this->Employee->findUncompleteAttan())
			{
				$data['title'] = 'Uncomplete Attendance';
				$data['upCompleteAtt'] = $this->Employee->findUncompleteAttan();
				$this->load->view('employee/uncompleteAttendance',$data);
			
			
			}
			else
			{
			     $data['title'] = 'Uncomplete Attendance';
				
				$this->load->view('employee/uncompleteAttendance',$data);	
			}
			
		}
		
		function saveUncompleteQuery()
		{
			
			$date = $this->input->post('attendanceDateS');
			$id = $this->input->post('attendanceIdS');
			$hour = $this->input->post('hour');
			$min = $this->input->post('min');
			$am = $this->input->post('ap');
			$signOutTime = strtotime(date('Y-m-d',$date).' '.$hour.':'.$min.':00'.' '.$am);
			
			$arr =  array(
		                'signouttime'=>$signOutTime,
						'remark'=>'Sorry! I Missed Sign Out.'
		               );
			if($this->Employee->saveOldSignOut($date,$arr,$id))
			{
			
			
			
			   redirect('employees/viewAllPresence');
			
			}
			else
			{
			redirect('employees/uncompleteAttandance');	
			}
			
			
		}
		
		
		function currentProject()
		{ 
			$pro_id= $this->session->userdata('id');
			$data['title']=$this->lang->line('site_name').' :: Current Project:: ';
			$data['empData'] = $this->Add_Project_Model->show_project($pro_id);
			$this->load->view('employee/currentProject',$data);
		}
		
		function completeProject()
		{
		
			$data['title']=$this->lang->line('site_name').' :: Current Project:: ';
			$data['cpData'] = $this->Employee->myCompleteProject();
			
			$this->load->view('employee/completeProject',$data);
		}
		
		function rejectProject()
		{
			$data['title']=$this->lang->line('site_name').' :: Reject Project:: ';
			$data['title']=$this->lang->line('site_name').' :: Current Project:: ';
			$data['cpData'] = $this->Employee->myRejectProject();
			
			$this->load->view('employee/rejectProject',$data);
			
		}
		
		function projectAcceptReject()
		{
			
			$AssignId = $_POST['AssignId'];
			$AssignStatus = $_POST['AssignStatus'];
			$comment = $_POST['AssignComment'];
			$pid = $this->Employee->assignToProId($AssignId);
			
			if($AssignStatus == 'A')
			{
			$arr = array(
			             'status'=>$AssignStatus,
						 'report'=>$comment,
						 'workStart' =>strtotime(date('Y-m-d h:i:s A'))
			            );
						
						$admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(25,$adminUrl) || in_array(27,$adminUrl) || in_array(28,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
						
						
					$noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				        $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has been accepted a project.',
									'date' =>$noteDate,
									'link' =>'customers/projectSingle/'.$pid							
							     	);
									$this->Notificationmodel->addNote($note);
						}		
						
			}
			else
			{
				$arr = array(
			             'status'=>$AssignStatus,
						 'report'=>$comment .'<b> Rejected Time:</b> '. date('Y-m-d h:i:s A')
						 
			            );
						
						
						$admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(25,$adminUrl) || in_array(27,$adminUrl) || in_array(28,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
						
				      $noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				        $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has been rejected a project.',
									'date' =>$noteDate,	
									'link' =>'customers/projectSingle/'.$pid						
							     	);
									$this->Notificationmodel->addNote($note);
						}		
				
			}
			if($this->Employee->AssignAccept($arr,$AssignId))
			{
				$this->session->set_flashdata('success', 'You Successfully Done.');
			
				return $this->output->set_output('true');
			}
			else
			{
				$this->session->set_flashdata('failed', 'Error');
				
			
			return $this->output->set_output('false');
			}
			
		}
		
		
		
		function projectComplete($id =-1)
	     {
				if($this->Employee->AssignCompleteRequest($id))
				{
					$this->session->set_flashdata('success', 'Your Request Has Been Sent To Admin, Please Wait For Response.');
					
                       $admnList = $this->Notificationmodel->FindAdmin();
						$admnReal = array();
						foreach($admnList as $key=>$adn)
						{
						  $adminUrl = $this->Adminmodel->AuthoUrlbyId($adn);
						  if(in_array(25,$adminUrl) || in_array(27,$adminUrl) || in_array(28,$adminUrl))
						  {
						     //unset($admnList[$key]);
							 $admnReal[] =$adn;	  
						  }
						}
					
					
					$noteToList = array_merge($admnReal,$this->Notificationmodel->FindSuperAdmin());
						$senderName =	$this->Messagemodel->FindName($this->session->userdata('id'));								
						$noteDate = strtotime(date('Y-m-d h:i:s A'));
						
						foreach($noteToList as $value)
						{
				        $note = array(
						   			'to' =>$value,
									'msg' => '<b>'.$senderName .'</b> has sent Project Complete Request.',
									'date' =>$noteDate,
									'link'=>'admin/viewProjectCompleteRequest'							
							     	);
									$this->Notificationmodel->addNote($note);
						}
					
					redirect('employees/currentProject');
				}
				
				else
				{
					$this->session->set_flashdata('failed', 'You are not Acces Accoring Software, or You Have Already Sent A Request To Admin.');
					redirect('employees/currentProject');
				}
				
		 }


         
		 
		 
		 function viewHoliday($year=-1)
		{
			if($this->session->userdata('user_type') == 'E')
			{
				$data['title']=$this->lang->line('site_name').' :: View Holidays :: ';
				$data['list'] = $this->Employee->viewHoliday($year);
				$this->load->view("employee/holiday", $data);
			}
			else
			{
				redirect('admin/noaccess');
			}
			
		}
		
		
	/*	function test()
		{
		   echo strtotime(date('Y-m-d',strtotime('2011-9-25')));	
		}*/

}

/* End of file establishment.php */
/* Location: ./application/controllers/establishment.php */