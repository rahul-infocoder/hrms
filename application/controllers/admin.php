<?php if (!defined('BASEPATH')) {    exit('No direct script access allowed');}
require_once ("secure_area.php");
class Admin extends secure_area{
		public function __construct()    {  
		
		parent::__construct();		
		$this->load->model('Add_Project_Model');    
		$this->load->helper('download');
		$this->load->library('session');
		 $this->load->library('form_validation');
		}

	public function index()
	{


	}
	
	function viewCompanies()
	{
		if($this->session->userdata('user_type') != 'E')
		{
		if(!$this->Adminmodel->AdminAutho(36)){ redirect('admin/noaccess');}
		$data['cData'] = $this->Adminmodel->getAllCompanies();
		$data['title']=$this->lang->line('site_name').' :: VIEW COMPANIES :: ';
		$this->load->view("admin/viewCompanies", $data);
		}
		else
		{
			redirect('admin/noaccess');
		}
	
	}
	function noaccess()
		{
			
		
		$data['title']=$this->lang->line('site_name').' :: No Access  :: ';
		$this->load->view("access/noaccess", $data);
		
		}
	
	function viewEmployees($limit=50)
	{
		if($this->session->userdata('user_type') != 'E')
		{
			if(!$this->Adminmodel->AdminAutho(18)){ redirect('admin/noaccess');}
			
			$total =$this->Adminmodel->TotalgetAllEmployee();
			$limit =($limit == 'all')?$total:$limit;
			$config = array();
			$config["base_url"] = site_url('admin/viewEmployees/'.$limit);
			$config["total_rows"] = $total;
			$config["per_page"] = $limit;
			$config["uri_segment"] = 4; 
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data["links"] = $this->pagination->create_links();
			$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

			$data['empData'] = $this->Adminmodel->getAllEmployee($limit,$page);
			$data['title']=$this->lang->line('site_name').' :: VIEW EMPLOYEES :: ';
			$this->load->view("admin/viewAllEmployees", $data);
		}
		else
		{
			redirect('admin/noaccess');
		}
	
	}
	
	function viewIncrements($month='all',$year='all',$limit=50)
	{
		if($this->session->userdata('user_type') != 'E')
		{
		    if(!$this->Adminmodel->AdminAutho(11)){ redirect('admin/noaccess');}
			
			$dateFilter = $this->monthYear($month,$year);
			$dateFrom = $dateFilter[0];
			$dateTo = $dateFilter[1];
			
			$data['incData'] = $this->Adminmodel->getAllIncrements();
			$data['title']=$this->lang->line('site_name').' :: VIEW EMPLOYEES INCREMENTS :: ';
			$this->load->view("admin/viewAllIncrements", $data);
		}
		else
		{
			redirect('admin/noaccess');
			
		}
	
	}
	
	function viewMonthSalary($limit=50)
	{
		if($this->session->userdata('user_type') != 'E')
		{
		    if(!$this->Adminmodel->AdminAutho(1)){ redirect('admin/noaccess');}
			
			
			     $total = $this->Adminmodel->TotalSalaryRow();
				 $limit = ($limit =='all')?$total:$limit;
				$config = array();
				$config["base_url"] = site_url('admin/viewMonthSalary/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 4; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data["links"] = $this->pagination->create_links();
				
				$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';
			
		    $data['salData'] = $this->Adminmodel->findEmpSlry($limit,$page);
			$data['title']=$this->lang->line('site_name').' :: VIEW MONTH SALARY :: ';
			$this->load->view("admin/viewMonthSal", $data);
		}
		else
		{
			redirect('admin/noaccess');
			
		}
	
	}
	
	private function dayMonthYear($day,$month,$year)
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
				
				
			return array($dateFrom,$dateTo);	
	}
	
	function viewAttendance($day='all',$month='all',$year='all',$limit=50,$today='Yes')
	{
		
		if($this->session->userdata('user_type') != 'E')
		{   
		    if(!$this->Adminmodel->AdminAutho(17)){ redirect('admin/noaccess');}
			$dateFilter = $this->dayMonthYear($day,$month,$year);
			$dateFrom = $dateFilter[0];
			$dateTo = $dateFilter[1];
			
			
			$total = $this->Adminmodel->getTotalAttendance($dateFrom,$dateTo,$today);
			$limit = ($limit=='all')?$total:$limit;
				
				$config = array();
				$config["base_url"] = site_url('admin/viewAttendance/'.$day.'/'.$month.'/'.$year.'/'.$limit.'/'.$today);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 8; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
				$data["links"] = $this->pagination->create_links();	
				
				$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

				
			$data['attData'] = $this->Adminmodel->getAttendance($limit,$page,$dateFrom,$dateTo,$today);
			$data['title']=$this->lang->line('site_name').' :: VIEW EMPLOYEES ATTENDANCE :: ';
			$this->load->view("admin/viewAttendance", $data);
		}
		else
		{
			redirect('admin/noaccess');
		}
	}
	
