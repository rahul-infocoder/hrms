<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Work Report <small>My Work</small> </h3>
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
        <h4><i class="icon-globe"></i>Employees Work Report</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
      <?php
	  $day = $this->uri->segment(3)?$this->uri->segment(3):'all';
	  $month = $this->uri->segment(4)?$this->uri->segment(4):'all';
	  $year = $this->uri->segment(5)?$this->uri->segment(5):'all';	    
	  $limit = $this->uri->segment(6)?$this->uri->segment(6):50;
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
      <select name="day" id="day" style="width:80px;">
      <option value="all">Day</option>
      <?php
	  
	
       for($i=1; $i<=31; $i++)
	   {
		  $selected = ($i==$day)?' selected="selected"':''; 
		echo '<option value="'.$i.'"'.$selected .'>'.$i.'</option>';   
	   }	  


	  ?>
      
      </select>
      </td>
      <td><select id="month" name="month" style="width:120px;">
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
      
      <select id="year" name="year" style="width:100px;">
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
      <button type="button" class="btn blue" id="filter" ><i class="icon-ok"></i> Filter</button>
      </td>
      </tr>
      </table>
      
      
      
        <table class="table table-striped table-bordered table-hover" id="msgTable">
          <thead>
            <tr>
    
              <th>Employee Name</th>
              <th>Date</th>
              <th class="hidden-480">Work Report</th>
              <th class="hidden-480">Attachments</th>
              <th>Action</th>
              <th>Comments</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($wData->result() as $wlist){ ?>
            <tr class="odd gradeX">
      
              <td><?php echo anchor('admin/viewEmployeeRead/'.$wlist->eid,$wlist->contact_name); ?></td>
              <td class="hidden-480"><?php echo date('d/m/Y', $wlist->reportdate);?></td>
              <td class="hidden-480"><?php 
			  
			
			  
			  echo strip_tags(substr($wlist->report,0,200)); 
			  
			
				  $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo anchor_popup('admin/reporPopup/'.$wlist->Wid, ' <i class="icon-circle-arrow-right"></i>', $atts);
				  
			 
			  
			  
			  ?></td>
              <td>
              <?php
			  $Isext = array('txt','docx','xlsx','pdf','rar','zip','doc','xls');
				 $arr = explode('/',$wlist->files);
				
				 if($wlist->files !='')
				 {
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
					  echo '<a href="'.base_url().'upload/report/'.$arr[$i].'"><img src="'.base_url().'images/icon/'.$icon.'.png" alt="'.$arr[$i].'" width="32" title="'.$arr[$i].'" /></a>';
					 
				 }
				 }
				 else 
				 {
				echo "No Attachment";	 
				 }
			  ?>
              
              </td>
              <td>
              <input type="hidden" id="reportmultiId" value="<?php  echo $wlist->Wid;?>" />
              <label  id="ReportComment" class="btn mini green">Comment</label>
              </td>
              <td>
              <?php echo User::countreportComment($wlist->Wid); ?>
              </td>
              
            </tr>
            <?php 
} ?>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			
			$("#formComment").validate();
			var site = '<?php echo site_url('admin/viewMyReport'); ?>';

			$('#filter').click(function(){
				    
					var day = $('#day').val();
			        var month = $('#month').val();
					var year = $('#year').val();
					
					var row = $('#row').val();
					var uri =day+'/'+month+'/'+year+'/'+row;
					
					
					location.href = site+'/'+uri;
				
				});
				
				
	 $( "#ReportComment" ).live( "click", function() {
		var rpId = $(this).parent('td').find('#reportmultiId').val();
		
		$('#reportId').val(rpId);
		$('#ActionDailog').show();

      });
	 $('#cancel').click(function(){
		  
		  $('#ActionDailog').hide();
	  });
				
		});
	</script> 
<!-- END JAVASCRIPTS -->

<!--Accept/Reject System-->

<div id="ActionDailog" style="width:100%; display:none; height:100%; position:fixed; background-color:rgba(0,0,0,0.4); left:0; top:0; z-index:9999999; overflow:hidden;">

<div style="width:300px; background-color:#fff; height:200px; border:1px solid #eee; position:absolute; left:50%; top:50%; margin-left:-150px; margin-top:-100px;">
<div style="padding:15px;">

 <?php echo form_open('workreportcomment/saveWorkComment/',array('id'=>'formComment', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
<table>
<tr>

<td colspan="2">
<label>Work Report Comment :</label><br/>
<textarea id="reportComment" name="reportComment" class="m-wrap span3 required"></textarea>
<input id="reportId" name="reportId" value="" type="hidden"/>
<input name="redirectTourl" type="hidden" value="<?php echo current_url() ?>" />

</td>
</tr>

<tr>

<td>

  <input type="submit" name="workcommSent" class="btn blue" value="Save" />              
</td>
<td>

   <button type="button" class="btn" id="cancel">Cancel</button>
</td>
</tr>

</table>
</form>
</div>

</div>


</div>

<!--/-->
<?php $this->load->view('partial/footer');?>
