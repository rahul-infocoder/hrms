<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Admin <small>All Admin</small> </h3>
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
        <h4><i class="icon-globe"></i>Admin List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a>
        <a href="<?php echo site_url('admin/addAdmin'); ?>"><i class="icon-plus-sign "></i></a>
         </div>
      </div>
      <div class="portlet-body">
      <?php 

	  $limit = $this->uri->segment(3)?$this->uri->segment(3):50;
	  
	   ?>
      <table class="table table-striped table-bordered table-hover" >
      <tr>
       <td>
       <select id="row" style="width:80px">
      <option value="all">Row</option>   
      <option value="50" <?php echo ($limit==50)?' selected="selected"':''; ?>>50</option>
      <option value="100" <?php echo ($limit==100)?' selected="selected"':''; ?>>100</option>
      <option value="200" <?php echo ($limit==200)?' selected="selected"':''; ?>>200</option>
      <option value="500" <?php echo ($limit==500)?' selected="selected"':''; ?>>500</option>
      <option value="all" <?php echo ($limit=='all')?' selected="selected"':''; ?>>All</option>
      </select>
      </td>
      </tr>
      </table>
      
      
        <table class="table table-striped table-bordered table-hover" id="msgTable">
          <thead>
            <tr>
              <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
              <th>Admin Name</th>
              <th class="hidden-480">Email</th>
              <th class="hidden-480">Password</th>
              <th class="hidden-480">Status</th>
              <th class="hidden-480">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($empData->result() as $elist){ ?>
            
            <tr class="odd gradeX" >
            <td <?php if($elist->u_active == 'N'){echo ' style="background-color: #999999;"';} ?>><input type="checkbox" class="checkboxes" value="1" /></td>
              
            <td class="hidden-480" <?php if($elist->u_active == 'N'){echo ' style="background-color: #999999;"';} ?>><?php echo $elist->contact_name;?></td>
            <td class="hidden-480" <?php if($elist->u_active == 'N'){echo ' style="background-color: #999999;"';} ?>><?php echo $elist->contact_email; ?> </td>
            <td class="hidden-480" <?php if($elist->u_active == 'N'){echo ' style="background-color: #999999;"';} ?>><?php echo $elist->plain; ?></td>
            <td class="hidden-480" <?php if($elist->u_active == 'N'){echo ' style="background-color: #999999;"';} ?>><?php if($elist->u_active=='N'){echo 'Deactive';}else{echo 'Active';} ?></td>
             <td class="hidden-480" <?php if($elist->u_active == 'N'){echo ' style="background-color: #999999;"';} ?>><?php echo anchor('admin/addAdmin/'.$elist->empid, '<i class="icon-edit"></i>');?> 
              <?php echo anchor('admin/delEmployees/'.$elist->empid, '<i class="icon-trash "></i>',array('class'=>'delete', 'onclick'=>"return confirmDialog();"));?></td>
            </tr>
            
            <?php 
} ?>
          </tbody>
        </table>
        <div class="pagination"><?php echo (isset($links))?$links:''; ?></div>
        <?php echo $rowInfo; ?>
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
			
			var site = '<?php echo site_url('admin/viewAdminUser'); ?>';
			$('#row').change(function(){
			       
					var row = $('#row').val();
					var uri =row;
					
					
					location.href = site+'/'+uri;
				
				});
		});
	</script> 
    <script>
function confirmDialog() {
    return confirm("Are you sure you want to delete this record?")
}
</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
