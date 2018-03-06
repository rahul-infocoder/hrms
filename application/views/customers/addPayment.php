<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Add Project </h3>
<?php $this->load->view('partial/breadcrumb');?>


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
              <h4><i class="icon-reorder"></i>Add Project</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
          
              <?php echo form_open('customers/savePayment',array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
          
      
      
       <div class="control-group">
                  <label class="control-label">Client Name: </label>
                  <div class="controls">
              
                 <?php 
				
				 if(Customer::clietListDropDown())
				 {
				    echo Customer::clietListDropDown();
				  }
				 ?>
                  </div>
                </div>
                
                 <div class="control-group">
                  <label class="control-label">Invoice No: </label>
                  <div class="controls">
              <select name="pid" id="pid" class="required">
              <option value="">Select</option>
              </select>
               
                  </div>
                </div>
                
                
               <div class="control-group">
                  <label class="control-label">Currency: </label>
                  <div class="controls">
               
               <!-- <select name="currency" id="currency" class="required">
                <option value="">Select</option>
                <option value="USD">USD</option>
                <option value="INR">INR</option>
                <option value="GBP">GBP</option>
                <option value="AUD">AUD</option>
                <option value="CAD">CAD</option> 
                <option value="SAR">SAR</option>
                <option value="AED">AED</option>
                
                </select>-->
                <b id="cValue"></b>
                <input type="hidden" name="currency" id="currency" />
                </div>
                </div>
               
                <div class="control-group">
                  <label class="control-label">Amount </label>
                  <div class="controls">
                
                  
                   <input type="text" name="amount" id="amount" class="m-wrap span12 required"  value="" />
                    
                    </div>
                </div>
               
               
               <div class="control-group">
                  <label class="control-label">Payment Method </label>
                  <div class="controls">
                
                  
                   <input type="text" name="method" id="method" class="m-wrap span12 required"  value=""    />
                    
                    </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Payment Date </label>
                  <div class="controls">
                
                  
                   <input type="text" name="payDate" id="payDate" class="m-wrap span12 required" style="width:200px;"   />
                    
                    </div>
                </div>
                
                <input type="hidden" name="limit" id="limit"  />
                
                <div class="form-actions">
                  <button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
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
		 $( "#payDate" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
	
		 
     $('#pid').change(function(){
		 $val = $(this).val();
		$option = $('#pid option[value="'+$val+'"]').attr('amount');
		$currency =$('#pid option[value="'+$val+'"]').attr('currency');
		$('#limit').val($option);
		$('#currency').val($currency);
		$('#cValue').html($currency);
		
		 });
	  
	  
	  	$("#form_est").validate();
		
		
		$('#client').change(function(){
			
			$('#pid').empty();
			$.ajax({
				 type: "POST",
				 url: '<?php echo site_url("customers/fetchInvoice");?>', 
				 data: {id: $(this).val()},
				 dataType: "text",  
				 cache:false,
				 success: 
					  function(data){
						 $('#pid').append(data);
					  }
		
			 
		 });
			
			});
	});
   </script>
   <?php $this->load->view('partial/footer');?>