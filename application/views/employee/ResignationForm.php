<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Resignation Form  <small>Resignation Form </small> </h3>
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
              <h4><i class="icon-reorder"></i>Resignation Form </h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <?php echo form_open('employees/saveResign',array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
               
 <div class="alert alert-error hide">
    <button class="close" data-dismiss="alert"></button>
    </div>
  <?php if(validation_errors()){
?>
  <div class="alert alert-error">
    <button class="close" data-dismiss="alert"></button>
    <span><?php echo validation_errors();?></span> </div>
  <?php }?>
                <div class="control-group">
                  <label class="control-label">Employee Name </label>
                  <div class="controls">
                    <input type="text" name="ename" class="m-wrap span12" value="<?php echo $empData->contact_name;?>" disabled="disabled" />
                    </div>
                </div>
                
                             
                  
                
                
                <!--/Hday-->
                
                  
                <div class="control-group" id="leaveTo">
                  <label class="control-label" >Resign Date</label>
                  <div class="controls">
                    <input type="text"  class="m-wrap span12 small" name="resignDate" id="resignDate"  >
                  </div>
                </div>
               
                

                
                <div class="control-group">
                  <label class="control-label" >Reason For Resign</label>
                  <div class="controls">
                    
                    <textarea name="reason" cols="5" rows="5" class="m-wrap span12" ></textarea>
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
		 
		 
		 
      });
   </script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 

<script>
  $(function() {
    $( "#resignDate" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });



	
  });
  </script>
     <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
