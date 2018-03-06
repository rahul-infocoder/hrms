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
 <div class="portlet box blue">   
 <div class="portlet-title"> 
 <h4><i class="icon-reorder"></i>Project List</h4> 
 <div class="tools"> 
 <a href="javascript:;" class="collapse"></a>   
 <a href="<?php echo site_url('admin/assignProject'); ?>" style="color:#fff;" title="Assign A Project"><i class="icon-share-alt"></i></a>  
 <a href="<?php echo site_url('admin/viewProjectCompleteRequest'); ?>" style="color:#fff;" title="View Complete Project Request">        <i class="icon-bolt"></i></a> 
 </div>   
 </div>   
 <div class="portlet-body">	              
 <table class="table table-striped table-bordered table-hover" id="msgTable">    
 <thead>         
 <tr>                     
 <th>Project Name</th>      
 <th class="hidden-480">Assigned to</th>      
 <th>Assign Date</th>       
 <th class="hidden-480">Start Date</th>           
 <th class="hidden-480">Complete Date</th>     
 <th>Dead Line</th>                     
 <th class="hidden-480">Emp Comment</th>      
 <th class="hidden-480">Status</th>       
 </tr>        
 </thead>        
 <tbody>        
 <?php 
if(is_array($wData) && count($wData)>0){
	
foreach($wData as $plist){ ?>   
         <tr class="odd gradeX">                 
		 <td ><?php  echo anchor('admin-project-details/'.$plist['pid'], $this->Add_Project_Model->project_name($plist['pid']));?></td>  
		 <td class="hidden-480"><?php echo $this->Adminmodel->emp_name($plist['eid']);?></td>    
         <td><?php echo date('d-M-Y',$plist['esdatefrom']); ?></td>   
		 <td class="hidden-480">            
		 <?php           // if($plist->assStatus == 'A')			  
			// echo date('d-M-Y',$plist['workStart']);	  			
		 // else if($plist->assStatus == 'C')			  	
			 // echo date('d-M-Y',$plist['workStart']);		
		 // //else if($plist->assStatus == 'R')		
			 // echo 'Employee Rejected';   		
		 // //else if($plist->assStatus == 'W')			 
			 // echo 'WaitEmployeeResponse';   		
		 ?>              </td>      
		 <td class="hidden-480">        
		 <?php              // if($plist->assStatus == 'A')		
			 // {			   
		 // echo 'Working';	  			
		 // }	
		 // else if($plist->assStatus == 'C')		
			 // {				
		// echo date('d-M-Y',$plist['endWork']);		
		 // }			
		 // else if($plist->assStatus == 'R')		
			 // {			
		 // echo 'Employee Rejected';   	
		 // }		
		 // else if($plist->assStatus == 'W')		
			 // {			
		 // echo 'WaitEmployeeResponse';   	
		 // }		
		 ?>              </td>          
		 <td><?php echo $plist['deadLine'] ==0?'Not Set': date('d-M-Y',$plist['deadLine']); ?></td>    
		 <td class="hidden-480">			  <?php 	
		 // if($plist->assStatus != 'W')		
			 // {				
		 // echo $plist->report;	
		 // }			
		 // else		
			 // {			
		 // echo 'Wait';	  	
		 // }			
		 echo $plist['remarks'];		
		 ?>      </td>      
		 <td class="hidden-480">			
		 <?php 			  			
		 echo $plist['status'];			
		 // if($plist->assStatus =='W')		
			 // {			
		 // echo '<label class="btn mini gray">Waiting</label>';	
		 // }			
		 // else if($plist->assStatus =='A')		
			 // {			
		 // echo '<label class="btn mini green">Accepted</label>';		
		 // }			  		
		 // else if($plist->assStatus =='C')		
			 // {				
		 // echo '<label class="btn mini blue">Completed</label>';	
		 // }			  		
		 // else if($plist->assStatus =='R')	
			 // {			
		 // echo '<label class="btn mini red">Rejected</label>';
		 // }			
		 ?>    </td>         
		 </tr>           
		 <?php } 
		 }
		 else{echo "no data to show";} ?>      
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
		 <!-- Load javascripts at bottom, this will reduce page load time --> 		 <script>	 jQuery(document).ready(function() {		 // initiate layout and plugins			App.setPage("table_managed");			App.init();							var site = '<?php echo site_url('admin/viewAssignProjects'); ?>';		var page = '/'+'<?php echo $page; ?>';		$('#filter').click(function(){			var limit = '/'+$('#row').val();		var month = $('#month').val();			var year = $('#year').val();		var status = $('#status').val();		if(status == ''){		status='/all';				}					else	{			status = '/'+status;	}							if(year == '')	{			year='/all';	}	else	{				year = '/'+year;		}		if(month == '')	{				month='/all';		}		else	{		month = '/'+month;		}		var uri =limit+page+month+year+status;			location.href = site+uri;					});			});	</script> 
		<script src="<?php echo base_url();?>assets/js/jquery-1.8.3.min.js"></script> 
		 <script src="<?php echo base_url();?>assets/breakpoints/breakpoints.js"></script>
		 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
		 <script src="<?php echo base_url();?>assets/fancybox/source/jquery.fancybox.pack.js"></script> 
		 <script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script>
		 <script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
		 <!-- ie8 fixes --> <!--[if lt IE 9]>	
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
 <!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>