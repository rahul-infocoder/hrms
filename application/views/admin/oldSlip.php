<?php $this->load->view('partial/header');?>

<style>
.ui-autocomplete {
	max-height: 200px;
	overflow-y: auto;
	/* prevent horizontal scrollbar */
    overflow-x: hidden;
}
/* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
	height: 100px;
}

.table td , .table td
{
	padding:2px !important;
	
	
}

</style>
<h3 class="page-title"><?php echo $this->lang->line('certificates_certificate');?> <small><?php echo $this->lang->line('certificates_addedit');?></small> </h3>
<?php $this->load->view('partial/breadcrumb');?>
</div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12">
    <div class="tabbable tabbable-custom boxless">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title">
              <h4><i class="icon-reorder"></i><?php echo $this->lang->line('certificates_form');?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM--> 
           
              <h3 class="form-section"><?php echo $this->lang->line('certificates_info');?></h3>
              <div class="alert alert-error hide">
    <button class="close" data-dismiss="alert"></button>
    </div>
  <?php if(validation_errors()){
?>
  <div class="alert alert-error">
    <button class="close" data-dismiss="alert"></button>
    <span><?php echo validation_errors();?></span> </div>
  <?php }?>
            <div id="cover">
                <h1>Salary Slip</h1>
                                
               <?php 
			   $leave = $salData->row()->leave;
			   if($salData->row()->paidLeaveYN == 'Y')
			  {
				  if($salData->row()->leave >=0 && $salData->row()->paidLeaveAmount ==0)
				  {
			         $leave++;
				  }
				  else if($salData->row()->leave ==0 && $salData->row()->paidLeaveAmount >0)
				  {
					  //$leave++;
				  }
			  }
			   
			   ?>
               <table class="table" style="text-transform:uppercase !important;">
               <!-- company logo -->
               <tr>
               <td colspan="2" style="vertical-align: middle !important;">
           <img src="<?php echo base_url();?>upload/profileimages/<?php echo $salData->row()->logo; ?>" alt="compny logo" width="200" />
               </td>
               <td colspan="2" style="vertical-align: middle !important;">Company Name: <b><?php echo $salData->row()->name; ?></b> </td>
               <td colspan="2" style="vertical-align: middle !important;">Salary  for the Month:<b> <?php echo date('M-Y',strtotime($salData->row()->pay_month.'-01')); ?></b> </td>
               </tr>
               <!--Company logo -->
               
               <!-- Employee Information -->
               
               <tr>
               <td colspan="6">
               
               <table class="table">
               
               <tr>
               <td class="hidden-480">Name: </td><td><?php echo  $salData->row()->contact_name; ?></td>
               <td style="width:30% !important"></td>
               <td class="hidden-480">Location:  </td><td><?php echo $salData->row()->address; ?></td>
               </tr>
               <tr>
               <td class="hidden-480">Employee Code:  </td><td>
			   
			   
			   
               
               <?php echo $salData->row()->sname.'/'. str_pad($salData->row()->employeeCode, 2, '0', STR_PAD_LEFT);?>
               </td>
               <td style="width:30% !important"></td>
               <td class="hidden-480">Joining Date:  </td><td><?php echo date('d-M-Y', $salData->row()->doj); ?></td>
               </tr>
               <tr>
               <td class="hidden-480">Department:  </td><td><?php echo $salData->row()->department; ?></td>
               <td style="width:30% !important"></td>
               <td class="hidden-480">Working days/Holidays:   </td><td><?php echo  date('t',strtotime(($salData->row()->pay_month.'-01')))-$leave; ?>/<?php echo $salData->row()->holiday; ?></td>
               </tr>
               <tr>
               <td class="hidden-480">Designation: </td><td><?php echo $salData->row()->designation; ?></td>
               <td style="width:30% !important"></td>
               <td class="hidden-480">Leave/Half Day:  </td><td><?php  
			  
			  echo $leave; ?>/<?php echo $salData->row()->halfday; ?></td>
               </tr>
               <tr>
               <td class="hidden-480">Pan No. </td><td><?php if($salData->row()->panno =='' || $salData->row()->panno==null){echo 'N/A';} else{ echo $salData->row()->panno; } ?></td>
               <td style="width:30% !important"></td>
               <td class="hidden-480">Bank A/c:  </td><td><?php if($salData->row()->bac == '' || $salData->row()->bac ==null){echo 'N/A';}else {echo $salData->row()->bac;} ?></td>
               </tr>
             
               </table>
               
               
               </td>
               </tr>
               <!--End Employee information -->
               
               <!-- Salary Information-->
               <tr>
               <td colspan="6">
               <table class="table">
               <tr>
               <th class="hidden-480">Earnings</th>
               <th class="hidden-480">Entitled Amt.</th>
               <th class="hidden-480">Earned Amt.</th>
               <th class="hidden-480">Deductions	</th>
               <th class="hidden-480">Amount</th>
               </tr>
               
               <tr>
               <td class="hidden-480">Basic</td>
               <td class="hidden-480"><?php echo number_format($salData->row()->basic, 2, '.', ','); ?></td>
               <td class="hidden-480"><?php echo  number_format($salData->row()->basic, 2, '.', ','); ?></td>
               <td class="hidden-480">Income Tax</td>
               <td class="hidden-480"><?php echo $salData->row()->incometax; ?></td>
               </tr>
               
               
               <tr>
               <td class="hidden-480">Car All</td>
               <td class="hidden-480"><?php echo $salData->row()->carAll; ?></td>
               <td class="hidden-480"><?php echo $salData->row()->carAll; ?></td>
               <td class="hidden-480">P.F.</td>
               <td class="hidden-480"><?php echo $salData->row()->pf; ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Duty Travel</td>
               <td class="hidden-480"><?php echo $salData->row()->dutyTravel; ?></td>
               <td class="hidden-480"><?php echo $salData->row()->dutyTravel; ?></td>
               <td class="hidden-480">VPF</td>
               <td class="hidden-480"><?php echo $salData->row()->vpf; ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Conveyance</td>
               <td class="hidden-480"><?php echo $salData->row()->conveyance; ?></td>
               <td class="hidden-480"><?php echo $salData->row()->conveyance; ?></td>
               <td class="hidden-480">ESI</td>
               <td class="hidden-480"><?php echo $salData->row()->esi; ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Medical</td>
               <td class="hidden-480"><?php echo $salData->row()->medical; ?></td>
               <td class="hidden-480"><?php echo $salData->row()->medical ?></td>
               <td class="hidden-480">Leaves Amount</td>
               <td class="hidden-480"><?php echo number_format($salData->row()->leaveAmount, 2, '.', ','); ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Bonus</td>
               <td class="hidden-480"><?php echo number_format($salData->row()->bonus, 2, '.', ','); ?></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Paid Leave Amount: </td>
               <td class="hidden-480"><?php echo number_format($salData->row()->paidLeaveAmount, 2, '.', ','); ?></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               </tr>
               
               </table>
               </td>
               
               </tr>
               
               <!--/ salary Information-->
               
               <?php
			   $net = ($salData->row()->basic +$salData->row()->paidLeaveAmount +$salData->row()->carAll+$salData->row()->dutyTravel+$salData->row()->conveyance+$salData->row()->medical+$salData->row()->bonus) -($salData->row()->incometax+$salData->row()->pf+$salData->row()->vpf+$salData->row()->esi+$salData->row()->leaveAmount);
			   ?>
               <!--Grand total-->
               <tr>
               <th colspan="2" class="hidden-480">Gross Earning (in Rs. )</th>
               <th colspan="2" class="hidden-480"><?php echo ($salData->row()->basic +$salData->row()->paidLeaveAmount+$salData->row()->carAll+$salData->row()->dutyTravel+$salData->row()->conveyance+$salData->row()->medical+$salData->row()->bonus); ?></th>
               <th class="hidden-480">Gross Deduction(in Rs)</th>
               <th class="hidden-480"><?php echo ($salData->row()->incometax+$salData->row()->pf+$salData->row()->vpf+$salData->row()->esi+$salData->row()->leaveAmount); ?></th>
               
               </tr>
               
               <!--End total-->
               
               
               <!--net amount -->
               <tr>
               <th colspan="2" class="hidden-480">Net Amount(in Rs.)</th>
               <th class="hidden-480" colspan="4"><?php echo number_format($net, 2, '.', ','); ?></th>
               </tr>
               
               <!-- / net amount-->
               
               <!-- Net Amount in word -->
               
               <tr>
               <th class="hidden-480">Net Amount (in Words)</th>
               <th class="hidden-480" colspan="5"><?php echo Numbertowords::convert_number($net); ?> Only</th>
               </tr>
               <!-- End -->
               
               <tr>
               <td class="hidden-480" colspan="6" style="text-align:center">This a system generated payslip, does not require any signature and/Or company seal.</td>
               </tr>
               
               </table>
               
                </div>
              <label class="btn mini green" onclick="pop_print();">Print</label>  
              
                           
              <!-- END FORM--> 
            </div>
          </div>
        </div>
      </div>
    </div>
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
<script src="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script> 
<!-- ie8 fixes --> 
<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>assets/js/excanvas.js"></script>
	<script src="<?php echo base_url();?>assets/js/respond.js"></script>
	<![endif]--> 
<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/data-tables/jquery.dataTables.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/data-tables/DT_bootstrap.js"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
		jQuery(document).ready(function() {	
			// initiate layout and plugins
			App.init();
				
			
		});
		
		
		function pop_print(){
		
		var site = '<?php echo base_url(); ?>';
		//alert(site);
		var html = '<html><head>'+
               '<link href="'+site+'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />'+
               '</head><style type="text/css" > .table td ,.table th  {padding:2px !important; padding-left:8px !important; font-size:12px !important;} #cover{width:95%; margin:0 auto}  </style><body><div id="cover">'+jQuery('#cover').html() +'</div></body></html>';
    w=window.open(null, 'Print_Page', 'scrollbars=yes');        
    w.document.write(html);
	//w.document.writeln(html);
	
    w.document.close();
    w.print();
}
		
	</script> 
<script type="text/javascript" src="<?php echo site_url('js/jquery-ui.min.js');?>"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 






<?php $this->load->view('partial/footer');?>
