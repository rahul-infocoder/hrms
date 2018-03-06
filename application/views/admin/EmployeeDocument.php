<?php $this->load->view('partial/header');?>
<style type="text/css">
label.error{
	display:none !important
}
.error{
	border:1px solid red !important;
}
</style>
<h3 class="page-title"> Documents <small>Add Employee Documents</small> </h3>
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
              <h4><i class="icon-reorder"></i>Documents</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <?php echo form_open_multipart('admin/saveDocument',array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
              
               <div class="control-group">
                  <label class="control-label" >Employee Name:</label>
                  <div class="controls">
                    <?php echo form_dropdown('elist', array(''=>' -- SELECT -- ') + $empList,'default','class=required' ); ?>
                  </div>
                </div>
                
                
                
                 <div class="control-group">
                  <label class="control-label" >Documents</label>
                  <div class="controls" id="creater">
                  <a href="javascript:void()" id="add">Add</a>
                    <div id="attach">
                    <input type="text" name="Dname[]" placeholder="Document Name" id="Dname" class="required"   />
                    <input type="file" name="file[]" class="required"   />
                   
                    
                    </div>
                  </div>
                  
                </div>
               
                <div class="form-actions">
                  <button type="submit" class="btn blue" id="submit" ><i class="icon-ok"></i> Save</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </form>
              <!-- END FORM--> 
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
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
      jQuery(document).ready(function() {      
         // initiate layout and plugins
         App.init();
		 
		 
		 $('#add').click(function(){
			 /*$file = $('<input/>').attr('type', 'file').attr('name', 'file[]');
			 $anchor = $('<a/>').attr('id','remove').text('Remove');*/
		$('#creater').append('<div id="attach"><input type="text" name="Dname[]" placeholder="Document Name" class="required"   /><input type="file" name="file[]" id="file" class="required"  /><a href="javascript:void()" id="remove" onclick="return Rremove(this);">Remove</a></div>');
			// $('#creater').find('#attach:last-child').find('input').rules('add', { required: true });
			 
		 });
     
	  
	  
	  
			
			
	});
	  
   </script>
   <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.min.js');?>"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 

 <script>
   function Rremove(id)
		{
			 $(id).parent().remove();
			 
		}

   </script>
   
   <script type="text/javascript">
   
$(document).ready(function() {
	//$("#form_est").validate();
	$("#form_est").validate();
	//$('#form_est').validate(); $("#submit").click(function(){

	
	$.validator.prototype.checkForm = function () {
                //overriden in a specific page
                this.prepareForm();
                for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
                    if (this.findByName(elements[i].name).length != undefined && this.findByName(elements[i].name).length > 1) {
                        for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                            this.check(this.findByName(elements[i].name)[cnt]);
                        }
                    } else {
                        this.check(elements[i]);
                    }
                }
                return this.valid();
            }

					
				
});
</script>
