<?php $this->load->view('partial/header');?>

<h3 class="page-title"> Add Users <small>Add</small> </h3>

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

              <h4><i class="icon-reorder"></i>Add Users</h4>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>

            </div>

            <div class="portlet-body form"> 

              <!-- BEGIN FORM-->

            
				<!-- <div class="col-sm-12"> -->
					<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/uploadData">
					  
						<div class="row-fluid">
							<div class="span6">
							   <div class="form-group">
								<label for="exampleFormControlFile1"  class="control-label col-sm-3">Import User Sheet</label>
								<div class="col-sm-9">
								<input type="file" class="form-control-file" id="userfile" name="userfile">
								</div>
							  </div>
							</div>
						</div>
							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-3">
									<button type="submit" class="btn btn-primary">Register</button>
								</div>
							</div>
					</form>
				<!-- </div> -->

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