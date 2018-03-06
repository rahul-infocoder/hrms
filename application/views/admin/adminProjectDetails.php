<?php $this->load->view('partial/header');
//print_r($proData);exit;?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jQuery.countdownTimer.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/countdownTimer.css" /> -->
<h3 class="page-title"> Admin Project Details <small>Admin Project Details </small> </h3>
<?php $this->load->view('partial/breadcrumb');?>
<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 160px;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: black;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
  font-weight: bold;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 15%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
a.prev {
    left: -10px;
}
span#cd_status {
    margin-left: 250px;
    padding-left: 250px;
}
.custom-cover{
	overflow: hidden;
}
</style>
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
        <h4><i class="icon-globe"></i>Admin Project Details </h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>	  
      <div class="portlet-body">
		<div class="custom-cover">
			<div class="left">
				
				<?php $image = json_decode($proData[0]['file']); $i=1; $count = count($image);
				//print_r($image);exit;
					foreach($image as $pro) { ?>
				  <div class="mySlides">
					<div class="numbertext"><?php echo $i.'/'.$count; ?></div>
				<?php $ext = pathinfo(base_url().'upload/'.$id.'/'.$pro, PATHINFO_EXTENSION);?>
					<a href="<?php echo base_url().'upload/'.$id.'/'.$pro; ?>" target="_blank">
					<img src="<?php if($ext == "csv" || $ext == "docx" || $ext == "doc" || $ext == "pdf"|| $ext == "xls" || $ext == "odt"){echo base_url().'upload/file.png';}else{echo base_url().'upload/'.$id.'/'.$pro;} ?>" height="360px" width="360px">
					</a>
				<?php  ?>
				  </div>
				<?php $i++; } ?> 
					
				  <a class="prev" onclick="plusSlides(-1)">❮</a>
				  <a class="next" onclick="plusSlides(1)">❯</a>

				  <div class="row" style="margin-left:0px !important;">
				  <?php $image = json_decode($proData[0]['file']); $i=1; $count = count($image);
					foreach($image as $pro) { ?>
					<div class="column">
					<?php $ext = pathinfo(base_url().'upload/'.$id.'/'.$pro, PATHINFO_EXTENSION);?>
					 <a href="<?php echo base_url().'upload/'.$id.'/'.$pro; ?>" target="_blank">
					 <img class="demo cursor" src="<?php if($ext == "csv" || $ext == "docx"|| $ext == "pdf"|| $ext == "xls" || $ext == "odt" || $ext == "doc"){echo base_url().'upload/file.png';}else{echo base_url().'upload/'.$id.'/'.$pro;} ?>" style="width:100%" onclick="currentSlide(<?php echo $i; ?>)">
					 </a>
					</div>
					<?php $i++; } ?> 
					
				  </div>
				
				
			</div>
			<div class="right">
				<p class="left1"><label for="middle-label" class="middle">Priority :</label></p>
				<p class="left1"><?php echo $proData[0]['priority']; ?></p>
				<p class="left1"><label for="middle-label" class="middle">Project Name :</label></p>
				<p class="left1"><?php echo $proData[0]['title']; ?></p>
				<div>
					<h3>Description</h3>
					<p><?php echo $proData[0]['description']; ?></p>
				</div>
				<p class="left1"><label for="middle-label" class="middle">Deadline :</label></p>
				<p class="left1"><?php echo $proData[0]['due_date']; ?></p>
			</div>
			
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
<!-- <script src="<?php //echo base_url();?>assets/js/jquery-1.8.3.min.js"></script>  -->
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
	var countTime = '';var updateTimer = '';
		jQuery(document).ready(function() {	
		
			// initiate layout and plugins
			App.setPage("table_managed");			
			App.init();	
					
		});
		
		
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
	</script>     
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