<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"><?php echo $this->lang->line(strtolower($this->session->userdata('selected_country')));?> Dashboard <small>Manage Your Menus Here</small> </h3>
<?php $this->load->view('partial/breadcrumb');?>
<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="tiles"> <?php echo anchor('establishment', '<div class="tile double-down bg-blue">
    <div class="tile-body"> <i class="icon-bell"></i> </div>
    <div class="tile-object">
      <div class="name"> Establishment Info </div>
      <div class="number"> '.Estmodel::getAllEst()->num_rows().' </div>
    </div>');?> </div>
<?php echo anchor('#', '<div class="tile bg-green">
  <div class="tile-body"> <i class="icon-calendar"></i> </div>
  <div class="tile-object">
    <div class="name"> '.anchor('establishment/viewProducts', 'Products').' </div>
    <div class="number"> '.Estmodel::getAllProductEst()->num_rows().' </div>
  </div>
</div>');?>
<div class="tile double selected bg-blue">
  <div class="corner"></div>
  <div class="check"></div>
  <div class="tile-body">
    <h4>sahil@mavencodes.com</h4>
    <p>Re: Will get this feature after project!</p>
    <p>Its just a nonworking tile.</p>
  </div>
  <div class="tile-object">
    <div class="name"> <i class="icon-envelope"></i> </div>
    <div class="number"> 14 </div>
  </div>
</div>
<div class="tile selected bg-red">
  <div class="corner"></div>
  <div class="tile-body"> <i class="icon-user"></i> </div>
  <div class="tile-object">
    <div class="name"> <?php echo anchor('establishment/viewConsignee', 'Consignee Names'); ?> </div>
    <div class="number"> <?php echo Estmodel::getAllConsignees()->num_rows();?> </div>
  </div>
</div>
<div class="tile double bg-purple">
  <div class="tile-body"> <img src="assets/img/photo1.jpg" alt="">
    <h3><?php echo anchor('establishment/viewExporters', 'Exporters'); ?></h3>
    <p> Everything is possible with us.. </p>
  </div>
  <div class="tile-object">
    <div class="name"> <?php echo Estmodel::getExporters()->num_rows();?> </div>
    <div class="number"> <?php echo date('Y/m/d');?> </div>
  </div>
</div>
<div class="tile bg-yellow">
  <div class="tile-body"> <i class="icon-shopping-cart"></i> </div>
  <div class="tile-object">
    <div class="name"> <?php echo anchor('establishment/viewVeterinarian', 'Veterinarians'); ?> </div>
    <div class="number"> <?php echo Estmodel::getAllVeterinarians()->num_rows();?> </div>
  </div>
</div>
<div class="tile bg-blue">
  <div class="tile-body"> <i class="icon-coffee"></i> </div>
  <div class="tile-object">
    <div class="name"> Processing Plants </div>
  </div>
</div>
<div class="tile bg-green">
  <div class="tile-body"> <i class="icon-comments-alt"></i> </div>
  <div class="tile-object">
    <div class="name"> Feedback </div>
    <div class="number"> 12 </div>
  </div>
</div>
<div class="tile double bg-grey">
  <div class="tile-body"> <img src="assets/img/photo2.jpg" alt="" class="pull-right">
    <h3>Notifications</h3>
    <p> I wanna comlete it ASAP. </p>
  </div>
  <div class="tile-object">
    <div class="name"> <i class="icon-twitter"></i> </div>
    <div class="number"> 10:45PM, 23 Jan </div>
  </div>
</div>
<div class="tile bg-blue">
  <div class="tile-body"> <i class="icon-coffee"></i> </div>
  <div class="tile-object">
    <div class="name"> <?php echo anchor('establishment/viewPorts', 'Port of Entries'); ?> </div>
    <div class="number"> <?php echo Estmodel::getPorts()->num_rows();?> </div>
  </div>
</div>
<div class="tile bg-green">
  <div class="tile-body"> <i class="icon-bar-chart"></i> </div>
  <div class="tile-object">
    <div class="name"> Reports </div>
    <div class="number"> </div>
  </div>
</div>
<div class="tile bg-purple">
  <div class="tile-body"> <i class="icon-briefcase"></i> </div>
  <div class="tile-object">
    <div class="name"> <?php echo anchor('establishment/viewCertificates', 'Certificates'); ?></div>
    <div class="number"> <?php echo Estmodel::getAllCertificates()->num_rows();?> </div>
  </div>
</div>

<div class="tile bg-yellow selected">
  <div class="corner"></div>
  <div class="check"></div>
  <div class="tile-body"> <i class="icon-cogs"></i> </div>
  <div class="tile-object">
    <div class="name"> Settings </div>
  </div>
</div>
<div class="tile bg-purple">
  <div class="tile-body"> <i class="icon-plane"></i> </div>
  <div class="tile-object">
    <div class="name"> Change Country </div>
  </div>
</div>
</div>
<br>
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
	<script src="<?php echo base_url();?>assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
	<script src="<?php echo base_url();?>assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>	
	<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>assets/js/excanvas.js"></script>
	<script src="<?php echo base_url();?>assets/js/respond.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>assets/js/app.js"></script>		
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage('calendar');
			App.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
