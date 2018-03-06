<html>
<title><?php echo $title; ?></title>
<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<head></head>


<body style="padding:20px !important;">
<div id="txt"></div>
<table class="table table-striped table-bordered table-hover">
<tr>
<td> Report By: </td>
<td> <?php echo $Wreport->contact_name; ?></td>
</tr>
<tr>
<td>Date: </td>
<td><?php echo date('d-m-Y',$Wreport->reportdate); ?></td>
</tr>

<tr>
<td colspan="2">
<?php 

echo   $Wreport->report



 ?>
</td>
</tr>
<tr>
<td>Attachments</td>

<td>
              <?php
			  $Isext = array('txt','docx','xlsx','pdf','rar','zip','doc','xls');
				 $arr = explode('/',$Wreport->files);
				
				 if($Wreport->files !='')
				 {
				 for($i=0; $i<count($arr); $i++)
				 {
					 $extention = explode('.',$arr[$i]);
					 $v = count($extention);
					  $extention = $extention[$v-1];
					 $icon ='unknown';
					 for($j =0; $j < count($Isext); $j++)
					 {
						
						 if($Isext[$j] == $extention)
						 {
						$icon = 	 $extention;
						 }
						 
					 }
					  echo '<a href="'.base_url().'upload/report/'.$arr[$i].'"><img src="'.base_url().'images/icon/'.$icon.'.png" alt="'.$arr[$i].'" width="32" title="'.$arr[$i].'" /></a>';
					 
				 }
				 }
				 else 
				 {
				echo "No Attachment";	 
				 }
			  ?>
              
              </td>
</tr>

</table>

<h2>Comments </h2>

<table class="table table-striped table-bordered table-hover">

<?php foreach($comment->result() as $row): ?>
<tr>
<td><?php echo User::nameForReport($row->whois); ?></td>
<td><?php echo $row->comment; ?></td>
<td><?php echo date('d-M-Y h:i:s A',$row->dateTime) ?></td>
</tr>
<?php endforeach; ?>
</table>



</body>

</html>