	function viewLeaveApps($month='all',$year='all',$limit=50)
	{
		
		if($this->session->userdata('user_type') != 'E')
		{
			if(!$this->Adminmodel->AdminAutho(29)){ redirect('admin/noaccess');}
			
			$dateFilter = $this->monthYear($month,$year);
			$dateFrom = $dateFilter[0];
			$dateTo = $dateFilter[1];
			
			
			$totalRow = $this->Adminmodel->getAllLeaveAppsTotal($dateFrom,$dateTo);
			$limit = ($limit=='all')?$totalRow:$limit;
			
				$config = array();
				$config["base_url"] = site_url('admin/viewLeaveApps/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $totalRow;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
			     

			$data['leaveData'] = $this->Adminmodel->getAllLeaveApps($limit,$page,$dateFrom,$dateTo);
			$data['title']=$this->lang->line('site_name').' :: VIEW EMPLOYEES APPLICATIONS :: ';
			
			 $to = ($totalRow < ($page+$limit))?$totalRow:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$totalRow.' entries';
			$this->load->view("admin/viewLeaveapps", $data);
		}
		else{
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
	
	
	function viewAssignProjects($limit=50,$page=0,$month='all',$year='all',$status='all')
	{
		if($this->session->userdata('user_type') != 'E')
		{
			if(!$this->Adminmodel->AdminAutho(27)){ redirect('admin/noaccess');}
			
			
			     if($month=='all' && $year=='all')
					{
					   $dateFrom ='all';
					   $dateTo ='all';	
					}
					else if($month=='all'&& $year !='all')
					{
						$dateFrom = strtotime($year.'-01-01');
						$dateTo = strtotime($year.'-12-31');
						
					}
					else if($month !='all' && $year =='all')
					{
					   $dateFrom = strtotime(date('Y').'-'.$month.'-01');
					   $dateTo = strtotime(date('Y-m-t',$dateFrom));	
					}
					
					else if($month !='all' && $year !='all')
					{
						$dateFrom = strtotime($year.'-'.$month.'-01');
						$dateTo = strtotime(date('Y-m-t',$dateFrom));
					}
					else
					{
					  $dateFrom='all';
					  $dateTo='all';	
					}
			$totalRow = $this->Adminmodel->TotalAssignprojects($dateFrom,$dateTo,$status);
			$limit = ($limit=='all')?$totalRow:$limit;
			
				$config = array();
				$config["base_url"] = site_url('admin/viewAssignProjects/'.$limit);
				$config["total_rows"] = $totalRow;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 4; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data["links"] = $this->pagination->create_links();
		
		$to = ($totalRow < ($page+$limit))?$totalRow:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$totalRow.' entries';

			//$data['wData'] = $this->Adminmodel->Assignprojects($limit,$page,$dateFrom,$dateTo,$status);
			$data['wData'] = $this->Adminmodel->Assignprojects();
			
			//print_r($data['wData']);exit;
			
			$data['title']=$this->lang->line('site_name').' :: ASSIGNED PROJECTS :: ';
			$this->load->view("admin/viewassignprojects", $data);
			
			
			
	   }
	else{
	    redirect('admin/noaccess');
		}
	
	}
	
	
	
	
	
	
	function addEmployees($id=-1)
	{
		if($this->session->userdata('user_type') != 'E')
		{
	if(!$this->Adminmodel->AdminAutho(19)){ redirect('admin/noaccess');}
		if($id != -1)
		{
			if($this->Adminmodel->viewUserPermission($id))
			{
					$data['id'] = $id;
				   // $data['compData'] = $this->Adminmodel->getCompInfo($id);	
					$data['empData'] = $this->Adminmodel->getEmpInfo($id);
					$data['title']=$this->lang->line('site_name').' :: ADD EMPLOYEE :: ';
					$this->load->view("admin/addEmployee", $data);
				
			}
			else
			{
				$this->session->set_flashdata('failed', 'You have no permision to update this user');
				$this->load->view('access/noaccess');
				
			}
		}
		else{
		$data['id'] = $id;
		$data['compData'] = $this->Adminmodel->getCompInfo($this->session->userdata('cid'));	
		$data['empData'] = $this->Adminmodel->getEmpInfo($id);
		$data['title']=$this->lang->line('site_name').' :: ADD EMPLOYEE :: ';
		$this->load->view("admin/addEmployee", $data);
		}
	
	//return false;
		}
   else{
	redirect('admin/noaccess');
		}
	
	}
	
	function addCompany($id=-1)
	{
	if($this->session->userdata('user_type') != 'E' || $this->session->userdata('user_type') != 'A' )
		{
		$data['compData'] = $this->Adminmodel->getCompInfo($id);	
		$data['title']=$this->lang->line('site_name').' :: ADD COMPANY :: ';
		$this->load->view("admin/addCompany", $data);
		}
   else{
	redirect('admin/noaccess');
		}
	
	}
	
	
	
	function assignProject($id=-1)
	{
				if($this->session->userdata('user_type') != 'E' )
				{
				  if(!$this->Adminmodel->AdminAutho(25)){ redirect('admin/noaccess');}
					$data['projectList'] = $this->Add_Project_Model->get_project();			
					$data['empList'] = $this->Adminmodel->getAllEmpList();		
						$data['title']=$this->lang->line('site_name').' :: ASSIGN PROJECT :: ';
						$this->load->view("admin/assignProject", $data);
				}
			   else{
				   
				   redirect('admin/noaccess');
				
				   }
	}
	
	
	
	
	function addIncrement($id=-1)
	{
	if($this->session->userdata('user_type') != 'E' )
	{
		if(!$this->Adminmodel->AdminAutho(12)){ redirect('admin/noaccess');}
		$data['empList'] = $this->Adminmodel->getAllEmpList();	
		$data['incData'] = $this->Adminmodel->getIncrementInfo($id);
		$data['title']=$this->lang->line('site_name').' :: ADD INCREMENT :: ';
		$this->load->view("admin/addIncrement", $data);
	}
   else{
	   
	   redirect('admin/noaccess');
	
	   }
	}
	
	function email_check($email,$id)
	{
		$email = strtolower($email);
		if($this->Adminmodel->existEmail($email,$id))
		{
			return true;
			
		}
		else
		{
			return false;
			
		}
		
	}
	
	function saveEmp($id=-1)
	{
		
		
		
			
		
	if($this->session->userdata('user_type') != 'E' )
	{if(!$this->Adminmodel->AdminAutho(19)){ redirect('admin/noaccess');}
		
		$config = array(
               array(
                     'field'   => 'ename',
                     'label'   => 'Employee Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|matches[re-password]'
                  ),
               array(
                     'field'   => 're-password',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
				  array(
                     'field'   => 'doj',
                     'label'   => 'Date of Join',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'cid',
                     'label'   => 'Company',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'department',
                     'label'   => 'Department',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'gender',
                     'label'   => 'Gender',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'contact',
                     'label'   => 'Contact',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'eno',
                     'label'   => 'Emergency Number',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'address',
                     'label'   => 'Address',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'dob',
                     'label'   => 'Date of Birth',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'salary',
                     'label'   => 'Salary',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'months',
                     'label'   => 'Experience Month',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'years',
                     'label'   => 'Experience Year',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'paidLeave',
                     'label'   => 'Paid Leave',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'active',
                     'label'   => 'Employee Status',
                     'rules'   => 'required'
                  ),					array(                      'field'   => 'designation',                     'label'   => 'Designation',                     'rules'   => 'required'                  ),								  array(                      'field'   => 'panno',                     'label'   => 'Pan No',                     'rules'   => 'required'                  ),				   array(                      'field'   => 'bac',                     'label'   => 'Bank A/c',                     'rules'   => 'required'                  ),				  array(                      'field'   => 'carall',                     'label'   => 'CarAll',                     'rules'   => 'required'                  ),				  array(                      'field'   => 'conveyance',                     'label'   => 'Conveyance',                     'rules'   => 'required'                  ),					array(                      'field'   => 'madical',                     'label'   => 'Medical',                     'rules'   => 'required'                  ),
				 array(                      'field'   => 'incometax',                     'label'   => 'Incometax',                     'rules'   => 'required'                  ),					 array(                      'field'   => 'pf',                     'label'   => 'P.F',                     'rules'   => 'required'                  ),
				   array(                      'field'   => 'vpf',                     'label'   => 'VPF',                     'rules'   => 'required'                  ),					array(                      'field'   => 'esi',                     'label'   => 'ESI',                     'rules'   => 'required'                  )
            );
		
		$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == false)
			{
				
				
					$this->addEmployees($this->input->post('id'));
				
			}
			else
			{
		if($_FILES['userfile']['error'] == 0){
		//upload and update the file
        $config['file_name'] = time();
        $config['upload_path'] = 'upload/profileimages/';
		$config['allowed_types'] = 'jpg|gif|png';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			
		}
		
		else
		 {
			$data = array('upload_data' => $this->upload->data());
		 }
		}
	 $ids=	$this->input->post('reportAccess');
		if($ids == true)
		{
		$AceessReport = $this->input->post('reportAccess');
        $AceessReport = implode(",", $AceessReport);
			
		}
		else
		{
		$AceessReport =0;
		}
		
		$employeeCode  = $this->Adminmodel->employeeCode($this->input->post('cid'));
		$empArray = array(
		'contact_name'=>$this->input->post('ename'),
		'doj'=>strtotime(date("Y-m-d", strtotime($this->input->post('doj')))),
		'cid'=>$this->input->post('cid'),
		'employeeCode'=>$employeeCode,
		'department'=>$this->input->post('department'),
		'designation'=>$this->input->post('designation'),
		'gender'=>$this->input->post('gender'),
		'contact_email'=>strtolower($this->input->post('email')),
		'phone_num'=>$this->input->post('contact'),
		'emergency_number'=>$this->input->post('eno'),
		'address'=>$this->input->post('address'),
		'dob'=>strtotime(date('Y-m-d', strtotime($this->input->post('dob')))),
		'salary'=>$this->input->post('salary'),
		'image'=>($_FILES['userfile']['error'] == 0) ? $this->upload->file_name : $this->input->post('pfile'),
		'experience'=>$this->input->post('months').'-'.$this->input->post('years'),
		'password'=>sha1('WHAT_THE _HELL_IS_THIS'.sha1($this->input->post('password'))),
		'plain'=>$this->input->post('password'),
		'added_on'=>strtotime(date('Y-m-d')),
		'user_type'=>'E',
		'active' =>$this->input->post('active'),
		'carAll'=>$this->input->post('carall'),
		'conveyance'=>$this->input->post('conveyance'),
		'medical'=>$this->input->post('madical'),
		'incometax'=>$this->input->post('incometax'),
		'pf'=>$this->input->post('pf'),
		'vpf'=>$this->input->post('vpf'),
		'esi'=>$this->input->post('esi'),
		'panno' =>$this->input->post('panno'),
		'paidLeave' =>$this->input->post('paidLeave'),
		'bac' =>$this->input->post('bac'),
		'reportAccess'=> $AceessReport
		);
		
		         if($id != -1)
				   {
				     if (array_key_exists('added_on', $empArray))
					    {
                           unset($empArray['added_on']);
                        }
					if (array_key_exists('cid', $empArray))
					    {
                           unset($empArray['cid']);
                        }	
					if (array_key_exists('employeeCode', $empArray))
					    {
                           unset($empArray['employeeCode']);
                        }
			       }
		
		
		           if(!$_FILES['userfile']['name'])
				   {
					   if(array_key_exists('image',$empArray))
					   {
						   unset($empArray['image']);
						   
						 }
					   
				   }
			
		if($this->email_check($this->input->post('email'),$id))
		{
			if($this->Adminmodel->saveEmployee($empArray, $id))
			{
				
						
				//New Certificate
					if($id==-1)
					{   
					$this->session->set_flashdata('success', 'New Employee Has been added.');					
						
					   
					
					}
					else //previous Certificate
					{
					$this->session->set_flashdata('success', 'Employee Has been updated.');
					
							
							 
					}
					$this->load->helper('email_helper');
					$msg = 'User Name: '.strtolower($this->input->post('email')).'<br/>';
					$msg .= 'Password: '.$this->input->post('password');
					send_email(strtolower($this->input->post('email')),'Log In Details',$msg);
					redirect('admin/viewEmployees');		
					
			   		
			}
			else//failure
			{	
			$this->session->set_flashdata('failed', 'There is some problem in saving data.');
				
					redirect('admin/viewEmployees');
				
			}
		
		}
				
	else
		{
			$this->session->set_flashdata('failed', 'Email is already exits.');
			
				redirect('admin/viewEmployees');
			
		}
		
		
		
		
			} // End validation
			
			
		}
   else{
	   
	   redirect('admin/noaccess');
	
	   }	
	   
	   
	   
	}
	
	function saveIncrement($id=-1)
	{
	if($this->session->userdata('user_type') != 'E' )
	{
		if(!$this->Adminmodel->AdminAutho(13)){ redirect('admin/noaccess');}
		$incArray = array(
		'empid'=>$this->input->post('elist'),
		'increment'=>$this->input->post('increment'),
		'doi'=>strtotime(date('Y-m-d', strtotime($this->input->post('doi')))),
		'remark'=>$this->input->post('remark')
		);
		
		if($this->Adminmodel->saveInc($incArray, $id, $this->input->post('elist'), $this->input->post('increment')))
		{
			//New Establishment
			   
		   
			
                $this->session->set_flashdata('success', 'Insentive has been added in '.date('M-Y', strtotime($this->input->post('doi'))) .' Salary');
					
					$noteDate = strtotime(date('Y-m-d h:i:s A'));				
					
					$note = array(
					'to' =>$this->input->post('elist'),
					'msg' => 'Congrat.. There is an increment of Rs '. $this->input->post('increment') .' in your month Salary. This will effect from '.date('M-Y', strtotime($this->input->post('doi'))),
					'date' =>$noteDate						
					);
					$this->Notificationmodel->addNote($note);
					
					
			
			redirect('admin/viewIncrements');
			
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('admin/viewIncrements');
		}
	}
   else{
	   
	   redirect('admin/noaccess');
	
	   }
		
	}
	
	
	
	function saveComp($id=-1)
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
		$this->form_validation->set_rules('cname', 'Company Name', 'required');
		/*$this->form_validation->set_rules('userfile', 'Company Logo', 'required');*/
		$this->form_validation->set_rules('des', 'Company Description', 'required');
		$this->form_validation->set_rules('sdate', 'Company salary date', 'required');
		$this->form_validation->set_rules('active', 'Company Active', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
			if($this->form_validation->run() == false)
			{
	         // return false;
	         $this->addCompany();
			}
			else
			{
		if($_FILES['userfile']['error'] == 0){
		//upload and update the file
        $config['file_name'] = time();
        $config['upload_path'] = 'upload/profileimages/';
		$config['allowed_types'] = 'jpg|gif|png';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			
		}
		
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
		}
		
		// End Upload file 
		
		$cArray = array(
		'name'=>$this->input->post('cname'),
		'logo'=>($_FILES['userfile']['error'] == 0) ? $this->upload->file_name : $this->input->post('pfile'),
		'description'=>$this->input->post('des'),
		'salaryDate'=>$this->input->post('sdate'),
		'active'=>$this->input->post('active'),
		'sname' => $this->input->post('sname'),
		'country'=>$this->input->post('country'),
		'state' =>$this->input->post('state'),
		'city' =>$this->input->post('city'),
		'address' =>$this->input->post('address'),
		'zip' =>$this->input->post('zip'),
		'phone'=>$this->input->post('phone'),
		'email' =>$this->input->post('email')
		);
		if(!$_FILES['userfile']['name'])
		{
				if (array_key_exists('logo', $cArray)) {
                    unset($cArray['logo']);
                    }
		}
		
		
		if($this->Adminmodel->comNameExists($this->input->post('cname'),$id))
		{
					if($this->Adminmodel->saveCompany($cArray, $id))
					{
						//New Establishment
						if($id==-1)
						{   
						$this->session->set_flashdata('success', 'New Company has been added.');
						redirect('admin/viewCompanies');
						}
						else //previous Establishment
						{
						$this->session->set_flashdata('success', 'Company has been updated.');
						redirect('admin/viewCompanies');
						}
					}
					else//failure
					{	
					$this->session->set_flashdata('failed', 'There is some problem in saving data.');
					redirect('admin/viewCompanies');
					}
					
			}
			else{
				$this->session->set_flashdata('failed', 'Invalid Company Name');
					redirect('admin/viewCompanies');
				
				}
					
		}
			
	}
   else{
	   
	   redirect('admin/noaccess');
	
	   }	
	}
	
