<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title"> Salary <small>View Monthly Salary</small> </h3>
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
        <h4><i class="icon-globe"></i>Salaries</h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a>  </div>
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
             
              <th>Employee Name</th>
              <th class="hidden-480">Working Days</th>
              <th class="hidden-480">Present Days</th>
              <th>Holidays</th>
              <th class="hidden-480">Halfdays</th>
              <th class="hidden-480">Leaves</th>
              
              <th>Deducted Salary</th>
              <th class="hidden-480">Net Salary</th>
              
               <th class="hidden-480">Month</th>
              <th class="hidden-480">Pay</th>
              
            </tr>
          </thead>
          <tbody>
         
            <?php foreach($salData->result() as $ilist){
		        // $id is Employee Id
				
				$id = $ilist->emid;
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
			/*$fullDaysLeaves = Adminmodel::getLeavesSpecificEmp($id)->row()->fulldays;
		     $halfday = Adminmodel::getLeavesSpecificEmp($id)->row()->halfdays;
			 if($halfday == '') { $halfday =0;	 }
			 if($fullDaysLeaves == ''){$fullDaysLeaves =0;}*/
				 /*End this month Full leave */
				
				
				
				/*Over Month leave with Sunday */
				/*if(Adminmodel::checkCrossLeave($id))
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
					 /*if(Adminmodel::OverMonthSunday($id))
								{
									$OverMonthsunday = Adminmodel::OverMonthSunday($id);
								}
							  else
								{
									
									 $OverMonthsunday=0;
								}*/
								
								
								/*End Over month Sunday */								
							
					

				 /*$thisMonthLeaveWithSunday = $fullDaysLeaves-$extraLeave; //This Month Full Leave With Sunday include
				
				 $thisMonthSunday = $Totalsunday-$OverMonthsunday; // In this value include this month sunday Only.
				
				 $leave = abs($thisMonthLeaveWithSunday-$thisMonthSunday); // in this value include Total leave of this month with out sunday
				
				$OverLeave = abs($extraLeave-$OverMonthsunday); // In this value include leave over this month.*/
				
				//due leave 				
				 //$dueLeave = Adminmodel::dueLeave($id);
								
				$holidayinLeave = Adminmodel::leaveInholiday($emp->id,$emp->cid);
				$leave = Adminmodel::employeeLeave($emp->id);
				$leave = $leave-$holidayinLeave;   //Total Leave include Over Month leave
				$TmLeave = $leave;
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
                
                 
                 
            <tr class="odd gradeX">
            
              <td ><?php echo anchor('admin/viewEmployeeRead/'.$ilist->emid,$ilist->contact_name); ?>
              
              </td>
              <td class="hidden-480"><?php echo date('t', $salaryFrom ); //echo $sl->working_days; // echo $last_pay_month;?></td>
              <td class="hidden-480"><?php echo abs(date('t', $salaryFrom )-$TmLeave);  ?></td>
               <th>
              <?php
			 $holidayList = $this->Adminmodel->findHolidayOfMonth($emp->id,$emp->cid);
			  echo count($holidayList);
			  
			  
		
			   
			   ?>
              </th>
              <td class="hidden-480"><?php echo $halfday;?></td>
              <td class="hidden-480"><?php echo $TmLeave; ?></td>
             
        <td style="text-align:right"><?php echo number_format( $deduction, 2, '.', ',');?></td>
              <td class="hidden-480" style="text-align:right"><?php echo number_format($netsalary, 2, '.', ',');?></td>
              
               <th class="hidden-480"><?php echo date('M-Y',$salaryFrom); ?></th>
              <td class="hidden-480"><?php echo anchor('admin/salarySlip/'.$ilist->emid, '<label class="btn mini green">View</label>');?></td>
            </tr>
            <?php 
} ?>
<tr>

<th style="border:none; border-top:1px solid #ccc;"></th>
<th style="border:none; border-top:1px solid #ccc;"></th>
<th style="border:none; border-top:1px solid #ccc;"></th>
<th style="border:none; border-top:1px solid #ccc;"></th>
<th style="border:none; border-top:1px solid #ccc;"></th>
<th style="border:none; border-top:1px solid #ccc;">Grand Total</th>
<th id="deducted" style="text-align:right;border:none; border-top:1px solid #ccc;"></th>
<th id="netSal" style="text-align:right; border:none; border-top:1px solid #ccc; border-left:1px solid #ccc;"></th>

<th style="border-top:1px solid #ccc; text-align:right;">

</th>
<th id="tSal" style="text-align:right; text-align:right; border:none; border-top:1px solid #ccc;"></th>
</tr>

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
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage('table_managed');
			App.init();
			var Deducted =0;
			var netSal = 0;
			$('#msgTable tr td:nth-child(7)').each(function(index, element) {
                Deducted += parseInt($(this).text().replace(',', ''));
				
            });
			$('#msgTable tr td:nth-child(8)').each(function(index, element) {
                netSal += parseInt($(this).text().replace(',', ''));
				
            });
			
			$('#deducted').text(Deducted+'.00');
			$('#netSal').text(netSal+'.00');
			
			var site = '<?php echo site_url('admin/viewMonthSalary'); ?>';
			$('#row').change(function(){
			       
					var row = $('#row').val();
					var uri =row;
					
					
					location.href = site+'/'+uri;
				
				});
			
			
		});
	</script> 
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
