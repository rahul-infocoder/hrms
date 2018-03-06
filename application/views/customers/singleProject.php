<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> <?php echo $pData->pName; ?> <small><?php echo $pData->pName; ?></small> </h3>
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
        <h4><i class="icon-globe"></i><?php echo $pData->pName; ?></h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="example">
         
         <tr>
           <td><strong>Client Name</strong></td><td><?php echo $pData->name; ?></td>
         </tr>
         
         <tr>
                 
         
         <td><strong>Name</strong></td><td><?php echo $pData->pName ?></td>
         </tr>
         <tr>         
         <td><strong>Project Url</strong></td><td><?php echo $pData->pUrl; ?></td>
         </tr>
          <tr>         
         <td><strong>Project Requirement</strong> </td><td><?php echo $pData->pDes; ?></td>
         </tr>
         
         <tr>
         <td><strong>Estimated Time</strong></td><td><?php echo $pData->pEstitime; ?></td>
         </tr>
         <tr>
         <td><strong>Added Date</strong></td><td><?php echo date('d-m-Y',$pData->AddDate); ?></td>
         </tr>
         
         <tr>
           <td><strong>Price</strong></td><td><?php echo $pData->price; ?></td>
         </tr>
         <tr>
           <td><strong>Status</strong></td><td><?php 
		   if($pData->status == 'R')
		   {
			   echo 'Running';
			   }
			   else if($pData->status == 'H')
			   {
				echo 'Hold';   
				}
				
				else if($pData->status == 'C')
				{
				echo 'Completed';	
				}
		   
		   ?></td>
           </tr>
           
             <tr>
             <th colspan="2">
             <h5><strong>Project Attach Document:</strong> </h5>
             </th>
             </tr> 
             
              <?php
		  $files =Customer::ProDocument($pData->pid);
		 foreach($files->result() as $row)
          { ?> 
              <tr>
             <td><a href="<?php echo base_url() ?>upload/projectFile/<?php echo $row->file; ?>"><?php echo $row->docName; ?></a></td>
             <td><?php echo anchor('admin/docsdelete/'.$row->id.'/'.$row->file.'/'.$row->profid.'/projectFile/customers-projectSingle', '<label class="btn mini red">Delete</label>'); ?></td>
             
             </tr>
         
         <?php } ?>
        </table>
        
        <h5><strong>Assign Infomation</strong></h5>
        
        <table class="table table-striped table-bordered table-hover" id="example">
        
        <tbody>
        <tr>
        <th>Employee Name: </th>
        <th>Status</th>
        <th>Start Date</th>
        <th>Complete Date</th>
        <th>Time</th>
        <th>Admin Comments</th>
        <th>Employee Comments</th>
        <th>ClientFeedBack</th>
        </tr>
        </tbody>
        
         <tbody>
         <?php $assData = Customer::projectAssignDetail($pData->pid);
		 
		 foreach($assData->result() as $row){
		  ?>
         
        <tr>
        <td><?php echo $row->contact_name; ?> </td>
        <td>
		
		<?php
		if($row->status =='W')
		{
		 echo 'Wait Emp Response';	
		}
		else if($row->status =='R')
		{
		echo 'Emp Rejected';	
		}
		else if($row->status =='C')
		{
		echo 'Complete';	
		}
		else if($row->status =='A')
		{
		echo 'Emp Working';	
		}
		
		 ?>
        
        
        </td>
        <td><?php echo $row->workStart !=0?date('d-m-Y',$row->workStart):'wait'; ?></td>
        <td><?php echo $row->endWork!=0?date('d-m-Y',$row->endWork):'wait'; ?></td>
        <td title="Day::Hours::Minute">
        <?php
		 if($row->status =='C')
		{
			$days = round(($row->endWork-$row->workStart) / (60 * 60 * 24));
			$hour = round(($row->endWork-$row->workStart) / (60 * 60));
			$minute = round(($row->endWork-$row->workStart) / (60 ));
			
			echo $days. '::'.$hour .'::'.$minute;
		}
		else
		{
		  echo 'Wait..';	
	    }
		
		?>
        </td>
        
        <td>
        <?php echo $row->remarks; ?>
        </td>
        <td><?php echo $row->report; ?></td>
        <td><?php echo $row->ePerformance; ?></td>
        
        </tr>
        <?php } ?>
        </tbody>
        
        </table>
        
        
      <h5><strong>Project Running Status</strong></h5>  
         <?php $ProSttt = Customer::getprojectStatus($pData->pid); ?>
              <table class="table table-striped table-bordered table-hover" >
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
		});
	</script> 
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
