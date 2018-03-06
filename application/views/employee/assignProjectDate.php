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
              <h4><i class="icon-reorder"></i>Project Details </h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
             
             
             <table class="table">
             <tr>
             <td>Project Name</td><td><?php echo $mpData->pName; ?></td>
             <td>Assign Date</td><td><?php echo date('d-m-Y',$mpData->esdatefrom); ?></td>
             
             </tr>
             
             <tr>
             <td>Dead Line </td><td><?php echo date('d-m-Y',$mpData->deadLine); ?></td>
             <td>Project Url</td><td><?php echo $mpData->pUrl != '' || $mpData->pUrl != null? $mpData->pUrl : 'No Link'; ?></td>
             </tr>
             
             <tr>
             <td>Start Date</td><td><?php echo $mpData->workStart != null? date('d-m-Y',$mpData->workStart):'No Started'; ?></td>
               <td>End Date </td><td><?php echo $mpData->endWork == '0'?'Not Started':date('d-m-Y',$mpData->endWork); ?></td>
             </tr>
             
             
             <tr>
             <td>Admin Comments</td>
             <td colspan="3">
             <?php
			 echo $mpData->remarks; 
			 ?>
             </td>
             </tr>
             
             
             <tr>
             <td>Project Requirement</td>
             <td colspan="3"><?php echo $mpData->pDes; ?></td>
             </tr>
             
             <tr>
             <td>Attachment</td>
             <td colspan="3">
                 <?php
		  $files =Customer::ProDocument($mpData->pid);
		 foreach($files->result() as $row)
          { ?> 
              
             <a href="<?php echo base_url() ?>upload/projectFile/<?php echo $row->file; ?>"><?php echo $row->docName; ?></a>
            
         <?php } ?>
             
             </td>
             </tr>
             
             
             <?php if($mpData->aStatus =='C') { ?>
             <tr>
             
             <td>Your Performance</td>
             <td colspan="3">
             <?php echo $mpData->ePerformance; ?>
             </td>
             </tr>
             <?php } ?>
             </table>
             
             
             
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
