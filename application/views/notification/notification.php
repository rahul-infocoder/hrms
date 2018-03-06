<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<style type="text/css">
.delete{
	position:absolute;
	top:50%;
	margin-top:-8px;
	right:20px;
	display:block;
	cursor:pointer;
}
.delete:hover{
	opacity:0.8;
}
.noteList{
	list-style:none;
	margin:0 !important;
}
.time{
	color:#008040;	
}
.noteList.extended.notification a {
  text-decoration: none;
    color: #000000;
  font-size: 12px;
  text-decoration: none;
}
.noteList.extended.notification > li {
  padding-top:10px;
  padding-bottom:10px;
  width:auto !important;
  border-bottom:1px solid #eee;

}
.noteList.extended.notification > li:hover{
	background-color:#fafafa;
}

</style>
<h3 class="page-title"> Notification <small>Notification</small> </h3>
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
        <h4><i class="icon-globe"></i>Notification</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
      
       <?php 

	  $limit = $this->uri->segment(3)?$this->uri->segment(3):50;
	  
	   ?>
      <table class="table table-striped table-bordered table-hover" >
      <tr>
       <td>
       <select id="row" style="width:80px">
      <option value="all">Row</option>  
       <option value="10" <?php echo ($limit==10)?' selected="selected"':''; ?>>10</option> 
      <option value="50" <?php echo ($limit==50)?' selected="selected"':''; ?>>50</option>
      <option value="100" <?php echo ($limit==100)?' selected="selected"':''; ?>>100</option>
      <option value="200" <?php echo ($limit==200)?' selected="selected"':''; ?>>200</option>
      <option value="500" <?php echo ($limit==500)?' selected="selected"':''; ?>>500</option>
      <option value="all" <?php echo ($limit=='all')?' selected="selected"':''; ?>>All</option>
      </select>
      </td>
      </tr>
      </table>
    
   <div style="height:auto; clear:both; position:static;">
    
      <ul class="noteList extended notification" style="display:block; position:static; width:100% !important; max-width:100% !important;">
      <?php foreach($noteList->result() as $row){ ?>
     <?php
			if($row->link != '' || $row->link != null)
			{
			  $noteLink = site_url().'/'.$row->link;	
			}
			else
			{
			 $noteLink = 'javascript:void()';	
			}
			
			?>
            <li style="position:relative;"> <a href="<?php echo $noteLink; ?>" > 
            <span class="label label-success"><i class="icon-bell"></i></span> 
			<?php echo $row->msg; ?> <span class="time"><?php echo time_elapsed_string($row->date); ?></span>
            
             </a>
             <span class="delete" id="note_delete">
             <input type="hidden" value="<?php echo $row->id ?>" name="noteId" id="noteId" />
             <img src="<?php echo  base_url('images/icon/delete.png'); ?>" alt=""/>
             </span>
              </li>
            
      <?php } ?>
</ul>
</div>

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
			var site = '<?php echo site_url('notification/noteList'); ?>';
			$('#row').change(function(){
			       
					var row = $('#row').val();
					var uri =row;
					
					
					location.href = site+'/'+uri;
				
				});
		});
	</script> 
    
      <script>
	  $(document).ready(function(e) {
		  
	 $('#pagination a').each(function(index, element) {
        $txt = $(this).text();
		 $include = '<label class="btn mini blue">'+$txt+'</label>';
		 $(this).html($include);
		 //alert($include);
    });
	
	 $('#pagination strong').each(function(index, element) {
        $txt = $(this).text();
		 $include = '<label class="btn mini red">'+$txt+'</label>';
		 $(this).html($include);
		 //alert($include);
    });
	
		  
        $('#note_delete').live('click',function(){
			
			$id = $(this).find('#noteId').val();
			var li = $(this).parent('li');
			$.ajax({
				 type: "POST",
				 url: '<?php echo site_url();?>'+"/notification/deleteNotice", 
				 data: {id: $id},
				 dataType: "text",  
				 cache:false,
				 success: 
					  function(data){
						 li.fadeOut(500,function(){li.remove(); });
						//alert('delete_done');
						
					  }
		
			 
		 });
			
			
			});
    });
	  
function confirmDialog() {
    return confirm("Are you sure you want to delete This Bonus?")
}
</script>
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
