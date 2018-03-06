<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Compose Message </h3>
<?php $this->load->view('partial/breadcrumb');?>
<style type="text/css">


label.error{
	display:none !important
}
.error{
	border:1px solid red !important;
}
</style>



</div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12">
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
    
    <?php if(validation_errors()){
?>
  <div class="alert alert-error">
    <button class="close" data-dismiss="alert"></button>
    <span><?php echo validation_errors();?></span> </div>
  <?php }?>
    <div class="tabbable tabbable-custom boxless">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title">
              <h4><i class="icon-reorder"></i>Compose Message</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
          
              <?php echo form_open_multipart('message/sendMessage',array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
          
      
      
       <div class="control-group">
                  <label class="control-label">To </label>
                  <div class="controls">
        <input type="text" name="to" id="to" class="m-wrap span12" value=""  />
        
      
     
                    </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Subject </label>
                  <div class="controls">
        <input type="text" name="subject" id="subject" class="m-wrap span12" value=""  />
                    </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label">Message </label>
                  <div class="controls">
                  
                  <textarea name="msg" id="msg" class="m-wrap span12"></textarea>
                  
                    </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Attachment</label>
                  <div class="controls" id="creater">
                  <a href="javascript:void()" id="add">Add</a>
                    <div id="attach">
                   
                    <input type="file" name="file[]"   />
                   
                    
                    </div>
                  </div>
                  
                </div>
               
                
                
                
                
                <div class="form-actions">
                  <button type="submit" class="btn blue"><i class="icon-ok"></i>Send</button>
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
		 
		
		 
      });
	  
	  
	  	
   </script>
   
 <script type="text/javascript">

 function RremoveAtta(id)
				{
					 $(id).parent().remove();
					 
				}



$(document).ready(function(e) {
	
	
	
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
	
	$('#add').click(function(){
			 /*$file = $('<input/>').attr('type', 'file').attr('name', 'file[]');
			 $anchor = $('<a/>').attr('id','remove').text('Remove');*/
		$('#creater').append('<div id="attach"><input type="file" name="file[]" id="file" class="required"  /><a href="javascript:void()" id="remove" onclick="return RremoveAtta(this);">Remove</a></div>');
			// $('#creater').find('#attach:last-child').find('input').rules('add', { required: true });
			 
		 });
		 
		 
		   
		 

	

		
		
		
		$(document).click( function(){
          $('#list').hide();
          });
		
});




      </script>
      
      
      
      
      
   
	<script src="<?php echo base_url('js/jquery.ui.core.js'); ?>"></script>
	<script src="<?php echo base_url('js/jquery.ui.widget.js'); ?>"></script>
	<script src="<?php echo base_url('js/jquery.ui.position.js'); ?>"></script>
	<script src="<?php echo base_url('js/jquery.ui.menu.js'); ?>"></script>
	<script src="<?php echo base_url('js/jquery.ui.autocomplete.js'); ?>"></script>
    <script src="<?php echo base_url('js/autoCompleteList.js');?>"></script>
    <script type="text/javascript">
 $('#to').AutoListPlugin({
	   url:'<?php echo site_url('message/fetchUserList'); ?>',
	   loader:'<?php echo base_url('images/loader.gif'); ?>',
	   afterCharecter :2,
	   multiple:true
	   });
	
	</script>

      
      
       <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  <?php $this->load->view('partial/footer');?>   