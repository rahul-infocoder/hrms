<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 2.3.1
Version: 1.1.2
Author: KeenThemes
Website: http://www.keenthemes.com/preview/?theme=metronic
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469
-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><?php echo $title;?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />


<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/metro.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link src="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link src="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style_responsive.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
<link href="<?php echo base_url();?>assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/uniform/css/uniform.default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.css" />
<link href="<?php echo base_url();?>assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />


<link href="<?php echo base_url('assets/data-tables/data/media/css/demo_page.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('assets/data-tables/data/media/css/demo_table.css'); ?>" type="text/css"  rel="stylesheet"/>
<link href="<?php echo base_url('assets/data-tables/data/extras/TableTools/media/css/TableTools.css'); ?>" type="text/css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url('css/autoCompleteList.css');?>" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('css/style.css');?>" type="text/css" />



<link href="<?php echo base_url('css/jquery/jquery-ui.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/thickbox.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/autoCompleteList.css');?>" rel="stylesheet" type="text/css"/>


<script src="<?php echo base_url('js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js');?>"></script>



 <script src="<?php echo base_url('js/jquery-1.10.2.js'); ?>"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript"> 
	jQuery(document).ready(function() {
		setInterval(timer,1000);
	 jQuery('#ct').hide();
	  jQuery('#log_in').click(function(){
		  jQuery('#ct').show();
		 jQuery('#log_in').hide();
	 });
	 jQuery('#log_out').click(function(){
		 jQuery('#log_in').show();
		 jQuery('#ct').hide();
	 });
	});

// function display_c(){

// var refresh=1000; // Refresh rate in milli seconds
// mytime=setTimeout('display_ct()',refresh)
// }

function timer(){
	$.ajax({
	url:"<?php echo base_url(); ?>login/timer",
 success: function(data){
	 $("#ct").html(data);
 }	
	});
}

// function display_ct() {
// var strcount
// var x = new Date()
// document.getElementById('ct').innerHTML = x;
// tt=display_c();
// }

</script>
 

