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

 .table td
{
	padding:2px !important;
	padding-left:8px !important;
		
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
              <?php echo form_open_multipart('admin/payit/'.$id, array('id'=>'form_certificate', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>
              
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
                <h1>Pay Slip</h1>
                
                
                <?php
				
				// $id is Employee Id
				
				$emp = Adminmodel::salarySlipEmp($id); //Employee Details
				 
				$comp = Adminmodel::SalaryCompany($emp->cid); // employee Company Details
				
			    $incAmount = Adminmodel::incrementAdd($id);  // Employee Increment Tiil Now
				
				$salaryBefore = $emp->salary; // salary when employee Join 
				
				$salary = $incAmount + $salaryBefore;  // Total Salary of Employee
			    
				
				$Lmonth = Adminmodel::runMonthsalary($id); // Last Salary Month Fetch	
			   
			 
			
					
						$Ldate = $Lmonth.'-'.'1'; // add date
						$salaryFrom = strtotime(date_format(new DateTime($Ldate),'d-m-Y'). " +1 month"); // This month date Increment
					
						$salaryTo = date('Y-m',$salaryFrom).'-'.date('t', $salaryFrom );  // Last date to This Month
					   $salaryTo = strtotime(date_format(new DateTime($salaryTo),'d-m-Y')); // 
					   
				      $salaryMonth = date('M-Y',$salaryFrom); // Month Of this Salary.
					   
					   
					   
					$bonus = Adminmodel::FindBonus(date('Y-m',$salaryTo),$id); // Bonus   
			        $insentive = Adminmodel::Findinsentive(date('Y-m',$salaryTo),$id); // Employee Insentive Of This Month
					
					
					
					
			         
			$halfday = Adminmodel::getLeavesSpecificEmp($id)->row()->halfdays;
			 if($halfday == '') { $halfday =0;	 }
				
			/*This Month Full Leave with sunday */
		/*	$fullDaysLeaves = Adminmodel::getLeavesSpecificEmp($id)->row()->fulldays;
		     
			 if($fullDaysLeaves == ''){$fullDaysLeaves =0;}*/
				 /*End this month Full leave */
				
				
				
				/*Over Month leave with Sunday */
			/*	if(Adminmodel::checkCrossLeave($id))
				{
				 $extraLeave = Adminmodel::checkCrossLeave($id);
				}
				else
				{
				$extraLeave =0; 	
				}*/
				
				/*Over Month leave End*/

				
				/*Total sunday In total Leave of this month + over month*/
							/* if(Adminmodel::removeSunday($id))
								{
									$Totalsunday = Adminmodel::removeSunday($id);
								}
							  else
								{
									$Totalsunday=0;
									
								}*/
								
								/*End Sunday*/
					
					/*Over Month Sunday*/
					/* if(Adminmodel::OverMonthSunday($id))
								{
									$OverMonthsunday = Adminmodel::OverMonthSunday($id);
								}
							  else
								{
									
									 $OverMonthsunday=0;
								}
								*/
								
								/*End Over month Sunday */								
							
					
/*
				 $thisMonthLeaveWithSunday = $fullDaysLeaves-$extraLeave; //This Month Full Leave With Sunday include
				
				 $thisMonthSunday = $Totalsunday-$OverMonthsunday; // In this value include this month sunday Only.
				
				 $leave = abs($thisMonthLeaveWithSunday-$thisMonthSunday); // in this value include Total leave of this month with out sunday
				
				$OverLeave = abs($extraLeave-$OverMonthsunday); // In this value include leave over this month.
				*/
				/*due leave */				
				// $dueLeave = Adminmodel::dueLeave($id);
				/*End due leave*/
				
				/*Holiday Maneg*/
				$holidayinLeave = Adminmodel::leaveInholiday($emp->id,$emp->cid);
			   
			   	$holidayList = Adminmodel::findHolidayOfMonth($emp->id,$emp->cid);
				
				$leave = Adminmodel::employeeLeave($emp->id);
			     $noHoliday = count($holidayList);
				 
				 /*End Holiday*/
				 
				$leave = $leave-$holidayinLeave;  //Total Leave include Over Month leave
				$TmLeave = $leave; // total leave of this month 
				
				
				
				/*Paid Amount */
				$paidLeaveAmount =0;
				
				if( $emp->paidLeave =='Y' && $leave >=1)
				{
					$leave = $leave-1;
				   	
				}
				else if($emp->paidLeave =='Y' && $leave <= 0)
				{
					$paidLeaveAmount =floor(($salary )/30);
					
				}
				
				/*Emd Paid Amount */
				
			
			
			/* Decrease Leave Amount*/	
			$salaryLess =	floor((($salary )/30)*$leave);
		    $halfdayLess = floor(((($salary)/30)*$halfday)/2);
			$LeaveAmount = $salaryLess +$halfdayLess;
			
		  
		   /*Complete Leave Amount*/	
		 
		   
		    
			//earning
		   $carAll = $emp->carAll;
		   $duttyTravel = 0;
		   $conveyance = $emp->conveyance;
		   $medical = $emp->medical;
		   
		   $earning = ($carAll+$duttyTravel+$conveyance+$medical+$bonus+$insentive+$paidLeaveAmount+$salary);
		   
		   // Deductions
		   $incometax = $emp->incometax;
		   $pf = $emp->pf;
		   $vpf = $emp->vpf;
		   $esi = $emp->esi;
		   
		   $deduction = ($incometax+$pf+$vpf+$esi+$LeaveAmount);
		   
		   $netsalary = $earning-$deduction;
		   
		   $words = Numbertowords::convert_number($netsalary);
				
				?>
               <table class="table" style="text-transform:uppercase !important;">
               <!-- company logo -->
               <tr>
               <td colspan="2" style="vertical-align: middle !important;">
               <img src="<?php echo base_url();?>upload/profileimages/<?php echo $comp->logo; ?>" alt="compny logo" width="200" />
               </td>
               <td colspan="2" style="vertical-align: middle !important;">Company Name: <b><?php echo $comp->name; ?></b> </td>
               <td colspan="2" style="vertical-align: middle !important;">Salary  for the Month:<b> <?php echo $salaryMonth; ?></b> </td>
               </tr>
               <!--Company logo -->
               
               <!-- Employee Information -->
               
               <tr>
               <td colspan="6">
               
               <table class="table">
               
               <tr>
               <td style=" width:130px;"><strong>Name:</strong></td><td> <?php echo  $emp->contact_name; ?></td>
              
               <td class="hidden-480"style=" padding-left:100px !important" > <strong>Address:</strong>  </td><td >  <?php echo $emp->address; ?></td>
               </tr>
               <tr>
               <td class="hidden-480"><strong>Employee Code:</strong>  </td><td> 
                <?php echo $comp->sname.'/'. str_pad($emp->employeeCode, 2, '0', STR_PAD_LEFT);?></td>
              
               <td class="hidden-480" style=" padding-left:100px !important" ><strong>Joining Date:</strong>  </td><td > <?php echo date('d-M-Y', $emp->doj); ?></td>
               </tr>
               <tr>
               <td class="hidden-480"><strong>Department:</strong>  </td><td> <?php echo $emp->department; ?></td>
                
               <td class="hidden-480" style=" padding-left:100px !important" ><strong>Present Days/Holidays:</strong>   </td><td > <?php echo (date('t', $salaryFrom )-$TmLeave) ?>/<?php echo  $noHoliday; ?></td>
               </tr>
               <tr>
               <td class="hidden-480"><strong>Designation:</strong> </td><td> <?php echo $emp->designation; ?></td>
               
               <td class="hidden-480" style=" padding-left:100px !important" ><strong>Leave/Half Day:</strong>  </td><td > <?php echo $TmLeave ?>/<?php echo $halfday; ?></td>
               </tr>
               <tr>
               <td class="hidden-480"><strong>Pan No.</strong> </td><td><?php if($emp->panno == '' || $emp->panno ==null){echo 'N/A';} else{ echo $emp->panno;} ?></td>
              
               <td class="hidden-480" style=" padding-left:100px !important" > <strong>Paid Date :</strong></td><td > <?php echo  date('d-M-Y')?></td>
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
               <td class="hidden-480"><?php echo number_format($salary, 2, '.', ','); ?></td>
               <td class="hidden-480"><?php echo  number_format($salary, 2, '.', ','); ?></td>
               <td class="hidden-480">Income Tax</td>
               <td class="hidden-480"><?php echo $incometax; ?></td>
               </tr>
               
               
               <tr>
               <td class="hidden-480">Car All</td>
               <td class="hidden-480"><?php echo $carAll; ?></td>
               <td class="hidden-480"><?php echo $carAll; ?></td>
               <td class="hidden-480">P.F.</td>
               <td class="hidden-480"><?php echo $pf; ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Duty Travel</td>
               <td class="hidden-480"><?php echo $duttyTravel; ?></td>
               <td class="hidden-480"><?php echo $duttyTravel; ?></td>
               <td class="hidden-480">VPF</td>
               <td class="hidden-480"><?php echo $vpf; ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Conveyance</td>
               <td class="hidden-480"><?php echo $conveyance; ?></td>
               <td class="hidden-480"><?php echo $conveyance; ?></td>
               <td class="hidden-480">ESI</td>
               <td class="hidden-480"><?php echo $esi; ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Medical</td>
               <td class="hidden-480"><?php echo $medical; ?></td>
               <td class="hidden-480"><?php echo $medical ?></td>
               <td class="hidden-480">Leaves Amount</td>
               <td class="hidden-480"><?php echo number_format($LeaveAmount, 2, '.', ','); ?></td>
               </tr>
               
               <tr>
               <td class="hidden-480">Bonus</td>
               <td class="hidden-480"><?php echo number_format($bonus, 2, '.', ','); ?></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               </tr>
               
                <tr>
               <td class="hidden-480">Insentive</td>
               <td class="hidden-480"><?php echo number_format($insentive, 2, '.', ','); ?></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               </tr>
                <tr>
               <td class="hidden-480">Paid Leave Amount</td>
               <td class="hidden-480"><?php echo number_format($paidLeaveAmount, 2, '.', ','); ?></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               <td class="hidden-480"></td>
               </tr>
               
                              <!--Grand total-->
               <tr style="font-weight:bold !important">
               <td  class="hidden-480" >Gross Earning (in Rs. ): </td>
               <td colspan="2"><?php echo number_format($earning, 2, '.', ','); ?></td>
              
               <td class="hidden-480" >Gross Deduction(in Rs):  </td>
               <td colspan=""><?php echo number_format($deduction, 2, '.', ','); ?></td>
              
               
               </tr>
               
               <!--End total-->

               
               </table>
               </td>
               
               </tr>
               
               <!--/ salary Information-->
               
               
               
               
               <!--net amount -->
               <tr style="font-weight:bold !important">
               <td class="hidden-480"  style="padding-left:16px !important">Net Amount(in Rs.): </td>
               <td colspan="5"><?php echo number_format($netsalary, 2, '.', ','); ?></td></td>
              
               </tr>
               
               <!-- / net amount-->
               
               <!-- Net Amount in word -->
               
               <tr style="font-weight:bold !important">
               <td class="hidden-480" style="padding-left:16px !important">Net Amount (in Words):</td>
               <td class="hidden-480" colspan="5"><?php echo $words; ?> Only</td>
               </tr>
               <!-- End -->
               
               <tr>
               <td class="hidden-480" colspan="6" style="text-align:center">This a system generated payslip, does not require any signature and/Or company seal.</td>
               </tr>
               
               </table>
                </div>
                <!--Insert Feild in dataBase-->
                <input type="hidden" value="<?php echo $id; ?>" name="EmpId" />
                <input type="hidden" value="<?php echo $netsalary; ?>" name="netSalary" />                
                <input type="hidden" value="<?php echo date('Y-m',$salaryTo); ?>" name="pay_month" />
                <input type="hidden" value="<?php echo $leave; ?>" name="leave" />
                <input type="hidden" value="<?php echo $halfday; ?>" name="halfday" />
                <input type="hidden" value="<?php echo $bonus; ?>" name="bonus" />
                <input type="hidden" value="<?php echo $insentive; ?>" name="insentive" />
                <input type="hidden" value="<?php echo $carAll; ?>" name="carAll"/>
                <input type="hidden" value="<?php echo $duttyTravel; ?>" name="dutyTravel" />
                <input type="hidden" value="<?php echo $conveyance; ?>" name="conveyance" />
                <input type="hidden" value="<?php echo $medical; ?>" name="medical" />
                <input type="hidden" value="<?php echo $incometax; ?>" name="incometax" />
                <input type="hidden" value="<?php echo $pf; ?>" name="pf"/>
                <input type="hidden" value="<?php echo $vpf; ?>" name="vpf" />
                <input type="hidden" value="<?php echo $esi; ?>" name="esi" />
                <input type="hidden" value="<?php echo $LeaveAmount; ?>" name="leaveAmount" />
                <input type="hidden" value="<?php echo $salary; ?>" name="basic" />
                <input type="hidden" value="<?php echo $paidLeaveAmount; ?>" name="paidLeaveAmount" />
                <input type="hidden" value="<?php echo $emp->paidLeave; ?>" name="paidLeaveYN" />
                 <input type="hidden" value="<?php echo $noHoliday; ?>" name="holiday"  />
                
                <div class="form-actions">
                <button type="submit" class="btn blue" id="submit1" ><i class="icon-ok"></i> Pay Salary</button>
                        <label class="btn mini green" onclick="pop_print();">Print</label>       
              </div>
              </form>
              
                           
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
