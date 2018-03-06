<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller{
	public $ConfigValidation = array();
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
			  
			
			 require_once("validation.php");
			//$variable
			//print_r($configVali['saveCustomer']);
			$this->ConfigValidation = $configVali;
			
			
           if($this->session->userdata('user_type') == 'E'){
			   redirect('/');
		   }
		   
		   if(!$this->Adminmodel->AdminAutho(6)){ redirect('admin/noaccess');}
			 
    }
	 	public function index()
			{
				
		     
			
			}
			
			
			function addCustomer ($id=-1)
			{
			
				$data['title']=$this->lang->line('site_name').' :: ADD Customers :: ';
				if($id != -1)
				{
					if($this->Customer->CustomerDetail($id))
					{
						$data['cInfo'] = $this->Customer->CustomerDetail($id);
					}
					
				}
				$this->load->view("customers/addCustomer", $data);
				
			} 
			
			function saveCustomer($id =-1)
			{
				
				
				$dor = strtotime(date('Y-m-d',strtotime($this->input->post('addDate'))));
				
				
	
						$this->form_validation->set_rules($this->ConfigValidation['saveCustomer']);
						
						$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
						if($this->form_validation->run() == false)
							{
								
								
									
									$this->addCustomer();
								
							}
							else
							
							{
								
								$arr = array(
								            'name'=>$this->input->post('ename'),
											'email' =>$this->input->post('email'),
											'mobile' =>$this->input->post('mobile'),
											'address' =>$this->input->post('address'),
											'zip'=> $this->input->post('zip'),
											'companyName' => $this->input->post('ccompany'),
											'bycompany' =>$this->input->post('company'),
											'dor'=> $dor,
											'country'=>$this->input->post('country'),
											'state'=>$this->input->post('state'),
											'city'=>$this->input->post('city'),
								             'currency'=>$this->input->post('currency')
								             );
								
								 if($id != -1)
								   {
									 /*if (array_key_exists('dor', $arr))
										{
										   unset($arr['dor']);
										}*/
										
									if (array_key_exists('currency', $arr))
										{
										   unset($arr['currency']);
										}		
								   }
								
								if(!$this->Customer->EmailExists($this->input->post('email')))
								{
									$this->session->set_flashdata('failed', 'Email is already exists.');
								     redirect('customers/addCustomer');
								}
								if($this->Customer->saveCustomer($id,$arr))
								{
								 	
								    redirect('customers/viewClient');
								}
								else
								{
									$this->session->set_flashdata('failed', 'There Is Some Database Problem.');
									redirect('customers/addCustomer');
									
								}
								
							}
				  
				
			}
			
			function addProject($id =-1)
			{
				$data['title']=$this->lang->line('site_name').' :: ADD Project:: ';
				if($this->Customer->ProjectByIdDB($id))
				{
					$data['Pdetail'] = $this->Customer->ProjectByIdDB($id);
				}
				
				$this->load->view("customers/addProject", $data);
				
			}
			function aadPayment($id=-1)
			{
				$data['title']=$this->lang->line('site_name').' :: ADD Payment:: ';
	
				
				$this->load->view("customers/addPayment", $data);
			}
			
			
			
			function saveProject($id=-1)
			{
				$addDate = strtotime(date('Y-m-d',strtotime($this->input->post('addDate'))));
				$aar = array(
				             'clienId'=>$this->input->post('client'),
							 'pName' => $this->input->post('pName'),
							 'pUrl' => $this->input->post('pUrl'),
							 'pDes'=> $this->input->post('pDes'),
							 'pEstitime' =>$this->input->post('estiTime'),
							 'status' =>$this->input->post('pStatus'),
							 'AddDate' => $addDate,
							 'price' =>$this->input->post('pPrice'),
							 'pType' => $this->input->post('pType'),
							 'proType' => $this->input->post('proType')
				
				            );
							
											
									
									
							if($id !=-1)
							{
								
								if (array_key_exists('clienId', $aar))
									{
									   unset($aar['clienId']);
									}
									
								/*	if (array_key_exists('AddDate', $aar))
									{
									   unset($aar['AddDate']);
									}	*/	
									
								
											
							}
						
							
							
							if($proId= $this->Customer->saveProjectDB($aar,$id))
							{
							
								
								$upload_conf = array(
										'upload_path'   => realpath('upload/projectFile/'),
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
													  'profid' =>$proId,
													  'docName' =>$DName,
													  'file'=>$FName					               
										
														);
														
														
											$this->Adminmodel->saveDocuments($Daaray);
													
																
									}
								if($id == -1)
								{
								$this->session->set_flashdata('success', 'Project Add Successfully.');
								}
								else
								 {
									 $this->session->set_flashdata('success', 'Project Has Been Updated.');
								}
							redirect('customers/viewProject');
							  	
							}
							
							else
							{
							       $this->session->set_flashdata('failed', 'There Is Some Database Problem.');
									redirect('customers/addProject');	
							 }
			}
			
			
			function savePayment()
			{
				if($this->input->post('amount') <= $this->input->post('limit'))
				{
					$payDate = strtotime(date('Y-m-d',strtotime($this->input->post('payDate'))));
					$reference = $this->Customer->referenceNo();;
					$arr = array(
					              'srNo'=>$this->Customer->nextPaymentNo($this->input->post('client')),
								 'amount'=> $this->input->post('amount'),
								 'clientId' => $this->input->post('client'),
								 'date' =>$payDate,
								 'reference'=>$reference,
								 'currency'=>$this->input->post('currency'),
								 'payMethod'=>$this->input->post('method'),
								 'Iid'=>$this->input->post('pid')
								);
					
					if($this->Customer->savePayment($arr))
					{
						redirect('customers/viewPayment');
					}
				
				}
				else
				{
			     $this->session->set_flashdata('failed', 'Your Amount Greater Than Invoice Amount');
				 redirect('customers/aadPayment');	
				}
				
				
				
			}
			
			
			function viewClient($month='all',$year='all',$limit=50)
			{
				 
				
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
					$total = $this->Customer->totalClient($dateFrom,$dateTo);
					$limit = ($limit =='all')?$total:$limit;
				$config = array();
				$config["base_url"] = site_url('customers/viewClient/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
				
				$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';
				$data['title']=$this->lang->line('site_name').' :: ADD Project:: ';
			    $data['cData'] = $this->Customer->clientList($dateFrom,$dateTo,$limit,$page);		
				$this->load->view("customers/viewClient", $data);
			}
			
			function viewProject($limit=50,$page=0,$month='all',$year='all',$status='all')
			{
				
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
				
				$total = $this->Customer->TotalProjectList($dateFrom,$dateTo,$status);
				$limit = ($limit=='all')?$total:$limit;
				$data['title']=$this->lang->line('site_name').' :: View Project:: ';				
				$config = array();
				$config["base_url"] = site_url('customers/viewProject/'.$limit.'/'.$page.'/'.$month.'/'.$year.'/'.$status);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 8; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
				$data["links"] = $this->pagination->create_links();
				
				
				
				$to = ($total < ($page+$limit))?$total:($page+$limit);
				$data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';
			
			    $data['cData'] = $this->Customer->ProjectList($limit,$page,$dateFrom,$dateTo,$status);
				$data['tData'] = $this->Customer->totalProjectAmount($dateFrom,$dateTo,$status);
				$this->load->view("customers/viewProject", $data);
			}
			
			
			
			
			function viewPayment($month='all',$year='all',$limit=50)
			{
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
					$total = $this->Customer->TotalpaymentList($dateFrom,$dateTo);
					$limit = ($limit=='all')?$total:$limit;
				$config = array();
				$config["base_url"] = site_url('customers/viewPayment/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
				
				$data['amountDetails'] =$this->Customer->TotalAmountPayment($dateFrom,$dateTo);
				
					$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

				$data['title']=$this->lang->line('site_name').' :: View Payment: ';
			
			    $data['cData'] = $this->Customer->paymentList($dateFrom,$dateTo,$limit,$page);		
				
				$this->load->view("customers/viewPayment", $data);
				
			}
			
			
			
			
/*			function Send()
			{
				$this->load->library('customemail');
				//$this->customemail->to('hitesh.speedupseo@gmail.com');
               $this->customemail->Email('sdgshgd','Mail Mail','hitesh.speedupseo@gmail.com','Testing');
			}
	          */
			 
			 
			 function addInvoice($id=-1)
			 {
				 $data['title']=$this->lang->line('site_name').' :: Add Invoice: ';
				 if($this->Customer->clientDeatil($id))
				 {
				 $data['cData'] =$this->Customer->clientDeatil($id);
				 $this->load->view("customers/addInvoice", $data);
				 }
				 
			  } 
			  
			  
			  function saveInvoice()
			  {
				  //Project Information
				  $projects = $this->input->post('project');
				  $Pamount = $this->input->post('amount');
				  $des = $this->input->post('des');
				  
				  $currency = $this->input->post('currency');
				  $duedate = $this->input->post('due');
				  $duedate = strtotime(date('Y-m-d',strtotime($duedate)));
				  
				  //Invoice Information 
				  
				  
				  $clientId = $this->input->post('Cid'); 
				  
				  
				  $grandTotal = $this->input->post('hgrandTotal');
				  $total = $this->input->post('hTotal');
				  $discount = $this->input->post('hDiscount');
				  
				  $serviceTax = $this->input->post('sTax');
				  $educationTax = $this->input->post('eTax');
				  $secondaryTax = $this->input->post('secTax');
				  
				
				   $date = strtotime(date('Y-m-d',strtotime($this->input->post('incD'))));
				
				  $createBy = $this->session->userdata('id'); 
				  
				  $invArr = array(
				                  'invoiceNo'=>$this->Customer->nextInvoiceNo($clientId),
				                  'clientId'=>$clientId,
								  'total'=>$total,
								  'discount'=>$discount,
								  'serviceTax'=>$serviceTax,
								  'EducationTax'=>$educationTax,
								  'SecondaryTax'=>$secondaryTax,
								  'CreateBy'=>$createBy,
								  'date'=>$date,
								  'grandTotal'=>$grandTotal,
								  'currency'=>$currency,
								  'dueDate' =>$duedate,
								  'pid' =>$projects
				                   
				                  );
								  
								  
			  if($this->Customer->saveInvoice($invArr,$projects,$Pamount,$des))
			  {
				  $this->session->set_flashdata('success', 'Invoice Has Been Create.');
				  redirect('customers/viewInvoice');
			  }
				  
				  
			  }
			  
			  function viewInvoice($month='all',$year='all',$limit=50)
			  {
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
					
				$total =$this->Customer->totalInvoice($dateFrom,$dateTo);	
				$limit = ($limit =='all')?$total:$limit;
				$config = array();
				$config["base_url"] = site_url('customers/viewInvoice/'.$month.'/'.$year.'/'.$limit);
				$config["total_rows"] = $total;
				$config["per_page"] = $limit;
				$config["uri_segment"] = 6; 
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["links"] = $this->pagination->create_links();
				
				
				$data['amountDtails'] = $this->Customer->invoiceTotal($dateFrom,$dateTo);
				  
				  $data['InvcData'] = $this->Customer->viewInvoice($dateFrom,$dateTo,$limit,$page);
				  $to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

				  $data['title']=$this->lang->line('site_name').' :: View Invoice List : ';
				  $this->load->view("customers/viewInvoiceList", $data);
				  
				}
				
				
				function invoiceDetail($id)
				{
					 $data['cData'] = $this->Customer->viewInvoiceDetails($id);
					 $data['title']=$this->lang->line('site_name').' :: View Invoice Detail : ';
					 $this->load->view("customers/viewInvoiceDetail", $data);
					
					
					
				}
				
				
				function clientSingle($id)
				{
					$data['title']=$this->Customer->singleClient($id)->clientName;
					$data['Cdata']= $this->Customer->singleClient($id);
					$this->load->view("customers/singleClientDetail", $data);
					
				}
				
				function projectSingle($id)
				
				{
					$data['title']=$this->Customer->projectById($id)->pName;
					$data['pData']= $this->Customer->projectById($id);
					$this->load->view("customers/singleProject", $data);
					
				}
				
				
				
			 
			 function fetchInvoice()
			 {
				 if($this->input->post('id'))
				 {
				   $cid = $this->input->post('id');
				   
				 // return $this->output->set_output($this->Customer->clientRunProjectOption($cid));
				 return $this->output->set_output($this->Customer->RuniingInvoice($cid));
				 }
				 
				 //echo $this->Customer->RuniingInvoice(7);
				 
			 }
			 
			 function ActionSlip($id)
			 {
				 $data['title'] ='Pay Slip';
				 $data['payData'] = $this->Customer->paySlipDetails($id);				 
				 $this->load->view("customers/actionPaySlip",$data);
			 }
			 
			 
			 function emailPaySlip($id)
			 {
				// $data['payData'] = $this->Customer->paySlipDetails($id);				 
				 $data['payData'] = $this->Customer->paySlipDetails($id);
				 $config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,					
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
	
				
				//$this->load->library('email');
				//$this->CI->load->library('email');
				
                 $data['emailSendLoad'] =true;
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from($data['payData']->comEmail,$data['payData']->comName); // change it to yours
				$this->email->to($data['payData']->cusEmail);// change it to yours
			    $this->email->subject('Payment Slip ('.date('d-m-Y',$data['payData']->payDate).')');
			   
				  $email = $this->load->view('customers/actionPaySlip', $data, TRUE);
	 
				   $this->email->message( $email );
	
				if($this->email->send()){
					echo 'Email sent.';
				}
				else{
					show_error($this->email->print_debugger());
				}
				 
			 }
			 
			 function invoiceMail($id)
			 {
				
				$this->invoiceCTopdf($id);
				 
			 }
			 
			 
			 function projectStatus()
			 {
				 $pid = $this->input->post('pid');
				  $status = $this->input->post('pstatus');
				 
				 $year = $this->input->post('year');
				 $month = $this->input->post('month');
				 $day = $this->input->post('day');
				 
				 $date =  strtotime($year.'-'.$month.'-'.$day);
				 if($status =='S')
				 {
				     // Start Project 	
					 $arr = array(
					             'projectId'=>$pid,
								 'startDate'=>$date,
								 'sById'=>$this->session->userdata('id')
				                 );
					  
					  if($this->Customer->projectStart($arr,$pid))
					  {
					     $this->session->set_flashdata('success', 'Project Has Been Started.');
				         redirect('customers/viewProject');	  	  
					  }
					  
					  else
					  {
						 $this->session->set_flashdata('failed', 'Database Error.');
				         redirect('customers/viewProject');
					  }
					  
				 }
				 else if($status =='C')
				 {
				    // Complete Your Project	
					$arr = array(
								 'endDate'=>$date,
								 'ebyId'=>$this->session->userdata('id')
				                 );
								 
								 
						if($this->Customer->projectComplete($pid,$arr))
						  {
							 $this->session->set_flashdata('success', 'Project Has Been Completed.');
							 redirect('customers/viewProject');	  	  
						  }
					  
					  else
					  {
						 $this->session->set_flashdata('failed', 'Database Error.');
				         redirect('customers/viewProject');
					  }		 
					 
				 }
				 
				 else
				 {
				   $this->session->set_flashdata('failed', 'You are accessing incorrect path');
				   redirect('customers/viewProject');	 
				 }
		     }
			 
			 
		private function invoiceCTopdf($id)
		     {
			  require APPPATH .'third_party/pdf/cppdf/dompdf_config.inc.php';
				global $_dompdf_show_warnings;
				global $_dompdf_debug;
				global $_DOMPDF_DEBUG_TYPES;
				
				
				$outfile = 'invoice.pdf';
				$save_file = true; // Save the file or not
				
				
				$data['cData'] = $this->Customer->viewInvoiceDetails($id);
					 $data['title']=$this->lang->line('site_name').' :: View Invoice Detail : ';
			//$htmldata =$this->load->view("pdf/invoice", $data,true);	 
				
	         $buff=	$this->load->view("pdf/invoice", $data,true);
	
				$dompdf = new DOMPDF();
			$base_path = false;
	
				$dompdf->load_html($buff);
				if ( isset($base_path) ) {
					$dompdf->set_base_path($base_path);
				}
				$dompdf->render();
				
		
				if ( $_dompdf_show_warnings ) {
					global $_dompdf_warnings;
					foreach ($_dompdf_warnings as $msg) {
						echo $msg . "\n";
					}
					echo $dompdf->get_canvas()->get_cpdf()->messages;
					flush();
				}
			
			
			
			if ( $save_file ) {
				

				if ( strtolower(DOMPDF_PDF_BACKEND) == "gd" ) {
					$outfile = str_replace(".pdf", ".png", $outfile);
				}

				list($proto, $host, $path, $file) = explode_url($outfile);

				if ( $proto != "" ) // i.e. not file://
					$outfile = $file; // just save it locally, FIXME? could save it like wget: ./host/basepath/file

				$outfile = dompdf_realpath('upload/attachment/'.$outfile);
				// if ( strpos($outfile, DOMPDF_CHROOT) !== 0 )
					// throw new DOMPDF_Exception("Permission denied.");
				file_put_contents($outfile, $dompdf->output( array("compress" => 0) ));
			}
			
			
			
				
				     $data['cData'] = $this->Customer->viewInvoiceDetails($id);
					 $data['title']='Invoice';
					
					  $data['xname'] =$this->Customer->viewInvoiceDetails($id)->byCompName;
					 //$this->load->view("email/invoice", $data);
					 
					  $config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,					
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
	
				
				
                
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from($data['cData']->byCompEmail,$data['cData']->byCompName); // change it to yours
				$this->email->to($data['cData']->cEmail);// change it to yours
				//$this->email->to('hitesh.speedupseo@gmail.com');
			    $this->email->subject('Invoice Mail');
			   
				  $message = $this->load->view("email/invoice", $data,TRUE);
	  	
				   $this->email->message($message);
				$this->email->attach($outfile);
	
				if($this->email->send()){
					echo 'Email sent.';
					$this->email->clear(TRUE);  
				}
				else{
					show_error($this->email->print_debugger());
				}
	
		}
		
		
}
/* End of file customer.php */
/* Location: ./application/controllers/customer.php */