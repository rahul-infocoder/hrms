<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Request Leave <small>Raise A Request</small> </h3>
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
              <h4><i class="icon-reorder"></i>Project Reply Form</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <?php echo form_open('employees/saveMyProjectDates/'.$mpData->id,array('id'=>'form_projectdate', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="control-group">
                  <label class="control-label">Employee Name </label>
                  <div class="controls">
                    <input type="text" name="ename" class="m-wrap span12" readonly value="<?php echo $mpData->contact_name;?>" />
                    </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Project Name </label>
                  <div class="controls">
                    <input type="text" name="ename" class="m-wrap span12" readonly value="<?php echo $mpData->projectname;?>" />
                    </div>
                </div>
                 <div class="control-group">
                  <label class="control-label" >Client Date From</label>
                  <div class="controls">
                    <input type="text"  class="m-wrap span12 small" readonly value="<?php echo date('m/d/Y', $mpData->pstartdate);?>" >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Client Date To</label>
                  <div class="controls">
                    <input type="text"  class="m-wrap span12 small" readonly value="<?php echo date('m/d/Y', $mpData->penddate);?>" >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Date From</label>
                  <div class="controls">
                    <input type="text"  class="m-wrap span12 small" name="datefrom" id="leavefrom" >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Date To</label>
                  <div class="controls">
                    <input type="text"  class="m-wrap span12 small" name="dateto" id="leaveto" >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Remarks</label>
                  <div class="controls">
                    <input type="text"  class="m-wrap span12" name="remarks" >
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
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
      jQuery(document).ready(function() {      
         // initiate layout and plugins
         App.init();
      });
   </script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script>
  $(function() {
    $( "#leavefrom" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo site_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
	$( "#leaveto" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo site_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
  });
  </script>
