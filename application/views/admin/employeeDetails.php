<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Employee Details <small>Employee Details</small> </h3>
<?php $this->load->view('partial/breadcrumb');?>
</div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12">
  
  <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <?php if($this->session->flashdata('success') != ''){?>
    <!-- BEGIN SUCCESS MESSAGE-->
    <div class="portlet-body">
      <div class="alert alert-success">
        <button class="close" data-dismiss="alert"></button>
        <strong><?php echo $this->lang->line('common_success');?>!</strong> <?php echo $this->session->flashdata('success');?> </div>
    </div>
    <!-- END SUCCESS MESSAGE-->
    <?php } ?>
    <?php if($this->session->flashdata('failed') != ''){?>
    <!-- BEGIN ERROR MESSAGE-->
    <div class="portlet-body">
      <div class="alert alert-error">
        <button class="close" data-dismiss="alert"></button>
        <strong><?php echo $this->lang->line('common_error');?>!</strong> <?php echo $this->session->flashdata('failed');?> </div>
    </div>
    <!-- END ERROR MESSAGE-->
    <?php }?>
    <div class="tabbable tabbable-custom boxless">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title">
              <h4><i class="icon-reorder"></i>Employee Details</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
             
             <table class="table">
             
             <tr>
             <td>Employee Name</td><td><?php echo $empData->contact_name; ?></td>
             <td>Employee Code</td><td>
             
             <?php echo $empData->sname.'/'. str_pad($empData->employeeCode, 2, '0', STR_PAD_LEFT);?>
             </td>
             </tr>
             <tr>
             <td>Company Name</td><td><?php echo $empData->name; ?></td>
             <td>Date of join</td><td><?php echo date('d-M-Y',$empData->doj); ?></td>
             </tr>
              <tr>
             <td>Gender:</td>
             <td><?php echo $empData->gender=='M'?'Male':'Female'; ?></td>
             <td>Email:</td>
             <td><?php echo $empData->contact_email; ?></td>
             </tr>
             <tr>
             <td>Experience</td><td><?php $exp = explode('-',$empData->experience); echo $exp[0].' Months '.$exp[1].' Years'; ?></td>
             <td>Date of Birth</td><td><?php echo date('d-M-Y',$empData->dob); ?></td>
             
             </tr>
             
             
               <tr>
             <td>Emergency Number</td><td><?php echo $empData->emergency_number; ?></td>
             <td>Phone Number</td><td><?php echo $empData->phone_num; ?></td>
             </tr>
             
               <tr>
             <td>Address</td><td><?php echo $empData->uaddress; ?></td>
             <td>Password</td><td><?php echo $empData->plain; ?></td>
             </tr>
             
             
              <tr>
             <td>Department</td><td><?php echo $empData->department; ?></td>
             <td>Designation</td><td><?php echo $empData->designation; ?></td>
             </tr>
             
             
              <tr>
             <td>Pan no</td><td><?php echo $empData->panno; ?></td>
             <td>Bank A/C</td><td><?php echo $empData->bac; ?></td>
             </tr>
             
              <tr>
             <td>Car All</td><td><?php echo $empData->carAll; ?></td>
             <td>Conveyance</td><td><?php echo $empData->conveyance; ?></td>
             </tr>
             
              <tr>
             <td>Medical</td><td><?php echo $empData->medical; ?></td>
             <td>Incometax</td><td><?php echo $empData->incometax; ?></td>
             </tr>
             
             
              <tr>
             <td>PF</td><td><?php echo $empData->pf; ?></td>
             <td>VPF</td><td><?php echo $empData->vpf;?></td>
             </tr>
             
              <tr>
             <td>ESI</td><td><?php echo $empData->esi; ?></td>
             <td>Status</td><td>
             
             <?php
			 if($empData->uActive == 'Y'){ echo '<label class="btn mini green">Active</label>';} else {echo '<label class="btn mini red">Deactive</label>';}
			 ?>
             </td>
             </tr>
             <tr>
             
             <td>Paid Leave: </td>
             <td colspan="3"><?php if($empData->paidLeave =='N'){ echo 'No Paid Leave';} else{ echo 'Have Paid Leave';} ?></td>
             </tr>
             
            
             
             
             <?php if(Adminmodel::getDocument($empData->emid)){  $doc = Adminmodel::getDocument($empData->emid);?>
            <tr><th colspan="4">Documents: </th></tr>
             <?php foreach($doc->result() as $row){ ?>
             <tr>
             <td colspan=""><a href="<?php echo base_url() ?>upload/document/<?php echo $row->file; ?>"><?php echo $row->docName; ?></a></td>
             <td><?php echo anchor('admin/docsdelete/'.$row->id.'/'.$row->file.'/'.$row->emid.'/document/admin-viewEmployeeRead', '<label class="btn mini red">Delete</label>'); ?></td>
             <td colspan="2"></td>
             </tr>
             
             <?php } }?>
             
             
             </table>
              <!-- END FORM--> 
              
              <h3>Salary Details: </h3>
