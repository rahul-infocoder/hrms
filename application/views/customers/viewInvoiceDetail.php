<?php $this->load->view('partial/header');?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<style type="text/css">
.slip {
  position: absolute;
  right: 0px;
  top: 80px;
  width:150px;
  -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

</style>
<h3 class="page-title">  Invoice <small> Invoice</small> </h3>
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
    <div class="portlet box light-grey">
      <div class="portlet-title">
        <h4><i class="icon-globe"></i> <?php echo $cData->cName; ?>'s Invoice </h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
      </div>
      <div class="portlet-body">
        
        
        <div id="mainF" style="position:relative;">
        <h4><strong>Company Details</strong></h4>
         <div class="row-fluid" style="padding: 10px; border-bottom:1px solid #ccc; border-top:1px solid #ccc; width:auto">
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
          <div class="row-fluid" style=" width:auto">
                           <!--/span--> 
                <div class="span6" style="padding-left:10px;"> 
                <h4><strong>Invoice Information</strong></h4>
                </div>
                <div class="span6"> 
                <h4><strong>Invoice To</strong></h4>
                </div>
                
                </div>
          
            
           <div class="row-fluid" style="padding: 10px; border-bottom:1px solid #ccc; border-top:1px solid #ccc; width:auto">
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
        
          <div class="row-fluid" style="text-align:right !important; padding-left:10px ">
               
                <div class="span5" style="text-align:left;">
                
                 <b style="font-size:14px;" >   Description </b>
                 
                </div>
                <div class="span5" >
               <b style="font-size:14px;"> Amount(in <?php echo $cData->currency;?>)</b>
                </div>
               
                
                </div>
          
         <?php 
		$pList = Customer::invoiceProjectDetail($cData->Iid);
		 foreach($pList->result() as $row){
		  ?>
          <div class="row-fluid" style="text-align:right !important; padding-left:10px">
                
                
                <!--/span--> 
                  <div class="span5" style="text-align:left;">
                
                    <?php echo $row->desc; ?>
                      
                    
                </div>
                <!--/span--> 
                <!--/span-->
                <div class="span5">
                 <?php echo number_format($row->pAmount,2,'.',','); ?>
                    
                 </div>
                
              </div>
              <!--/row-->
              
              
              <?php } ?>
              
              
              <div class="row-fluid" style="text-align:right !important; border-top:1px solid #ccc; padding-left:10px;">
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
                <div class="row-fluid" style="text-align:right !important; padding-left:10px;">
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
                 <div class="row-fluid" style="text-align:right !important; padding-left:10px;">
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
                <div class="row-fluid" style="text-align:right !important; padding-left:10px;">
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
              <div class="row-fluid" style="text-align:right !important; padding-left:10px;">
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
                
                
                 <div class="row-fluid" style="text-align:right !important; padding-left:10px; border-top:1px solid #ccc;">
                           <!--/span--> 
                <div class="span8" > 
              
            <strong> Grand  Total(in <?php echo $cData->currency; ?>)</strong>
            
                </div>
                      
                      <div class="span2">
                <strong>      <?php echo number_format(round($cData->total),2,'.',',');  ?>  </strong>
                      </div>
                    
                </div>
                
                <?php if($Advance >0 && $Advance != round($cData->total)){ ?>
                <div class="row-fluid" style="text-align:right !important; padding-left:10px; border-top:1px solid #ccc;">
                           <!--/span--> 
                <div class="span8" > 
              
               <strong> Paid Amount</strong>
            
                </div>
                      
                      <div class="span2">
                      <strong>      <?php echo number_format($Advance,2,'.',',');  ?>  </strong>
                      </div>
                    
                </div>
                
                 <div class="row-fluid" style="text-align:right !important; padding-left:10px; ">
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
                
                <p align="center" style="margin-top:40px;">THIS A SYSTEM GENERATED INVOICE, DOES NOT REQUIRE ANY SIGNATURE AND/OR COMPANY SEAL</p>
               
               <br />
               <br />
               <br />
               <h2 style="color: #005B5B;font-weight: bold;text-align: center;">Thank You</h2>
             </div>
              <div class="form-actions">
                <label  class="btn mini green" id="print" onclick="pop_print();">Print</label>
                 <label  class="btn mini blue" ><a href="<?php echo site_url('customers/invoiceMail/'.$cData->Iid) ?>" >Send Email</a></label>
              </div>
<!--          </div>-->
          
          
          
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
			App.setPage("table_managed");
			App.init();
		});
		
		function pop_print(){
		
		var site = '<?php echo base_url(); ?>';
		//alert(site);
		var html = '<html><head>'+
               '<link href="'+site+'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />'+
               '</head><style type="text/css" > .table td ,.table th  {padding:2px !important; padding-left:8px !important; font-size:12px !important;} #cover{width:95%; margin:0 auto}  </style><body><div id="cover">'+jQuery('#mainF').html() +'</div></body></html>';
    w=window.open(null, 'Print_Page', 'scrollbars=yes');        
    w.document.write(html);
	//w.document.writeln(html);
	
    w.document.close();
    w.print();
}
		
	</script> 
<!-- END JAVASCRIPTS -->
<?php $this->load->view('partial/footer');?>
