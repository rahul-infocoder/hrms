<?php $this->load->view('partial/header');?>
<style type="text/css">
label.error{
	display:none !important
}
.error{
	border:1px solid red !important;
}
</style>
<h3 class="page-title"> Add Customer </h3>
<?php $this->load->view('partial/breadcrumb');?>


</div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12">
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
    
    <?php if(validation_errors()){
?>
  <div class="alert alert-error">
    <button class="close" data-dismiss="alert"></button>
    <span><?php echo validation_errors();?></span> </div>
  <?php }?>
    <div class="tabbable tabbable-custom boxless">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title">
              <h4><i class="icon-reorder"></i>Add Customer</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
            
            
      
            
             <table class="table">
             <tr>
             <th colspan="6">Client Detail: </th>
             </tr>
             <tr>
             <td><strong>Name</strong> </td><td><?php echo $cData->name; ?></td>
             <td><strong>Email</strong> </td><td><?php echo $cData->email; ?></td>
             <td><strong>Mobile </strong></td><td><?php echo $cData->mobile; ?></td>             
             </tr>
             <tr>
             <td><strong>Address </strong></td>
             <td colspan="5">
             <?php echo $cData->address; ?>
             </td>
             
             </tr>
             
             <!--<tr>
             <th colspan="6">Company Detail: </th>
             </tr>
             
             <tr>
             <td>Logo</td><td></td>
             <td>Email </td><td></td>
             <td>Phone No</td><td></td>
             
             </tr>
             
             <tr>
             <td>Address </td>
             <td colspan="5">
             
             </td>
             
             </tr>-->
             
             
             </table>
             
             <?php echo form_open('customers/saveInvoice',array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
          <div id="mainF">
           <div class="row-fluid" style="margin-top:30px; margin-bottom:30px; border:1px solid #eee; padding-bottom:20px; padding-top:20px; border-left:none; border-right:none;">
            <div class="span1"><strong>Project</strong></div>
           
                <div class="span3">
                  
                   <?php $project = Customer::ProjectSelectorMulti($cData->id); 
				   echo $project;
				   ?>
                   
                </div>
                <?php $curr = Customer::findClienCurrency($cData->id); ?>
                <div class="span1"><strong>Currency</strong></div>
                <div class="span2">
                <input type="hidden" name="currency" value="<?php echo $cData->currency; ?>"  />
                <?php echo $cData->currency; ?>
               <!-- <select name="currency" id="currency" class="m-wrap span12 required">
                <option value="">Select</option>
                <option value="USD" <?php if($curr){if($curr == 'USD'){ echo ' selected="selected"';}} ?> >USD</option>
                <option value="INR"  <?php if($curr){if($curr == 'INR'){ echo ' selected="selected"';}} ?>>INR</option>
                <option value="GBP"  <?php if($curr){if($curr == 'GBP'){ echo ' selected="selected"';}} ?> >GBP</option>
                <option value="AUD"  <?php if($curr){if($curr == 'AUD'){ echo ' selected="selected"';}} ?> >AUD</option>
                <option value="CAD"  <?php if($curr){if($curr == 'CAD'){ echo ' selected="selected"';}} ?> >CAD</option> 
                <option value="SAR"  <?php if($curr){if($curr == 'SAR'){ echo ' selected="selected"';}} ?>>SAR</option>
                <option value="AED"  <?php if($curr){if($curr == 'AED'){ echo ' selected="selected"';}} ?> >AED</option>
                
                </select>-->
                </div>
                
                <div class="span2"><strong>Due Date</strong></div>
                <div class="span3">
                <input type="text" name="due" class="m-wrap span12 required" id="due" style="width:90px !important;"  />
                (m/d/Y)
                </div> 
                
                
                <div class="span2"><strong>Invoice Date</strong></div>
                <div class="span3">
                <input type="text" name="incD" class="m-wrap span12 required" id="incD" style="width:90px !important;"  />
                (m/d/Y)
                </div> 
                          
                
                
                
                </div>
          
          <div class="row-fluid">
                
                <div class="span6" style="text-align:center">
             
               <b style="font-size:14px;">  Service Description </b>
                </div>
                <div class="span6" style="text-align:center; position:relative">
               <b style="font-size:14px;"> Amount(in Rs)</b>
              
              <label style="display:inline; position:absolute; top:2px; right:5px;" class="btn mini green" id="add">Add</label>
                </div>
                
                </div>
          
         
         
                <!--/span-->
                <div class="row-fluid">
                <div class="span6">
                 
                      
                      <textarea name="des[]" id="des" class="m-wrap span12 required" style="height:35px !important"></textarea>
                 </div>
                <!--/span--> 
                <div class="span6">
                  
                      <input type="text" name="amount[]" class="m-wrap span12 required number" id="amount" maxlength="10" />
                    
                </div>
                <!--/span--> 
                
              </div>
              <!--/row-->
              
              </div>
              <table style="margin-top:20px; margin-bottom:20px;" width="100%">
            
              <tr>
              <td>
              
              <table>
              <tr>
              <td>Tax Type</td>
              <td>
              <select name="taxType" id="taxType">
              <option value="P">Perc(%)</option>
              <option value="A">Amount</option>
              </select>
              </td>
              </tr>
              <tr>
              <td>Service Tax</td>
              <td>
              <input type="text" name="serviceTax" id="serviceTax" value="0" class="required number" />
              <input type="hidden" name="sTax" id="sTax" />
              </td>
              </tr>
              <tr>
              <td>Education Tax</td>
              <td>
              <input type="hidden" name="eTax" id="eTax" />
              <input type="text" name="educaTax" id="educaTax" value="0" class="required number" />
              </td>
              </tr>
              
               <tr>
              <td>Secondary  Tax</td>
              <td>
              <input type="hidden" name="secTax" id="secTax" />
              <input type="text" name="seconTax" id="seconTax" value="0" class="required number" />
              </td>
              </tr>
              </table>
              </td>
              
              <td>
              
              <table>
               <tr>
              <td>Grand Total</td><td>
              <input type="text" name="gtotal" id="gtotal" readonly="readonly" value="0" />
             <input type="hidden" name="hgrandTotal" id="hgrandTotal"/>
              </td>
              </tr>
              <tr>
              <td>Discount</td>
              
              <td>
              <select name="discountType" id="discountType" style="width:100px;">
              <option value="P">Perc(%)</option>
              <option value="A">Amount</option>
              </select>
              <input type="text" name="discount" id="discount" value="0" style="width:100px" class="required number" />
              <input type="hidden" name="hDiscount" id="hDiscount"/>
              </td>
              </tr>
              <tr>
              <td>Total</td><td><input type="text" name="total" id="total" value="0" readonly="readonly" />
              <input type="hidden" name="hTotal" id="hTotal"/>
              </td>
              </tr>
              
              </table>
              </td>
              </tr>
              
              </table>
              <input type="hidden" name="Cid" value="<?php echo $cData->id; ?>"/>
              <div class="form-actions">
                <button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn">Cancel</button>
              </div>
          </div>
          </form>
             
              
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
<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script> 
<!-- ie8 fixes --> 
<!--[if lt IE 9]>
   <script src="<?php echo base_url();?>assets/js/excanvas.js"></script>
   <script src="<?php echo base_url();?>assets/js/respond.js"></script>
   <![endif]--> 
<script type="text/javascript" src="<?php echo base_url();?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-daterangepicker/date.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 

<script src="<?php echo base_url();?>assets/js/app.js"></script> 

<script>
jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			
			
			
			
		});
		
		
		 $(function() {
	$( "#due" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
	
	$( "#incD" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
			 
		 });
		  
	  	
   </script>
   
   <script type="application/javascript">
   	 
   $(document).ready(function(e) {
	   
	   $("#form_est").validate();
    
	var field = '<div class="row-fluid"><div class="span6"><textarea name="des[]" id="des" class="m-wrap span12 required" style="height:35px !important; "></textarea></div><!--/span--><div class="span6" style="position:relative"><input type="text" name="amount[]" maxlength="10" class="m-wrap span12 required number" id="amount" /> <label style="display:inline; position:absolute; top:2px; right:5px;" class="btn mini red" id="remove">Remove</label></div><!--/span--></div><!--/row-->';
			  
			  
			  $('#add').click(function(){
				  
				 $('#mainF').append(field);
			  });
			  
			  $('#remove').live('click',function(){
				  
				 $(this).parent('.span6').parent('.row-fluid').remove();
				 TotalAmount();
				// alert('kk');
			  });
			  
			
			  $('#amount').live('blur',function(){
				
						TotalAmount();
						
			  });
			  
			  $('#discount').blur(function(){
				 TotalAmount();
				  
				  });
				   $('#serviceTax').blur(function(){
				 TotalAmount();
				  
				  });
				   $('#educaTax').blur(function(){
				 TotalAmount();
				  
				  });
				   $('#seconTax').blur(function(){
				 TotalAmount();
				  
				  });
				  
				  $('#taxType').change(function(){
					  TotalAmount();
					  });
					  
					   $('#discountType').change(function(){
					  TotalAmount();
					  });
			  
			  
			  function TotalAmount()
			  {
				   var Tamount =0;
				   $('input[id=amount]').each(function(index,val){
					   
					   $val = $(this).val();
					   if($val=='')
					   {
						 $val =0;   
						}
							Tamount += parseFloat($val);
							
						});
						
						//alert($('#taxType').val());
						var serviceTaxt = $('#serviceTax').val();
						var educationTaxt = $('#educaTax').val();
						var seconderyTax = $('#seconTax').val();
						parseFloat(serviceTaxt);
						parseFloat(educationTaxt);
						parseFloat(seconderyTax);
						
						//alert(serviceTaxt);
						if($('#taxType').val()=='P')
						{
							serviceTaxt = (Tamount*serviceTaxt)/100;
							educationTaxt = (Tamount*educationTaxt)/100;
							seconderyTax = (Tamount*seconderyTax)/100;
						}
						
						var Tax = parseFloat(serviceTaxt)+parseFloat(educationTaxt)+parseFloat(seconderyTax)
						
						var GrandTotal = parseFloat(Tamount)+parseFloat(Tax);
						
						var discount = $('#discount').val();
						
						if($('#discountType').val() =='P')
						{
						  	discount = (GrandTotal*discount)/100;
						}
						
						var total = GrandTotal-discount;
						
						$('#gtotal').val(GrandTotal);
						$('#total').val(total);
						
						$('#sTax').val(serviceTaxt);
						$('#secTax').val(seconderyTax);
						$('#eTax').val(educationTaxt);
						$('#hgrandTotal').val(GrandTotal);
						$('#hDiscount').val(discount);
						$('#hTotal').val(total);						
						
						
				  
			  }
			  $.validator.prototype.checkForm = function () {
                //overriden in a specific page
                this.prepareForm();
                for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
                    if (this.findByName(elements[i].name).length != undefined && this.findByName(elements[i].name).length > 1) {
                        for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                            this.check(this.findByName(elements[i].name)[cnt]);
                        }
                    } else {
                        this.check(elements[i]);
                    }
                }
                return this.valid();
            }
			  
	
});
   
   </script>
   <?php $this->load->view('partial/footer');?>
   