<?php $this->load->view('partial/header');?>
<h3 class="page-title"> Add Project </h3>
<?php $this->load->view('partial/breadcrumb');?>
<style type="text/css">
label.error{
	display:none !important
}
.error{
	border:1px solid red !important;
}
</style>

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
              <h4><i class="icon-reorder"></i>Add Project</h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
             <?php
			 
			 $id ='';
				 if(isset($Pdetail))
				 {
				    	 $id = '/'.$Pdetail->id;
				 }
				 
				 ?>
              <?php echo form_open_multipart('customers/saveProject'.$id,array('id'=>'form_est', 'autocomplete' => 'off', 'class' => 'form-horizontal form-bordered')); ?>
          
      
      
       <div class="control-group">
                  <label class="control-label">Client Name: </label>
                  <div class="controls">
              
                 <?php 
				 $cid ="default";
				 $disable =  "default";
				 if(isset($Pdetail))
				 {
				    	 $cid = $Pdetail->clienId;
						 $disable = 'disabled="disabled"';
				 }
				 if(Customer::clietListDropDown($cid))
				 {
				    echo Customer::clietListDropDown($cid,$disable);
				  }
				 ?>
                  </div>
                </div>
               
                <div class="control-group">
                  <label class="control-label">Project Name: </label>
                  <div class="controls">
                
                  
                   <input type="text" name="pName" id="pName" class="m-wrap span12"  value="<?php if(isset($Pdetail)){echo $Pdetail->pName;} ?>"    />
                    
                    </div>
                </div>
               
                <div class="control-group">
                  <label class="control-label" >Project Url</label>
                  <div class="controls">
                   <input type="text" name="pUrl" id="pUrl" class="m-wrap span12" value="<?php if(isset($Pdetail)){echo $Pdetail->pUrl;} ?>"  />
                 
                  </div>
                </div>
                  <div class="control-group">
                  <label class="control-label" >Estimated Time</label>
                  <div class="controls">
                  <input type="text" name="estiTime" id="estiTime" class="m-wrap span12" value="<?php if(isset($Pdetail)){echo $Pdetail->pEstitime;} ?>"  />
                  </div>
                </div>
                        
                        
                    
                
                
                 <div class="control-group">
                  <label class="control-label" >Payment Type </label>
                  <div class="controls">
                   
                   <select id="pType" name="pType" >
                   <option value="">Select</option>
                   <option value="M" <?php if(isset($Pdetail)){if($Pdetail->pType == 'M'){ echo ' selected="selected"';}} ?>>Monthly Payment</option>
                   <option value="O" <?php if(isset($Pdetail)){if($Pdetail->pType == 'O'){ echo ' selected="selected"';}} ?>>One Time Payment</option>                   
                   </select>
                  </div>
                </div>
                
                 <div class="control-group">
                  <label class="control-label" >Project Type </label>
                  <div class="controls" id="proCan">
                   
                   <select id="proType" name="proType">
                   <option value="">Select</option>
                   <option value="SEO" <?php if(isset($Pdetail)){if($Pdetail->proType == 'SEO'){ echo ' selected="selected"';}} ?>>SEO</option>
                    <option value="WEB DEVELOPMENT" <?php if(isset($Pdetail)){if($Pdetail->proType == 'WEB DEVELOPMENT'){ echo ' selected="selected"';}} ?>>Website Development</option>
                    <option value="SOFTWARE DEVELOPMENT" <?php if(isset($Pdetail)){if($Pdetail->proType == 'SOFTWARE DEVELOPMENT'){ echo ' selected="selected"';}} ?>>Software Development</option>   
                    <option value="OTHER" <?php if(isset($Pdetail)){if($Pdetail->proType == 'OTHER'){ echo ' selected="selected"';}} ?>>Other</option>          
                   </select>
                   
                   
                  </div>
                </div>
                
                  <div class="control-group">
                  <label class="control-label" >Price </label>
                  <div class="controls">
                   <input type="text" name="pPrice" id="pPrice" class="m-wrap span12" value="<?php if(isset($Pdetail)){echo $Pdetail->price;} ?>"  />
                   
                  </div>
                </div>
                
               <!-- <div class="control-group">
                  <label class="control-label" >Offer Price </label>
                  <div class="controls">
                    <input type="text" name="pOffer" id="pOffer" class="m-wrap span12" value="<?php if(isset($Pdetail)){echo $Pdetail->offer;} ?>"  />
                   
                  </div>
                </div>
                -->
                
                
                
                  <div class="control-group">
                  <label class="control-label" >Project Status </label>
                  <div class="controls">
                   
                 <select id="pStatus" name="pStatus">
                 <option value="" >Select</option>
                 <option value="R" <?php if(isset($Pdetail)){if($Pdetail->status == 'R'){ echo ' selected="selected"';}} ?>>Run</option>
                 <option value="C" <?php if(isset($Pdetail)){if($Pdetail->status == 'C'){ echo ' selected="selected"';}} ?>>Complete/Close</option>
                 <option value="H" <?php if(isset($Pdetail)){if($Pdetail->status == 'H'){ echo ' selected="selected"';}} ?>>Hold</option>
                 
                 </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Added Date</label>
                  <div class="controls">
                   
                   <input type="text" name="addDate" id="addDate" class="m-wrap span12" style="width:200px;" value="<?php if(isset($Pdetail)){echo date('m-d-Y',$Pdetail->AddDate);} ?>"  /> (M-d-Y)
                  </div>
                </div>
                
                 <div class="control-group">
                  <label class="control-label" >Project Requirment</label>
                  <div class="controls">
                    <textarea name="pDes" id="pDes" class="m-wrap span12"><?php if(isset($Pdetail)){echo $Pdetail->pDes;} ?></textarea>
                   
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" >Documents</label>
                  <div class="controls" id="creater">
                  <a href="javascript:void()" id="add">Add</a>
                    <div id="attach">
                    <input type="text" name="Dname[]" placeholder="Document Name" id="Dname"  />
                    <input type="file" name="file[]"    />
                   
                    
                    </div>
                  </div>
                  
                </div>
                
                <div class="form-actions">
                  <button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
                  <button type="reset" class="btn">Cancel</button>
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
         App.init();
		 $( "#addDate" ).datepicker({
      showOn: "button",
      buttonImage: "<?php echo base_url('images/calendar.gif');?>",
      buttonImageOnly: true
    });
		
		 
      });
	  $('#add').click(function(){
			 /*$file = $('<input/>').attr('type', 'file').attr('name', 'file[]');
			 $anchor = $('<a/>').attr('id','remove').text('Remove');*/
		$('#creater').append('<div id="attach"><input type="text" name="Dname[]" placeholder="Document Name" class="required"   /><input type="file" name="file[]" id="file" class="required"  /><a href="javascript:void()" id="remove" onclick="return Rremove(this);">Remove</a></div>');
			// $('#creater').find('#attach:last-child').find('input').rules('add', { required: true });
			 
		 });
		  function Rremove(id)
			{
				 $(id).parent().remove();
				 
			}
		  
	  	$("#form_est").validate({
		rules: {
			client:"required",
			pName:"required",
			pUrl:"required",
			estiTime:"required",
			pType:"required",
			proType:"required",
			pPrice:"required",
			pStatus:"required",
			pDes:"required"
			
		}
	});
	
	$('#proType').change(function(){
		  
		  if($(this).val()=='OTHER')
		  {
			  $('#proCan').html('<input type="text" class="m-wrap span12" name="proType" id="proType" />');
		  }
		  
		
		});
		
	"<?php if(isset($Pdetail)) {?>";
	
	var ll = "<?php echo $Pdetail->proType; ?>";
	if($('#proType').val() == '')
	{
		
	  $('#proType').remove();
	  $('#proCan').html('<input type="text" class="m-wrap span12" name="proType" id="proType" value="'+ll+'" />');	
	   
	
	}
	"<?php } ?>"	
		
		
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
	
   </script>
   
     <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  <?php $this->load->view('partial/footer');?>