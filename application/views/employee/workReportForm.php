<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Work Report<small> Work Report</small> </h3>
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
              <h4><i class="icon-reorder"></i>Daily Work Report Form</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <?php echo form_open_multipart('employees/saveMyReport/'.$wData->eid,array('id'=>'form_wreport', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="control-group">
                  <label class="control-label">Employee Name </label>
                  <div class="controls">
                    <input type="text" name="ename" class="m-wrap span12" value="<?php echo $wData->contact_name;?>" disabled="disabled" />
                    </div>
                </div>
               
                <div class="control-group">
                  <label class="control-label" >Work Report</label>
                  <div class="controls">
                    
                    <textarea class="m-wrap span12" name="report" cols="5" rows="5"></textarea>
                   
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" >Attachment</label>
                  <div class="controls" id="creater">
                  <a href="javascript:void()" id="add">Add</a>
                    <div id="attach">
                    <input type="file" name="file[]"  />
                   
                    
                    </div>
                  </div>
                  
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn blue"><i class="icon-ok"></i> Send</button>
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
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
      jQuery(document).ready(function() {      
         // initiate layout and plugins
         App.init();
		 
		 
		 
		 $('#add').click(function(){
			 $file = $('<input/>').attr('type', 'file').attr('name', 'file[]');
			 $anchor = $('<a/>').attr('id','remove').text('Remove');
		$('#creater').append('<div id="attach"><input type="file" name="file[]" id="file" /><a href="javascript:void()" id="remove" onclick="return Rremove(this);">Remove</a></div>');
			 
			 
		 });
		 

	 
		 
		 
      });
   </script>
   
   
   <script>
   function Rremove(id)
{
	 $(id).parent().remove();
	 
}
   </script>
   
   <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  
   <?php $this->load->view('partial/footer');?>   