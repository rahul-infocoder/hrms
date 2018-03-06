<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> View Bonus <small>View Bonus</small> </h3>
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
        <h4><i class="icon-globe"></i>View Bonus</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> 
        <a href="<?php echo site_url('admin/addBonus'); ?>"><i class="icon-plus-sign "></i></a>
        
        </div>
      </div>
      <div class="portlet-body">
      <?php echo form_open_multipart('admin/bonusFilter/', array('id'=>'form_certificate', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>
      
      <table>
      <tr>
      <td>Month: </td>
      <td>
      <select id="month" name="month">
      <option value="">Select</option>
      <option value="01">January</option>
      <option value="02">February</option>
      <option value="03">March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
      </select>
      </td>
      <td>Year </td>
      <td>
      
      <select id="year" name="year">
      <option value="">Select</option>
      <?php
	  $start = 2013;
	  $now_y = date('Y');
       for($start=2013; $start<= $now_y; $start++)
	   {
		echo '<option value="'.$start.'">'.$start.'</option>';   
	   }	  


	  ?>
      </select>
      </td>
      <td>
      <button type="submit" class="btn blue" id="submit1" ><i class="icon-ok"></i> Filter</button>
      </td>
      </tr>
      </table>
      </form>
      
      
      <table class="table table-striped table-bordered table-hover" id="msgTable">
     <thead>
      <tr>
      <th>Employee Name</th>
      <th>Bonus Month </th>
      <th>Amount</th>
      <th>Added Date</th>
      <th>Edit</th>
      </tr>
      </thead>
       <tbody>
      <?php foreach($bList->result() as $bdata){ ?>
      <tr>
      <td><?php echo $bdata->contact_name; ?></td>
      <td><?php echo date('M-Y',strtotime($bdata->month.'-1')) ?></td>
      <td><?php echo $bdata->amount; ?></td>
      <td><?php echo date('d-M-Y',$bdata->bonusDate); ?></td>
      <td> <?php echo anchor('admin/delbonus/'.$bdata->bid, '<label class="btn mini red">Delete</label>',array('class'=>'delete', 'onclick'=>"return confirmDialog();"));?></td>
      </tr>
      
      <?php } ?>
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
    
      <script>
function confirmDialog() {
    return confirm("Are you sure you want to delete This Bonus?")
}
</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
