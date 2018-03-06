<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Admin <small>All Companies</small> </h3>
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
    <div class="portlet box blue">
      <div class="portlet-title">
        <h4><i class="icon-globe"></i>Company List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> 
        <a href="<?php echo site_url('admin/addCompany/-1'); ?>"><i class="icon-plus-sign "></i></a>
        
        </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="msgTable">
          <thead>
            <tr>
             
              <th>Name</th>
              <th>Employee</th>
              <th>Projects</th>
              <th class="hidden-480">Status</th>
               <?php if($this->session->userdata('user_type') == 'SA') {?>
              <th class="hidden-480">Action</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach($cData->result() as $elist){ 
			$AempNo = Adminmodel::getAEmployeeInCompany($elist->id)->row()->AempNo;
			$DempNo = Adminmodel::getDEmployeeInCompany($elist->id)->row()->DempNo;
			?>
           
            
            <tr class="odd gradeX">
           
              <td class="hidden-480"><?php echo $elist->name;?></td>
              
              <td title="Active Employee/Deactive Employee"><?php echo $AempNo .' / '.$DempNo; ?></td>
              <td title="Running/Completed Project">
              <?php echo Adminmodel::CompanyProject($elist->id,'R'); ?> / <?php echo Adminmodel::CompanyProject($elist->id,'C'); ?>
              </td>
              <td class="hidden-480"><?php if($elist->active =='Y'){echo "Active";}else{echo "Deactive";} ?></td>
               <?php if($this->session->userdata('user_type') == 'SA') {?>
              <td class="hidden-480">
              
              
			  <?php echo anchor('admin/addCompany/'.$elist->id, 'Edit');?> / <?php echo anchor('admin/delCompanies/'.$elist->id, 'Delete',array('class'=>'delete', 'onclick'=>"return confirmDialog();")) ?>
             
              </td>
               <?php } ?>
            </tr>
            <?php } ?>
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
    
    
    <script>
function confirmDialog() {
    return confirm("Are you sure you want to delete this record?")
}
</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
