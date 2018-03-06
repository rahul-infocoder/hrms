<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (isset($title))?$title:'Invoice' ?></title>
<link rel="stylesheet" href="<?php echo base_url()?>pdfStyle/style.css" />

</head>

<body>
<div class="main">
<h4><strong>Company Details</strong></h4>
         <div class="row-fluid" style=" border-bottom:1px solid #ccc; border-top:1px solid #ccc;">
                           <!--/span--> 
                <div class="span6"> 
          
             <img src="<?php echo base_url() ?>upload/profileimages/<?php echo $cData->logo; ?>" alt="logo" />
           </div>
            <div class="span6"> 
             <strong><?php echo $cData->byCompName; ?> <br/></strong>
             <?php echo $cData->byCompAddress; ?>,<br />
			 <?php echo $cData->byCompCity ?>, <?php echo $cData->byCompState ?>, <?php echo $cData->byCompCountry ?>, <?php echo $cData->byCompZip; ?>
             <br />
             <?php echo $cData->byCompEmail; ?> <br />
             <?php echo $cData->byCompPhone; ?>
             
          </div>
          </div>
          <div class="row-fluid">
                           <!--/span--> 
                <div class="span6"> 
                <h4><strong>Invoice Information</strong></h4>
                </div>
                <div class="span6"> 
                <h4><strong>Invoice To</strong></h4>
                </div>
                
                </div>
          
            
           <div class="row-fluid" style=" border-bottom:1px solid #ccc; border-top:1px solid #ccc;">
                           <!--/span--> 
                <div class="span6"> 
           <strong> Invoice#: </strong> <?php echo $cData->invoiceNo; ?> <br />
          <strong> Invoice Date: </strong> <?php echo date('d-M-Y',$cData->date); ?><br />
         <strong> Due Date: </strong> <?php echo date('d-M-Y',$cData->dueDate); ?>
           
          </div>
            
            <div class="span6"> 
           <strong><?php echo $cData->companyName; ?> (<?php echo $cData->cName; ?> )</strong> <br />
			<?php echo $cData->cAddress; ?><br />
            <?php echo $cData->cCity; ?>,  <?php echo $cData->cState; ?>, <?php echo $cData->cCountry; ?> ,<?php echo $cData->cZip; ?><br />
            <?php echo $cData->cEmail; ?><br />
            <?php echo $cData->cMobile ?>
                        
         </div>
         </div>
        
          <div class="row-fluid" style="border-bottom:1px solid #ccc;">
               
                <div class="span6" style="text-align:left;">
                
                 <b>   Description </b>
                 
                </div>
                
                <div class="span6" style="text-align:right;" >
               <b> Amount(in <?php echo $cData->currency;?>)</b>
                </div>
               
                
                </div>
          
         <?php 
		$pList = Customer::invoiceProjectDetail($cData->Iid);
		 foreach($pList->result() as $row){
		  ?>
          <div class="row-fluid" >
                
                
                <!--/span--> 
                  <div class="span6" style="text-align:left;">
                
                    <?php echo $row->desc; ?>
                      
                    
                </div>
              
                  <div class="span6" style="text-align:right;">
                 <?php echo number_format($row->pAmount,2,'.',','); ?>
                    
                 </div>
                
              </div>
              <!--/row-->
              
              
              <?php } ?>
              
              
              <div class="row-fluid" style="text-align:right !important; border-top:1px solid #ccc; ">
                           <!--/span--> 
                <div class="span8" > 
                
             <strong>   Sub Total </strong>
               
                 </div>
                     
                      <div class="span2">
                <strong>    <?php echo number_format(($cData->grandTotal-($cData->serviceTax+$cData->EducationTax+$cData->SecondaryTax)), 2, '.', ','); ?>
                      </strong>
                      </div>
                    
                </div>
                
                <?php if($cData->serviceTax >0 ){ ?>
                <div class="row-fluid" style="text-align:right !important; ">
                           <!--/span--> 
                <div class="span8"> 
               
                Service Tax(<strong><?php echo  round(($cData->serviceTax*100)/($cData->grandTotal -$cData->serviceTax)); ?>%</strong>)
                
                </div>
                      
                      <div class="span2">
                <strong>      <?php echo number_format($cData->serviceTax,2,'.',','); ?> </strong>
                      </div>
                    
                </div>
                <?php }?>
                <?php if($cData->EducationTax >0 ){ ?>
                 <div class="row-fluid" style="text-align:right !important; ">
                           <!--/span--> 
                <div class="span8"> 
                
                Education Cess(<strong><?php echo  round(($cData->EducationTax*100)/($cData->grandTotal -$cData->EducationTax)); ?>%</strong>)
                
                </div>
                      
                      <div class="span2">
                <strong>      <?php echo number_format($cData->EducationTax,2,'.',','); ?> </strong>
                      </div>
                    
                </div>
                <?php }?>
                
                <?php if($cData->SecondaryTax >0){ ?>
                <div class="row-fluid" style="text-align:right !important; ">
                           <!--/span--> 
                <div class="span8" > 
              
               Secondary and Higher Education Cess(<strong><?php echo  round(($cData->SecondaryTax*100)/($cData->grandTotal -$cData->SecondaryTax)); ?>%</strong>)
              
                </div>
                      
                      <div class="span2">
                <strong>      <?php echo number_format($cData->SecondaryTax,2,'.',','); ?> </strong>
                      </div>
                    
                </div>
                <?php } ?>
                
                <?php if($cData->discount >0){ ?>
              <div class="row-fluid" style="text-align:right !important; ">
                           <!--/span--> 
                <div class="span8" > 
                
               Discount (<strong><?php echo round(($cData->discount*100)/$cData->grandTotal) ?>%</strong>)
               
                </div>
                      
                      <div class="span2">
                <strong>      <?php echo number_format($cData->discount,2,'.',','); ?> </strong>
                      </div>
                    
                </div>
                <?php } ?>
                
                
                  <?php
			 $Advance = Customer::invoiceAdvance($cData->Iid,$cData->clientId);
			 //echo $balance = ($dueAmount-$paidAmount);		 			  
			  
				?>
                
                
                 <div class="row-fluid" style="text-align:right !important;  border-top:1px solid #ccc;">
                           <!--/span--> 
                <div class="span8" > 
              
            <strong> Grand  Total(in <?php echo $cData->currency; ?>)</strong>
            
                </div>
                      
                      <div class="span2">
                <strong>      <?php echo number_format(round($cData->total),2,'.',',');  ?>  </strong>
                      </div>
                    
                </div>
                
                <?php if($Advance >0 && $Advance != round($cData->total)){ ?>
                <div class="row-fluid" style="text-align:right !important;  border-top:1px solid #ccc;">
                           <!--/span--> 
                <div class="span8" > 
              
               <strong> Paid Amount</strong>
            
                </div>
                      
                      <div class="span2">
                      <strong>      <?php echo number_format($Advance,2,'.',',');  ?>  </strong>
                      </div>
                    
                </div>
                
                 <div class="row-fluid" style="text-align:right !important;  ">
                           <!--/span--> 
                <div class="span8" > 
              
               <strong> UnPaid Amount</strong>
            
                </div>
                      
                      <div class="span2">
                      <strong>      <?php echo number_format((round($cData->total)-$Advance),2,'.',',');  ?>  </strong>
                      </div>
                    
                </div>
                
                <?php } ?>
              <?php 
			  if($Advance == round($cData->total))
			  {
				  
			    echo '<div class="slip"><img src="'.base_url('images/icon/paid.png').'" alt="" /></div>';	  
			 }
			 else if($Advance < round($cData->total))
			 {
				  echo '<div class="slip"><img src="'.base_url('images/icon/unpaid.png').'" alt="" /></div>';	
			 }
			  ?>
                <div class="row-fluid">
                <p align="center" style="margin-top:40px;">THIS A SYSTEM GENERATED INVOICE, DOES NOT REQUIRE ANY SIGNATURE AND/OR COMPANY SEAL</p>
               
               <br />
               <br />
               <br />
               <h2 style="color: #005B5B;font-weight: bold;text-align: center;">Thank You</h2>
               </div>
               </div>
</body>
</html>