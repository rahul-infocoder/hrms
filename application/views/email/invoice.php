<html>
<head>
<title>Invoice</title>

<style type="text/css">
table{
	width:100%;
}
table tr td {
	padding-top:10px;
	padding-left:10px;
	border-bottom:1px solid #eee;
	
}

table.price tr{
	
	text-align:right !important

}
.slipPaid{
	
  position: absolute; right: 0px;
  top: 80px;
  width:150px;
  -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
</head>
<body>
<div style="position:relative;">
<h2 style="font-weight: bold;">Company Detail</h2>
<table class="Vdetail">
<tr>
<td>
<img src="<?php echo base_url() ?>upload/profileimages/<?php echo $cData->logo; ?>" alt="logo" />
</td>
<td>
<?php echo $xname; ?> <br/>
<?php echo $cData->byCompAddress; ?>,<br />
			 <?php echo $cData->byCompCity ?>, <?php echo $cData->byCompState ?>, <?php echo $cData->byCompCountry ?>, <?php echo $cData->byCompZip; ?>
             <br />
             <?php echo $cData->byCompEmail; ?> <br />
             <?php echo $cData->byCompPhone; ?>
</td>
</tr>









<tr>
<td><h2 style="font-weight: bold;">Invoice Information</h2></td>
<td><h2 style="font-weight: bold;">Invoice To</h2></td>
</tr>
<tr>

<td>
<strong> Invoice#: </strong> <?php echo $cData->invoiceNo; ?> <br />
          <strong> Invoice Date: </strong> <?php echo date('d-M-Y',$cData->date); ?><br />
         <strong> Due Date: </strong> <?php echo date('d-M-Y',$cData->dueDate); ?>
</td>


<td>
<strong> <?php echo $cData->cName; ?>(<?php echo $cData->companyName; ?>)</strong> <br />
			<?php echo $cData->cAddress; ?><br />
            <?php echo $cData->cCity; ?>,  <?php echo $cData->cState; ?>, <?php echo $cData->cCountry; ?> ,<?php echo $cData->cZip; ?><br />
            <?php echo $cData->cEmail; ?><br />
            <?php echo $cData->cMobile ?>
</td>

</tr>


</table>
<div class="coverd">
<table class="price">

<tr>
<td><h2 style="font-weight: bold;text-align:left;">Description </h2></td>
<td><h2 style="font-weight: bold;text-align:right;"> Amount(in <?php echo $cData->currency;?>)</h2></td>
</tr>

 <?php 
		$pList = Customer::invoiceProjectDetail($cData->Iid);
		 foreach($pList->result() as $row){
		  ?>
          <tr style="text-align:right">
          <td style="text-align:left"><?php echo $row->desc; ?></td>
          
          <td>
          <?php echo number_format($row->pAmount,2,'.',','); ?>
          </td>
          
          </tr>
          
          
          <?php } ?>
          
          <tr style="text-align:right">
          <td>
         <strong> Sub Total: </strong>
          </td>
          
          <td>
        <strong>  <?php echo number_format(($cData->grandTotal-($cData->serviceTax+$cData->EducationTax+$cData->SecondaryTax)), 2, '.', ','); ?></strong>
          </td>
          
          </tr>
          
           <?php if($cData->serviceTax >0 ){ ?>
          <tr style="text-align:right">
          <td><strong> Service Tax(<?php echo  round(($cData->serviceTax*100)/($cData->grandTotal -$cData->serviceTax)); ?>%)</strong></td>
          <td>     <?php echo number_format($cData->serviceTax,2,'.',','); ?> </td>
          </tr>
          <?php }?>
          
           <?php if($cData->EducationTax >0 ){ ?>
          <tr style="text-align:right">
          <td><strong>Education Cess(<?php echo  round(($cData->EducationTax*100)/($cData->grandTotal -$cData->EducationTax)); ?>%)</strong></td>
          <td><?php echo number_format($cData->EducationTax,2,'.',','); ?></td>
          </tr>
          <?php } ?>
          
          
          <?php if($cData->SecondaryTax >0){ ?>
          <tr style="text-align:right">
          <td> <strong>Secondary and Higher Education Cess(<?php echo  round(($cData->SecondaryTax*100)/($cData->grandTotal -$cData->SecondaryTax)); ?>%)</strong>
</td>
          <td>      <?php echo number_format($cData->SecondaryTax,2,'.',','); ?> </td>
          </tr>
          <?php } ?>
          
          
          
          <?php if($cData->discount >0){ ?>
          <tr style="text-align:right">
          <td><strong>Discount (<?php echo round(($cData->discount*100)/$cData->grandTotal) ?>%)</strong></td>
          <td><?php echo number_format($cData->discount,2,'.',','); ?></td>
          </tr>
          <?php } ?>
          
          <tr style="text-align:right">
          <td><strong> Grand  Total(in <?php echo $cData->currency; ?>)</strong></td>
          <td><strong><?php echo number_format(round($cData->total),2,'.',',');  ?>  </strong></td>
          </tr>
           <?php
			 $Advance = Customer::invoiceAdvance($cData->Iid,$cData->clientId);
			 //echo $balance = ($dueAmount-$paidAmount);		 			  
			  
				?>
                
                <?php if($Advance >0 && $Advance != round($cData->total)){ ?>
           <tr style="text-align:right">
          <td><strong> Paid Amount </strong></td>
          <td><strong><?php echo number_format($Advance,2,'.',',');  ?>   </strong></td>
          </tr>
          
           <tr style="text-align:right">
          <td><strong> Unpaid Amount </strong></td>
          <td><strong><?php echo number_format((round($cData->total)-$Advance),2,'.',',');  ?>    </strong></td>
          </tr>
          
                
             <?php }?>   
       

</table>
</div>
              <br />
               <br />
               <br />
         <?php 
			  if($Advance == round($cData->total))
			  {
				  
			    echo '<center><img src="'.base_url('images/icon/paid.png').'" alt="" width="200" /></center>';	  
			 }
			 else if($Advance < round($cData->total))
			 {
				  echo '<center><img src="'.base_url('images/icon/unpaid.png').'" alt="" width="200" /></center>';	
			 }
			  ?>

              <br />
               <br />
               <br />
               <h2 style="color: #005B5B;font-weight: bold;text-align: center;">Thank You</h2>
               </div>
 </body>
</html>
           
               