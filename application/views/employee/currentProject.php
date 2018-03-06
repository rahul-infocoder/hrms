<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Projects <small>My Projects</small> </h3>
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
	<?php //print_r($empData);exit; ?>
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
        <h4><i class="icon-globe"></i>Project List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="example">
          <thead>
            <tr>
             
              <th>Project Name</th>
               <th class="hidden-480">Dead Line</th>
              <th class="hidden-480">Assigned Date</th>
              <th>Start Date</th>
              <th class="hidden-480">Admin Comments</th>
              <th class="hidden-480">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($empData) && count($empData)>0){
			foreach($empData as $plist){ ?>
            <tr>
              
              <td ><?php echo anchor('employees/project-details/'.$plist['pid'], $this->Add_Project_Model->project_name($plist['pid']));?></td>
              
              <td class="hidden-480"><?php echo $plist['deadLine'] !='0'?date('d-m-Y',$plist['deadLine']):'No date';  ?></td>
              <td class="hidden-480"><?php echo date('d-m-Y',$plist['esdatefrom']); ?></td>
              <td class="hidden-480"><?php echo date('d-m-Y',$plist['workStart']) ?></td>
              
              <td class="hidden-480"><?php echo $plist['remarks'];?></td>
              <td class="hidden-480"><?php 
			  if($plist['completeReq'] =='N')
			  {
			  echo anchor('employees/projectComplete/'.$plist['pid'],'<label class="btn mini green">Complete</label>'); 
			   }
			   else
			   {
				  echo '<label class="btn mini blue">Wait...</label>'; 
				}
			  
			  ?> 
              </td>
            </tr>
            <?php 
}
			}else{
				echo "no data to show";
			} ?>
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
