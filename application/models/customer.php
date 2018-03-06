<?php
class Customer extends CI_Model {
	
	function EmailExists($email)
	{
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('email',$email);
		$query = $this->db->get();
		if($query->num_rows ==1)
		{
			$query = $query->row();
			$demail = $query->email;
			if($demail == $email)
			{
			  return true;	
			}
			else
			{
				return false;
				
			}
		
		}
		else if($query->num_rows ==0)
		{
		return true;	
		}
		
	}
	function CustomerExists($id)
	{
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows >=1)
		{
		return false;	
		}
		else
		{
		return true;	
		}
		
	}
	
	function saveCustomer($id,$cArray)
	{
		if($this->CustomerExists($id))
		{
			if($this->db->insert('customers', $cArray))
			{
				$this->session->set_flashdata('success', 'Customer Add Successfully.');
				return true;
			}
			
			return false;
		}
		else
		{
			
		 if( $this->db->update('customers', $cArray,array('id'=>$id)))
		 {
			 $this->session->set_flashdata('success', 'Customer Update Successfully.');
		  return true;
		 }
		 else
		 {
			 return false;
			 
			}
			
		}
		
	}
	
	
	function CustomerDetail($id)
	{
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows >0)
		{
			return $query->row();			
		
		}
		else
		{
			return false;
			
		}
		
		
	}
	function clietListDropDown($selected='',$disable='')
	{
		$where = $this->Customer->adminWhere();
		$this->db->select('*');
		$this->db->from('customers');
		if($where)
		{
			$this->db->where($where);
			
		}
		$query =  $this->db->get();
		if($query->num_rows >=1)
		{
			$select ='<select id="client" class="required" name="client"'.$disable.'>';
			$select .= '<option value="">Select</option>';
			foreach($query->result()  as $row)
			{
				$chk = '';
				if($selected == $row->id)
				{
					$chk =' selected="selected"';
				}
				$select .= '<option value="'.$row->id.'"'. $chk .'>'.$row->name.'</option>';
			}
			$select .= '</select>';	
			
			return $select;	
			
		}
		
		else
		{
			return false;
		}
		
		
	}
	
	
	
	function saveProjectDB($pArray,$id)
	{
	if($id ==-1)
	 {	
		  if($this->db->insert('clienproject', $pArray))
				{
					
					return $this->db->insert_id();
				}
				
				
			
	 }
	 
	 else
	 {
		 $this->db->where('id',$id);
		 if($this->db->update('clienproject',$pArray))
		 {
			
					return $id;
		  }
		 
	  }
	}
	
	function ProjectByIdDB($id)
	{
		
		$this->db->select('*');
		$this->db->from('clienproject');
	
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		if($query->num_rows == 1)
		{
			return $query->row();
		}
		else
		{
		return false;	
		}
		
		
		
	}
	
	
	function savePayment($pArray)
	{
		if($this->db->insert('clientpayment', $pArray))
				{
					$this->session->set_flashdata('success', 'Payment has been Added.');
					return true;
				}
				
				return false;
	}
	
	function referenceNo()
	{
		$this->db->select_max('id');
		$query = $this->db->get('clientpayment');
		//return $query->num_rows();
		if($query->row()->id)
		{
		  return $query->row()->id+10000+1;
		}
		else
		{
		return 10000;	
		}
	
		
			//return 0;
		
	 }
	
	 function adminWhere()
	{
	  $AssComp =$this->Adminmodel->AdminAccessCompany();
	  if($AssComp)
	  {
		  $where ='';
		  for($i=0; $i<count($AssComp); $i++)
		  {
			  $where .='(`customers`.`bycompany`='.$AssComp[$i].')';
			  if($i+1 != count($AssComp) )
				{
			   $where .= ' OR';
			   }
		  }
		  return $where;		  
	  }
	  else
	  {
		return false;  
		}
	}
	function clientList($dateFrom='all',$dateTo='all',$limit,$offset)
	{
		$where = $this->adminWhere();
		
	 $this->db->select('*');
	 $this->db->from('customers');
		 
		if($where){ 
		 $this->db->where($where);
		}
		
		if(($dateFrom !='all') || ($dateTo != 'all'))
		{
			 $this->db->where('dor >=',$dateFrom);
			 $this->db->where('dor <=',$dateTo);
		}	
	if($this->session->userdata('global_comp') !=''){
			$this->db->where('bycompany',$this->session->userdata('global_comp'));
			
			}
		$this->db->order_by('customers.name','asc');
	$this->db->limit($limit,$offset);	
	 return $this->db->get();	
	}
	
	function totalClient($dateFrom='all',$dateTo='all')
	{
		
		    $where = $this->adminWhere();
		
	          $this->db->select('*, count(customers.id) as TTotal');
         	 $this->db->from('customers');
		 
			if($where){ 
			 $this->db->where($where);
			}
			
			if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('dor >=',$dateFrom);
				 $this->db->where('dor <=',$dateTo);
			}	
		   if($this->session->userdata('global_comp') !=''){
				$this->db->where('bycompany',$this->session->userdata('global_comp'));
				
				}
		$this->db->order_by('customers.dor','desc');
			
		 return $this->db->get()->row()->TTotal;
	}
	
	
	function ClientPaidAmount($id)
	{
	 $this->db->select('*, sum(amount) as TotalPaid');
	 $this->db->from('clientpayment');
	 $this->db->where('clientId',$id);
	 
	  $query = $this->db->get();
	 
		   $query = $query->row();
		   
		   return $query->TotalPaid;
		   
		
	 	
	}
	
	function ClientInvoiceAmount($cid)
	{
	   $this->db->select('* , sum(total) as TotalInvoice');
	   $this->db->from('invoice');
	   $this->db->where('clientId',$cid);
	   $this->db->where('dueDate <=',strtotime(date('Y-m-d')));
	   $query = $this->db->get();

		   $query = $query->row();
		   
		   return $query->TotalInvoice;
		   
		
	   	
	}
	
	
	function noOfClientProject($id,$status)
	{
	  $this->db->select('*');
	  $this->db->from('clienproject');
	  $this->db->where('clienId',$id);
	  $this->db->where('status',$status);	
	  $query = $this->db->get();
	  return $query->num_rows();
	  
	}
	
	
	function ProjectList($limit=50,$offset=0,$dateFrom,$dateTo,$status)
	{
		$where = $this->Customer->adminWhere();
	  $this->db->select('*,clienproject.id as pid,customers.id as cid');
	  $this->db->from('clienproject');
	
	  $this->db->join('customers','customers.id = clienproject.clienId');
	  if($where)
	  {
	  $this->db->where($where);	  
	  }
	  if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
	   
	   if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('clienproject.AddDate >=',$dateFrom);
				 $this->db->where('clienproject.AddDate <=',$dateTo);
			}
	 if($status != 'all')
	 {
	    $this->db->where('clienproject.status',$status);	 
	 }		
			
	   $this->db->order_by('clienproject.AddDate','desc');
	   $this->db->limit($limit,$offset);
	  return $this->db->get();	
		
	}
	
	function TotalProjectList($dateFrom,$dateTo,$status)
	{
		$where = $this->Customer->adminWhere();
	  $this->db->select('*,clienproject.id as pid,customers.id as cid, count(clienproject.id) as TotalRow');
	  $this->db->from('clienproject');
	
	  $this->db->join('customers','customers.id = clienproject.clienId');
	  if($where)
	  {
	  $this->db->where($where);	  
	  }
	  if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
			
	     if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('clienproject.AddDate >=',$dateFrom);
				 $this->db->where('clienproject.AddDate <=',$dateTo);
			}
		 if($status != 'all')
		 {
			$this->db->where('clienproject.status',$status);	 
		 }		
	   $this->db->order_by('clienproject.AddDate','desc');
	   
	  return $this->db->get()->row()->TotalRow;	
		
	}
	
	function totalProjectAmount($dateFrom,$dateTo,$status)
	{
		$where = $this->Customer->adminWhere();
	  $this->db->select('*,customers.currency as CCCurrency,sum(clienproject.price) as tTotal');
	  $this->db->from('clienproject');
	
	  $this->db->join('customers','customers.id = clienproject.clienId');
	  if($where)
	  {
	    $this->db->where($where);	  
	  }
	  if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
			
	     if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('clienproject.AddDate >=',$dateFrom);
				 $this->db->where('clienproject.AddDate <=',$dateTo);
			}
		 if($status != 'all')
		 {
			$this->db->where('clienproject.status',$status);	 
		 }		
	  
	  $this->db->group_by('customers.currency'); 
	  return $this->db->get();
		
	}
	
	function paymentList($dateFrom='all',$dateTo='all',$limit,$offset)	
	{
		$where = $this->Customer->adminWhere();
		$this->db->select('*, clientpayment.id as pid, customers.id as cid,clientpayment.date as pDate,invoice.pid as proId' );
				
		$this->db->from('clientpayment');
		
		$this->db->join('customers','customers.id = clientpayment.clientId');
		$this->db->join('invoice','invoice.id = clientpayment.Iid');
		
		 if($where)
			  {
			  $this->db->where($where);	  
			  }
	
		 if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('clientpayment.date >=',$dateFrom);
				 $this->db->where('clientpayment.date <=',$dateTo);
			}	
		
      $this->db->order_by('clientpayment.id', 'desc');
	  $this->db->limit($limit,$offset);
	 return $this->db->get();	
		
	}
	
	function TotalpaymentList($dateFrom='all',$dateTo='all')	
	{
		$where = $this->Customer->adminWhere();
		$this->db->select('*, count(clientpayment.id) as Ttotal' );
				
		$this->db->from('clientpayment');
		
		$this->db->join('customers','customers.id = clientpayment.clientId');
		$this->db->join('invoice','invoice.id = clientpayment.Iid');
		 if($where)
			  {
			  $this->db->where($where);	  
			  }
	
		 if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('clientpayment.date >=',$dateFrom);
				 $this->db->where('clientpayment.date <=',$dateTo);
			}	
		
      $this->db->order_by('clientpayment.id', 'desc');
	 
	  return $this->db->get()->row()->Ttotal;
		
	}
	
	function TotalAmountPayment($dateFrom='all',$dateTo='all')
	{
		$where = $this->Customer->adminWhere();
		$this->db->select('*, sum(clientpayment.amount) as tTotal ,clientpayment.currency as pcurry' );
				
		$this->db->from('clientpayment');
		
		$this->db->join('customers','customers.id = clientpayment.clientId');
		$this->db->join('invoice','invoice.id = clientpayment.Iid');
		 if($where)
			  {
			  $this->db->where($where);	  
			  }
	
		 if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('clientpayment.date >=',$dateFrom);
				 $this->db->where('clientpayment.date <=',$dateTo);
			}	
		
     $this->db->group_by('clientpayment.currency');
	 
	  return $this->db->get();
	}
	
	
	
	function ProjectSelectorMulti($cid)
	{
		$this->db->select('*');
		$this->db->from('clienproject');
		$this->db->where('clienId',$cid);
		$this->db->where('status','R');
		$query = $this->db->get();
		
		$select = '<select name="project" class="required m-wrap span12" id="project">';
	    $select .= '<option value="">Select</option>';
		if($query->num_rows >= 1)
		{
			
			
			foreach($query->result() as $row)
			{
				$select .= '<option value="'.$row->id.'">'.$row->pName.'</option>';
			}
			
		}
	$select .= '</select>';
	
	return $select;
		
		
    }
	
	
	function clientDeatil($id)
	{
	 $this->db->select('*');
	 $this->db->from('customers');
	 $this->db->where('id',$id);
	 $query = $this->db->get();
	 if($query->num_rows >= 1)
	 {
		 return $query->row();
	 }
	 
	 else
	 {
	  return false;	 
	 }
	 
	 	
	}
	
	function saveInvoice($invArray,$prd,$prdAmount,$prdDes)
	{
		if($this->db->insert('invoice',$invArray))
		{
			$invId = $this->db->insert_id();
			if($this->saveInvoiceDetail($prd,$prdAmount,$prdDes,$invId))
			{
				
			}
			
			
		}
		return true;
		
		
	}
	
	function saveInvoiceDetail($prd,$prdAmount,$prdDes,$invId)
     {
		 for($i=0; $i<count($prdAmount); $i++)
		 {
			 $invDArr = array(
			                  'iId'=>$invId,
							  'pId'=>$prd,
							  'pAmount'=>$prdAmount[$i],
							  'desc'=>$prdDes[$i]
			                  );
			 $this->db->insert('invoicedetail',$invDArr);
		 }
		 
		 
	 }
	 
	 function viewInvoice($dateFrom,$dateTo,$limit,$page)
	 {
		 $where = $this->Customer->adminWhere();
		 $this->db->select('*,invoice.id as Iid, clienproject.id as pid,customers.id as cid,invoice.date as invDate');
		 $this->db->from('invoice');
		 $this->db->join('customers','customers.id=invoice.clientId');
		 $this->db->join('clienproject','clienproject.id =invoice.pid');
		 if($where){
			 $this->db->where($where);
			 }
	   if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
			if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('invoice.date >=',$dateFrom);
				 $this->db->where('invoice.date <=',$dateTo);
			}
		 $this->db->order_by('invoice.invoiceNo','desc');
		 $this->db->limit($limit,$page);
		 
		 return $this->db->get();
		 
	  }
	  
	  
	   function invoiceTotal($dateFrom,$dateTo)
	 {
		 $where = $this->Customer->adminWhere();
		 $this->db->select('*,sum(invoice.total) as Tamount, invoice.currency as inccur');
		 $this->db->from('invoice');
		 $this->db->join('customers','customers.id=invoice.clientId');
		 $this->db->join('clienproject','clienproject.id =invoice.pid');
		 if($where){
			 $this->db->where($where);
			 }
	   if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
			
			if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('invoice.date >=',$dateFrom);
				 $this->db->where('invoice.date <=',$dateTo);
			}
		 $this->db->group_by('invoice.currency');
		
		 
		 return $this->db->get();
		 
	  }
	  
	  function totalInvoice($dateFrom,$dateTo)
	  {
		  $where = $this->Customer->adminWhere();
		 $this->db->select('*,count(invoice.id) as tTotal');
		 $this->db->from('invoice');
		 $this->db->join('customers','customers.id=invoice.clientId');
		 $this->db->join('clienproject','clienproject.id =invoice.pid');
		 if($where){
			 $this->db->where($where);
			 }
	   if($this->session->userdata('global_comp') !=''){
			$this->db->where('customers.bycompany',$this->session->userdata('global_comp'));
			
			}
		if(($dateFrom !='all') || ($dateTo != 'all'))
			{
				 $this->db->where('invoice.date >=',$dateFrom);
				 $this->db->where('invoice.date <=',$dateTo);
			}	
		
		 
		 return $this->db->get()->row()->tTotal;
		  
	 }
	  
	  
	  
	  
	  
	 
	 
	 function viewInvoiceDetails($id)
	 {
		  $this->db->select('*,invoice.id as Iid, company.name as byCompName,company.email as byCompEmail,company.address as byCompAddress, company.phone as byCompPhone,company.state as byCompState,company.city as byCompCity, company.country as byCompCountry, company.zip as byCompZip,customers.name as cName, customers.email as cEmail,customers.address as cAddress,customers.city as cCity , customers.country as cCountry, customers.state as cState, customers.zip as cZip,customers.mobile as cMobile ');
		 $this->db->from('invoice');
		 $this->db->join('customers','customers.id=invoice.clientId');
		 $this->db->join('company','customers.bycompany=company.id');
		 $this->db->where('invoice.id',$id);
		 
		$query = $this->db->get();
		if($query->num_rows >= 1)
		{
			return $query->row();
		}
		else
		{
		return false;	
		}
		
		 
	 }
	 
	 function invoiceProjectDetail($id)
	 {
	  $this->db->select('*');
	  $this->db->from('invoicedetail');
	  $this->db->join('clienproject','clienproject.id=invoicedetail.pId');
	  $this->db->where('invoicedetail.iId',$id);
	  $this->db->order_by('invoicedetail.pAmount','asc');	 
	  return $this->db->get();
	  
	 }
	 
	 /*client full details*/
	 
	 
	 function clienPayment($cid)
	 {
	   	   
	    $this->db->select('*, customers.id as cid , clientpayment.id as pid,invoice.pid as proId,clientpayment.date as pDate');		
		$this->db->from('clientpayment');
		$this->db->join('customers','customers.id = clientpayment.clientId');
		$this->db->join('invoice','invoice.id = clientpayment.Iid');
	
		$this->db->where('clientpayment.clientId',$cid);
		$this->db->order_by("clientpayment.reference", "desc");
		/*$this->db->limit('50','0');*/
		return $this->db->get();	
	   
	   	 
	 }
	 function clientProject($cid)
	 {
		
	   
	   $this->db->select('*, customers.id as cid, clienproject.id as pid ');
	  $this->db->from('clienproject');
	  $this->db->join('customers','customers.id = clienproject.clienId');
	  $this->db->where('clienproject.clienId',$cid);
	  
	  return $this->db->get();
		 
	}
	
	function clienInvoice($cid)
	{
	   
	   
	   $this->db->select('*,invoice.id as Iid, clienproject.id as pid,customers.id as cid,invoice.date as invDate');
		 $this->db->from('invoice');
		 $this->db->join('customers','customers.id=invoice.clientId');
		 $this->db->join('clienproject','clienproject.id =invoice.pid');
		 $this->db->where('invoice.clientId',$cid);
		 $this->db->order_by('invoice.date','desc');
		 
		 return $this->db->get();	
	}
	
	
	 function singleClient($cid)
	 {
		 $this->db->select('*,customers.id as clientId, company.name as bycom,customers.name as clientName,customers.email as cusEmail');
		 $this->db->from('customers');
		 $this->db->join('company','company.id=customers.bycompany');
		 $this->db->where('customers.id',$cid);
		 $query = $this->db->get();
		 return $query->row();
		 
	 }
	 
	 function projectById($id)
	 {
		 $this->db->select('*, customers.id as cid, clienproject.id as pid ');
	  $this->db->from('clienproject');
	  $this->db->join('customers','customers.id = clienproject.clienId');
	  $this->db->where('clienproject.id',$id);
	  $query =$this->db->get();
	  return $query->row();	
		 
	 }
	 
	 
	 function projectAssignDetail($id)
	 {
		 $this->db->select('*');
		 $this->db->from('assign_project');
		 $this->db->where('assign_project.pid',$id);
		 $this->db->join('users','users.id = assign_project.eid');
		 return $this->db->get();
		 
	 }
	 
	 
	 function ProDocument($id)
	 {
	    $this->db->select('*');
		$this->db->from('document');
		$this->db->where('profid',$id);		
		return $this->db->get();	 
	 }
	
	
	
	function ProjectStartDate($id)
	{
	  $this->db->select_min('workStart');
	   $this->db->where('status !=','R');
	   $this->db->where('status !=','W');
	   $this->db->where('pid',$id);
	   $query = $this->db->get('assign_project');
	   if($query->row()->workStart)
		{
			return date('d-M-Y',$query->row()->workStart);
			
		}
		else
		{
		return '?';	
		}
	 
	 
	}
	 function TotalAssignPro($id)
	 {
	    $this->db->select('*, count(id) as TotalAssign');
		$this->db->from('assign_project');
		$this->db->where('status !=','R');
		$this->db->where('pid',$id);
		$query = $this->db->get();
		
		return $query->row()->TotalAssign;
			 
	 }
	 
	 
	 function totalCompletePro($id)
	 {
		 $this->db->select('*, count(id) as TotalAssign');
		$this->db->from('assign_project');
		$this->db->where('status','C');
		$this->db->where('pid',$id);
		$query = $this->db->get();
		
		return $query->row()->TotalAssign;
		 
		}
		
		
		function ProjectCompleteDate($id)
		{
		   $total = $this->Customer->TotalAssignPro($id);
		   $complete = $this->Customer->totalCompletePro($id);
		   
		   if($total !=0 && $complete != 0)
		   {
			   if($total == $complete)
			   {
			     return  $this->Customer->FindProjectCompleteDate($id);	   
			  }
			  else
			  {
			    return 'Process';	  
			  }
			   
			   
		   }
		   
		   else
		   {
			 return '?';   
		   }
		   	
		}
		
		
		function FindProjectCompleteDate($id)
		{
			$this->db->select_max('endWork');
		   $this->db->where('status','C');
		   $this->db->where('pid',$id);
		   $query = $this->db->get('assign_project');
		   if($query->row()->endWork)
			{
				return date('d-M-Y',$query->row()->endWork);
				
			}
			else
			{
			return '?';	
			}
			
		}
	 	
		
   function clientRunProjectOption($cid)
	   {
		   $this->db->select('*');
		   $this->db->from('clienproject');
		   $this->db->where('clienId',$cid);
		   $this->db->where('status','R');
		   $query = $this->db->get();
		   $option = '<option value="">Select</option>';	
		   if($query->num_rows() >=1)
		   {
			   foreach($query->result() as $row)
			   {
				   $option .='<option value="'.$row->id.'">'.$row->pName.'</option>';
				   
			   }
			   return $option;
		   }
		   else
		   {
			   return $option;
		   }
		   	 
	  }
	  	
		
		
		function RuniingInvoice($cid)
		{
			$this->db->select('*');
			$this->db->from('invoice');
			$this->db->where('clientId',$cid);
			$query = $this->db->get();
			$option = '<option value="">Select</option>';
			if($query->num_rows() >=1)
			{
				foreach($query->result() as $row)
			    {
					 $payAmout = $this->checkPayment($cid,$row->id);
					 $incAmount = $row->total;
					 if($incAmount > $payAmout)
					 {
						$amount = number_format((float)($incAmount-$payAmout), 2, '.', '');  
						  
						 $option .='<option value="'.$row->id.'" amount="'.$amount.'" currency="'.$row->currency.'">'.$row->invoiceNo.' Amount ='.$incAmount.'/'.$amount.'</option>';
					 }
			    }
				return $option;
			}
			
			else
			{
			  return $option;	
			}
			
		}
		function checkPayment($cid,$Iid)
		{
			$this->db->select('*, sum(amount) as Total');
			$this->db->from('clientpayment');
			$this->db->where('clientId',$cid);
			$this->db->where('Iid',$Iid);
			$query = $this->db->get();
			return $query->row()->Total;
		}
		
		
		
		function paySlipDetails($payid)
		{
		  $this->db->select('*,company.name as comName,company.id as comId,company.email as comEmail, company.address as comAddress, company.country as comCountry,company.state as comState,company.city as comCity,company.zip as comZip, company.phone as comPhone,customers.id as cusId, customers.name as cusName, customers.email as cusEmail,customers.mobile as cusMobile,customers.address as cusAddress,customers.zip as cusZip,customers.country as cusCountry, customers.state as cusState, customers.city as cusCity,clientpayment.id as payId,clientpayment.date as payDate,clientpayment.currency as payCurrency,clientpayment.date as cpDate');
		  $this->db->from('clientpayment');
		  $this->db->join('invoice','invoice.id =clientpayment.Iid');
		  $this->db->join('customers','customers.id=clientpayment.clientId');
		  $this->db->join('company','company.id = customers.bycompany');
		  $this->db->where('clientpayment.id',$payid);
		  $query = $this->db->get();		  
		  return $query->row();	
		}
		
		
		
		
		function projectListFilter($date,$status,$r)
	    {
			if($status !='' )
			{	
				if($status =='Y')
				{
					$from = $date.'-01-01';
					$from = strtotime(date('Y-m-d',strtotime($from)));
					$to = $date.'-12-31';
					$to = strtotime(date('Y-m-d',strtotime($to)));	
				}
				else if($status =='MY' || $status =='M' )
				{
					$from = $date.'-01';
					$to = $date.'-31';
					$to = strtotime(date('Y-m-d',strtotime($to)));	
					$from = strtotime(date('Y-m-d',strtotime($from)));
					
					
				}
				
			}
			
		  $this->db->select('*, customers.id as cid, clienproject.id as pid ');
	     $this->db->from('clienproject');
	     $this->db->join('customers','customers.id = clienproject.clienId');
	  if($status !='' )
			{
		 $this->db->where('clienproject.AddDate >=',$from);
		 $this->db->where('clienproject.AddDate <=',$to);
			}
		 if($r !='')
		 {
			 $this->db->where('clienproject.status',$r);
		  }
		
		//$this->db->limit('50','0');

		return $this->db->get();
		
		
		
		 
	  }
	  
	  
	  
	  function findClienCurrency($cid)
	  {
		  $this->db->select('*');
		  $this->db->from('clientpayment');
		  $this->db->where('clientId',$cid);
		  $query = $this->db->get();
		  if($query->num_rows >=1)
		  {
			  return $query->row()->currency;
		 }
		 else
		 {
		  return false;	 
		}
		   
	 }
	 
	 function invoiceAdvance($inc,$cid)
	 {
	    $this->db->select('*, sum(amount) as total');
		$this->db->from('clientpayment');
		$this->db->where('Iid',$inc);	
		$this->db->where('clientId',$cid); 
		$query =  $this->db->get();
		return $query->row()->total;
	 }
	 
	 function projectIdToname($id)
	 {
		 $this->db->select('pName');
		 $this->db->from('clienproject');
		 $this->db->where('id',$id);
		 $query = $this->db->get();
		 
		 return $query->row()->pName;
		 
	 }
	 
	 
	 function clientByCompany($cid)
	 {
	     $this->db->select('bycompany');
		 $this->db->from('customers');
		 $this->db->where('id',$cid);
		 $query = $this->db->get();		 
		 return $query->row()->bycompany;	 
	 }
	 
	 function clientListOfOneCompany($cid)
	 {
		 $comId = $this->clientByCompany($cid);
		 $this->db->select('id');
		 $this->db->from('customers');
		 $this->db->where('bycompany',$comId);
		 $query = $this->db->get();
		 if($query->num_rows >=1)
		 {
			 $list = array();
		          foreach ($query->result() as $row)
				  {
				     $list[]= $row->id;  	  
				  }	
				  
				  return $list; 
		 }
		 else
		 {
		return false;	 
		 }
		 
	 }
	 
	
	 
	 function nextInvoiceNo($cid)
	 {
		 if($this->clientListOfOneCompany($cid))
		 {
			 $list = $this->clientListOfOneCompany($cid);
			 $this->db->select('MAX(invoiceNo) as No');
			 $this->db->from('invoice');
			 $this->db->where_in('clientId',$list);
			 $query = $this->db->get();
			 
			 return ($query->row()->No+1);
			 
		 }
		 else
		 {
		  return 1;	 
		 }
	 }
	 
	 function nextPaymentNo($cid)
	 {
		 if($this->clientListOfOneCompany($cid))
		 {
			 $list = $this->clientListOfOneCompany($cid);
			 $this->db->select('MAX(srNo) as No');
			 $this->db->from('clientpayment');
			 $this->db->where_in('clientId',$list);
			 $query = $this->db->get();
			 
			 return ($query->row()->No+1);
			 
		 }
		 else
		 {
		  return 1;	 
		 }
	 }
	 
	 function projectCurrency($id)
	 {
	    $this->db->select('currency');
		$this->db->from('invoice');
		$this->db->where('pid',$id);
		$query = $this->db->get();
		if($query->num_rows() >0)
		{
			foreach($query->result() as $row)
             {
			   return $row->currency;
			   break;	 
		     }
       	}
		else
		{
		  return ' ?';	
		}
			 
	 }
	 
	 
