<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Add Customer </h3>
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
              <h4><i class="icon-reorder"></i>Add Customer</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <?php
			  if(isset($cInfo)){
				  
				   $id = '/'.$cInfo->id;
				  
				  
				  }
				  else
				  {
					 $id=''; 
					 }
			  ?>
              <?php echo form_open('customers/saveCustomer'.$id,array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
          
      
      
       <div class="control-group">
                  <label class="control-label">Company: </label>
                  <div class="controls">
                   <?php  $cList = User::getCompanies();
	  echo form_dropdown('company', array(''=>'--SELECT--') + $cList); ?>
                    </div>
                </div>
               
                <div class="control-group">
                  <label class="control-label">Customer Name </label>
                  <div class="controls">
                    <input type="text" name="ename" id="ename" class="m-wrap span12 required" value="<?php if(isset($cInfo)){echo $cInfo->name;} ?>"  />
                    </div>
                </div>
               
                <div class="control-group">
                  <label class="control-label" >Email</label>
                  <div class="controls">
                   
                   <input type="text" name="email" id="email" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->email;} ?>"  />
                  </div>
                </div>
                  <div class="control-group">
                  <label class="control-label" >Mobile No</label>
                  <div class="controls">
                   
                   <input type="text" name="mobile" id="mobile" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->mobile;} ?>"  />
                  </div>
                </div>
                
                
                  <div class="control-group">
                  <label class="control-label" >Address</label>
                  <div class="controls">
                   
                   <input type="text" name="address" id="address" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->address;} ?>"  />
                  </div>
                </div>
                
                 <div class="control-group">
                  <label class="control-label" >Country</label>
                  <div class="controls">
                    <input type="text" name="country" id="country" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->country;} ?>"  />
                 
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" >State</label>
                  <div class="controls">
                    <input type="text" name="state" id="state" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->state;} ?>"  />
                 
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >City</label>
                  <div class="controls">
                    <input type="text" name="city" id="city" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->city;} ?>"  />
                 
                  </div>
                </div>
                
                
                  <div class="control-group">
                  <label class="control-label" >Zip code</label>
                  <div class="controls">
                   
                   <input type="text" name="zip" id="zip" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->zip;} ?>"  />
                  </div>
                </div>
                
                
                  <div class="control-group">
                  <label class="control-label" >Company</label>
                  <div class="controls">
                   
                   <input type="text" name="ccompany" id="ccompany" class="m-wrap span12" value="<?php if(isset($cInfo)){echo $cInfo->companyName;} ?>"  />
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" >Currency</label>
                  <div class="controls">
                   <select name="currency" id="currency" class="m-wrap span12 required">
                <option value="">Select</option>
                <option value="USD" <?php if(isset($cInfo)){if($cInfo->currency == 'USD'){ echo ' selected="selected"';}} ?> >USD</option>
                <option value="INR"  <?php if(isset($cInfo)){if($cInfo->currency  == 'INR'){ echo ' selected="selected"';}} ?>>INR</option>
                <option value="GBP"  <?php if(isset($cInfo)){if($cInfo->currency  == 'GBP'){ echo ' selected="selected"';}} ?> >GBP</option>
                <option value="AUD"  <?php if(isset($cInfo)){if($cInfo->currency  == 'AUD'){ echo ' selected="selected"';}} ?> >AUD</option>
                <option value="CAD"  <?php if(isset($cInfo)){if($cInfo->currency  == 'CAD'){ echo ' selected="selected"';}} ?> >CAD</option> 
                <option value="SAR"  <?php if(isset($cInfo)){if($cInfo->currency  == 'SAR'){ echo ' selected="selected"';}} ?>>SAR</option>
                <option value="AED"  <?php if(isset($cInfo)){if($cInfo->currency  == 'AED'){ echo ' selected="selected"';}} ?> >AED</option>
                
                </select>
                  
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" >Added Date</label>
                  <div class="controls">
                   
                   <input type="text" name="addDate" id="addDate" class="m-wrap span12" style="width:200px;" value="<?php if(isset($cInfo)){echo date('m-d-Y',$cInfo->dor);} ?>"  /> (M-d-Y)
                  </div>
                </div>
                
                
                
                
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
		 	 $( "#addDate" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
		 
		 
		 '<?php if(isset($cInfo)) {?>'
		
		 $('select[name="company"] option[value="<?php echo $cInfo->bycompany ?>"]').attr("selected","selected");
		 '<?php } ?>'
		 
      });
	  
	  
	  	$("#form_est").validate({
		rules: {
			ename: {
			required:true
			
			
			},
			email: {
				required: true,
				email: true
			},
			mobile:{
				 required:true
				
				},
				
				address:"required",
				zip:"required",
				ccompany:"required",
				company:"required"
			
		}
	});
   </script>
   <?php $this->load->view('partial/footer');?>