<?php $id = $this->uri->segment(3)?$this->uri->segment(3):0; ?>
              <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
       
              <th>Employee Name</th>             
              <th class="hidden-480">Leaves</th>
              <th class="hidden-480">Halfdays</th>
              <th>Holidays</th>
              <th class="hidden-480">Salary Month</th>
              <th class="hidden-480">Admin Paid</th>
              <th class="hidden-480">Net Amount</th>
              <th>Bonus</th>
              <th class="hidden-480">Paid Date</th>  
              <th class="hidden-480">View Salary Slip </th>  
                         
            </tr>
          </thead>
          <tbody> 
          
          <?php $salData = Adminmodel::employeSalayD($id); ?>        
            <?php foreach($salData->result() as $ilist){
				
				$admin = Adminmodel::adminName($ilist->pay_by);
				?>
		      
            <tr class="odd gradeX">
              
             
              <td ><?php echo$ilist->contact_name; ?></td>
              <td class="hidden-480"><?php 
			  
		  $leave = $ilist->leave;
		
			  if($ilist->paidLeaveYN == 'Y')
			  {
			   if($ilist->leave >=0 && $ilist->paidLeaveAmount ==0)
				  {
			         $leave++;
				  }
				  else if($ilist->leave ==0 && $ilist->paidLeaveAmount >0)
				  {
					 // $leave++;
				  }	  
			  }
			  echo $leave;
			  
			   ?></td>
              <td class="hidden-480"><?php echo $ilist->halfday; ?></td>
              <td class="hidden-480"><?php echo $ilist->holiday ?></td>
              <td class="hidden-480"><?php $d = $ilist->pay_month .'-01'; echo date('M-Y',strtotime($d)); ?></td>
              <td class="hidden-480"><?php if (isset($admin->contact_name)){echo $admin->contact_name; } else{ echo 'Not Found';}?></td>
              <td class="hidden-480"><?php echo $ilist->amount; ?></td>
               <td class="hidden-480"><?php echo $ilist->bonus; ?></td>
              <td class="hidden-480"> <?php echo date('d-M-Y',$ilist->pay_date); ?></td>
              <td class="hidden-480"><?php echo anchor('admin/oldSlip/'.$ilist->emid .'/'.$ilist->pay_month,'<label class="btn mini green">Salary Slip</label>' ); ?></td>
            
            </tr>
            <?php 
} ?>
          </tbody>
        </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
</div>
<!-- END CONTAINER --> 
<!-- BEGIN JAVASCRIPTS --> 
<!-- Load javascripts at bottom, this will reduce page load time --> 
<script src="<?php echo base_url();?>assets/js/jquery-1.8.3.min.js"></script> 
<script src="<?php echo base_url();?>assets/breakpoints/breakpoints.js"></script> 
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script> 
<!-- ie8 fixes --> 
<!--[if lt IE 9]>
   <script src="<?php echo base_url();?>assets/js/excanvas.js"></script>
   <script src="<?php echo base_url();?>assets/js/respond.js"></script>
   <![endif]--> 
<script type="text/javascript" src="<?php echo base_url();?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-daterangepicker/date.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
      jQuery(document).ready(function() {      
         // initiate layout and plugins
         App.init();
		 
		 
		 

		 

	 
		 
		 
      });
   </script>
   
   
