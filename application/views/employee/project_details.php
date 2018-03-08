<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jQuery.countdownTimer.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/countdownTimer.css" /> -->
<h3 class="page-title"> Project Details <small>Project Details </small> </h3>
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
  right: 225px;
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
ul.breadcrumb li:last-child {
    display: none;
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
        <h4><i class="icon-globe"></i>Project Details </h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>	  
      <div class="portlet-body">
		<div class="custom-cover">
			<div class="left">
				
				<?php $image = json_decode($proData[0]['file']); $i=1; $count = count($image);
					foreach($image as $pro) { ?>
				  <div class="mySlides">
					<div class="numbertext"><?php echo $i.'/'.$count; ?></div>
				<?php $ext = pathinfo(base_url().'upload/'.$id.'/'.$pro, PATHINFO_EXTENSION);?>
					<a href="<?php echo base_url().'upload/'.$id.'/'.$pro; ?>" target="_blank">
					<img src="<?php if($ext == "csv" || $ext == "docx" || $ext == "doc" || $ext == "pdf"|| $ext == "xls" || $ext == "odt"){echo base_url().'upload/file.png';}else{echo base_url().'upload/'.$id.'/'.$pro;} ?>" height="360px" width="290px">
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
			<div class="count">
				
				<span id="net_time">00:00:00</span>
				<br/>
				<br/>
				<input type="button" value="Start" id="cd_start" />
				<input type="button" value="Pause" id="cd_pause" />
				<br/>
				<br/>
				<input type="hidden" value="<?php if($time_seconds >0){echo $time_seconds;}else{?><script>alert(<?php echo $time_seconds;?>);</script><?php }?>" id="cd_seconds" />
				
				<span id="cd_status">Idle</span>
				
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
        $(document).ready(function() {
			
			$("#cd_pause").attr("disabled", "disabled");
            (function($){
            
                $.extend({
                    
                    APP : {                
                        
                        formatTimer : function(a) {
                            if (a < 10) {
                                a = '0' + a;
                            }                              
                            return a;
                        },    
                        
                        startTimer : function(dir) {
                            
                            var a;
                            
                            // save type
                            $.APP.dir = dir;

                            // get current date
                            $.APP.d1 = new Date();
                            
                            switch($.APP.state) {
                                    
                                case 'pause' :
                                    
                                    // resume timer
                                    // get current timestamp (for calculations) and
                                    // substract time difference between pause and now
                                    $.APP.t1 = $.APP.d1.getTime() - $.APP.td; 
                                    $('#' + $.APP.dir + '_start').prop( "disabled", true );
                                    $('#' + $.APP.dir + '_pause').prop( "disabled", false );
                                    $.APP.state = 'pause';
                                break;
                                    
                                default :
                                    
                                    // get current timestamp (for calculations)
                                    $.APP.t1 = $.APP.d1.getTime(); 

                                    // if countdown add ms based on seconds in textfield
                                    if ($.APP.dir === 'cd') {
                                        $.APP.t1 += parseInt($('#cd_seconds').val())*1000;
                                    }    
                                
                                break;
                                    
                            }                                   
                            
                            // reset state
                            $.APP.state = 'alive';   
                            $('#' + $.APP.dir + '_status').html('Running');
							$('#' + $.APP.dir + '_start').prop( "disabled", true );
                            
                            // start loop
                            $.APP.loopTimer();
							setstartTime($('#net_time').text());
                            
                        },
                        
                        pauseTimer : function() {
                            
                            // save timestamp of pause
                            $.APP.dp = new Date();
                            $.APP.tp = $.APP.dp.getTime();
                            
                            // save elapsed time (until pause)
                            $.APP.td = $.APP.tp - $.APP.t1;
                            
                            // change button value
                            $('#' + $.APP.dir + '_start').val('Resume');
                            $('#' + $.APP.dir + '_start').prop( "disabled", false );
                            $('#' + $.APP.dir + '_pause').prop( "disabled", true );
                            // set state
                            $.APP.state = 'pause';
                            $('#' + $.APP.dir + '_status').html('Paused');
							setPauseTime($('#net_time').text());
                            
                        },
                        
                        stopTimer : function() {
                            
                            // change button value
                            $('#' + $.APP.dir + '_start').val('Restart');                    
                            
                            // set state
                            $.APP.state = 'stop';
                            $('#' + $.APP.dir + '_status').html('Stopped');
                            
                        },
                        
                        resetTimer : function() {

                            // reset display
                            $('#' + $.APP.dir + '_ms,#' + $.APP.dir + '_s,#' + $.APP.dir + '_m,#' + $.APP.dir + '_h').html('00');                 
                            
                            // change button value
                            $('#' + $.APP.dir + '_start').val('Start');                    
                            
                            // set state
                            $.APP.state = 'reset';  
                            $('#' + $.APP.dir + '_status').html('Reset & Idle again');
                            
                        },
                        
                        endTimer : function(callback) {
                           
                            // change button value
                            $('#' + $.APP.dir + '_start').val('Restart');
                            
                            // set state
                            $.APP.state = 'end';
                            
                            // invoke callback
                            if (typeof callback === 'function') {
                                callback();
                            }    
                            
                        },    
                        
                        loopTimer : function() {
                            
                            var td;
                            var d2,t2;
                            
                            var ms = 0;
                            var s  = 0;
                            var m  = 0;
                            var h  = 0;
                            
                            if ($.APP.state === 'alive') {
                                        
                                // get current date and convert it into 
                                // timestamp for calculations
                                d2 = new Date();
                                t2 = d2.getTime();   
                                
                                // calculate time difference between
                                // initial and current timestamp
                                if ($.APP.dir === 'sw') {
                                    td = t2 - $.APP.t1;
                                // reversed if countdown
                                } else {
                                    td = $.APP.t1 - t2;
                                    if (td <= 0) {
                                        // if time difference is 0 end countdown
                                        $.APP.endTimer(function(){
                                            $.APP.resetTimer();
                                            $('#' + $.APP.dir + '_status').html('Ended & Reset');
                                        });
                                    }    
                                }    
                                
                                // calculate milliseconds
                                ms = td%1000; 
                                if (ms < 1) {
                                    ms = 0;
                                } else {    
                                    // calculate seconds
                                    s = (td-ms)/1000;
                                    if (s < 1) {
                                        s = 0;
                                    } else {
                                        // calculate minutes   
                                        var m = (s-(s%60))/60;
                                        if (m < 1) {
                                            m = 0;
                                        } else {
                                            // calculate hours
                                            var h = (m-(m%60))/60;
                                            if (h < 1) {
                                                h = 0;
                                            }                             
                                        }    
                                    }
                                }
                              
                                // substract elapsed minutes & hours
                                ms = Math.round(ms/100);
                                s  = s-(m*60);
                                m  = m-(h*60);                                
                                
                                // update display
                                //$('#' + $.APP.dir + '_ms').html($.APP.formatTimer(ms));
                                //$('#' + $.APP.dir + '_s').html($.APP.formatTimer(s));
                                //$('#' + $.APP.dir + '_m').html($.APP.formatTimer(m));
                                //$('#' + $.APP.dir + '_h').html($.APP.formatTimer(h));
                                $('#net_time').html($.APP.formatTimer(h)+":"+$.APP.formatTimer(m)+":"+$.APP.formatTimer(s));
                                
                                // loop
                                $.APP.t = setTimeout($.APP.loopTimer,1);
                            
                            } else {
                            
                                // kill loop
                                clearTimeout($.APP.t);
                                return true;
                            
                            }  
                            
                        }
                            
                    }    
                
                });    

                $('#cd_start').live('click', function() {
                    $.APP.startTimer('cd');
					$("#cd_pause").prop( "disabled", false );
                });           
                
                $('#sw_stop,#cd_stop').live('click', function() {
                    $.APP.stopTimer();
                });
                
                $('#sw_reset,#cd_reset').live('click', function() {
                    $.APP.resetTimer();
                });  
                
                $('#sw_pause,#cd_pause').live('click', function() {
                    $.APP.pauseTimer();
                });                
                        
            })(jQuery);
                
        });
		
</script>
<script>
	var countTime = '';var updateTimer = '';
		jQuery(document).ready(function() {	
		
			// initiate layout and plugins
			App.setPage("table_managed");			
			App.init();	
					
		});
		
		function setPauseTime(time){
			var pid=<?php echo $this->uri->segment(3); ?>;
			jQuery.ajax({
				type : "POST",
				url : "<?php echo base_url(); ?>employees/inputpausetime",
				data : { 'time' : time,'pid':pid}		
			})
			.done(function(data) {
				console.log(data);
			})
			.fail(function(data) {
				console.log('AJAX Error'+data);
			});
		}
		function setstartTime(time){
			var pid=<?php echo $this->uri->segment(3); ?>;
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>employees/startTime",
				data: {'time' : time,'pid':pid}
			})
			.done(function(data){
				console.log(data);
			})
			.fail(function(data){
				console.log('AJAX Error'+data);
			})
		}

		jQuery("#cd_start").click(function(){
			updateTimer = setInterval(startCountTimer, 15000);
			countTime = setInterval(getTimeInterval, 1000);
		});
		function startCountTimer(){
			setPauseTime(jQuery('#net_time').text());
			
		}
		function getTimeInterval(){
			if("00:00:00" == jQuery("#net_time").text()){
				clearInterval(countTime);
				clearInterval(updateTimer);
					var pid=<?php echo $this->uri->segment(3); ?>;
					jQuery.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>employees/sendMail",
						data: {'pid':pid}
					})
					.done(function(data){
						console.log(data);
					})
					.fail(function(data){
						console.log("AJAX Error"+data);
					})
				 
			}
			
		}
		
		jQuery("#cd_pause").click(function(){
			clearInterval(updateTimer);
			clearInterval(countTime);
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