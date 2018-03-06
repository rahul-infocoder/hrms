<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Projects <small>My Projects</small> </h3>
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
        <h4><i class="icon-globe"></i>Project List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
          <thead>
            <tr>
             
              <th>Project Name</th>
              
              <th class="hidden-480">Assigned Date</th>
              
              <th class="hidden-480">Rejected Reason </th>
              <th class="hidden-480">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($cpData->result() as $plist){ ?>
            <tr>
            
              <td ><?php echo anchor('employees/projectDetail/'.$plist->AssignId, $plist->pName);?></td>
             
              <td class="hidden-480"><?php echo date('d-m-Y',$plist->esdatefrom); ?></td>
              <td class="hidden-480"><?php echo $plist->report; ?></td>
              
              <td class="hidden-480">
              <input type="hidden" id="assignId" value="<?php echo $plist->AssignId; ?>" />
              <label class="btn mini green" id="accept">Accept</label>
              
               </td>
            </tr>
            <?php 
} ?>
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
<!-- END JAVASCRIPTS -->

<script type="application/javascript">

$(document).ready(function(e) {
	
	
    $( "#accept" ).live( "click", function() {
		var AssignId = $(this).parent('td').find('#assignId').val();
		
		//alert(AssignId);
		$('#ActionAssignId').val(AssignId);
		$('#ActionStatus').val('A');
		$('#ActionDailog').show();

      });
	  
		  
	  $('#cancel').click(function(){
		  
		  $('#ActionDailog').hide();
	  });
	  
	   $('#Doaction').click(function(){
		  var comment = $('#comment').val();
		  $curent = $(this);
		  if(comment != '')
		  {
			  var AssId = $('#ActionAssignId').val();
			  var AssStatus = $('#ActionStatus').val();
			  //alert(AssId + 'Status'+ AssStatus );
			  
			   $.ajax({
				 type: "POST",
				 url: '<?php echo base_url();?><?php echo index_page();?>'+"/employees/projectAcceptReject", 
				 data: {AssignId: AssId, AssignStatus:AssStatus,AssignComment:comment},
				 dataType: "text",  
				 cache:false,
				 beforeSend: function() {
				   	$curent.after('<img src="<?php echo base_url('images/loader.gif');?>" alt"" />');
				 },
				 success: 
					  function(data){
						location.reload(); 
					  }
		
			 
		 });
		  
		  
		  }
		  else
		  {
			  alert('Enter Comment');
		  }
		  
	  });
	
	
});
</script>
<!--Accept/Reject System-->

<div id="ActionDailog" style="width:100%; display:none; height:100%; position:fixed; background-color:rgba(0,0,0,0.4); left:0; top:0; z-index:9999999; overflow:hidden;">

<div style="width:300px; background-color:#fff; height:200px; border:1px solid #eee; position:absolute; left:50%; top:50%; margin-left:-150px; margin-top:-100px;">
<div style="padding:15px;">
<table>
<tr>

<td colspan="2">
<label>Any Comment:</label><br/>
<textarea id="comment" name="comment" class="m-wrap span3"></textarea>
<input id="ActionAssignId" value="" type="hidden"/>
<input id="ActionStatus" value="" type="hidden"/>

</td>
</tr>

<tr>

<td>
<label class="btn mini blue" id="Doaction">Accept</label>
</td>
<td>
 <label class="btn mini red" id="cancel">Cancel</label>
</td>
</tr>

</table>
</div>

</div>


</div>

<!--/-->

<?php $this->load->view('partial/footer');?>