<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top"> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="container-fluid"> 
    
    <?php
	function time_elapsed_string($datetime) {
    $now = strtotime(date('Y-m-d h:i:s A'));
    $ago = $datetime;
    $diff = ($now-$ago);

    if($diff <60)
	{
	 return $diff .' second ago.';	
	}
	else if($diff >60 && $diff<60*60)
	{
	 return round($diff/60) .' Minutes ago';	
	}
	else if($diff >60*60 && $diff<60*60*24)
	{
	  return round($diff/(60*60)) .' Hours ago';	
	}
	else if($diff > 60*60*24 && $diff<60*60*24*30)
	{
	   return round($diff/(60*60*24)) .' Days ago';	
	}
	else if($diff > 60*60*24*30 && $diff<60*60*24*365)
	{
	   return round($diff/(60*60*24*30)) .' Months ago';	
	}
	
	else if($diff > 60*60*24*364)
	{
	   return 	round($diff/(60*60*24*365)) .' Years ago';
	}
	
}
	?>
      <!-- BEGIN LOGO --> 
      <!--<a class="brand" href="index.html">
				<img src="<?php //echo base_url();?>assets/img/logo.png" alt="logo" />
				</a>--> 
      <?php echo anchor(base_url(), $this->lang->line('site_name').' ADMIN', array('class'=>'brand','style'=>'font-weight:bold; color:#FFF;'));?> 
      <!-- END LOGO --> 
      <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
      <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse"> <img src="<?php echo base_url();?>assets/img/menu-toggler.png" alt="" /> </a> 
      <!-- END RESPONSIVE MENU TOGGLER --> 
      <!-- BEGIN TOP NAVIGATION MENU -->
      <ul class="nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <?php $noteNo = Notificationmodel::unReadNote();
		$noteList =  Notificationmodel::noteList();
		 ?> 
        
        <li class="dropdown" id="header_notification_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notiRead"> <i class="icon-warning-sign"></i> <?php if($noteNo >0){ ?><span class="badge"><?php echo $noteNo; ?></span><?php } ?> </a>
          <ul class="dropdown-menu extended notification">
            <li>
              <p>You have <?php echo $noteNo; ?> new notifications</p>
            </li>
            
            <?php foreach($noteList->result() as $row){ ?>
            <?php
			if($row->link != '' || $row->link != null)
			{
			  $noteLink = site_url($row->link);	
			}
			else
			{
			 $noteLink = 'javascript:void()';	
			}
			
			?>
            
            <li> <a href="<?php echo $noteLink; ?>" > <span class="label label-success"><i class="icon-bell"></i></span> <?php echo $row->msg; ?> <span class="time"><?php echo time_elapsed_string($row->date); ?></span> </a> </li>
            
            <?php } ?>
            
          <!--  <li> <a href="#"> <span class="label label-important"><i class="icon-bolt"></i></span> Server #12 overloaded. <span class="time">15 mins</span> </a> </li>
            <li> <a href="#"> <span class="label label-warning"><i class="icon-bell"></i></span> Server #2 not respoding. <span class="time">22 mins</span> </a> </li>
            <li> <a href="#"> <span class="label label-info"><i class="icon-bullhorn"></i></span> Application error. <span class="time">40 mins</span> </a> </li>
            <li> <a href="#"> <span class="label label-important"><i class="icon-bolt"></i></span> Database overloaded 68%. <span class="time">2 hrs</span> </a> </li>
            <li> <a href="#"> <span class="label label-important"><i class="icon-bolt"></i></span> 2 user IP blocked. <span class="time">5 hrs</span> </a> </li>
          -->
          
          <li class="external"> <a href="<?php echo site_url() ?>/notification">See all notifications <i class="m-icon-swapright"></i></a> </li>
          </ul>
        </li>
        <!-- END NOTIFICATION DROPDOWN --> 
        <!-- BEGIN INBOX DROPDOWN -->
        <?php $unReadNoMsg = Messagemodel::unReadMsg(); ?>
        <li class="dropdown" id="header_inbox_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-envelope-alt"></i> <?php if($unReadNoMsg > 0){ ?> <span class="badge"><?php echo $unReadNoMsg; ?></span> <?php } ?> </a>
          <ul class="dropdown-menu extended inbox">
            <li>
              <p>You have <?php echo $unReadNoMsg; ?> new messages</p>
            </li>
            <?php $unReadList = Messagemodel::unReadList(); ?>
            <?php foreach ($unReadList->result() as $row) {?>
            
            <?php 
			if($row->image != '' || $row->image != null)
			{
			  $msgImgUrl = base_url().'upload/profileimages/'.$row->image;	
			}
			else
			{
				$msgImgUrl =  base_url().'upload/profileimages/blank.jpg';
				
			}
			?>
            <li> <a href="<?php echo site_url() ?>/message/viewInbox/<?php echo $row->msgId; ?>"> <span class="photo"><img src="<?php echo $msgImgUrl ?>" alt="" /></span> <span class="subject"> <span class="from"><?php echo substr(Messagemodel::FindName($row->msg_from),0,7); ?></span> <span class="time"><?php echo time_elapsed_string($row->date); ?></span> </span> <span class="message"> 
            <?php  echo strip_tags(substr($row->msg,0,100));  ?>... </span> </a> </li>
         
         <?php } ?>
            <li class="external"> <a href="<?php echo site_url(); ?>/message/inbox">See all messages <i class="m-icon-swapright"></i></a> </li>
          </ul>
        </li>
        <!-- END INBOX DROPDOWN --> 
        <!-- BEGIN TODO DROPDOWN -->
        <?php if($this->session->userdata('user_type') == 'E'){ ?>
        
        <?php $noTask = Notificationmodel::task(); 
		$taskDetail = Notificationmodel::taskDetail();
		?>
        <li class="dropdown" id="header_task_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-tasks"></i>
         <?php if($noTask>0){ ?><span class="badge"><?php echo $noTask; ?></span><?php } ?> </a>
         <ul class="dropdown-menu extended notification">
            <li>
              <p>You have <?php echo $noTask; ?> pending tasks</p>
            </li>
            
            <?php foreach($taskDetail->result() as $row){ ?>
         <li> <a href="<?php echo site_url() ?>/employees/viewmyNewProjects" > <span class="label label-success"><i class="icon-bell"></i></span> you have assigned for <?php echo $row->pName ?> <span class="time"><?php echo date('D-M',$row->esdatefrom); ?></span> </a> </li>
         <?php }?>
          </ul>
        </li>
        <?php } ?>
        <!-- END TODO DROPDOWN --> 
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <li class="dropdown user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="" src="<?php echo base_url();?>upload/profileimages/<?php echo $this->session->userdata('profileImg')?>" width="20" /> <span class="username"> <?php echo $user_info->contact_name;?></span> <i class="icon-angle-down"></i> </a>
          <ul class="dropdown-menu">
            <li>
            <a href="<?php echo base_url();?><?php echo index_page();?>/admin/editProfile"><i class="icon-user"></i> My Profile</a>
                        
            </li>
            <!--<li><a href="calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>-->
            <!--<li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>-->
            <li class="divider"></li>
            <li><?php echo anchor('login/logout','<i class="icon-off"></i> Log Out');?></li>
          </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
      </ul>
      <!-- END TOP NAVIGATION MENU --> 
    </div>
  </div>
  <!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER --> 
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar nav-collapse collapse"> 
  <!-- BEGIN SIDEBAR MENU -->
  <ul>

    <li style="background-color:#fff"> 
    <?php $logo = $this->User->companyLogo(); ?>
    <div style="padding:10px;">
    <img src="<?php echo base_url($logo); ?>" alt="" />
    </div>
      <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
    <!--  <form class="sidebar-search">
        <div class="input-box"> <a href="javascript:;" class="remove"></a>
          <input type="text" placeholder="Search..." />
          <input type="button" class="submit" value=" " />
        </div>
      </form>-->
      <!-- END RESPONSIVE QUICK SEARCH FORM --> 
    </li>
      <li> 
      
      <div class="sidebar-toggler hidden-phone" style="margin-top:10px; margin-bottom:10px;"></div>
    
    </li>
    
    <li class="start active " style="position:relative"> <?php echo anchor(base_url(), '<i class="icon-home"></i> <span class="title">Dashboard</span> <span class="selected"></span>');?>
    
    </li>
    
	 <li class="has-sub "> <a href="javascript:;"><i class="icon-envelope-alt"></i><span class="title">Message</span> <span class="arrow "></span> </a>
      <ul class="sub">
       <li ><?php echo anchor('message/compose', '<i class="icon-envelope"></i> Compose Messsage');?></li>
        <li ><?php echo anchor('message/inbox', '<i class="icon-inbox"></i> In Box');?></li>
         <li ><?php echo anchor('message/sent', '<i class="icon-book"></i> Sent');?></li>
      
      </ul>
    </li>
    <li class="start"> <?php echo anchor('notification', '<i class="icon-bell-alt"></i> <span class="title">Notification</span>');?></li>
    
    <!-- Employee Links -->
         <?php if($this->session->userdata('user_type') == 'E'){?>
            <li class="start"> <?php echo anchor('employees/viewAllPresence', '<i class="icon-eye-open"></i> <span class="title">My Attendance</span>');?></li>
            
            
            
            <li class="has-sub "> <a href="javascript:;"> <i class="icon-beaker "></i> <span class="title">Attendance</span> <span class="arrow "></span> </a>
  <ul class="sub">
  <li ><?php echo anchor('employees/signIn/'.$this->session->userdata('id'), '<i class="icon-signin"></i> Sign In');?></li>
  <li ><?php echo anchor('employees/signOut/'.$this->session->userdata('id'), '<i class="icon-signout"></i> Sign Out');?></li>
  <li ><?php echo anchor('employees/uncompleteAttandance', '<i class="icon-eye-close"></i> Missing Attendance');?></li>
  </ul>
  </li>


<li class="has-sub "> <a href="javascript:;"> <i class="icon-road"></i> <span class="title">Work Report</span> <span class="arrow "></span> </a>
      <ul class="sub">
        
        <li ><?php echo anchor('employees/sendWorkReport/'.$this->session->userdata('id'), '<i class="icon-share-alt"></i> Send Work Report');?></li>
        <li ><?php echo anchor('employees/viewMyReport/', '<i class="icon-plane"></i> View Report');?></li>
      </ul>
    </li>
    <li class="has-sub "> <a href="javascript:;"> <i class="icon-question-sign"></i> <span class="title">Leaves</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('employees/viewAllLeaves', '<i class="icon-eye-open"></i> View My Leaves');?></li>
        <li ><?php echo anchor('employees/reqLeave/'.$this->session->userdata('id'), '<i class="icon-truck"></i> Raise Leave Req.');?></li>
      </ul>
    </li>
   

<li class="has-sub "> <a href="javascript:;"> <i class="icon-th-large"></i> <span class="title">My Project</span> <span class="arrow "></span> </a>
  <ul class="sub">
<li ><?php echo anchor('NewProjects', '<i class="icon-lightbulb"></i> New Projects');?></li>
<li ><?php echo anchor('current-project', '<i class="icon-spinner icon-spin icon-2x pull-left"></i> Running Projects');?></li>
<li ><?php echo anchor('complete-project', '<i class="icon-flag icon-2x pull-left"></i> Completed Projects');?></li>
<li ><?php echo anchor('employees/rejectProject', '<i class="icon-minus-sign"></i> Reject Projects');?></li>
</ul>
</li>

    <li class="has-sub "> <a href="javascript:;"> <i class="icon-eject"></i> <span class="title">Resign</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('employees/viewResign', '<i class="icon-eye-open"></i> View Resign Status');?></li>
        <li ><?php echo anchor('employees/resignLetter', '<i class="icon-eject"></i> Resignation Form');?></li>
      </ul>
    </li>

<li class="start"> <?php echo anchor('employees/viewHoliday', '<i class="icon-plane"></i> <span class="title">Holidays</span>');?></li>
    <?php } ?>
    <!--/employee-->
    
    
    
    
    <!--Edmin and super admin Links -->
    <?php if($this->session->userdata('user_type') == 'SA'){?>
      <!--   <li class="has-sub "> <a href="javascript:;"> <i class="icon-bookmark-empty"></i> <span class="title">Languages</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('language', 'Modify Labels');?></li>
      </ul>
    </li>-->
   
   
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-group"></i> <span class="title">Company</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewCompanies', '<i class=" icon-eye-open "></i> View/Edit Companies');?></li>
        
        
        
        <li ><?php echo anchor('admin/addCompany/-1', '<i class="icon-plus-sign "></i> Add Company');?></li>
        
      </ul>
    </li>
    
    
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-th-large"></i> <span class="title">Projects Assign</span> <span class="arrow "></span> </a>
      <ul class="sub">
	  <li ><?php echo anchor('add-project', '<i class="icon-share-alt"></i> Add Project');?></li>
	  <li ><?php echo anchor('view-project', '<i class="icon-share-alt"></i> View Project');?></li>
       <li ><?php echo anchor('assign-project', '<i class="icon-share-alt"></i> Assign Project');?></li>
        <li ><?php echo anchor('view-assign-projects', '<i class=" icon-eye-open "></i> View Assigned Project');?></li>
        <li ><?php echo anchor('view-project-complete-request', '<i class="icon-flag icon-2x pull-left"></i> Complete Project Request');?></li>
      </ul>
    </li>
    
<li class="has-sub "> <a href="javascript:;"> <i class="icon-asterisk"></i> <span class="title">Employees</span> <span class="arrow "></span> </a>
      <ul class="sub">
	  <li ><?php echo anchor('add-user', '<i class="icon-share-alt"></i> Add User');?></li>
        <li ><?php echo anchor('view-employees', '<i class=" icon-eye-open "></i> View/Edit Employees');?></li>
        <li ><?php echo anchor('admin/addEmployees/-1', '<i class="icon-plus-sign"></i> Add Employee');?></li>
        <li ><?php echo anchor('admin/AddDocuments', '<i class="icon-plus-sign"></i> Add Documents');?></li>
        <li ><?php echo anchor('admin/viewDisbaleEmp', '<i class="icon-eject"></i> Disabled Employee');?></li>
        
      </ul>
    </li>
    
    <li> <?php echo anchor('admin/viewAttendance', '<i class="icon-beaker "></i> <span class="title">Attendance</span>');?></li>

<!--<li class="has-sub "> <a href="javascript:;"> <i class="icon-beaker "></i> <span class="title">Attendance</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewAttendance/1', '<i class="icon-retweet "></i> Today Attendance');?></li>
        <li ><?php echo anchor('admin/viewAttendance/2', '<i class="icon-retweet "></i> All Attendance');?></li>
      </ul>
    </li>-->
<li> <?php echo anchor('admin/viewMyReport', '<i class="icon-road"></i> <span class="title">Work Reports</span>');?></li>

<li class="has-sub "> <a href="javascript:;"> <i class="icon-question-sign"></i> <span class="title">Leaves</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewLeaveApps', '<i class="icon-question-sign"></i> View Leave Applications');?></li>
      </ul>
    </li>

<li class="has-sub "> <a href="javascript:;"> <i class="icon-plus-sign-alt "></i> <span class="title">Increments</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewIncrements', '<i class=" icon-eye-open "></i> View Increment');?></li>
        <li ><?php echo anchor('admin/addIncrement/-1', '<i class="icon-plus-sign"></i>  Add Increment');?></li>
      </ul>
    </li>


     <li class="has-sub "> <a href="javascript:;"> <i class="icon-plus-sign-alt "></i> <span class="title">Bonus</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <li ><?php echo anchor('admin/viewBonus', '<i class=" icon-eye-open "></i> View Bonus');?></li>
        <li ><?php echo anchor('admin/addBonus', '<i class="icon-plus-sign"></i>  Add Bonus');?></li>   
      </ul>
    </li>
    
    
    <li class="has-sub "> <a href="javascript:;"> <i class="icon-plus-sign-alt "></i> <span class="title">Insentive</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <li ><?php echo anchor('admin/viewInsentive', '<i class=" icon-eye-open "></i> View Insentive');?></li>
        <li ><?php echo anchor('admin/addInsentive', '<i class="icon-plus-sign"></i>  Add Insentive');?></li>   
      </ul>
    </li>
     
   
    <li class="has-sub "> <a href="javascript:;"> <i class="icon-money"></i> <span class="title">Salary</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewMonthSalary', '<i class=" icon-eye-open "></i>  View Month Salary');?></li>
          <li ><?php echo anchor('admin/viewPaidSalary', '<i class="icon-fast-backward "></i>  Paid Salary');?></li>
      </ul>
    </li>

    
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-briefcase"></i> <span class="title">Clients</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('customers/addCustomer', '<i class="icon-plus-sign"></i> Add Client');?></li>
        <li ><?php echo anchor('customers/addProject', '<i class="icon-plus-sign"></i> Add Project');?></li>
        <li ><?php echo anchor('customers/aadPayment', '<i class="icon-plus-sign"></i> Add Payment');?></li>
        <li ><?php echo anchor('customers/viewClient', '<i class="icon-eye-open"></i> View Clients');?></li>
        <li ><?php echo anchor('customers/viewProject', '<i class="icon-eye-open"></i> View Project');?></li>
        <li ><?php echo anchor('customers/viewPayment', '<i class="icon-eye-open"></i> View Payment');?></li>
        <li ><?php echo anchor('customers/viewInvoice', '<i class="icon-eye-open"></i> View Invoice');?></li>
        
        
      </ul>
    </li>
    
    
        <li class="has-sub "> <a href="javascript:;"> <i class="icon-group"></i> <span class="title">Admin Users</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('view-admin-user', '<i class="icon-eye-open"></i> Admin Users');?></li>
        <li ><?php echo anchor('add-admin', '<i class="icon-plus-sign"></i> Add Admin Users');?></li>
        
      </ul>
    </li>
     <li>
   <li> <?php echo anchor('admin/resignApplication', '<i class="icon-eject"></i> <span class="title">Resign Application</span>');?></li>
   
   <li> <?php echo anchor('admin/viewHoliday', '<i class="icon-plane"></i> <span class="title">HoliDays</span>');?></li>
   
	<?php } ?>
    
    <!--End Super Admin-->
    
    <!--Start Admin -->
    <?php if($this->session->userdata('user_type') == 'A') {?>    
    <?php $AdminUrl = Adminmodel::AuthoUrl(); ?>
    
    <?php if (in_array('36', $AdminUrl)) {  ?>
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-group"></i> <span class="title">Company</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewCompanies', '<i class=" icon-eye-open "></i> View/Edit Companies');?></li>   
        
      </ul>
    </li>
    <?php } ?>
    <?php if (in_array('25', $AdminUrl) || in_array('27', $AdminUrl) || in_array('28', $AdminUrl)) {  ?>
    
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-th-large"></i> <span class="title">Projects Assign</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <?php if (in_array('25', $AdminUrl)){ ?>
       <li ><?php echo anchor('admin/assignProject', '<i class="icon-share-alt"></i> Assign Project');?></li>
       <?php } ?>
       
        <?php if (in_array('27', $AdminUrl)){ ?>
        <li ><?php echo anchor('admin/viewAssignProjects', '<i class=" icon-eye-open "></i> View Assigned Project');?></li>
        <?php } ?>
         <?php if (in_array('28', $AdminUrl)){ ?>
        <li ><?php echo anchor('admin/viewProjectCompleteRequest', '<i class="icon-flag icon-2x pull-left"></i> Complete Project Request');?></li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>
    
    
    
    <?php if (in_array('18', $AdminUrl) || in_array('19', $AdminUrl) || in_array('21', $AdminUrl) || in_array('23', $AdminUrl) || in_array('24', $AdminUrl)) {  ?>
<li class="has-sub "> <a href="javascript:;"> <i class="icon-asterisk"></i> <span class="title">Employees</span> <span class="arrow "></span> </a>
      <ul class="sub">
      
       <?php if (in_array('18', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/viewEmployees', '<i class=" icon-eye-open "></i> View/Edit Employees');?></li>
        <?php } ?>
         <?php if (in_array('19', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/addEmployees/-1', '<i class="icon-plus-sign"></i> Add Employee');?></li>
        <?php } ?>
          <?php if (in_array('21', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/AddDocuments', '<i class="icon-plus-sign"></i> Add Documents');?></li>
        <?php } ?>
          <?php if (in_array('24', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/viewDisbaleEmp', '<i class="icon-eject"></i> Disabled Employee');?></li>
        <?php } ?>
      </ul>
    </li>
<?php } ?>
<?php if (in_array('17', $AdminUrl) ){?>
<li> <?php echo anchor('admin/viewAttendance', '<i class="icon-beaker "></i> <span class="title">Attendance</span>');?></li>
    
    <?php } ?>
    
    <?php if (in_array('15', $AdminUrl) ){?>
<li> <?php echo anchor('admin/viewMyReport', '<i class="icon-road"></i> <span class="title">Work Reports</span>');?></li>
 <?php } ?>
 
 <?php if (in_array('29', $AdminUrl) ){?>
<li class="has-sub "> <a href="javascript:;"> <i class="icon-question-sign"></i> <span class="title">Leaves</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('admin/viewLeaveApps', '<i class="icon-question-sign"></i> View Leave Applications');?></li>
      </ul>
    </li>
    
    <?php } ?>


<?php if (in_array('11', $AdminUrl) || in_array('12', $AdminUrl) || in_array('13', $AdminUrl)) {  ?>
<li class="has-sub "> <a href="javascript:;"> <i class="icon-plus-sign-alt "></i> <span class="title">Increments</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <?php if (in_array('11', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/viewIncrements', '<i class=" icon-eye-open "></i> View Increment');?></li>
        <?php } ?>
        <?php if (in_array('13', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/addIncrement/-1', '<i class="icon-plus-sign"></i> Add Increment');?></li>
        <?php } ?>
      </ul>
    </li>

<?php } ?>

<?php if (in_array('7', $AdminUrl) || in_array('8', $AdminUrl) || in_array('9', $AdminUrl)) {  ?>
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-plus-sign-alt "></i> <span class="title">Bonus</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <?php if (in_array('7', $AdminUrl) ){?>
      <li ><?php echo anchor('admin/viewBonus', '<i class=" icon-eye-open "></i> View Bonus');?></li>
      <?php } ?>
      <?php if (in_array('9', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/addBonus', '<i class="icon-plus-sign"></i> Add Bonus');?></li>   
        <?php } ?>
      </ul>
    </li>
    
    <?php } ?>
    
    
    <?php if (in_array('40', $AdminUrl) || in_array('41', $AdminUrl) || in_array('42', $AdminUrl)) {  ?>
    
    <li class="has-sub "> <a href="javascript:;"> <i class="icon-plus-sign-alt "></i> <span class="title">Insentive</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <?php if (in_array('40', $AdminUrl) ){?>
      <li ><?php echo anchor('admin/viewInsentive', '<i class=" icon-eye-open "></i> View Insentive');?></li>
      <?php } ?>
      <?php if (in_array('41', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/addInsentive', '<i class="icon-plus-sign"></i> Add Insentive');?></li> 
        <?php } ?>  
      </ul>
    </li>
     <?php } ?>
   <?php if (in_array('1', $AdminUrl) || in_array('2', $AdminUrl) || in_array('3', $AdminUrl) || in_array('5', $AdminUrl) || in_array('4', $AdminUrl)) {  ?>
    <li class="has-sub "> <a href="javascript:;"> <i class="icon-money"></i> <span class="title">Salary</span> <span class="arrow "></span> </a>
      <ul class="sub">
      <?php if (in_array('1', $AdminUrl) ){?>
        <li ><?php echo anchor('admin/viewMonthSalary', '<i class=" icon-eye-open "></i> View Month Salary');?></li>
        <?php } ?>
        <?php if (in_array('3', $AdminUrl) ){?>
        
          <li ><?php echo anchor('admin/viewPaidSalary', '<i class="icon-fast-backward "></i> Paid Salary');?></li>
          <?php } ?>
      </ul>
    </li>
<?php } ?>
    
     <?php if (in_array('6', $AdminUrl) ){?>
     <li class="has-sub "> <a href="javascript:;"> <i class="icon-briefcase"></i> <span class="title">Clients</span> <span class="arrow "></span> </a>
      <ul class="sub">
        <li ><?php echo anchor('customers/addCustomer', '<i class="icon-plus-sign"></i> Add Client');?></li>
        <li ><?php echo anchor('customers/addProject', '<i class="icon-plus-sign"></i> Add Project');?></li>
        <li ><?php echo anchor('customers/aadPayment', '<i class="icon-plus-sign"></i> Add Payment');?></li>
        <li ><?php echo anchor('customers/viewClient', '<i class=" icon-eye-open "></i> View Clients');?></li>
        <li ><?php echo anchor('customers/viewProject', '<i class=" icon-eye-open "></i> View Project');?></li>
        <li ><?php echo anchor('customers/viewPayment', '<i class=" icon-eye-open "></i> View Payment');?></li>
        <li ><?php echo anchor('customers/viewInvoice', '<i class=" icon-eye-open "></i> View Invoice');?></li>
        
        
      </ul>
    </li>
    <?php } ?>
    
        <?php if (in_array('31', $AdminUrl) || in_array('32', $AdminUrl)) {  ?>
   <li> <?php echo anchor('admin/resignApplication', '<i class="icon-eject"></i> <span class="title">Resign Application</span>');?></li>
   
   <?php } ?>
   
   
    <?php } ?>
   
  
    <!--End Admin-->
    
	
	

 
    </li>
  </ul>
  <!-- END SIDEBAR MENU --> 
</div>
<!-- END SIDEBAR --> 
<!-- BEGIN PAGE -->
<div class="page-content">
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div id="portlet-config" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button"></button>
    <h3>Widget Settings</h3>
  </div>
  <div class="modal-body">
    <p>Here will be a configuration form</p>
  </div>
</div>
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid">
<!-- BEGIN PAGE HEADER-->
<div class="row-fluid">
<div class="span12">
<!-- BEGIN STYLE CUSTOMIZER -->
<div class="color-panel hidden-phone">
  <div class="color-mode-icons icon-color"></div>
  <div class="color-mode-icons icon-color-close"></div>
  <div class="color-mode">
    <p>THEME COLOR</p>
    <ul class="inline">
      <li class="color-black current color-default" data-style="default"></li>
    </ul>
    <label class="hidden-phone">
      <input type="checkbox" class="header" checked value="" />
      <span class="color-mode-label">Fixed Header</span> </label>
  </div>
</div>
<!-- END BEGIN STYLE CUSTOMIZER -->



<?php if($this->session->userdata('user_type') == 'SA' || $this->session->userdata('user_type') == 'A'){?>
<div  class="global_company">
<div>Select Global Company: </div>
<div>
 <?php   
	$cList = User::getACompanies();
	
	 ?>
<select name="global_company" id="global_company">
<option value="" >Select</option>
<?php
foreach(array_keys($cList) as $key)
					{
						$status='';
						if($this->session->userdata('global_comp') == $key){$status ='selected="selected"';}
						echo '<option value="'.$key.'"'.$status.'>'.$cList[$key].'</option>';
						
					}

?>
<option value="-1" >Unset</option>
</select>
</div>
</div>
<?php } ?>
