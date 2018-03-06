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
<h3 class="page-title"><?php echo $this->lang->line('certificates_certificate');?> <small><?php echo $this->lang->line('certificates_addedit');?></small> </h3>
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
              <h4><i class="icon-reorder"></i><?php echo $this->lang->line('certificates_form');?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
               <!-- BEGIN FORM--> 
               
              <?php echo form_open_multipart('admin/saveMyProfile/', array('id'=>'form_certificate', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>
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
                    <label class="control-label" >User Name</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="uname" id="uname" value="<?php echo $empData->userName;?>" maxlength="8" >
                    </div>
                  </div>
                </div>
                <!--/span--> 
                              <!--/span-->
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Contact Number</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="contact" id="contact" value="<?php echo $empData->phone_num;?>">
                    </div>
                  </div>
                </div>
                <!--/span--> 
                </div>
                
                <?php if($this->session->userdata('user_type')== 'SA'){?>
<div class="row-fluid">
<div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Email: </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="email" id="email" value="<?php echo $empData->contact_email;?>">
                    </div>
                  </div>
                </div>
                <!--/span--> 
                <div class="row-fluid">
<div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Name: </label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="name" id="name" value="<?php echo $empData->contact_name;?>">
                    </div>
                  </div>
                </div>
                <!--/span--> 
                
                
                </div>
                
                <?php } ?>                
              
              <!--/row-->
              <div class="row-fluid">
              
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Emergency Number</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="eno" id="eno" value="<?php echo $empData->emergency_number;?>" >
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Address</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="address" id="address" value="<?php echo $empData->address;?>" >
                    </div>
                  </div>
                </div>
                <!--/span--> 
              </div>
              <!--/row-->
             
           
              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Image</label>
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo (trim($empData->image) == '' || is_null($empData->image) || ($empData->image == 0)) ? base_url().'upload/profileimages/blank.jpg' : base_url().'upload/profileimages/'.$empData->image; ?>" alt="" /> </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                          <input type="file" class="default" name="userfile" />
                           <input type="hidden" name="pfile" value="<?php echo $empData->image;?>" />
                          </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                      </div>
                      <span class="label label-important">NOTE!</span> <span> Attached image thumbnail is
                      supported in Latest Firefox, Chrome, Opera, 
                      Safari and Internet Explorer 10 only </span> </div>
                  </div>
                </div>
              </div>
            
              <div class="row-fluid">
              
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >password</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="password" id="password" value="<?php echo $empData->plain;?>" />
                    </div>
                  </div>
                </div>
                <!--/span-->
               
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Re-Password</label>
                    <div class="controls">
                      <input type="text" class="m-wrap span12" name="re-password" id="password" value="<?php echo $empData->plain;?>" />
                    </div>
                  </div>
                </div>
                <!--/span--> 
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
<script>
		jQuery(document).ready(function() {	
			// initiate layout and plugins
			App.init();
		});
	</script> 
<script type="text/javascript" src="<?php echo site_url('js/jquery-ui.min.js');?>"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script>
  $(function() {
    $( "#doj" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo site_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
	$( "#dob" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo site_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
  });
  </script>
<?php $this->load->view('partial/footer');?>
  
	   <script type="text/javascript">
	 //  $('select[name="cid"]').;
	   $('select[name="cid"] option[value="<?php echo $this->session->userdata('cid') ?>"]').attr("selected","selected");
	  //alert(v);
	   $('select[name="cid"]').attr("disabled", "disabled");
	   </script>
	