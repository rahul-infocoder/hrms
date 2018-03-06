<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Holiday Form <small>Holiday Form</small> </h3>
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
        <h4><i class="icon-globe"></i>Holiday Add From</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a>
        <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
        <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
      <?php echo form_open_multipart('admin/holidaySave',array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
       
                
                
            <div class="control-group">
                  <label class="control-label" >Company</label>
                  <div class="controls">
                        <?php 
	  $cList = User::getCompanies();
	  echo form_dropdown('cid', array(''=>'--SELECT--') + $cList,'default','class=required'); ?>
                  </div>
                </div>
                
                
               <div class="control-group">
                  <label class="control-label" >Date From</label>
                  <div class="controls">
                  <input type="text"  class="m-wrap span4 required" name="dateFrom"  id="dateFrom" >  
                    
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" >Date To</label>
                  <div class="controls">
                  
                     <input type="text"  class="m-wrap span4 required" name="dateTo"  id="dateTo"  >  
                  </div>
                </div>
             
               <div class="control-group">
                  <label class="control-label" >Holiday Name</label>
                  <div class="controls">
                      <input type="text"  class="m-wrap span4 required" name="name" value="" >
                  </div>
                </div>
              
              
              
                
                
                 <div class="form-actions">
                <button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn">Cancel</button>
              </div>
        </form>
        
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
		});
	</script> 

<script>

$(function() {
	$("#form_est").validate();
	
    $( "#dateTo" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
	 $( "#dateFrom" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
});
</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>