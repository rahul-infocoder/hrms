<?php $this->load->view('partial/header');?>

<style>
.ui-autocomplete {
	max-height: 200px;
	overflow-y: auto;
	/* prevent horizontal scrollbar */
    overflow-x: hidden;
	
}

/* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
	height: 100px;
}
</style>
<h3 class="page-title">Company <small>Add Companies</small> </h3>
<?php $this->load->view('partial/breadcrumb');?>
</div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12">
    <div class="tabbable tabbable-custom boxless">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title">
              <h4><i class="icon-reorder"></i>Company Action Form</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM--> 
              <?php echo form_open_multipart('admin/saveComp/'.$compData->id, array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>
              <h3 class="form-section"><?php echo $this->lang->line('certificates_info');?></h3>
             <div class="alert alert-error hide">
    <button class="close" data-dismiss="alert"></button>
    </div>
  <?php if(validation_errors()){
?>
  <div class="alert alert-error">
    <button class="close" data-dismiss="alert"></button>
    <span><?php echo validation_errors();?></span> </div>
  <?php }?>
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Company Name: </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="cname" value="<?php echo $compData->name; ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="span6">
                <div class="control-group">
                    <label class="control-label">Short Name:</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="sname" value="<?php echo $compData->sname; ?>">
                    </div>
                  </div>
                  </div>
              </div>
              
               
                  <div class="control-group">
                    <label class="control-label">Logo</label>
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo (trim($compData->logo) == '' || is_null($compData->logo) || ($compData->logo == 0)) ? base_url().'upload/profileimages/blank.jpg' : base_url().'upload/profileimages/'.$compData->logo ?>" alt="" /> </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                          <input type="file" class="default" name="userfile" />
                           <input type="hidden" name="pfile" value="" />
                          </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                      </div>
                      <span class="label label-important">NOTE!</span> <span> Attached image thumbnail is
                      supported in Latest Firefox, Chrome, Opera, 
                      Safari and Internet Explorer 10 only </span> </div>
                  </div>
               
                <!--/span-->                 
              
              
              <div class="control-group">
                  <label class="control-label" >Description </label>
                  <div class="controls">
                   
                    <textarea name="des" cols="5" rows="5" class="m-wrap span12 required" ><?php echo $compData->description;?></textarea>
                  </div>
                </div>
                <!--/full-->
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Salary Date</label>
                    <div class="controls">
                       <select name="sdate"  class="required">
                     <option value="">Select</option>
                     <?php for($i=1;  $i<=30; $i++ ){ ?>
                     
                     <option value="<?php echo $i; ?>" <?php if($compData->salaryDate == $i){ echo ' selected="selected"'; }?> ><?php echo $i; ?></option>
                  <?php } ?>
                     </select>
                    </div>
                  </div>
                </div>
                <!--/span-->
                 <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Active</label>
                    <div class="controls">
                     <select name="active" id="active" class="required">
                     <option value="">Select</option>
                     <option value="Y" <?php if($compData->active == 'Y'){ echo ' selected="selected"'; }?>>Yes</option>
                     <option value="N" <?php if($compData->active == 'N'){ echo ' selected="selected"'; }?>>No</option>
                     
                     </select>
                    </div>
                  </div>
                </div>
                <!--/span-->
                
              
              </div>
              
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Country : </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="country" value="<?php echo $compData->country; ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="span6">
                <div class="control-group">
                    <label class="control-label">State:</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="state" value="<?php echo $compData->state; ?>">
                    </div>
                  </div>
                  </div>
              </div>
              
              
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">City: </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="city" value="<?php echo $compData->city; ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="span6">
                <div class="control-group">
                    <label class="control-label">Zip Code:</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="zip" value="<?php echo $compData->zip; ?>">
                    </div>
                  </div>
                  </div>
              </div>
              
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Address:  </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="address" value="<?php echo $compData->address; ?>">
                    </div>
                  </div>
                </div>
                
                 <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Phone:  </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="phone" value="<?php echo $compData->phone; ?>">
                    </div>
                  </div>
                </div>
              
              </div>
              
              
              
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Email:  </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12 required" name="email" value="<?php echo $compData->email; ?>">
                    </div>
                  </div>
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
<script src="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script> 
<!-- ie8 fixes --> 
<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>assets/js/excanvas.js"></script>
	<script src="<?php echo base_url();?>assets/js/respond.js"></script>
	<![endif]--> 
<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/data-tables/jquery.dataTables.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/data-tables/DT_bootstrap.js"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 

<script>
		jQuery(document).ready(function() {	
			// initiate layout and plugins
			App.init();
		});
	</script> 
    
    <script type="application/javascript">
   $(document).ready(function(e) {
	   
	   $("#form_est").validate();
	   
	   
   });
   
   </script>
   
    
<script type="text/javascript" src="<?php echo site_url('js/jquery-ui.min.js');?>"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 

<?php $this->load->view('partial/footer');?>
