<html>
<head>
<title><?php echo $title; ?></title>


<style type="text/css" media="print">
  #myFooter, #myHeader
  {
    display: none;
  }
  </style>
<style type="text/css">
@media print
    {
    	.form-actions{ display: none; }
    	
    }
img { border:none;}
table{
	border:1px solid #ccc;
}
table tr td{
	border-top:1px solid #ccc;
	/*border-bottom:1px solid #ccc;*/
	padding:20px;
	text-align:left;
	
	}
	
	 table tr th{
		 border-top:1px solid #ccc;
	/*border-bottom:1px solid #ccc;*/
	padding:10px;
	padding-left:20px;
	text-align:left;
		 
	 }
	
</style>
</head>
<body>
<div id="print">
<table  width="95%" id="msgTable">

<!--Company Details-->
<tr>
<tr>
<td colspan="2" style="border:none; padding:10px"><h2 align="center" style="margin: 0 auto; font-size:22px; ">Payment Receipt </h2></td>
</tr>
<td >
<img src="<?php echo base_url(); ?>upload/profileimages/<?php echo $payData->logo; ?>"
</td>
<td>
<?php echo $payData->comName; ?> <br/>

<?php echo $payData->comAddress;?><br />
<?php echo $payData->comCity ?>, <?php echo $payData->comState ?>, <?php echo $payData->comCountry; ?>, <?php echo $payData->comZip ?><br />
<?php echo $payData->comEmail; ?><br/>
<?php echo $payData->comPhone; ?>


</td>
</tr>

<!--End Company Details-->


<!-- Pay Slip And Client details-->
<tr>
<th>Payment Details	</th>
<th>Client Details</th>
</tr>
<tr>

<td>
<strong>Receipt#</strong> <?php echo $payData->srNo; ?>
<br />
<strong>Reference#</strong> <?php echo $payData->reference ?> <br />
<strong>Paid Date</strong> <?php echo date('d-m-Y',$payData->cpDate); ?> <br/>
<strong>Payment Method</strong> <?php echo $payData->payMethod; ?> <br />
<strong>Currency</strong> <?php echo $payData->payCurrency; ?>
</td>

<td>
<strong><?php echo $payData->companyName; ?> (<?php echo $payData->cusName; ?>)</strong> <br/>
<?php echo $payData->cusAddress; ?> <br />
<?php echo $payData->cusCity; ?>, <?php echo $payData->cusState; ?>, <?php echo $payData->cusCountry; ?>, <?php echo $payData->cusZip; ?><br />
<?php echo $payData->cusEmail; ?><br />
<?php echo $payData->cusMobile;  ?>

</td>

</tr>

<!-- End Pay Slip -->


<tr>
<th>Project Name</th><th style="text-align:right; padding-right:20px;">Amount</th>

</tr>
<tr>
<td><?php echo Customer::projectIdToname($payData->pid); ?></td>
<td style="text-align:right"><?php echo $payData->amount; ?> <?php echo $payData->payCurrency; ?></td>
</tr>
<tr>
<td colspan="2">
<p align="center">THIS A SYSTEM GENERATED PAYMENT RECEIPT, DOES NOT REQUIRE ANY SIGNATURE AND/OR COMPANY SEAL.</p> 
</td>
</tr>

</table>
</td>
<?php if(!isset($emailSendLoad)) {?>
 
<div class="form-actions">
               <a href="javascript:window.print()">Print</a> | <a href="<?php echo site_url('customers/emailPaySlip/'.$payData->payId) ?>">Send Email</a>
              </div>
              <?php } ?>
              
              

</body>



</html>