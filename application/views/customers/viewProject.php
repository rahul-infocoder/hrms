<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> All Project <small>All Project</small> </h3>
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
        <h4><i class="icon-globe"></i>All Project List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a>
        <a href="<?php echo site_url('customers/addProject'); ?>"><i class="icon-plus-sign "></i></a>
         </div>
      </div>
      <div class="portlet-body">
      
  <?php
	   $month = $this->uri->segment(5)?$this->uri->segment(5):'all';
	   $year = $this->uri->segment(6)?$this->uri->segment(6):'all';
	   $status = $this->uri->segment(7)?$this->uri->segment(7):'all';
	   $limit= $this->uri->segment(3)?$this->uri->segment(3):50;
	   $page = $this->uri->segment(4)?$this->uri->segment(4):0;
	   
	  
	   ?>
      <table class="table table-striped table-bordered table-hover" >
      <tr>
      <td>
       <select id="row" style="width:80px">
      <option value="all">Row</option>   
      <option value="50" <?php echo ($limit==50)?' selected="selected"':''; ?>>50</option>
      <option value="100" <?php echo ($limit==100)?' selected="selected"':''; ?>>100</option>
      <option value="200" <?php echo ($limit==200)?' selected="selected"':''; ?>>200</option>
      <option value="500" <?php echo ($limit==500)?' selected="selected"':''; ?>>500</option>
      <option value="all" <?php echo ($limit=='all')?' selected="selected"':''; ?>>All</option>
      </select>
      </td>
      <td>
      <select id="month" name="month">
      <option value="all" <?php echo ($month=='all')?' selected="selected"':''; ?>>Month</option>
      <option value="01" <?php echo ($month==1)?' selected="selected"':''; ?> >January</option>
      <option value="02" <?php echo ($month==2)?' selected="selected"':''; ?>>February</option>
      <option value="03" <?php echo ($month==3)?' selected="selected"':''; ?>>March</option>
      <option value="04" <?php echo ($month==4)?' selected="selected"':''; ?>>April</option>
      <option value="05" <?php echo ($month==5)?' selected="selected"':''; ?>>May</option>
      <option value="06" <?php echo ($month==6)?' selected="selected"':''; ?>>June</option>
      <option value="07" <?php echo ($month==7)?' selected="selected"':''; ?>>July</option>
      <option value="08" <?php echo ($month==8)?' selected="selected"':''; ?>>August</option>
      <option value="09" <?php echo ($month==9)?' selected="selected"':''; ?>>September</option>
      <option value="10" <?php echo ($month==10)?' selected="selected"':''; ?>>October</option>
      <option value="11" <?php echo ($month==11)?' selected="selected"':''; ?>>November</option>
      <option value="12" <?php echo ($month==12)?' selected="selected"':''; ?>>December</option>
      </select>
      </td>
      
      <td>
      
      <select id="year" name="year">
      <option value="all">Year</option>
      <?php
	  
	  $now_y = date('Y');
       for($start=2000; $start<= $now_y; $start++)
	   {
		  $selected = ($start==$year)?' selected="selected"':''; 
		echo '<option value="'.$start.'"'.$selected .'>'.$start.'</option>';   
	   }	  


	  ?>
      </select>
      </td>
    <td>
    <select name="status" id="status">
      <option value="all" <?php echo ($status=='all')?' selected="selected"':''; ?>>Status</option>
      <option value="R" <?php echo ($status=='R')?' selected="selected"':''; ?>>Running</option>
      <option value="C" <?php echo ($status=='C')?' selected="selected"':''; ?>>Complete</option>
       <option value="H" <?php echo ($status=='H')?' selected="selected"':''; ?>>Hold</option>
      </select>
    </td>
      <td>
      <button type="button" class="btn blue" id="filter" ><i class="icon-ok"></i> Filter</button>
      </td>
      </tr>
      </table>
   
     
        <table class="table table-striped table-bordered table-hover" id="msgTable">
          <thead>
            <tr>
            
             <th>Project Name</th>
              <th>Client Name</th>
              
              <th class="hidden-480">Project Type</th>
              <th>Added Date</th>
           <!--   <th class="hidden-480">Start Date</th>
             
              <th class="hidden-480">End Date</th>-->
               <th class="hidden-480">Price</th>
               <th class="hidden-480">Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($cData->result() as $row){ ?>
            <tr >
               <td class="hidden-480">
               
               <?php echo anchor('customers/projectSingle/'.$row->pid,$row->pName); ?>
               </td>
              <td >
              <?php echo anchor('customers/clientSingle/'.$row->cid, $row->name); ?>
              </td>
             
              <td class="hidden-480">
			  
			  <?php echo $row->proType; ?>
              
              </td>
              <td><?php echo date('d-M-Y',$row->AddDate); ?></td>
              
             <!-- <td class="hidden-480">
              <?php
			//  echo Customer::ProjectStartDate($row->pid);
			   ?>
              
              </td>
              
              <td class="hidden-480">
              <?php //echo Customer::ProjectCompleteDate($row->pid);		 ?>
              
              </td>-->
              <td class="hidden-480"><?php echo $row->price .' '.$row->currency; ?> </td>
              <td class="hidden-480" id="Pstatus" style="position:relative !important; cursor:pointer;">
              <?php echo Customer::proStatus($row->pid); ?>
                <?php $ProSttt = Customer::getprojectStatus($row->pid); ?>
              <table class="table table-striped table-bordered table-hover" style="width:200px !important; display:none; position:absolute; right:100%; top:2%; margin-right:100%; z-index:999; font-size:10px;">
              <thead>
              <tr>
              <th>Start Date</th>
              <th>Complete Date</th>
              </tr>
              </thead>
              
              <tbody>
              <?php foreach($ProSttt->result() as $row2): ?>
              <tr>
              
              <td><?php echo date('d-M-Y',$row2->startDate); ?></td>
              <td><?php echo ($row2->endDate !=0)?date('d-M-Y',$row2->endDate):'?'; ?></td>
              </tr>
              <?php endforeach; ?>
              </tbody>
              </table>
              
              </td>
             <td>
             <input type="hidden" id="pidL" name="pidL" value="<?php echo $row->pid; ?>"  />
            
			<?php
             if(Customer::findProjectStatus($row->pid))
			 {
			   echo '<label id="statusAction" class="btn mini green">Complete It</label><input type="hidden" id="psstus" name="psstus" value="C" />';	 
			 }
			 else
			 {
			   echo '<label id="statusAction" class="btn mini green">Start It</label><input type="hidden" id="psstus" name="psstus" value="S" />';	 
			 }
			 ?>
			 <?php echo anchor('customers/addProject/'.$row->pid,'<label class="btn mini yellow">Edit</label>'); ?></td>
              
            </tr>
            <?php 
} ?>
          </tbody>
        </table>
        <div class="pagination"><?php echo (isset($links))?$links:''; ?></div>
        <?php echo $rowInfo ?>
        <h3>  Total Amount According To Search </h3>
       <table class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
           
      <th>Total</th>
    
      <th>Currency</th>
      
      </tr>
      </thead>
      <tbody>
	  <?php foreach($tData->result() as $rowAmount): ?>
      <tr>
      <td><?php echo $rowAmount->tTotal; ?></td>
      <td><?php echo  $rowAmount->CCCurrency; ?></td>
      </tr>
	  <?php endforeach; ?>
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
			
			
			var site = '<?php echo site_url('customers/viewProject'); ?>';
			
			$('#filter').click(function(){
			        var month = $('#month').val();
					var year = $('#year').val();
					var limit = $('#row').val();
					var status = $('#status').val();
					var uri =limit +'/0/'+ month+'/'+year+'/'+status;
					location.href = site+'/'+uri;
				
				});
				
				
				
				$('#statusAction').live('click',function(){
				
				var id =$(this).parent().find('#pidL').val();
				var pStatus =$(this).parent().find('#psstus').val();
				
				
				   $('#pid').val(id);
				   $('#pstatus').val(pStatus);
				   $('#ActionDailog').show();
				
				});
				
	     	$('#cancel').click(function(){
		  
		          $('#ActionDailog').hide();
	         });
			 $('#Pstatus').live('mouseover',function(){
				 
				$(this).find('table').fadeIn(200);
				 
				 });
				 
				$('#Pstatus').live('mouseout',function(){
				 
				 $(this).find('table').fadeOut(200);
				 
				 }); 
			 
		});
		
		
	</script> 
   
   
       <!--Accept/Reject System-->

