<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Inbox Message <small>Inbox Message</small> </h3>
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
    <div class="portlet box blue">
      <div class="portlet-title">
        <h4><i class="icon-globe"></i>Inbox Message</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
      <label class="btn mini  blue"><?php echo date('d-m-Y h:i:s A',$inbox->date); ?></label>
      <!--To-->
     <div style="padding-top:20px;">
     <label class="btn  blue"> From: </label>
   <label class="btn mini blue">  <?php	  echo Messagemodel::FindName($inbox->msg_from);?></label>
	  
	  
	  
      
     </div>
     
         
     <!--End To-->
     
     
     
     
     
     <div style="padding-top:20px;">
     <label class="btn blue"> Subject: </label>
     <label class="btn mini green"> <?php echo  $inbox->subject; ?> </label>
     
     </div>
     
     
     
     <div style="padding-top:20px; display:inline-block">
     <label class="btn  blue"> Message: </label>
     
     
     <?php echo $inbox->msg; ?>
     
     </div>
     <?php if($inbox->attachment != '' || $inbox->attachment !=null ){
		$arr = explode('<@@>',$inbox->attachment);
		 $Isext = array('txt','docx','xlsx','pdf','rar','zip','doc','xls','jpg','jpeg','png','gif','bitmap');
		  ?> 
      <div style="padding-top:20px;">
       <label class="btn  blue"> Attachment: </label>
      <?php
	  for($i=0; $i<count($arr); $i++)
				 {
					 $extention = explode('.',$arr[$i]);
					 $v = count($extention);
					  $extention = $extention[$v-1];
					 $icon ='unknown';
					  for($j =0; $j < count($Isext); $j++)
					 {
						
						 if($Isext[$j] == $extention)
						 {
						$icon = 	 $extention;
						 }
						 
					 }
					 
					 
					 echo '<a href="'.base_url().'upload/msg/'.$arr[$i].'"><img src="'.base_url().'images/icon/'.$icon.'.png" alt="'.$arr[$i].'" width="32" title="'.$arr[$i].'" /></a>';
					 
					 
				 }
	  
	  ?>
      </div>
     
     
     <?php } ?>
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
    
      <script>
function confirmDialog() {
    return confirm("Are you sure you want to delete This Bonus?")
}
</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>