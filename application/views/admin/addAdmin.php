<?php $this->load->view('partial/header');?><style>
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
.list{
	list-style-type:square;
}
.list li {
	font-size:14px;
	font-weight:bold;
	float:left;
	width:30%;
}
.list li ol li{
	font-size:12px;
	font-weight:normal;
	float:none;
	width:100%;
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
            <form action="updateRole" method="POST">		<strong>Select User:</strong>			<select name="role[]" multiple="multiple">			<?php 				foreach($empData as $value)				{ ?>					<option value="<?php echo $value['id']; ?>"><?php echo $value['Name']; ?></option>			<?php	} ?>			</select>					<label class="radio-inline">      <input type="radio" name="roll" value="SA"> SuperAdmin    </label>    <label class="radio-inline">    <input type="radio" name="roll" value="A"> Admin    </label>    <label class="radio-inline">     <input type="radio" name="roll" value="E"> User    </label>								<input type="submit" value="submit" id="sub">	</form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/multiple-select/1.2.0/multiple-select.js"></script> <script src="<?php echo base_url();?>assets/js/jquery-1.8.3.min.js"></script> 
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
			App.init();	
		});</script> 
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
	
	if($('#employeeType').val()=='A')
	{
	$('#companiesss').show(); 
	 if('<?php echo $this->session->userdata('user_type') ?>' != 'SA')
	  {
	
	$("input#companies").attr("disabled", true);
	  }
	
	}
	   
	   
	   $('#employeeType').change(function(){
		
	if($(this).val() == 'A')
	{
        $('#companiesss').show();        
     
	}
	else
	{
		 $('#companiesss').hide(); 
	}
	
	
    
     });
    	
  });
  </script>

<?php $this->load->view('partial/footer');?>
