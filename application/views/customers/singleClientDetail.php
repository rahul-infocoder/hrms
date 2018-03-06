<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> <?php echo $Cdata->clientName; ?> <small><?php echo $Cdata->clientName; ?></small> </h3>
<?php $this->load->view('partial/breadcrumb');?>
<!-- END PAGE TITLE & BREADCRUMB-->
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
    <div class="portlet box light-grey">
      <div class="portlet-title">
        <h4><i class="icon-globe"></i><?php echo $Cdata->clientName; ?>'s Detail</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
        <table class="table table-bordered table-hover" id="example">
          <tr>
          <td><strong>Name</strong> </td><td><?php echo $Cdata->clientName; ?></td>
          <td><strong>Mobile</strong> </td><td><?php echo $Cdata->mobile; ?></td>
          <td><strong>Email</strong> </td><td><?php echo $Cdata->cusEmail; ?></td>
          </tr>
          <tr>
          <td><strong>Company</strong> </td><td><?php echo $Cdata->companyName; ?></td>
          <td><strong>Client of </strong></td><td><?php echo $Cdata->bycom; ?></td>
          <td><strong>Client added</strong> </td><td><?php echo date('d-m-Y', $Cdata->dor) ?></td>
          </tr>
          
          <tr>
          <td><strong>Address</strong></td>
          <td colspan="5">
          <?php echo $Cdata->address; ?>
          <br />
          <strong>Zip Code</strong>  <?php echo $Cdata->zip; ?>
          </td>
          </tr>
          
        </table>
        
        <h5><strong>Project Information</strong></h5>
        
         <table class="table table-striped table-bordered table-hover" id="example">
          <thead>
            <tr>
              
              
             <th>Project Name</th>
              <th>Client Name</th>
              
              <th class="hidden-480">Project Type</th>
              <th>Added Date</th>
           <!--   <th class="hidden-480">Start Date</th>
             
              <th class="hidden-480">End Date</th>-->
               <th class="hidden-480">Price</th>
               <th class="hidden-480">Status</th>
              <th>Action</th>            
               
            </tr>
          </thead>
          <tbody>
            <?php 
			
			$pData = Customer::clientProject($Cdata->clientId);
			foreach($pData->result() as $row){ ?>
           <tr class="odd gradeX">
               <td class="hidden-480">
               
               <?php echo anchor('customers/projectSingle/'.$row->pid,$row->pName); ?>
               </td>
              <td >
              <?php echo anchor('customers/clientSingle/'.$row->cid, $row->name); ?>
              </td>
             
              <td class="hidden-480">
			  
			  <?php echo $row->proType; ?>
              
              </td>
              <td><?php echo date('d-M-Y',$row->AddDate); ?></td>
              
             <!-- <td class="hidden-480">
              <?php
			//  echo Customer::ProjectStartDate($row->pid);
			   ?>
              
              </td>
              
              <td class="hidden-480">
              <?php //echo Customer::ProjectCompleteDate($row->pid);		 ?>
              
              </td>-->
              <td class="hidden-480"><?php echo $row->price .' '.$row->currency; ?> </td>
              <td class="hidden-480" id="Pstatus" style="position:relative !important; cursor:pointer;">
              <?php echo Customer::proStatus($row->pid); ?>
                <?php $ProSttt = Customer::getprojectStatus($row->pid); ?>
              <table class="table table-striped table-bordered table-hover" style="width:200px !important; display:none; position:absolute; right:100%; top:2%; margin-right:100%; z-index:999; font-size:10px;">
              <thead>
              <tr>
              <th>Start Date</th>
              <th>Complete Date</th>
              </tr>
              </thead>
              
              <tbody>
              <?php foreach($ProSttt->result() as $row2): ?>
              <tr>
              
              <td><?php echo date('d-M-Y',$row2->startDate); ?></td>
              <td><?php echo ($row2->endDate !=0)?date('d-M-Y',$row2->endDate):'?'; ?></td>
              </tr>
              <?php endforeach; ?>
              </tbody>
              </table>
              
              </td>
             <td>
             <input type="hidden" id="pidL" name="pidL" value="<?php echo $row->pid; ?>"  />
            
			<?php
             if(Customer::findProjectStatus($row->pid))
			 {
			   echo '<label id="statusAction" class="btn mini green">Complete It</label><input type="hidden" id="psstus" name="psstus" value="C" />';	 
			 }
			 else
			 {
			   echo '<label id="statusAction" class="btn mini green">Start It</label><input type="hidden" id="psstus" name="psstus" value="S" />';	 
			 }
			 ?>
			 <?php echo anchor('customers/addProject/'.$row->pid,'<label class="btn mini yellow">Edit</label>'); ?></td>
            </tr>
            <?php 
} ?>
          </tbody>
        </table>
        <h5><strong>Payment  Information</strong></h5>
        
        <table class="table table-striped table-bordered table-hover" id="example">
          <thead>
            <tr>
             
              <th>Receipt No.</th>
              <th>Reference Number</th>
              <th class="hidden-480">Payment Date</th>
              <th>Client Name</th>
              <th>Project</th>
              <th>Invoice NO</th>
              <th>Due Date</th>
              <th class="hidden-480">Amount</th>
              <th>Payment Method</th>
              
             
        
            </tr>
          </thead>
          <tbody>
            <?php
			
			$payData = Customer::clienPayment($Cdata->clientId);
			 foreach($payData->result() as $row){ ?>
             <tr class="odd gradeX">
              <td>
              <?php
               $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo anchor_popup('customers/ActionSlip/'.$row->pid, $row->srNo, $atts);
?>
              </td>
              <td>
              
                <?php
               $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo anchor_popup('customers/ActionSlip/'.$row->pid, $row->reference, $atts);
?>
              </td>
              <td class="hidden-480"><?php echo date('d-m-Y',$row->date); ?> </td>
              <td><?php echo anchor('customers/clientSingle/'.$row->cid,$row->name); ?></td>
               <td><?php echo anchor('customers/projectSingle/'.$row->proId, Customer::projectName($row->proId))?></td>
               <td><?php echo anchor('customers/invoiceDetail/'.$row->Iid,$row->Iid); ?></td>
                <td><?php echo date('d-M-Y',$row->dueDate); ?></td>
              <td class="hidden-480"><?php echo $row->amount; ?> <?php echo $row->currency; ?></td>
              
             <td><?php echo $row->payMethod; ?></td>
            
              
              
            </tr>
            <?php 
} ?>
          </tbody>
        </table>
        
        <h5><strong>Invoice  Information</strong></h5>
        
        
        <table class="table table-striped table-bordered table-hover" id="example">
          <thead>
            <tr>
               <th style="width:8px;">#</th>
              <th>Invoice Date  </th>
              <th>Due Date</th>
             <th class="hidden-480">Project</th>
             <th>Project Type</th>
              <th>Client Name</th>
             
              
              <th>Tax</th>
              <th class="hidden-480">Discount</th>
              
              <th class="hidden-480">Net Amount</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
          <?php
		  $InvcData = Customer::clienInvoice($Cdata->clientId);
		   foreach($InvcData->result() as $row){ ?>
         
 
  
        <tr>
      <td><?php echo $row->invoiceNo; ?></td>
          <td><?php echo date('d-M-Y',$row->invDate); ?></td>
          <td><?php echo date('d-M-Y',$row->dueDate); ?></td>
          <td><?php echo anchor('customers/projectSingle/'.$row->pid,$row->pName); ?></td>
          <td><?php echo $row->proType; ?></td>
          <td><?php echo anchor('customers/clientSingle/'.$row->cid,$row->name); ?></td>
          <td><?php echo round($row->serviceTax+$row->EducationTax+$row->SecondaryTax).' '. $row->currency;?></td>
          <td><?php echo $row->discount.' '. $row->currency; ?></td>
          <td><?php echo $row->total.' '. $row->currency; ?></td>
          <td><?php echo anchor('customers/invoiceDetail/'.$row->Iid,'View') ?></td>
          </tr>
          
          <?php }?>
          
          </tbody>
        </table>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET--> 
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
<script src="<?php echo base_url();?>assets/fancybox/source/jquery.fancybox.pack.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script> 
<!-- ie8 fixes --> 
<!--[if lt IE 9]>
	<script src="assets/js/excanvas.js"></script>
	<script src="assets/js/respond.js"></script>
	<![endif]--> 