	function saveAssignProject($id=-1)
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
		$fArray = array(
		'pid'=>$this->input->post('plist'),
		'eid'=>$this->input->post('elist')
		);
		
		if($this->Adminmodel->assignIt($fArray, $id))
		{
			//New Establishment
			if($id==-1)
			{   
		    $this->session->set_flashdata('success', 'Your project has been assigned.');
			redirect('admin/viewIncrements');
			}
			else //previous Establishment
			{
			$this->session->set_flashdata('success', 'Your Increment has been updated.');
			redirect('admin/viewIncrements');
			}
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('admin/viewIncrements');
		}
		
		}
   else{
	   
	   redirect('admin/noaccess');
	
	   }
		
	}
	
	function toggleLeaveStatus($id, $status)
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
			if(!$this->Adminmodel->AdminAutho(30)){ redirect('admin/noaccess');} 
		if($this->Adminmodel->togStatus($id, $status))
		{
		    $this->session->set_flashdata('success', 'Leave Status Changed.');
			if($status == 'Y')
			{
			 $strL = 'Approved';	
			}
			else
			{
				 $strL = 'Disapproved';
			}
			
									
						$noteDate = strtotime(date('Y-m-d h:i:s A'));					
						$to = $this->Notificationmodel->leaveInfo($id);
				        $note = array(
						   			'to' =>$to,
									'msg' => 'Your Leave has been '.$strL.'.',
									'date' =>$noteDate,
									'link'=>'employees/viewAllLeaves'							
							     	);
									$this->Notificationmodel->addNote($note);
						
			
			redirect('admin/viewLeaveApps');
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('admin/viewLeaveApps');
		}
		}
   else{
	   
	   redirect('admin/noaccess');
	
	   }
		
	}
	
	function delEmployees($id)
	{
	if($this->session->userdata('user_type') != 'E' )
	     {
			 if(!$this->Adminmodel->AdminAutho(19)){ redirect('admin/noaccess');}
		  if($this->Adminmodel->delEmp($id)){
			  
			$this->session->set_flashdata('success', 'Employee Has been deleted.');
			redirect('admin/viewEmployees');  
			
		  }
		  
		  else{
			  
			$this->session->set_flashdata('failed', 'Not Deleted! Error!!!.');
			redirect('admin/viewEmployees'); 
			  
		  }
		}
   else{
	   
	   redirect('admin/noaccess');
	
	   }  	  
	}
	
	function delCompanies($id)
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
		  if($this->Adminmodel->delComp($id)){
			  
			$this->session->set_flashdata('success', 'Company Has been deleted.');
			redirect('admin/viewCompanies');  
			
		  }
		  
		  else{
			  
			$this->session->set_flashdata('failed', 'Not Deleted! Error!!!.');
			redirect('admin/viewCompanies'); 
			  
		  }
		 }
	   else{
		   
		   redirect('admin/noaccess');
		
		   } 
		  	  
	}
	
	
	function editProfile()
	{
		
			$data['title']=$this->lang->line('site_name').' :: Edit Profile :: ';
			$data['empData'] = $this->Adminmodel->getAdminInfo($this->session->userdata('id'));
			//$data['compData'] = $this->Adminmodel->getCompInfo($this->session->userdata('cid'));
		     $this->load->view("admin/updateProfile", $data);	
		
	}
	function signOut($id)
	{
		
		
	$data['signoutData'] = $this->Adminmodel->get_emp_info($id);
	$data['title']=$this->lang->line('site_name').' :: SIGN OUT :: ';
	$this->load->view("Adminmodel/signout", $data);
		
	
	}
	
	function saveSignout($id)
	{
		
		$signoutArray = array(
		'signouttime' => strtotime(date('Y-m-d h:i:s'))
		);
		
		if($this->Adminmodel->saveSignout($signoutArray, $id))
		{
			//New Establishment
			if($id==-1)
			{   
		    $this->session->set_flashdata('success', 'You Are Now Signed Out.');
			redirect('Adminmodels/viewAllPresence');
			}
			else //previous Establishment
			{
			$this->session->set_flashdata('success', 'Signout Has been updated.');
			redirect('Adminmodels/viewAllPresence');
			}
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('establishment');
		}

		
	}
	
	function reqLeave($id)
	{
		
	$data['empData'] = $this->Adminmodel->get_emp_info($id);
	$data['title']=$this->lang->line('site_name').' :: REQUEST LEAVE :: ';
	$this->load->view("Adminmodel/reqleave", $data);
		
	
	}
	
	function saveLeaveReq($id)
	{
		$leaveArray = array(
		'empid' => $id,
		'leavefrom' => strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom')))),
		'leaveto' => strtotime(date('Y-m-d', strtotime($this->input->post('leaveto')))),
		'fullday' => (strtotime(date('Y-m-d', strtotime($this->input->post('leaveto')))) - strtotime(date('Y-m-d', strtotime($this->input->post('leavefrom'))))) / 86400,
		'reason' => $this->input->post('reason')
		);
		
		if($this->Adminmodel->saveLeaveR($leaveArray, $id))
		{
			//New Establishment
			if($id==-1)
			{   
		    $this->session->set_flashdata('success', 'Leave Request Has Been Saved.');
			redirect('Adminmodels/viewAllLeaves');
			}
			else //previous Establishment
			{
			$this->session->set_flashdata('success', 'Leave Request Has been updated.');
			redirect('Adminmodels/viewAllLeaves');
			}
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('establishment');
		}
		
	}
	

	function viewAllPresence()
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
	$data['presenceData'] = $this->Adminmodel->getAllPresence($this->session->userdata('id'));
	$data['title']=$this->lang->line('site_name').' :: VIEW MY ATTENDANCE :: ';
	$this->load->view("Adminmodel/viewPresesnce", $data);
	 }
	   else{
		   
		   redirect('admin/noaccess');
		
		   } 
	}
	
	function viewmyProjects()
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
		
	$data['pData'] = $this->Adminmodel->getMyProject($this->session->userdata('id'));
	$data['title']=$this->lang->line('site_name').' :: MY PROJECTS :: ';
	$this->load->view("Adminmodel/viewMyProjects", $data);
	 }
	   else{
		   
		   redirect('admin/noaccess');
		
		   } 
	
	}
	
	function assignProjectDate($id)
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
		
	$data['mpData'] = $this->Adminmodel->get_project_info($id);
	$data['title']=$this->lang->line('site_name').' :: ASSIGN DATE SLOT :: ';
	$this->load->view("Adminmodel/assignProjectDate", $data);
	 }
	   else{
		   
		   redirect('admin/noaccess');
		
		   } 
	
	}
	
	function sendWorkReport($id)
	{
		
	$data['wData'] = $this->Adminmodel->get_project_info($id);
	$data['title']=$this->lang->line('site_name').' :: SEND WORK REPORT :: ';
	$this->load->view("Adminmodel/workReportForm", $data);
	
	}
	
	function saveMyProjectDates($id)
	{
		
		$pArray = array(
		'esdatefrom' => strtotime(date('Y-m-d', strtotime($this->input->post('datefrom')))),
		'esdateto' => strtotime(date('Y-m-d', strtotime($this->input->post('dateto')))),
		'remarks' => $this->input->post('remarks'),
		'status' => 'M'
		);
		
		if($this->Adminmodel->savemyPDates($pArray, $id))
		{
			//New Establishment
			if($id==-1)
			{   
		    $this->session->set_flashdata('success', 'Your Project Date Has Been Marked.');
			redirect('Adminmodels/viewmyProjects');
			}
			else //previous Establishment
			{
			$this->session->set_flashdata('success', 'Your Project Date Has Been Marked.');
			redirect('Adminmodels/viewmyProjects');
			}
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('Adminmodels/viewmyProjects');
		}
		
	
	
	
		
	}
	
	function saveMyReport($id)
	{
		if($this->session->userdata('user_type') != 'E' )
	     {
		$wArray = array(
		'eid'=>$this->session->userdata('id'),
		'reportdate' => strtotime(date('Y-m-d')),
		'report' => $this->input->post('report')
		);
		
		if($this->Adminmodel->saveMyWork($wArray, $id))
		{
			//New Establishment
			if($id==-1)
			{   
		    $this->session->set_flashdata('success', 'Your Work Report sent and saved.');
			redirect('Adminmodels/viewMyReport');
			}
			else //previous Establishment
			{
			$this->session->set_flashdata('success', 'Your Work Report sent and saved.');
			redirect('Adminmodels/viewMyReport');
			}
		}
		else//failure
		{	
		$this->session->set_flashdata('failed', 'There is some problem in saving data.');
		redirect('Adminmodels/viewMyReport');
		}
		}
	   else{
		   
		   redirect('admin/noaccess');
		
		   } 
	}
	
	function viewMyReport($day='all',$month='all',$year='all',$limit=50)
	{
		if($this->session->userdata('user_type') != 'E')
		{
			if(!$this->Adminmodel->AdminAutho(15)){ redirect('admin/noaccess');}
			
			
			
			
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
			
			   $total = $this->Adminmodel->TotalgetMyWorkReports($dateFrom,$dateTo);
				$limit = ($limit=='all')?$total:$limit;
				
				$config = array();
				$config["base_url"] = site_url('admin/viewMyReport/'.$day.'/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 7; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
				$data["links"] = $this->pagination->create_links();	
			
			$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

			$data['wData'] = $this->Adminmodel->getMyWorkReports($limit,$page,$dateFrom,$dateTo);
			$data['title']=$this->lang->line('site_name').' :: MY WORK REPORTS :: ';
			$this->load->view("admin/viewMyWorks", $data);
		}
		else
		{
		   redirect('admin/noaccess');	
		}
	
	}
	
	
	
	/*View And add Admin User */
	
	function viewAdminUser($limit=50)
	{
		if($this->session->userdata('user_type')== 'SA')
		{
			$total = $this->Adminmodel->totalAdmin();
			$limit =($limit=='all')?$total:$limit;
			
			    $config = array();
				$config["base_url"] = site_url('admin/viewAdminUser/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 4; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data["links"] = $this->pagination->create_links();
				
				$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

			
			$data['empData'] = $this->Adminmodel->getAdminAllEmployee($limit,$page);
	        $data['title']=$this->lang->line('site_name').' :: VIEW ADMIN USERS :: ';
	        $this->load->view("admin/viewAdmin", $data);
		}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
	}
	
	function addAdmin($id =-1)
	{
		if($this->session->userdata('user_type')== 'SA')
		{ 
				 $data['empData'] = $this->Adminmodel->AdminInfo();
				 $data['title']=$this->lang->line('site_name').' :: ADD ADMIN USERS :: ';
				 $this->load->view("admin/addAdmin", $data);
			// if($this->Adminmodel->adminExists($id))
			// {
				// $data['id'] = $id;
				// //$data['empData'] = $this->Adminmodel->getAdminInfo($id);
				// $data['empData'] = $this->Adminmodel->AdminInfo();
				// $data['title']=$this->lang->line('site_name').' :: ADD ADMIN USERS :: ';
				// $this->load->view("admin/addAdmin", $data);
				
			// }
			// else
			// {
				// $data['id'] = $id;
				// $data['empData'] = $this->Adminmodel->getAdminInfo($id);
				// $data['title']=$this->lang->line('site_name').' :: ADD ADMIN USERS :: ';
				// $this->load->view("admin/addAdmin", $data);
			// }

		}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
		
    }
	public function updateRole()
	{
		$update = $this->Adminmodel->userStatus();
		 //print_r($update);exit;
	if(isset($update)){
		//print_r("hello");exit;
		 $this->Adminmodel->updateUserRoles($update);
	}
		redirect('admin/addAdmin');
	}
	function saveAdmin($id=-1)
	{		if($this->session->userdata('user_type')== 'SA')
		{
		
		$config = array(
               array(
                     'field'   => 'ename',
                     'label'   => 'Admin Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|matches[re-password]'
                  ),
               array(
                     'field'   => 're-password',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
				  array(
                     'field'   => 'adminActive',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'companies',
                     'label'   => 'Access Companies',
                     'rules'   => 'required'
                  )
            );
		
		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == false)
			{
				$this->addAdmin($this->input->post('id'));
			}
			else
			{
				if(!$this->email_check($this->input->post('email'),$id))
						{
						 $this->session->set_flashdata('failed', 'Email Already Exist.');
						 redirect('admin/viewAdminUser');
						}
				
				$adminAutho =array(
				                ($this->input->post('Vcompany'))?$this->input->post('Vcompany'):'0',
								($this->input->post('Acompany'))?$this->input->post('Acompany'):'0',
								($this->input->post('Dcompany'))?$this->input->post('Dcompany'):'0',
								($this->input->post('addAssignProject'))?$this->input->post('addAssignProject'):'0',
								($this->input->post('VassignProject'))?$this->input->post('VassignProject'):'0',
								($this->input->post('AssignProjectRequest'))?$this->input->post('AssignProjectRequest'):'0',
								($this->input->post('Vemployee'))?$this->input->post('Vemployee'):'0',
								($this->input->post('Aemployee'))?$this->input->post('Aemployee'):'0',
								($this->input->post('ADemployee'))?$this->input->post('ADemployee'):'0',
								($this->input->post('VDemployee'))?$this->input->post('VDemployee'):'0',
								($this->input->post('VIemployee'))?$this->input->post('VIemployee'):'0',
								($this->input->post('Vattendance'))?$this->input->post('Vattendance'):'0',
								($this->input->post('Vreport'))?$this->input->post('Vreport'):'0',
								($this->input->post('Vleave'))?$this->input->post('Vleave'):'0',
								($this->input->post('Aleave'))?$this->input->post('Aleave'):'0',
								($this->input->post('Vinc'))?$this->input->post('Vinc'):'0',
								($this->input->post('Ainc'))?$this->input->post('Ainc'):'0',
								($this->input->post('Dinc'))?$this->input->post('Dinc'):'0',
								($this->input->post('Vbonus'))?$this->input->post('Vbonus'):'0',
								($this->input->post('Abonus'))?$this->input->post('Abonus'):'0',
								($this->input->post('Dbonus'))?$this->input->post('Dbonus'):'0',
								($this->input->post('Vins'))?$this->input->post('Vins'):'0',
								($this->input->post('Ains'))?$this->input->post('Ains'):'0',
								($this->input->post('Dins'))?$this->input->post('Dins'):'0',
								($this->input->post('Vsalary'))?$this->input->post('Vsalary'):'0',
								($this->input->post('VSsalary'))?$this->input->post('VSsalary'):'0',
								($this->input->post('VOsalary'))?$this->input->post('VOsalary'):'0',
								($this->input->post('VOSsalary'))?$this->input->post('VOSsalary'):'0',
								($this->input->post('Gsalary'))?$this->input->post('Gsalary'):'0',
								($this->input->post('client'))?$this->input->post('client'):'0',
								($this->input->post('Vresign'))?$this->input->post('Vresign'):'0',
								($this->input->post('VPresign'))?$this->input->post('VPresign'):'0'
								
								);
								
				$remove = array(0);
				$adminAutho = array_diff($adminAutho, $remove);
		        $adminUrl = implode(',',$adminAutho);				
				
				$comapnies = $this->input->post('companies');
		        $comapnies = implode(",", $comapnies);
				$admArray =  array(
				                    'contact_name' => $this->input->post('ename'),
									'contact_email' => $this->input->post('email'),
									'password' => sha1('WHAT_THE _HELL_IS_THIS'.sha1($this->input->post('password'))),
									'plain' => $this->input->post('password'),
									'accessComp' => $comapnies,
									'active' => $this->input->post('adminActive'),
									'added_on' => strtotime(date('Y-m-d')),
									'user_type' => 'A',
									'adminAutho' => $adminUrl			
				                   );
				
				if($id != -1)
				{
				   if (array_key_exists('added_on', $admArray)) {
                    unset($admArray['added_on']);
                    }	
			    }
				
				
				
				if($this->Adminmodel->saveEmployee($admArray, $id))
				 {
					 
					 if($id == -1)
					 {
						 $this->session->set_flashdata('success', 'New Admin Has been added.');
						 
					 }
					 else
					 {
						 $this->session->set_flashdata('success', 'Admin has been updated ');
						 
					 }
					 
					  $this->load->helper('email_helper');
					$msg = 'User Name: '.strtolower($this->input->post('email')).'<br/>';
					$msg .= 'Password: '.$this->input->post('password');
					send_email(strtolower($this->input->post('email')),'Log In Details',$msg);
					redirect('admin/viewAdminUser');
					
					
					 
				 }
				 else
				 {
					 $this->session->set_flashdata('failed', 'There is some problem in saving data.');
					 redirect('admin/viewAdminUser');
					 
				 }
				
			}
			
			}
		else
		{
			
			 redirect('admin/noaccess');
		}
		
	}
	
	
	/*End Admin Control*/
	
	
	
	/*My profile*/
	
	function globalCompany()
	{
		if($this->session->userdata('user_type') != 'E')
		{
		if($_POST['id'] != -1){
		$this->session->set_userdata('global_comp',$_POST['id']);
		}
		else
		{
			$this->session->set_userdata('global_comp','');
		}
		
			}
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	
	/*Pay salary */
	function payIt($id)	
	{
		if(!$this->Adminmodel->AdminAutho(4)){ redirect('admin/noaccess');}
		if($this->session->userdata('user_type') != 'E')
		{
		
		   $sly = array(
		             'pay_date'=>strtotime(date('d-m-Y')),
					 'amount'=> $this->input->post('netSalary'),
					 'emid'=> $this->input->post('EmpId'),
					 'pay_month'=> $this->input->post('pay_month'),
					 'pay_by'=>$this->session->userdata('id'),
					 'leave'=>$this->input->post('leave'),
					 'halfday'=>$this->input->post('halfday'),
					 'bonus'=>$this->input->post('bonus'),
					 'insentive'=>$this->input->post('insentive'),
					 'carAll' => $this->input->post('carAll'),
					 'dutyTravel'=> $this->input->post('dutyTravel'),
					 'conveyance'=> $this->input->post('conveyance'),
					 'medical'=> $this->input->post('medical'),
					 'incometax'=>$this->input->post('incometax'),
					 'pf'=> $this->input->post('pf'),
					 'vpf' =>$this->input->post('vpf'),
					 'esi' =>$this->input->post('esi'),
					 'leaveAmount'=>$this->input->post('leaveAmount'),
					 'basic'=>$this->input->post('basic'),
					 'paidLeaveAmount' =>$this->input->post('paidLeaveAmount'),
					 'paidLeaveYN' =>  $this->input->post('paidLeaveYN'),
					 'holiday'=>$this->input->post('holiday')
		   
		             );
		   
		   
		   if($this->Adminmodel->savesalary($sly))
		   {
			   $this->session->set_flashdata('success', 'Salary has been save Sucessfully.');
			   
			     $noteDate = strtotime(date('Y-m-d h:i:s A'));				
				
				$note = array(
						'to' =>$id,
						'msg' => 'Your Salary has been paid for the month of '.$this->input->post('pay_month'),
						'date' =>$noteDate						
						);
				$this->Notificationmodel->addNote($note);
			   redirect('admin/viewMonthSalary');
		   }
		   else
		   {
			   $this->session->set_flashdata('failed', 'Problem to save salary');
			   redirect('admin/viewMonthSalary');
			   
			}
		   
		}
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	
	function salarySlip($id)
	{
		if(!$this->Adminmodel->AdminAutho(5)){ redirect('admin/noaccess');}
		
		if($this->session->userdata('user_type') == 'A')
		{
			if(!$this->Adminmodel->salarySlipAdminAccess($id))
		   {
			   
			   redirect('admin/noaccess');
		   }
		 
			
			
		}
		
		
		if($this->session->userdata('user_type') != 'E')
		{
			$data['id']= $id;
			
			$data['title']=$this->lang->line('site_name').' :: VIEW Salary Slip :: ';
			$this->load->view("admin/salarySlip", $data);
	
	
	     }
		else
		{
			
			 redirect('admin/noaccess');
		}
	}
	/*pay salary*/
	
	function saveMyProfile()
	{
		$config = array(
               array(
                     'field'   => 'contact',
                     'label'   => 'Contact No',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|matches[re-password]'
                  ),
               array(
                     'field'   => 're-password',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'eno',
                     'label'   => 'Emergency No',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'address',
                     'label'   => 'Address',
                     'rules'   => 'required'
                  ),
				  
				  array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
				   array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
				  array(
                     'field'   => 'uname',
                     'label'   => 'User Name',
                     'rules'   => 'required'
                  )
				   				 
				  
            );
			
			//unset($config[0]);
			 if($this->session->userdata('user_type')!='SA')
				   {
					unset($config[5]); 
					unset($config[6]);   
					   
				   }
		
		$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == false)
			{
				
				$this->editProfile();
			}
			
			else
			{
				
				$id = $this->session->userdata('id');
				if($_FILES['userfile']['error'] == 0){
						//upload and update the file
						$config['file_name'] = time();
						$config['upload_path'] = 'upload/profileimages/';
						$config['allowed_types'] = 'jpg|gif|png';
						
						$this->load->library('upload', $config);
				
						if ( ! $this->upload->do_upload('userfile'))
						{
							$error = array('error' => $this->upload->display_errors());
							
						}
						
						else
						 {
							$data = array('upload_data' => $this->upload->data());
						 }
		            }
				/* file upload*/
				
				$empArray = array(				                 
				                 'phone_num'=>$this->input->post('contact'),
								'emergency_number'=>$this->input->post('eno'),
								'address'=>$this->input->post('address'),
								'image'=>($_FILES['userfile']['error'] == 0) ? $this->upload->file_name : $this->input->post('pfile'),
								'password'=>sha1('WHAT_THE _HELL_IS_THIS'.sha1($this->input->post('password'))),
								'plain'=>$this->input->post('password'),
								'contact_email' =>$this->input->post('email'),
								'contact_name' =>$this->input->post('name'),
								'userName' => $this->input->post('uname')
				                 );
				
				
				 if(!$_FILES['userfile']['name'])
				   {
					   if(array_key_exists('image',$empArray))
					   {
						   unset($empArray['image']);
						   
						 }
					   
				   }
				   if($this->session->userdata('user_type')!='SA')
				   {
					   if(array_key_exists('contact_email',$empArray))
					   {
						   unset($empArray['contact_email']);
						   
						 }
						 if(array_key_exists('contact_name',$empArray))
					   {
						   unset($empArray['contact_name']);
						   
						 }
					   
					 }
				   
				   if($this->email_check($this->input->post('email'),$this->session->userdata('id')))
		           {
				      if($this->User->userNameCheck($this->input->post('uname')))
					  {
							   if($this->Adminmodel->saveEmployee($empArray, $id))
								 {
									 $this->session->set_flashdata('success', 'Your Information has been updated.');
									 redirect('admin/editProfile');
						
								 }
								 else
								 {
									 $this->session->set_flashdata('failed', 'Problem.');
									 redirect('admin/editProfile');
								}
								
								


					  }
					  else
					  {
						  $this->session->set_flashdata('failed', 'User Name is already exits.');
							
								redirect('admin/editProfile');
						  
						}
					  
				}
					
								
	
					else
						{
							$this->session->set_flashdata('failed', 'Email is already exits.');
							
								redirect('admin/editProfile');
							
						}
						 
				
				
			}
		
	}
	
	
	
	
	
		function viewPaidSalary($month='all',$year='all',$limit=50)
		{
			if(!$this->Adminmodel->AdminAutho(2)){ redirect('admin/noaccess');}
			if($this->session->userdata('user_type') != 'E')
		    {
				$paymonth = 'all';
				if(($month !='all') && ($year !='all'))
				{
					$paymonth =$year.'-'.$month;
				}
				
				$total = $this->Adminmodel->salarydetailsTotal($paymonth);
				$limit = ($limit=='all')?$total:$limit;
				
				$config = array();
				$config["base_url"] = site_url('admin/viewPaidSalary/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();				
			    
				$data['salData'] = $this->Adminmodel->salarydetails($paymonth,$limit,$page);
				$data['title']=$this->lang->line('site_name').' :: PAID SALARY :: ';
				$data['totalAmount'] = $this->Adminmodel->salaryamountTotal($paymonth);
				$this->load->view("admin/salaryDetail", $data);
		     }
			else
			{
				
				 redirect('admin/noaccess');
			}
		
		}
		
		
		
		
	
		
	
		
		function viewBonus()
		{
			if($this->session->userdata('user_type') != 'E')
		    {
				if(!$this->Adminmodel->AdminAutho(7)){ redirect('admin/noaccess');}
				$data['bList']= $this->Adminmodel->viewBonus();
				$data['title']=$this->lang->line('site_name').' :: View BONUS :: ';
				$this->load->view("admin/viewBonus", $data);
			}
			else
			{
				redirect('admin/noaccess');
			}
			
		}
		
		function addBonus()
		{
			if($this->session->userdata('user_type') != 'E')
		    {
				if(!$this->Adminmodel->AdminAutho(9)){ redirect('admin/noaccess');}
				$data['empList'] = $this->Adminmodel->getAllEmpList();	
				$data['title']=$this->lang->line('site_name').' :: ADD BONUS :: ';
				$this->load->view("admin/addBonus", $data);
				
			}
			else
			{
				redirect('admin/noaccess');
			}
		}
		function savebonus()
		{
			if($this->session->userdata('user_type') != 'E')
		    {
				if(!$this->Adminmodel->AdminAutho(9)){ redirect('admin/noaccess');}
				$emid = $this->input->post('elist');
				$bonus = $this->input->post('bonus');
				$remark = $this->input->post('remark');
				
				$month = $this->Adminmodel->runMonthsalary($emid);
				$month = $month.'-'.'1';
		        $month = strtotime(date_format(new DateTime($month),'d-m-Y'). " +1 month");
				$month = date('Y-m',$month);
				
				$arr = array(
				               'empid'=>$emid,
							   'amount'=>$bonus,
							   'month'=>$month,
							   'date'=>strtotime(date('d-m-Y')),
							   'remarks'=>$remark
				
				              );
				if($this->Adminmodel->saveBonusData($arr))
				{
					$this->session->set_flashdata('success', 'Bonus has been added in '.$month .' Salary');
					
					$noteDate = strtotime(date('Y-m-d h:i:s A'));				
					
					$note = array(
					'to' =>$emid,
					'msg' => 'Congratulation Rs: '.$bonus. ' bonus has been added in your salary of '.$month,
					'date' =>$noteDate						
					);
					$this->Notificationmodel->addNote($note);
					
					redirect('admin/viewBonus');
					
				}
				else
				{
					$this->session->set_flashdata('failed', 'Some database error');
					redirect('admin/viewBonus');
					
				}			  
				
				
			}
			else
			{
				redirect('admin/noaccess');
			}
			
		}
		
		
		
		
		function increFilter()
		{
			if($this->session->userdata('user_type') != 'E')
		    {
				if(!$this->Adminmodel->AdminAutho(11)){ redirect('admin/noaccess');}
				$m = $this->input->post('month');
			$y = $this->input->post('year');
			$date = $y.'-'.$m.'-01';
			$data['incData'] = $this->Adminmodel->incrementfilter($date);
			$data['title']=$this->lang->line('site_name').' :: INCREMENTS :: ';
			$this->load->view("admin/viewAllIncrements", $data);
				
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
			
		}
		
		function bonusFilter()
		{
			
			if($this->session->userdata('user_type') != 'E')
		    {
			if(!$this->Adminmodel->AdminAutho(7)){ redirect('admin/noaccess');}	
				$m = $this->input->post('month');
			$y = $this->input->post('year');
			$date = $y.'-'.$m.'-01';
			$data['bList'] = $this->Adminmodel->bonusfilter($date);
			$data['title']=$this->lang->line('site_name').' :: BONUS :: ';
			$this->load->view("admin/viewBonus", $data);
				
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
			
		}
		
		function oldSlip($id,$month)
		{
			if(!$this->Adminmodel->AdminAutho(4)){ redirect('admin/noaccess');}
			if($this->session->userdata('user_type') != 'E')
		    {
				if($this->session->userdata('user_type') == 'A')
				   {
						if(!$this->Adminmodel->salarySlipAdminAccess($id))
					   {
						   
						   redirect('admin/noaccess');
					   }
			 
				
				
				   }
				$data['salData'] = $this->Adminmodel->salarydetailsSap($id,$month);
				$data['title']=$this->lang->line('site_name').' :: PAID SALARY SLIP :: ';
				
				$this->load->view("admin/oldSlip", $data);
				}
			else
				{
					
					 redirect('admin/noaccess');
				}
		    	
		}
		
		function delbonus($id)
		{
			if(!$this->Adminmodel->AdminAutho(8)){ redirect('admin/noaccess');}
			
			if($this->session->userdata('user_type') == 'A')
			{
			 if(!$this->Adminmodel->BonusUrlPermission($id))
			 {
				 redirect('admin/noaccess');
				 
				}
			}
			if($this->session->userdata('user_type') != 'E')
		    {
				
				if($this->Adminmodel->delBonus($id))
				{
					$this->session->set_flashdata('success', 'Bonus has been deleted.');
					redirect('admin/viewBonus');
					
				}
			
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
			
		}
		
		
		function viewEmployeeRead($id)
		{
			if($this->session->userdata('user_type') != 'E')
		    {
				if(!$this->Adminmodel->AdminAutho(24)){ redirect('admin/noaccess');}
		        $data['empData'] = $this->Adminmodel->getEmpInfo($id);
	            $data['title']=$this->lang->line('site_name').' :: View Employee :: ';
	            $this->load->view("admin/employeeDetails", $data);	
				
				}
			else
				{
					
					 redirect('admin/noaccess');
				}
		}
		
		
		function reporPopup($id)
		{
			if($this->Adminmodel->Vreport($id))
			{
			$data['Wreport'] = $this->Adminmodel->Vreport($id);
			$data['title'] ='Work Report';
			$this->load->model('Reportcomment'); 
			$data['comment']  =$this->Reportcomment->fetchreportComm($id);
			
			
			$this->load->view("all/report", $data);
			}
			
		}
		
		
		function resignApplication($month='all',$year='all',$limit=50)
		{
			if(!$this->Adminmodel->AdminAutho(31)){ redirect('admin/noaccess');}
			if($this->session->userdata('user_type') != 'E')
		    {
				$dateFilter = $this->monthYear($month,$year);
				 
				 $dateFrom = $dateFilter[0];
				 $dateTo = $dateFilter[1];
				 
				 
				 $total = $this->Adminmodel->TotalResignLatter($dateFrom,$dateTo);
				 $limit = ($limit =='all')?$total:$limit;
				$config = array();
				$config["base_url"] = site_url('admin/resignApplication/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
				$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

				
				$data['ReData'] = $this->Adminmodel->viewResignDetails($limit,$page,$dateFrom,$dateTo);
				$data['title']=$this->lang->line('site_name').' :: RESIG APPLICATION :: ';
				$this->load->view("admin/resignApplication", $data);
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
		}
		
		function resignApprove($id,$status)
		{ 
		   if(!$this->Adminmodel->AdminAutho(32)){ redirect('admin/noaccess');}
			if($this->session->userdata('user_type') != 'E')
		    {
				if($this->session->userdata('user_type') == 'A')
				 {
					 if(!$this->Adminmodel->resignUrlPermission($id))
					 {
						redirect('admin/noaccess');
						
					 }
					
				 }
				
			
				if($status == 'W')
				{
					$array = array(
					                 'approvedBy'=>$this->session->userdata('id'),
									 'approvedDate' => strtotime('Y-m-d'),
									 'status' => 'A'
					               );
					 if($this->Adminmodel->ResignUpdate($id,$array))
						 {
							 
							 $this->session->set_flashdata('success', 'Resign Has Been Approved.');
							 $noteDate = strtotime(date('Y-m-d h:i:s A'));				
							$to = $this->Notificationmodel->resignToEmp($id);
							$note = array(
									'to' =>$to,
									'msg' => 'Your Resign Has Been Approved' .'.',
									'date' =>$noteDate,
									'link'=>'employees/viewAllLeaves'							
									);
							$this->Notificationmodel->addNote($note);
							 redirect('admin/resignApplication');
						  }
						  else
						  {
							   $this->session->set_flashdata('failed', 'Database Problem.');
							   redirect('admin/resignApplication');
							  
						 }
				}
				
				else if($status == 'A')
				{
					$array = array(
					                 
									 'status' => 'R'
					               );
					 if($this->Adminmodel->ResignUpdate($id,$array))
						 {
							 $this->Adminmodel->DisableEmployee($id);
							 $this->session->set_flashdata('success', 'Resign Has Been Complete.');
							 redirect('admin/resignApplication');
						  }
						  else
						  {
							   $this->session->set_flashdata('failed', 'Database Problem.');
							   redirect('admin/resignApplication');
							  
						 }
					
				}
				
				else if($status == 'D')
				{
					$array = array(
					                 
									 'status' => 'D'
					               );
					 if($this->Adminmodel->ResignUpdate($id,$array))
						 {
							// $this->Adminmodel->DisableEmployee($id);
							 $this->session->set_flashdata('success', 'Resign Has Been Disapproved.');
							 redirect('admin/resignApplication');
						  }
						  else
						  {
							   $this->session->set_flashdata('failed', 'Database Problem.');
							   redirect('admin/resignApplication');
							  
						 }
					
				}
				
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
		}
		
		
		function AddDocuments()
		{
			if($this->session->userdata('user_type') != 'E')
		    {
				if(!$this->Adminmodel->AdminAutho(21)){ redirect('admin/noaccess');}
				$data['empList'] = $this->Adminmodel->getAllEmpList();
				$data['title']=$this->lang->line('site_name').' :: DOCUMENTS :: ';
			     $this->load->view("admin/EmployeeDocument", $data);
				
				
				
				}
			else
				{
					
					 redirect('admin/noaccess');
				}
			
		}
		
		function saveDocument()
		{
			if($this->session->userdata('user_type') != 'E')
				{
				 if(!$this->Adminmodel->AdminAutho(21)){ redirect('admin/noaccess');}
					    $upload_conf = array(
						'upload_path'   => realpath('upload/document/'),
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
					
					$eid = $this->input->post('elist');		
					$DocName = $this->input->post('Dname');
					$message = '';
					for($i=0; $i< count($Fname); $i++)
					{
						$DName = $DocName[$i];
						$FName = $Fname[$i];
					
						$message .= $DName;
						$Daaray = array(
						              'emid' =>$eid,
									  'docName' =>$DName,
									  'file'=>$FName					               
						
										);
										
										
							if($this->Adminmodel->saveDocuments($Daaray))
							{
							   $message .= ' has been saved <br/>';	
							}			
												
					}
					
					
					$this->session->set_flashdata('success', $message);
					 redirect('admin/AddDocuments');
					
					
				
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
		}
		
		function docsdelete($id,$fname,$eid,$folder,$redirect)
		{
		if(!$this->Adminmodel->AdminAutho(21)){ redirect('admin/noaccess');}
			$redirect = explode('-',$redirect);
			$redirect = implode('/',$redirect);
			$this->Adminmodel->delDocument($id);
			$url = 'upload/'.$folder.'/'.$fname;
			if(file_exists($url))
			{
			   unlink($url);
			}
			
			if($this->Adminmodel->delDocument($id))
			{
				
				$this->session->set_flashdata('success', 'Document Has Been Deleted');
					 redirect($redirect.'/'.$eid);
					
			}
		}
		
		function viewDisbaleEmp($limit=50)
		{
			if($this->session->userdata('user_type') != 'E')
				{
					if(!$this->Adminmodel->AdminAutho(24)){ redirect('admin/noaccess');}	
					
					echo $total =$this->Adminmodel->TotalgetAllEmployeeD();
			$limit =($limit == 'all')?$total:$limit;
			$config = array();
			$config["base_url"] = site_url('admin/viewDisbaleEmp/'.$limit);
			$config["total_rows"] = $total;
			$config["per_page"] = $limit;
			$config["uri_segment"] = 4; 
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data["links"] = $this->pagination->create_links();
			$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

			$data['empData'] = $this->Adminmodel->getAllEmployeeD($limit,$page);
						
					
					$data['title']=$this->lang->line('site_name').' :: VIEW DISABLE EMPLOYEES :: ';
					$this->load->view("admin/disableEmp", $data);
				}
				else
				{
					redirect('admin/noaccess');
				}
		}
		
		
		
		function delIncreMent($id)
		{
			if($this->session->userdata('user_type') == 'A')
			{
			  if(!$this->Adminmodel->AdminAutho(12)){ redirect('admin/noaccess');}	
			 if(!$this->Adminmodel->IncrementUrlPermission($id))
			 {
				 redirect('admin/noaccess');
				 
			 }
			}
			
			
			if($this->session->userdata('user_type') != 'E')
				{
			
			   if($this->Adminmodel->delInc($id))
			   {
				   $this->session->set_flashdata('success', 'Increment Has Been Deleted');
					 redirect('admin/viewIncrements');
				   
			   }
			   
			   else
			   {
				   $this->session->set_flashdata('failed', 'Database error found');
					 redirect('admin/viewIncrements');
				   
				  }
			
			
				}
				else
				{
					redirect('admin/noaccess');
				}
			
		}
		
		function AceesCompaniesEmployee()
		{
			if($this->session->userdata('user_type') != 'E')
				{
			//echo $cid;
			 $cid = $_POST['id'];
			
			
			if($this->Adminmodel->getCompanyEmp($cid))
			{
			 return $this->output->set_output(json_encode($this->Adminmodel->getCompanyEmp($cid)));
			}
			else
			{
			return $this->output->set_output(json_encode(false));
			}
			}
				else
				{
					redirect('admin/noaccess');
				}
			
		}
		
		function saveAssignProjectC()
	   {
		if($this->session->userdata('user_type') != 'E' )
	     {
			 if(!$this->Adminmodel->AdminAutho(25)){ redirect('admin/noaccess');}
			 $dl = strtotime(date('Y-m-d',strtotime($this->input->post('dl'))));
		     $ary = array(
		           'pid' =>$this->input->post('plist'),
				   'eid' => $this->input->post('elist'),
				   'status' =>'W',
				   'remarks' => $this->input->post('remark'),
				   'esdatefrom'=> strtotime(date('Y-m-d')),
		           'deadLine'=> $dl
		            );
		
				if($this->Adminmodel->AssignSave($ary))
				{
					
					$noteDate = strtotime(date('Y-m-d h:i:s A'));				
					$to = $this->input->post('elist');
					$note = array(
									'to' =>$to,
									'msg' => 'You have been Assigned For a New Project.',
									'date' =>$noteDate,
									'link' =>'employees/viewmyNewProjects'							
									);
                         
					$this->Notificationmodel->addNote($note);
					//$this->session->set_flashdata('success', 'Project has been sent to Employee');
					 _set_message('Project has been sent to Employee','success');
				    redirect('admin/assignProject');
				}
				else
				{
					_set_message('failed','error');
					redirect('admin/assignProject');	
				}
		
		
		 }
		   else{
			   
			   redirect('admin/noaccess');
			
			   }
	
		
	}
	
	function viewProjectCompleteRequest($limit=50)
	{
		if($this->session->userdata('user_type') != 'E')
				{
				if(!$this->Adminmodel->AdminAutho(28)){ redirect('admin/noaccess');}
				
				
				
				$config = array();
				$config["base_url"] = site_url('admin/viewProjectCompleteRequest/'.$limit);
				$config["total_rows"] = $this->Adminmodel->TotalCompleteProjectRequestModule();
				$config["per_page"] = $limit;
				$config["uri_segment"] = 4; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data["links"] = $this->pagination->create_links();
				
				$data['title']=$this->lang->line('site_name').' :: VIEW Request :: ';
				$data['wData']=$this->Adminmodel->CompleteProjectRequestModule($limit,$page);
				
			    $this->load->view("admin/projectCompleteRequest", $data);	
				}
				
				else
				{
					redirect('admin/noaccess');
				}
				
				
		
	}
	function saveProjectRequest()
	{
		
	
			 if($this->session->userdata('user_type') != 'E')
				{
				  if(!$this->Adminmodel->AdminAutho(28)){ redirect('admin/noaccess');}
						$AssignId = $_POST['AssignId'];
						$AssignStatus = $_POST['AssignStatus'];
						$comment = $_POST['AssignComment'];						
						$noteDate = strtotime(date('Y-m-d h:i:s A'));				
						$to = $this->Notificationmodel->assignToEmp($AssignId);
						
						if($AssignStatus == 'A')
						{
						$arr = array(
									 'status'=>'C',
									 'ePerformance'=>$comment,
									 'endWork' =>strtotime(date('Y-m-d h:i:s A'))
									);
									
									
									
									 
							$note = array(
									'to' =>$to,
									'msg' => 'Your Request For Complete Project Has Been Accepted.',
									'date' =>$noteDate,
									'link'=>'employees/completeProject'							
									);
							
									
						}
						else
						{
							$arr = array(
									 'completeReq'=>'N',
									 'ePerformance'=>$comment .'<b> Rejected Time:</b> '. date('Y-m-d h:i:s A')
									 
									);
									
							$note = array(
									'to' =>$to,
									'msg' => 'Your Request For Complete Project Has Been Rejected.',
									'date' =>$noteDate,
									'link'=>'employees/currentProject'							
									);		
							
						}
						
						if($this->Adminmodel->ProjecjComplete($arr,$AssignId))
						{
							$this->session->set_flashdata('success', 'You Successfully Done.');
							$this->Notificationmodel->addNote($note);
							
						}
						else
						{
							$this->session->set_flashdata('failed', 'Error');
						}
						
					
				}
				
				else
				{
					redirect('admin/noaccess');
				}
		
	}
	
	function addInsentive()
     {
		 if(!$this->Adminmodel->AdminAutho(41)){ redirect('admin/noaccess');}
		 if($this->session->userdata('user_type') != 'E')
		    {
				$data['empList'] = $this->Adminmodel->getAllEmpList();	
				$data['title']=$this->lang->line('site_name').' :: ADD BONUS :: ';
				$this->load->view("admin/Addinsemtive", $data);
				
			}
			else
			{
				redirect('admin/noaccess');
			}
		 
	}
	
	function saveInsen()
	{
		if(!$this->Adminmodel->AdminAutho(41)){ redirect('admin/noaccess');}
			if($this->session->userdata('user_type') != 'E')
		    {
				$emid = $this->input->post('elist');
				$insentive = $this->input->post('bonus');
				$remark = $this->input->post('remark');
				
				$month = $this->Adminmodel->runMonthsalary($emid);
				$month = $month.'-'.'1';
		        $month = strtotime(date_format(new DateTime($month),'d-m-Y'). " +1 month");
				$month = date('Y-m',$month);
				
				$arr = array(
				               'empid'=>$emid,
							   'amount'=>$insentive,
							   'month'=>$month,
							   'date'=>strtotime(date('d-m-Y')),
							   'remarks'=>$remark
				
				              );
				if($this->Adminmodel->saveInsentiveData($arr))
				{
					$this->session->set_flashdata('success', 'Insentive has been added in '.$month .' Salary');
					
					$noteDate = strtotime(date('Y-m-d h:i:s A'));				
					
					$note = array(
					'to' =>$emid,
					'msg' => 'Congratulation Rs: '.$insentive. ' Insentive has been added in your salary of '.$month,
					'date' =>$noteDate						
					);
					$this->Notificationmodel->addNote($note);
					
					redirect('admin/viewInsentive');
					
				}
				else
				{
					$this->session->set_flashdata('failed', 'Some database error');
					redirect('admin/viewInsentive');
					
				}			  
				
				
			}
			else
			{
				redirect('admin/noaccess');
			}
	}
	
    function viewInsentive($month='all',$year='all',$limit=50)
     {
		 if(!$this->Adminmodel->AdminAutho(40)){ redirect('admin/noaccess');}
		 if($this->session->userdata('user_type') != 'E')
		    {
				$dateFilter = $this->monthYear($month,$year);
				$dateFrom = $dateFilter[0];
				$dateTo = $dateFilter[1];
				
				$totalRow = $this->Adminmodel->InsentiveTotal($dateFrom,$dateTo);
			     $limit = ($limit=='all')?$totalRow:$limit;
			
				$config = array();
				$config["base_url"] = site_url('admin/viewInsentive/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $totalRow;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
				$to = ($totalRow  < ($page+$limit))?$totalRow :($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$totalRow .' entries';

				
				$data['bList']= $this->Adminmodel->viewInsentive($limit,$page,$dateFrom,$dateTo);
				$data['title']=$this->lang->line('site_name').' :: View BONUS :: ';
				$this->load->view("admin/viewInsentive", $data);
			}
			else
			{
				redirect('admin/noaccess');
			}
	 }
	
	
	function delInsentive($id)
		{
			
			if($this->session->userdata('user_type') == 'A')
			{
			 if(!$this->Adminmodel->InsentiveUrlPermission($id))
			 {
				 redirect('admin/noaccess');
				 
				}
			}
			if($this->session->userdata('user_type') != 'E')
		    {
				
				if($this->Adminmodel->delInsentive($id))
				{
					$this->session->set_flashdata('success', 'Insentive has been deleted.');
					redirect('admin/viewInsentive');
					
				}
				else{
					
					$this->session->set_flashdata('failed', 'Error.');
					redirect('admin/viewInsentive');
					}
			
			}
			else
				{
					
					 redirect('admin/noaccess');
				}
			
		}
		
		function holiday()
		{
			if($this->session->userdata('user_type') == 'E')
			{
				 redirect('admin/noaccess');
			}
			else
			{
				$data['title']=$this->lang->line('site_name').' :: Holidays :: ';
				return $this->load->view("admin/hodiday", $data);
			}
			
			
		    
		}
		
		function holidaySave()
		{
			$msg= '';
			$this->load->model('holidaymodel');
			
	    $cid = $this->input->post('cid');
		 $name= $this->input->post('name');
	     $dateFrom = strtotime(date('Y-m-d',strtotime($this->input->post('dateFrom'))));
	      $dateTo = strtotime(date('Y-m-d',strtotime($this->input->post('dateTo'))));
          $date =$this->input->post('dateFrom');

		   $days = (($dateTo-$dateFrom)/86400)+1;
		
		for($i=0; $i<$days; $i++)
			{
				
				$ondate = strtotime(date('Y-m-d',strtotime($date)));
				$dayIs = date('D',strtotime($date));
				$date = $date.'+1 day';
				$arry = array(
				               'cid'=>$cid,
							   'day'=>$dayIs,
							   'date'=>$ondate,
							   'hname'=>$name
				              );
					if($this->holidaymodel->holidayExits($cid,$ondate))
					{			  
					   $this->holidaymodel->addholiday($arry);
					   $msg .= 'Holiday Of '. date('d-m-Y',$ondate) .' Is Add. <br/>';	
					}
					else
					{
					  $msg .= 'Holiday Of '. date('d-m-Y',$ondate) .' Is Already Exits. <br/>';	
					}
				
				
				
			}
			
			$this->session->set_flashdata('success',$msg);
			redirect('admin/viewHoliday');
			
		}
		
		function viewHoliday($year=-1)
		{
			if($this->session->userdata('user_type') == 'E')
			{
				 redirect('admin/noaccess');
			}
			else
			{
				$data['title']=$this->lang->line('site_name').' :: View Holidays :: ';
				$this->load->model('holidaymodel');
				$data['list'] = $this->holidaymodel->viewHoliday($year);
				$this->load->view("admin/viewHoliday", $data);
			}
			
		}
		
		function deleteHoliday($id)
		{
			
			if($this->session->userdata('user_type') == 'E')
			{
				 redirect('admin/noaccess');
			}
			else
			{
				
				$this->load->model('holidaymodel');
				if($this->holidaymodel->holidayDelete($id))
				{
					$this->session->set_flashdata('success','Holiday Has been Delete');
				   redirect('admin/viewHoliday');
				}
				
				else
				{
					$this->session->set_flashdata('success','Some SQL ERROR.');
					redirect('admin/viewHoliday');
				}
				
			}
			
		}
		
		
	/* rahul code starts */	
		
    function addProject(){
	$title=$this->lang->line('site_name').' :: ADD PROJECT :: ';	
	$this->load->view("admin/addProject", compact('title'));	
	}		
	function insert_project(){
		$this->load->library('session');
		$dataInfo = array(); $dataName = array();
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		$add_project=$this->Add_Project_Model->insert_project($_POST);
		//$add_project='51';
		if($add_project!=""){
			for($i=0; $i < $cpt; $i++)
			{           
				$_FILES['userfile']['name']= $files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i]; 

				$this->load->library('upload');
				$this->upload->initialize($this->set_upload_options($add_project, time().$_FILES['userfile']['name']));
				if ( ! $this->upload->do_upload('userfile'))
				{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
				}
				else{
					$dataInfo[] = $this->upload->data();
				}
			}
			foreach($dataInfo as $image){
				$dataName[] = $image['file_name'];
			}
			
			$add_update_image=$this->Add_Project_Model->update_image(json_encode($dataName), $add_project);
			//print_r($add_update_image);exit;
			if($add_update_image){
				//print_r($add_update_image);exit;
				//echo '<script>alert("added");</script>';
				// $message="You have Successfully Uploaded Your Data.";
				// $case="success";
				 _set_message('You have Successfully Uploaded Your Data.','success');
				 redirect('admin/addProject');
			
				//$this->session->set_flashdata('succ_msg','You have Successfully Uploaded Your Data.');
				
			}else{
				_set_message("Something gone wrong,Data was not Uploaded.",'error');
				redirect('admin/addProject');
			}
			
		} 
		
		//echo json_encode($dataName);print_r($add_project);
	}
	private function set_upload_options($add_project, $new_name)
	{   
		//upload an image options
		if(!file_exists('./upload/'.$add_project)){
			$dir=mkdir('./upload/'.$add_project);
		}
		
		$config = array();
		$config['file_name'] = $new_name;
		$config['upload_path'] = './upload/'.$add_project;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}
	
	function viewProject(){	
	$title=$this->lang->line('site_name').' :: VIEW PROJECT :: ';	
	//$this->load->model('Add_Project_Model');
	$all_project=$this->Add_Project_Model->get_project();
	$this->load->view("admin/viewProject", compact('title','all_project'));	
	}
	 function addUser(){
	$title=$this->lang->line('site_name').' :: ADD USER :: ';	
	$this->load->view("admin/addUser", compact('title'));	
	}
		function uploadData()
		{
			
			$this->Add_Project_Model->uploadData();
			redirect('admin/addUser');
		}
		
		public function AdminProjectDetails($id){
		if($this->session->userdata('user_type') == 'SA' || $this->session->userdata('user_type') == 'A'){	
		 $id=$id;
		 $data['id']=$id;
		 $data['proData']=$this->Add_Project_Model->decribe_project($id);
		// $data['eid'] = $this->session->userdata('id');
		// $value=$this->db->query("select * from start_time where eid='".$data['eid']."' AND pid='".$data['id']."'");
		// $value = $value->row();
		// //print_r($value->pause);
		
		// if(!empty($value)){
			// $str_time = $value->pause;
			// $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
			// sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
			// $data['time_seconds'] = $hours * 3600 + $minutes * 60 + $seconds;
		// }else{
			// $data['time_seconds']= 5;
		// }
		//print_r($time_seconds);
		$data['title']=$this->lang->line('site_name').' :: ADMIN PROJECT DETAILS :: ';
	  $this->load->view('admin/adminProjectDetails',$data);	
	}else {	
	redirect('admin/noaccess');			
		}
	}
				
		/* rahul code ends */	
}

/* End of file establishment.php */
/* Location: ./application/controllers/establishment.php */