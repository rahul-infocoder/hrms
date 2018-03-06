<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->


<h3 class="page-title"> All Invoice <small>All Invoice</small> </h3>
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
        <h4><i class="icon-globe"></i>All Invoice List</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
      </div>
      <div class="portlet-body">
      
     
     <?php
	   $month = $this->uri->segment(3)?$this->uri->segment(3):'all';
	   $year = $this->uri->segment(4)?$this->uri->segment(4):'all';
	  $limit = $this->uri->segment(5)?$this->uri->segment(5):50;
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
      <option value="" <?php echo ($month=='all')?' selected="selected"':''; ?>>Month</option>
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
      <option value="">Year</option>
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
      <button type="button" class="btn blue" id="filter" ><i class="icon-ok"></i> Filter</button>
      </td>
      </tr>
      </table>
      
      
      
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="msgTable">
          <thead>
            <tr>
              <th style="width:8px;">#</th>
              <th>Invoice Date  </th>
              <th>Due Date</th>
             <th class="hidden-480">Project</th>
             <th>Project Type</th>
              <th>Client Name</th>
             
              
              <th>Tax</th>
              <th class="hidden-480">Discount</th>
              
              <th class="hidden-480">Net Amount</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($InvcData->result() as $row){ ?>
          <tr>
          <td><?php echo $row->invoiceNo; ?></td>
          <td><?php echo date('d-M-Y',$row->invDate); ?></td>
          <td><?php echo date('d-M-Y',$row->dueDate); ?></td>
          <td><?php echo anchor('customers/projectSingle/'.$row->pid,$row->pName); ?></td>
          <td><?php echo $row->proType; ?></td>
          <td><?php echo anchor('customers/clientSingle/'.$row->cid,$row->name); ?></td>
          <td><?php echo round($row->serviceTax+$row->EducationTax+$row->SecondaryTax).' '. $row->currency;?></td>
          <td><?php echo $row->discount.' '. $row->currency; ?></td>
          <td><?php echo $row->total.' '. $row->currency; ?></td>
          <td><?php echo anchor('customers/invoiceDetail/'.$row->Iid,'View') ?></td>
          </tr>
          
          <?php }?>
          
          </tbody>
        </table>
        <div class="pagination"><?php echo (isset($links))?$links:''; ?></div>
        <?php echo $rowInfo; ?>
       <h3>  Total Amount According To Search </h3>
       <table class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
           
      <th>Total</th>
    
      <th>Currency</th>
      
      </tr>
      </thead>
      <tbody>
	  <?php foreach($amountDtails->result() as $rowAmount): ?>
      <tr>
      <td><?php echo $rowAmount->Tamount; ?></td>
      <td><?php echo  $rowAmount->inccur; ?></td>
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
<script type="text/javascript" src="<?php echo base_url();?>js/thickbox.js"></script> 
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			
			var site = '<?php echo site_url('customers/viewInvoice'); ?>';
			$('#filter').click(function(){
			        var month = $('#month').val();
					var year = $('#year').val();
					var limit = $('#row').val();
					var uri ='';
					if(month !='' && year !='')
					{
						uri=month+'/'+year +'/'+limit;
					}
					else if(month !='' && year =='')
					{
						uri=month+'/'+'all' +'/'+limit;
					}
					else if(month =='' && year !='')
					{
						uri='all/'+year +'/'+limit;
					}
					else
					{
						uri='all/'+'all' +'/'+limit;
					}
					
					location.href = site+'/'+uri;
				
				});
				
				


				
		});
	</script> 
    

		
<!-- END JAVASCRIPTS -->


<?php $this->load->view('partial/footer');?>
