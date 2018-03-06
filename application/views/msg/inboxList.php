<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<style type="text/css">
.Inboxheader{
	background-color:#ccc;
	
	}
	
	.unread{
		background-color:#fafafa;
		}
		.read
		{
			background-color:#eee;
			
		}

</style>
<h3 class="page-title">  In Box<small>View In Box</small> </h3>
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
        <h4><i class="icon-globe"></i>In Box</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
     <table class="table table-striped table-bordered table-hover">
      <tr>
      <td><a href="javascript:void()" id="delete_msg"><label class="btn mini red" title="Delete">Delete</label></a></td>
      <td><?php  $rowSelect = ($this->uri->segment(3))?$this->uri->segment(3):''; ?>
      <select id="rowSelect" style="width:80px">
     <option value="10" <?php if($rowSelect =='' || $rowSelect=='0'){ echo 'selected="selected"';} ?>>Row</option
      
        ><option value="20" <?php if($rowSelect =='20'){ echo 'selected="selected"';} ?>>20</option>       
           <option value="50" <?php if($rowSelect =='50'){ echo 'selected="selected"';} ?>>50</option>
           <option value="100" <?php if($rowSelect =='100'){ echo 'selected="selected"';} ?>>100</option>
           <option value="All" <?php if($rowSelect =='All'){ echo 'selected="selected"';} ?>>All</option>
      </select> </td>
      <td>
      <?php $daySelect = ($this->uri->segment(4))?$this->uri->segment(4):'new'; ?>
      <select name="day" id="day" style="width:80px;">
      <option value="new" <?php echo ($daySelect =='new')?' selected="selected"':''; ?>>Day</option>
       <?php
	  
	
       for($start=1; $start<= 31; $start++)
	   {
		   if($daySelect == $start)
		   {
			$select = ' selected="selected"';   
		   }
		   else
		   {
			   $select ='';
			   
			  }
		echo '<option value="'.$start.'"'. $select .'>'.$start.'</option>';   
	   }	  


	  ?>
      </select>
      </td>
    
      <td>
      <?php $monthSelect = ($this->uri->segment(5))?$this->uri->segment(5):'new'; ?>
      <select id="month" name="month" style="width:100px;">
      <option value="new" <?php echo ($monthSelect =='new')?' selected="selected"':''; ?>>Month</option>
      <option value="01" <?php echo ($monthSelect =='01')?' selected="selected"':''; ?>>January</option>
      <option value="02" <?php echo ($monthSelect =='02')?' selected="selected"':''; ?>>February</option>
      <option value="03" <?php echo ($monthSelect =='03')?' selected="selected"':''; ?>>March</option>
      <option value="04" <?php echo ($monthSelect =='04')?' selected="selected"':''; ?>>April</option>
      <option value="05" <?php echo ($monthSelect =='05')?' selected="selected"':''; ?>>May</option>
      <option value="06" <?php echo ($monthSelect =='06')?' selected="selected"':''; ?>>June</option>
      <option value="07" <?php echo ($monthSelect =='07')?' selected="selected"':''; ?>>July</option>
      <option value="08" <?php echo ($monthSelect =='08')?' selected="selected"':''; ?>>August</option>
      <option value="09" <?php echo ($monthSelect =='09')?' selected="selected"':''; ?>>September</option>
      <option value="10" <?php echo ($monthSelect =='10')?' selected="selected"':''; ?>>October</option>
      <option value="11" <?php echo ($monthSelect =='11')?' selected="selected"':''; ?>>November</option>
      <option value="12" <?php echo ($monthSelect =='12')?' selected="selected"':''; ?>>December</option>
      </select>
      </td>
      
      <td>
      <?php $yearSelect = ($this->uri->segment(6))?$this->uri->segment(6):'new'; ?>
      <select id="year" name="year" style="width:80px">
      <option value="new" <?php echo ($yearSelect =='new')?' selected="selected"':''; ?>>Year</option>
      <?php
	  
	  $now_y = date('Y');
       for($start=2013; $start<= $now_y; $start++)
	   {
		 if($yearSelect == $start)
		   {
			$select = ' selected="selected"';   
		   }
		   else
		   {
			   $select ='';
			   
			  }
		echo '<option value="'.$start.'"'.$select.' >'.$start.'</option>';   
	   }	  


	  ?>
      </select>
      </td>
      <td>
      <button type="button" class="btn blue" id="submit1" ><i class="icon-ok"></i> Filter</button>
      </td>
      </tr>
      </table>
      
  
     <table class="table table-striped table-bordered table-hover" id="msgTable">
      <thead>
      <tr >
      <th><input type="checkbox" id="checkTop" class="group-checkable" style="opacity: 0;">
      
      </th>
      <th>Date Time</th>
      <th>From</th>
      <th>Subject</th>
      <th>Message</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($inboxList->result() as $sdata){ ?>
      <?php
	  if($sdata->status =='R')
	  {
	   $class = 'read';	  
	  }
	  else
	  {
		  $class = 'unread';
		 }
	  ?>
      
      <tr  class="<?php echo $class; ?>">
      <td>
     
      <input type="hidden" id="msg_id" value="<?php echo $sdata->inId; ?>" />
      <input type="checkbox"  name="check[]" class="group" id="checkbox" />
      
      </td>
      <td onclick="location.href='<?php echo site_url("message/ViewInbox/".$sdata->inId) ?>'">
      <?php echo date('d-m-Y h:i:s A',$sdata->date); ?>
      </td>
      <td onclick="location.href='<?php echo site_url("message/ViewInbox/".$sdata->inId) ?>'">
       <?php	  echo Messagemodel::FindName($sdata->msg_from);?>
      </td>
      <td onclick="location.href='<?php echo site_url("message/ViewInbox/".$sdata->inId) ?>'">
      <?php echo $sdata->subject; ?>
      </td>
      <td onclick="location.href='<?php echo site_url("message/ViewInbox/".$sdata->inId) ?>'" >
      <div style="word-break:break-all !important;">
      <?php  echo strip_tags(substr($sdata->msg,0,200));  ?>
      
      </div>
     
     
     <?php if($sdata->attachment != '' || $sdata->attachment != null) {
		 
	echo '<img src="'.base_url().'images/icons/icon_attachment.gif'.'" alt="attach" />';	 
	 }
		 ?>
      </td>
      <td>
      <a href="<?php echo site_url() ?>/message/ViewInbox/<?php echo $sdata->inId; ?>" >View</a>
       
      </td>
      
      </tr>
      
      <?php } ?>
      </tbody>
      </table>
      
      <div class="pagination"><?php echo (isset($links))?$links:''; ?></div>
        <?php echo $rowInfo; ?>
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
			$('#rowSelect').change(function(){
				$row =$(this).val();
			location.href='<?php echo site_url("message/inbox") ?>'+'/'+$row+'/'+$('#day').val()+'/'+$('#month').val()+'/'+$('#year').val();
		
				});
				
				$('#submit1').click(function(){
					location.href='<?php echo site_url("message/inbox") ?>'+'/'+$('#rowSelect').val()+'/'+$('#day').val()+'/'+$('#month').val()+'/'+$('#year').val();
					
					//alert('sd');
					});
			
			
		});
	</script> 
    
      <script>
function confirmDialog() {
    return confirm("Are you sure you want to delete This Bonus?")
}


$('#checkTop').click(function(e){
	if($(this).is(':checked')){
            $('.group').attr("checked",true);
        }
        else{
            $('.group').attr("checked",false);
        }
$.uniform.update();
	});
	
	$('#delete_msg').click(function(){
		$ids ='';
		$('.group').each(function(index, element) {
            
			
			if($(this).is(':checked')){
			
			$msg_id = $(this).parent().parent().parent().find('#msg_id').val();
			//alert($msg_id);
			$ids += $msg_id +',';
			}
			
        });
		
	//	alert($ids)
	
	
	if($ids !='')
	{
		
		$.ajax({
				 type: "POST",
				 url: '<?php echo site_url('message/msg_delete');?>', 
				 data: {id: $ids},
				 dataType: "text",  
				 cache:false,
				 success: 
					  function(data){
						location.reload(); 
						//alert(data);
					  }
		
			 
		 });
	}
	
		
		});
	

</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>