<div id="ActionDailog" style="width:100%; display:none; height:100%; position:fixed; background-color:rgba(0,0,0,0.4); left:0; top:0; z-index:9999999; overflow:hidden;">

<div style="width:300px; background-color:#fff; height:140px; border:1px solid #eee; position:absolute; left:50%; top:50%; margin-left:-150px; margin-top:-70px;">
<div style="padding:15px;">
<form method="post" name="" action="<?php echo site_url('customers/projectStatus'); ?>" id="completeFormSign">
<input type="hidden" id="pstatus" name="pstatus"  />
<input type="hidden" id="pid" name="pid"  />
<table>
<tr>

<td colspan="2">
<label>Select Date(d/m/Y): </label>
<select id="day" name="day" class="required" style="width:70px">
<option value="">Day</option>
<?php for($i=1; $i<=31; $i++) {?>
<?php $selectedC = ($i==date('d'))?' selected="selected"':''; ?>
<option value="<?php echo $i; ?>" <?php echo $selectedC; ?>><?php echo $i ?></option>
<?php } ?>
</select>

<select id="month" name="month" class="required" style="width:80px">
<option value="">Month</option>
<?php for($i=1; $i<=12; $i++) {?>
<?php $selectedC = ($i==date('m'))?' selected="selected"':''; ?>
<option value="<?php echo $i; ?>" <?php echo $selectedC; ?>><?php echo $i ?></option>
<?php } ?>
</select>

<select id="year" name="year" class="required" style="width:80px">
<option value="">Year</option>

<?php for($i=2000; $i<=date('Y'); $i++) {?>
<?php $selectedC = ($i==date('Y'))?' selected="selected"':''; ?>
<option value="<?php echo $i; ?>" <?php echo $selectedC; ?>><?php echo $i ?></option>
<?php } ?>
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
<!-- END JAVASCRIPTS -->
<script>
$("#completeFormSign").validate();
</script>
<?php  $this->load->view('partial/footer');?>