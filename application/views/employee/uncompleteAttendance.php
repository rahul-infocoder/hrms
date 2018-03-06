<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<style type="text/css">
label.error{
	display:none !important
}
.error{
	border:1px solid red !important;
}
</style>

<h3 class="page-title">Uncomplete Attendance <small>Uncomplete Attendance </small> </h3>
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
    <div class="portlet box light-grey">
      <div class="portlet-title">
        <h4><i class="icon-globe"></i>Uncomplete Attendance List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="example">
          <thead>
            <tr>
             
              <th>Login Date</th>
              <th class="hidden-480">Sign In Time</th>
              <th class="hidden-480">Action</th>
             
            </tr>
          </thead>
          <tbody>
          <?php if(isset($upCompleteAtt)) {?>
            <?php foreach($upCompleteAtt->result() as $clist){ ?>
            <tr >
              
              <td ><?php echo date('d-M-Y', $clist->logindate);?></td>
              <td class="hidden-480"><?php echo date('d-M-Y h:i:s A', $clist->signintime);?></td>
              
              <td class="hidden-480">
			  
			  <input type="hidden" id="attendanceId" name="attendanceId" value="<?php echo $clist->id; ?>"  />
              <input type="hidden" id="attendanceDate" name="attendanceDate" value="<?php echo $clist->logindate; ?>"  />
              
			  <?php //echo anchor('employees/saveUncompleteQuery/'.$clist->logindate,'Complete It'); ?>
              
              <label class="btn mini green" id="complete">Complete</label>
              </td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/thickbox.js"></script> 
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>


		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			$('#complete').live('click',function(){
				
				var id =$(this).parent().find('#attendanceId').val();
				var dateVa =$(this).parent().find('#attendanceDate').val();
				$('#attendanceIdS').val(id);
				$('#attendanceDateS').val(dateVa);
				$('#ActionDailog').show();
				
				});
				
		$('#cancel').click(function(){
		  
		  $('#ActionDailog').hide();
	      });
			
		});
		
		
	</script> 
    
    
    
    <!--Accept/Reject System-->

<div id="ActionDailog" style="width:100%; display:none; height:100%; position:fixed; background-color:rgba(0,0,0,0.4); left:0; top:0; z-index:9999999; overflow:hidden;">

<div style="width:300px; background-color:#fff; height:140px; border:1px solid #eee; position:absolute; left:50%; top:50%; margin-left:-150px; margin-top:-70px;">
<div style="padding:15px;">
<form method="post" name="" action="<?php echo site_url('employees/saveUncompleteQuery'); ?>" id="completeFormSign">
<input type="hidden" id="attendanceIdS" name="attendanceIdS"  />
<input type="hidden" id="attendanceDateS" name="attendanceDateS"  />
<table>
<tr>

<td colspan="2">
<label>Time: </label>
<select id="hour" name="hour" class="required" style="width:60px">
<option value="">H</option>
<?php for($i=1; $i<=12; $i++) {?>
<option value="<?php echo $i; ?>"><?php echo $i ?></option>
<?php } ?>
</select>

<select id="min" name="min" class="required" style="width:60px">
<option value="">M</option>
<?php for($i=0; $i<=60; $i++) {?>

<option value="<?php echo $i; ?>"><?php echo $i ?></option>
<?php } ?>
</select>

<select id="ap" name="ap" class="required" style="width:60px">
<option value="">AM/PM</option>
<option value="AM">AM</option>
<option value="PM">PM</option>
</select>





</td>
</tr>

<tr>

<td>
<button type="submit" class="btn blue"><i class="icon-ok"></i> Send</button>
                  
</td>
<td>
<button type="reset" class="btn" id="cancel">Cancel</button>
</td>
</tr>

</table>
</form>
</div>

</div>


</div>

<!--/-->
<!-- END JAVASCRIPTS -->

<script>
$("#completeFormSign").validate();
</script>

<?php $this->load->view('partial/footer');?>
