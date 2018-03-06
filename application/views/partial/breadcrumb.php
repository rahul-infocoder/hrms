<ul class="breadcrumb">
  <li> <i class="icon-home"></i><?php echo anchor(base_url(),'Home');?>
  
 <?php  $segs = $this->uri->segment_array(); 
$breadURL = '';
foreach ($segs as $segment)
{
	$breadURL .=  $segment.'/';
	?>
  <i class="icon-angle-right"></i> </li> <li> <?php echo anchor($breadURL, $segment);?>
<?php 
}
  ?>
</ul>