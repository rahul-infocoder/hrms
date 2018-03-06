<?php $this->load->view('partial/header');?>

<h3 class="page-title"> View Project <small>View</small> </h3>

<?php $this->load->view('partial/breadcrumb');?>


</div>

</div>

<!-- END PAGE HEADER--> 

<!-- BEGIN PAGE CONTENT-->

<div class="row-fluid">

  <div class="span12"> 

    <!-- BEGIN EXAMPLE TABLE PORTLET-->

   
  

 

    <div class="portlet box blue">

      <div class="portlet-title">

        <h4><i class="icon-globe"></i>Project List</h4>

        <div class="tools"> <a href="javascript:;" class="collapse"></a>

        

        <a href="<?php echo site_url('admin/addProject'); ?>" style="color:#fff;" title="Add Project"><i class="icon-plus-sign" ></i></a>

        <a href="<?php echo site_url('admin/AddDocuments'); ?>" style="color:#fff;" title="Add Project Documents"><i class="icon-file-alt"></i></a>

        <!-- <a href="<?php echo site_url('admin/viewDisbaleEmp'); ?>" style="color:#fff" title="Disabled Employee"><i class="icon-eject"></i></a> -->

         </div>

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

      <option value="50" <?php echo ($limit==50)?' selected="selected"':''; ?>>50</option>

      <option value="100" <?php echo ($limit==100)?' selected="selected"':''; ?>>100</option>

      <option value="200" <?php echo ($limit==200)?' selected="selected"':''; ?>>200</option>

      <option value="500" <?php echo ($limit==500)?' selected="selected"':''; ?>>500</option>

      <option value="all" <?php echo ($limit=='all')?' selected="selected"':''; ?>>All</option>

      </select>

      </td>

      </tr>

      </table>

      

        <table class="table table-striped table-bordered table-hover" id="msgTable">

          <thead>

            <tr>

             

              <th>Title</th>

              <th>Description</th>

              <th class="hidden-480">Priority</th>

              <th class="hidden-480">Due Date</th>

              <th class="hidden-480">Image</th>

            </tr>

          </thead>

          <tbody>

			<?php if(!empty($all_project)): foreach($all_project as $all_projects) :?>
            

            <tr class="odd gradeX" >

             

              

              <td>

			  <?php echo $all_projects['title'];?>

			  

			  </td>

              <td><?php echo $all_projects['description']; ?></td>

              <td class="hidden-480"><?php echo $all_projects['priority'];?></td>

              <td class="hidden-480" ><?php echo $all_projects['due_date'];?></td>

              <td class="hidden-480" ><a target="_blank" href="<?php echo base_url().'upload/'.$all_projects['id'].'/'.$all_projects['file'] ;?>"><i class="fa fa-file" aria-hidden="true"></i></a></td>

             

            </tr>
				
            <?php endforeach; ?>

            <?php else: ?>
			<td colspan="3">
                            <strong>There is no record for display</strong>
                        </td><!--/ get error message if this empty-->
                    <?php endif; ?>

          </tbody>

        </table>

        <!--  <div class="pagination"><?php// echo (isset($links))?$links:''; ?></div> -->

        <?php //echo $rowInfo; ?>

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


<?php $this->load->view('partial/footer');?>

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