<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/data-tables/jquery.dataTables.js"></script> 

<script type="text/javascript" src="<?php echo base_url();?>assets/data-tables/DT_bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/thickbox.js"></script> 
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			$('#statusAction').live('click',function(){
				
				var id =$(this).parent().find('#pidL').val();
				var pStatus =$(this).parent().find('#psstus').val();
				
				
				   $('#pid').val(id);
				   $('#pstatus').val(pStatus);
				   $('#ActionDailog').show();
				
				});
				
	     	$('#cancel').click(function(){
		  
		          $('#ActionDailog').hide();
	         });
			 $('#Pstatus').live('mouseover',function(){
				 
				$(this).find('table').fadeIn(200);
				 
				 });
				 
				$('#Pstatus').live('mouseout',function(){
				 
				 $(this).find('table').fadeOut(200);
				 
				 }); 
		});
	</script> 
    
    
    
       <!--Accept/Reject System-->

<div id="ActionDailog" style="width:100%; display:none; height:100%; position:fixed; background-color:rgba(0,0,0,0.4); left:0; top:0; z-index:9999999; overflow:hidden;">

<div style="width:300px; background-color:#fff; height:140px; border:1px solid #eee; position:absolute; left:50%; top:50%; margin-left:-150px; margin-top:-70px;">
<div style="padding:15px;">
<form method="post" name="" action="<?php echo site_url('customers/projectStatus'); ?>" id="completeFormSign">
<input type="hidden" id="pstatus" name="pstatus"  />
<input type="hidden" id="pid" name="pid"  />
<table>
<tr>

<td colspan="2">
<label>Select Date(d/m/Y): </label>
<select id="day" name="day" class="required" style="width:70px">
<option value="">Day</option>
<?php for($i=1; $i<=31; $i++) {?>
<?php $selectedC = ($i==date('d'))?' selected="selected"':''; ?>
<option value="<?php echo $i; ?>" <?php echo $selectedC; ?>><?php echo $i ?></option>
<?php } ?>
</select>

<select id="month" name="month" class="required" style="width:80px">
<option value="">Month</option>
<?php for($i=1; $i<=12; $i++) {?>
<?php $selectedC = ($i==date('m'))?' selected="selected"':''; ?>
<option value="<?php echo $i; ?>" <?php echo $selectedC; ?>><?php echo $i ?></option>
<?php } ?>
</select>

<select id="year" name="year" class="required" style="width:80px">
<option value="">Year</option>

<?php for($i=2000; $i<=date('Y'); $i++) {?>
<?php $selectedC = ($i==date('Y'))?' selected="selected"':''; ?>
<option value="<?php echo $i; ?>" <?php echo $selectedC; ?>><?php echo $i ?></option>
<?php } ?>
</select>





</td>
</tr>

<tr>

<td>
<button type="submit" class="btn blue"><i class="icon-ok"></i> Send</button>
                  
</td>
<td>
<button type="reset" class="btn" id="cancel">Cancel</button>
</td>
</tr>

</table>
</form>
</div>

</div>


</div>

<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
