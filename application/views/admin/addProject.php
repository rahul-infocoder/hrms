<?php $this->load->view('partial/header');?>

<h3 class="page-title"> Add Project <small>Add</small> </h3>

<?php $this->load->view('partial/breadcrumb');?>


</div>

</div>

<!-- END PAGE HEADER--> 

<!-- BEGIN PAGE CONTENT-->


    <div class="tabbable tabbable-custom boxless">

      <div class="tab-content">

        <div class="tab-pane active" id="tab_1">

          <div class="portlet box blue">

            <div class="portlet-title">

              <h4><i class="icon-reorder"></i>Add Project</h4>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>

            </div>

            <div class="portlet-body form"> 
               <div class="error">
			     <?php
				     if($this->session->flashdata('succ_msg')){
						 echo $this->session->flashdata('succ_msg');
					 }
				 ?>
			   </div>
              <!-- BEGIN FORM-->

            
				<!-- <div class="col-sm-12"> -->
					<form name="proAdmin" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/insert_project" onsubmit="return validateForm()">
					  
					 <!--  <h3 style="text-align:center;"> OR </h3> -->
					  <p style="font-weight:bold;">ADD PROJECT </p>
					  <!--  <div class="form-group">
					   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Task List</label>
						<div class="col-sm-9">
						<select class="custom-select">
						  <option selected>Open this select menu</option>
						  <option value="1">One</option>
						  <option value="2">Two</option>
						  <option value="3">Three</option>
						</select>
					   </div>
					   </div> -->
					   <div class="row-fluid">
						<div class="span6">
					    <div class="form-group">
					   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Title</label>
						<div class="col-sm-9">
						 <input type="text" class="form-control" id="inputText" name="title">
					   </div>
					   </div>
					   </div>
					   <div class="span6">
					    <div class="form-group">
					   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Description</label>
						<div class="col-sm-9">
						 <textarea class="form-control" rows="5" id="des" name="des"></textarea>
					   </div>
					   </div>
					   </div>
					   </div>
					   <!--  <div class="form-group">
					   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Assigned To</label>
						<div class="col-sm-9">
						<select class="custom-select">
						  <option selected>Unassigned</option>
						  <option value="1">One</option>
						  <option value="2">Two</option>
						  <option value="3">Three</option>
						</select>
					   </div>
					   </div> -->
					    <div class="row-fluid">
							<div class="span6">
								<div class="form-group">
							   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Priority</label>
								<div class="col-sm-9">
								<select class="custom-select" name="priority">
								  <option selected>None</option>
								  <option value="1">One</option>
								  <option value="2">Two</option>
								  <option value="3">Three</option>
								</select>
							   </div>
							   </div>
							</div>
							<div class="span6">
								<div class="form-group">
							   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Due Date</label>
								<div class="col-sm-9" id="sandbox-container">
								 <input type="text" required name="dueDate" class="form-control">
							   </div>
							   </div>
							</div>
						</div>
						<div class="row-fluid">
							<!-- <div class="span6">
								<div class="form-group">
							   <label for="exampleFormControlFile1"  class="control-label col-sm-3">Notify</label>
								<div class="col-sm-9">
								<select class="custom-select">
								  <option selected>Choose Users</option>
								  <option value="1">One</option>
								  <option value="2">Two</option>
								  <option value="3">Three</option>
								</select>
							   </div>
							   </div>
							</div> -->
							<div class="span6">
							   <div class="form-group">
								<label for="exampleFormControlFile1"  class="control-label col-sm-3">Import Project Sheet</label>
								<div class="col-sm-9">
								<input type="file" class="form-control-file" id="userfile" name="userfile[]" multiple>
								</div>
							  </div>
							</div>
						</div>
							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-3">
									<button type="submit" class="btn btn-primary btn-block">Register</button>
								</div>
							</div>
					</form>
				<!-- </div> -->

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"/></script>
<script>
$('#sandbox-container input').datepicker({
    autoclose: true,
	startDate: "current"
});

$('#sandbox-container input').on('show', function(e){
    console.debug('show', e.date, $(this).data('stickyDate'));
    
    if ( e.date ) {
         $(this).data('stickyDate', e.date);
    }
    else {
         $(this).data('stickyDate', null);
    }
});

$('#sandbox-container input').on('hide', function(e){
    console.debug('hide', e.date, $(this).data('stickyDate'));
    var stickyDate = $(this).data('stickyDate');
    
    if ( !e.date && stickyDate ) {
        console.debug('restore stickyDate', stickyDate);
        $(this).datepicker('setDate', stickyDate);
        $(this).data('stickyDate', null);
    }
});
function validateForm() {
    var x = document.forms["proAdmin"]["title"].value;
    var y = document.forms["proAdmin"]["des"].value;
    var z = document.forms["proAdmin"]["priority"].value;
    var due = document.forms["proAdmin"]["dueDate"].value;
    if (x == "" || y == "" || z == "" || due == "") {
        alert("All Fields must be filled out");
		return false;
    }
}
</script>
<?php $this->load->view('partial/footer');?>
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
<script type="text/javascript" src="<?php echo base_url();?>js/thickbox.js"></script> 
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
		jQuery(document).ready(function() {	

			// initiate layout and plugins
			App.setPage("table_managed");			
			App.init();			
		});
		</script>