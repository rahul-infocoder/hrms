<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> View Holiday <small> View Holiday </small> </h3>
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
        <h4><i class="icon-globe"></i>View Holiday</h4>
        <div class="tools"> 
         <a href="<?php echo site_url('admin/holiday'); ?>"  style="color:#fff;">Add Holiday</a>  </div>
      </div>
      <div class="portlet-body">
      
      <?php $geturi =  ($this->uri->segment(3))?$this->uri->segment(3):date('Y'); ?>
      <select id="year">
      
	  <?php

	  for($year=2013; $year<= date('Y'); $year++)
	  {
		  $select = ($year==$geturi)?' selected="selected"':'';
		  echo '<option value="'.$year.'"'.$select.' >'.$year.'</option>';
		  
		 }
	   ?>
      </select>
      <table class="table table-striped table-bordered table-hover" id="example">
          <thead>
          <tr>
          <th>Holiday Name</th>
          <th>Holiday Date</th>
          <th>Day</th>
          </tr>
          
          </thead>
          
          
          <tbody> 
           <?php foreach($list->result() as $row):?>  
            <tr>
            <td><?php echo $row->hname; ?></td>
            <td><?php echo date('d-m-Y',$row->date); ?></td>
            <td><?php echo $row->day; ?></td>
            </tr>
			
			<?php endforeach;  ?>        
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
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 
<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			
			$('#year').change(function(){
			location.href='<?php echo site_url('employees/viewHoliday') ?>'+'/'+$(this).val();
			
			});
			
		});
		
		
			
			
	</script> 


<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>