/*	 function ByCompanyName($id)
	 {
		 $this->db->select('name');
		 $this->db->from('company');
		 $this->db->where('id',$id);
		 if($this->db->get()->num_rows >0)
		 {
		 return  $this->db->get()->row()->name;
		 }
		 else
		 {
		   return false;	 
		 }
	 }*/
	 
	function findProjectStatus($pid)
	 {
		 $this->db->select('*');
		 $this->db->from('projectstatus');
		 $this->db->where('projectId',$pid);
		 $query = $this->db->get();
		 if($query->num_rows() >0)
		 {
			 $iscomplete = true;
			foreach($query->result() as $row)
			{
			   if ($row->endDate ==0)
			   {
				     $iscomplete = false;
					 break;
			   }	
			}
			
			if($iscomplete == false)
			{
			   return true;	
			}
			else
			{
			   return false;	
			}
			
		 }
		 else
		 {
		    return false;	 
		 }
		
	 }
	
	function clienProjectUpdate($pid,$status)
	{
	  $this->db->where('id',$pid);
	  $this->db->update('clienproject',array('status'=>$status));	
	}
	function projectStart($arr,$pid)
	{
		if($this->db->insert('projectstatus',$arr))
		{
		  $this->clienProjectUpdate($pid,'R');
		  return true;	
		}
	} 
	
	function projectComplete($pid,$arr)
	{
	   $this->db->where('projectId',$pid);
	   $this->db->where('endDate',0);
	   if($this->db->update('projectstatus',$arr))
	   {
		   $this->clienProjectUpdate($pid,'C');
		 return true;   
	   }	
	}
	
	
	
	function proStatus($pid)
	{
		 $this->db->select('*');
		 $this->db->from('projectstatus');
		 $this->db->where('projectId',$pid);
		 $query = $this->db->get();
		
		 if($query->num_rows() >0)
		 {
			 $iscomplete = true;
			 $total = count($query->result());
			foreach($query->result() as $row)
			{
			   if ($row->endDate ==0)
			   {
				     $iscomplete = false;
					 break;
			   }	
			}
			
			if($iscomplete == false)
			{
				echo 'Running('.$total.')';
			}
			else
			{
			  echo 'Completed('.$total.')';	
			}
		 }
		 
		 else
		 {
		   echo 'Not Started';	 
		 }
		 
	}
	
	function getprojectStatus($pid)
	{
		 $this->db->select('*');
		 $this->db->from('projectstatus');
		 $this->db->where('projectId',$pid);
		 $this->db->order_by('id','desc');
		 return $this->db->get();
	}
	
	function projectName($id)
	{
		$this->db->select('pname');
		$this->db->from('clienproject');
		$this->db->where('id',$id);
		return $this->db->get()->row()->pname;
	}
	
}
?>