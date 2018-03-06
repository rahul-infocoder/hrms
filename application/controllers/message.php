<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends CI_Controller{
	
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
	  $this->compose();	
	}
	function compose()
	{
		
		$data['title'] = "Compose a New Message";
		$this->load->view('msg/msg',$data);
		
	}
	
	function sendMessage()
	{
	  // print_r($this->input->post('wanted'));	
	  
	  if($this->input->post('wanted'))
	  {
		  
		  $upload_conf = array(
						'upload_path'   => realpath('upload/msg/'),
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
					
					
					
					
					$attch = implode('<@@>',$Fname);
					$to  = $this->input->post('wanted');					
					$msg = $this->input->post('msg');
					$subject = $this->input->post('subject');
					$from = $this->session->userdata('id');
					$date = strtotime(date('Y-m-d h:i:s A'));
					//Inbox save
					
					for($i=0; $i<count($to); $i++)
					{
					     $arr = array(
						                'msg_to'=>$to[$i],
										'msg_from'=>$from,
										'subject'=>$subject,
										'msg'=>$msg,
										'attachment'=>$attch,
										'date'=>$date
						 
						              );	
									  
									  
									$this->Messagemodel->saveMsg($arr); 
									
									$this->load->helper('email_helper');
									send_email($this->Notificationmodel->idToEmail($arr['msg_to']),$arr['subject'],$arr['msg']);
									
									
									
								/*$senderName =	$this->MessageModel->FindName($from);
									
									//Add Note
									$note = array(
									             'to' =>$to[$i],
												 'msg' => "You've got a message from ".$senderName,
												 'date' =>$date
									
									             );
									
									$this->NotificationModel->addNote($note);*/
																	 
					}
					
					//End Inbox
					
					
					//Send Box
					
					$arr2 = array(
					                    'msg_to'=> implode(',',$to),
										'msg_from'=>$from,
										'subject'=>$subject,
										'msg'=>$msg,
										'attachment'=>$attch,
										'date'=>$date
					           );
					$this->Messagemodel->saveSent($arr2);  
					//End Sent Box
					
					$this->session->set_flashdata('success', 'Message Has Been Sent.');
					redirect('message/compose');
		  
	  }
	  
	  else
	  {
	             $this->session->set_flashdata('failed', 'You Can Not Leave Empty To Field.');
					redirect('message/compose');	  
	  }
	  
	}
	
	
	
	function inbox($limit=10,$day='new',$month='new',$year='new')
	{
		$total =$this->Messagemodel->TotalInbox($day,$month,$year);
		$limit = ($limit == 'All')?$total:$limit;
		$data['title'] ='In Box Message List';		
		$config = array();
        $config["base_url"] = site_url() . "/message/inbox/".$limit.'/'.$day.'/'.$month.'/'.$year;
        $config["total_rows"] = $total;
        $config["per_page"] = $limit;
        $config["uri_segment"] = 7;
 
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
		
		$data['inboxList'] = $this->Messagemodel->ViewInboxList($limit,$page,$day,$month,$year);
		$data["links"] = $this->pagination->create_links();
		$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';

		$this->load->view('msg/inboxList',$data);
		
	}
	
	function ViewInbox($id)
	{
		$this->Messagemodel->readMessaeg($id);
		$data['inbox'] = $this->Messagemodel->ViewInbox($id);
		$data['title'] = 'Sent';
		$this->load->view('msg/inbox',$data);
		
  	}
	
	function sent($limit=10,$day='new',$month='new',$year='new')
	{
		$total = $this->Messagemodel->TotalSent($day,$month,$year);
		$limit = ($limit == 'All')?$total:$limit;
		$data['title'] ='Sent Message List';
		$config = array();
        $config["base_url"] = site_url() . "/message/sent/".$limit.'/'.$day.'/'.$month.'/'.$year;
        $config["total_rows"] = $this->Messagemodel->TotalSent($day,$month,$year);
        $config["per_page"] = $limit;
        $config["uri_segment"] = 7;
 
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
		
		$data['sentList'] = $this->Messagemodel->ViewSentList($config["per_page"],$page,$day,$month,$year);
		$data["links"] = $this->pagination->create_links();
		$to = ($total < ($page+$limit))?$total:($page+$limit);
				 $data['rowInfo'] = ' Showing '.($page+1).' to '.$to.' of '.$total.' entries';
		$this->load->view('msg/sentList',$data);
	}
	
	function ViewSent($id)
	{
		
		$data['sent'] = $this->Messagemodel->ViewSent($id);
		$data['title'] = 'Sent';
		$this->load->view('msg/sent',$data);
		
  	}
	
	function fetchUserList()
	{
		
		$searchKey = $this->input->post('searchKey');
		//$searchKey='hi';
		/*$data1 = array(
		             array('id'=>'1','name'=>'Rahul'),
					 array('id'=>'2','name'=>'hitesh')
		           );*/
				   
		$data = $this->Messagemodel->fetchUserList($searchKey);
		 // print_r($data); 
		// $this->output->clear_all_cache();
		return  $this->output->set_output(json_encode($data));
		
	}
	
	function msg_delete()
	{
		if($this->input->post('id'))
		{
		    $ids = substr($this->input->post('id'), 0, -1);
			$msg_id = explode(',',$ids);
			foreach($msg_id as $value)
			{
		    $this->Messagemodel->delete_msg_db($value);
			}
			
			//$this->output->set_output($ids);
		
		}
		
	}
	
	function sent_delete()
	{
		if($this->input->post('id'))
		{
		    $ids = substr($this->input->post('id'), 0, -1);
			$msg_id = explode(',',$ids);
			foreach($msg_id as $value)
			{
		    $this->Messagemodel->delete_sent_db($value);
			}
			
			//$this->output->set_output($ids);
		
		}
		
		
		
	}
	
	function test()
	
	{
	  	$data['title']= 'kshdkj';
              $this->load->view('msg/test',$data);
   	}
	
	
	
	
}
?>