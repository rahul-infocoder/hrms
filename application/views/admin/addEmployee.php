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

              <h4><i class="icon-reorder"></i> Add Employee</h4>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> 

             

              </div>

            </div>

            <div class="portlet-body form"> 

              <!-- BEGIN FORM--> 

              <?php echo form_open_multipart('admin/saveEmp/'.$id, array('id'=>'form_certificate', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

             

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

  <input type="hidden" name="id" value="<?php echo $id; ?>"/>

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label">Name</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="ename" value="<?php if(!empty($empData->contact_name)){ echo $empData->contact_name; } else { echo set_value("ename"); } ?>">

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label">Joining Date</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="doj" id="doj" readonly="readonly" placeholder="Date of joining" value="<?php echo set_value("doj");//echo ($id == -1) ? '' : date('m/d/Y', $empData->doj);?>">

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              <!--/row-->

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label">Company</label>

                    <div class="controls">

                 <!--     <input type="text" class="m-wrap span12" name="company" readonly="readonly" value="<?php echo $compData->name;?>">

                      <input type="hidden" name="cid" value="<?php echo $compData->id;?>">-->

                      <?php 

	  $cList = User::getCompanies();

	  echo form_dropdown('cid', array(''=>'--SELECT--') + $cList,'default','id=cid'); ?>

  

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Department</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="department" value="<?php echo set_value("department"); //$empData->department;?>">

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              <!--/row-->

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Designation</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="designation" value="<?php echo set_value("designation"); //$empData->designation; ?>">

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Gender</label>

                    <div class="controls">

                      <label class="radio">

                        <input type="radio" name="gender" value="M" <?php echo set_value("gender",$empData->gender) == 'M' ? 'checked="checked"' : '';?> />

                        Male </label>

                      <label class="radio">

                        <input type="radio" name="gender" value="F" <?php echo set_value("gender",$empData->gender) == 'F' ? 'checked="checked"' : '';?> />

                        Female </label>

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              <!--/row-->

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Email</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="email" id="email" value="<?php echo set_value("email");//$empData->contact_email;?>" >

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Contact Number</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="contact" id="contact" value="<?php echo set_value("contact");//$empData->phone_num;?>">

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              <!--/row-->

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Emergency Number</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="eno" id="eno" value="<?php echo set_value("eno");//$empData->emergency_number;?>" >

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Address</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="address" id="address" value="<?php if(isset($empData->uaddress)){ echo $empData->uaddress; } else{ echo set_value("address"); } ?>" >

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              <!--/row-->

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Date of Birth</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="dob"  id="dob" value="<?php echo set_value("dob"); //echo ($id == -1) ? '' : date('m/d/Y', $empData->dob); ?>">

                    (m/d/Y)

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Salary</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="salary" id="salary" value="<?php echo set_value("salary"); //$empData->salary; ?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              <!--/row-->

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label">Image</label>

                    <div class="controls">

                      <div class="fileupload fileupload-new" data-provides="fileupload">

                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo (trim($empData->image) == '' || is_null($empData->image) || ($empData->image == 0)) ? base_url().'upload/profileimages/blank.jpg' : base_url().'upload/profileimages/'.$empData->image; ?>" alt="" /> </div>

                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                        <div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>

                          <input type="file" class="default" name="userfile" />

                           <input type="hidden" name="pfile" value="<?php echo $empData->image;?>" />

                          </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>

                      </div>

                      <span class="label label-important">NOTE!</span> <span> Attached image thumbnail is

                      supported in Latest Firefox, Chrome, Opera, 

                      Safari and Internet Explorer 10 only </span> </div>

                  </div>

                </div>

                

                

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Pan No</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="panno" id="panno" value="<?php echo set_value("panno"); //$empData->panno;?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

                

              </div>

              

              

              

               <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Paid Leave</label>

                    <div class="controls">

                      <select name="paidLeave">

                      <option value="" >Select</option>

                      <option  value="Y" <?php echo set_select("paidLeave","Y"); //if($empData->paidLeave == 'Y'){echo ' selected="selected"';} ?>  >Yes</option>

                      <option value="N" <?php echo set_select("paidLeave","N");//if($empData->paidLeave == 'N'){echo ' selected="selected"';} ?> >No</option>

                      </select>

                    </div>

                  </div>

                </div>

                <!--/span--> 

                

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Bank A/c</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="bac" id="bac" value="<?php echo set_value("bac"); //echo $empData->bac; ?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

                

              </div>

              

              

              

              <div class="row-fluid">

                

                  <div class="control-group">

                    <label class="control-label" >Experience in months</label>

                    <div class="controls">

                    <!--  <input type="text" class="m-wrap span12" name="exp" id="exp" maxlength="5" value="<?php echo $empData->experience;?>" />-->

                 

                 <?php

				  $exp = $empData->experience;

				 $exp=explode('-',$exp);

				

				 ?>

                   <div style="float:left">

                    <select name="months" id="months">

                    <option value="">Months</option>

                    <option value="0" <?php echo set_select("months","0"); //if($exp[0]==0){echo 'selected="selected"';} ?>>00</option>

                    <option value="1" <?php  echo set_select("months","1"); //if($exp[0]==1){echo 'selected="selected"';} ?>>01</option>

                    <option value="2" <?php  echo set_select("months","2"); //if($exp[0]==2){echo 'selected="selected"';} ?>>02</option>

                    <option value="3" <?php  echo set_select("months","3"); //if($exp[0]==3){echo 'selected="selected"';} ?>>03</option>

                    <option value="4" <?php  echo set_select("months","4"); //if($exp[0]==4){echo 'selected="selected"';} ?>>04</option>

                    <option value="5" <?php  echo set_select("months","5"); //if($exp[0]==5){echo 'selected="selected"';} ?>>05</option>

                    <option value="6" <?php  echo set_select("months","6"); //if($exp[0]==6){echo 'selected="selected"';} ?>>06</option>

                    <option value="7" <?php  echo set_select("months","7"); //if($exp[0]==7){echo 'selected="selected"';} ?>>07</option>

                    <option value="8" <?php  echo set_select("months","8"); //if($exp[0]==8){echo 'selected="selected"';} ?>>08</option>

                    <option value="9" <?php  echo set_select("months","9"); //if($exp[0]==9){echo 'selected="selected"';} ?>>09</option>

                    <option value="10" <?php  echo set_select("months","10"); //if($exp[0]==10){echo 'selected="selected"';} ?>>10</option>

                    <option value="11" <?php  echo set_select("months","11"); //if($exp[0]==11){echo 'selected="selected"';} ?>>11</option>

                    </select>

                    </div>

                    <div style="float:left">

                     

                    <select name="years" id="years">

                    <option value="">Years</option>

                   <?php

				   for($i=0; $i<=50; $i++)

				   {$select='';

					   if($exp[1]==$i){$select= 'selected="selected"';}

					   echo '<option value="'.set_select("years",$i).'"'.$select.' >'.$i.'</option>';

					   

					}

				   

				   ?>

                    </select>

                  

                    </div>

                    </div>

                  

                </div>

                <!--/span-->

                

                </div>

                <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Password</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="password" id="password" value="<?php echo set_value("password"); //$empData->plain;?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

                

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Re-Password</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="re-password" id="re-password" value="<?php echo set_value("re-password"); //$empData->plain;?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

                

              </div>

         

              

              <!-- Some Important information-->

              <div class="control-group">

              <h3>Salary Details</h3>

              </div>

              <div class="row-fluid">

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >CarAll</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="carall" id="carall" value="<?php echo set_value("carall"); //$empData->carAll; ?>" />

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Conveyance</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="conveyance" id="conveyance" value="<?php echo set_value("conveyance"); //$empData->conveyance;?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

              

               <div class="control-group">

                    <label class="control-label" >Medical</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="madical" id="madical" value="<?php echo set_value("madical"); //$empData->medical;?>" />

                    </div>

                  </div>

             

                

                

              <div class="control-group">

              <h3>Deductions Details:</h3>

              </div>

              

              <div class="row-fluid">

               

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >Incometax</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="incometax" id="incometax" value="<?php echo set_value("incometax"); //$empData->incometax;?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

                 <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >P.F.</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="pf" id="pf" value="<?php echo set_value("pf"); //$empData->pf; ?>" />

                    </div>

                  </div>

                </div>

                <!--/span-->

              </div>

              

              

              <div class="row-fluid">

               

                <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >VPF</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="vpf" id="vpf" value="<?php echo set_value("vpf"); //$empData->vpf;?>" />

                    </div>

                  </div>

                </div>

                <!--/span--> 

                 <div class="span6">

                  <div class="control-group">

                    <label class="control-label" >ESI</label>

                    <div class="controls">

                      <input type="text" class="m-wrap span12" name="esi" id="esi" value="<?php echo set_value("esi"); //$empData->esi; ?>" />

                    </div>

                  </div>

                </div>

                <!--/span-->

              </div>

              

              <!--End-->

              <div class="control-group">

                    <label class="control-label" >Report Access:</label>

                    <div class="controls" id="accessCover">

                      <?php

					  if($id != -1)

					  {

					  

						   $AccessList = Employee::AceesList($id,$empData->cid);

						   

						  $AccessFor = Employee::AccessFor($id);

						  

						  $AccessFor = explode(',',$AccessFor);

						  

						  

						

						if($AccessList == true){

					 foreach(array_keys($AccessList) as $key)

					   {

						   $chk ='';

						   if($id != -1)

					  {

						   if(count($AccessFor) >0)

							  {

								  for($i =0; $i<count($AccessFor); $i++)

								  {

								        if($AccessFor[$i] == $key)

										{

											$chk  =' checked="checked"';

										}	  

								  }

								 

								  

							  }

					  }

							 

						   echo '<input type="checkbox" name="reportAccess[]" id="reportAccess" value="'.$key.'"'. $chk .' />'. $AccessList[$key];

						   

					   }

					   

						}

					  }

					  

					  ?>

                    </div>

                  </div>

               

              <div class="control-group">

             

                    <label class="control-label" >Status</label>

                    <div class="controls">

                      <select id="active" name="active">

                      <option value="">Select</option>

                      <option value="Y"  <?php echo set_select("active","Y"); //if(isset($empData->uActive)){if($empData->uActive =='Y'){echo ' selected="selected"'; }} ?> >Active</option>

                   <option value="N" <?php echo set_select("active","N"); //if(isset($empData->uActive)){ if($empData->uActive =='N'){echo ' selected="selected"'; } } ?> >Deactive</option>

                      

                      </select>

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

	</script> 

<script type="text/javascript" src="<?php echo site_url('js/jquery-ui.min.js');?>"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 

<script>

  $(function() {

    $( "#doj" ).datepicker({

      showOn: "button",

      buttonImage: "<?php echo base_url('images/calendar.gif');?>",

      buttonImageOnly: true

    });

	$( "#dob" ).datepicker({

      showOn: "button",

      buttonImage: "<?php echo base_url('images/calendar.gif');?>",

      buttonImageOnly: true

    });

	

	if($('#employeeType').val()=='A')

	{

	$('#companiesss').show(); 

	 if('<?php echo $this->session->userdata('user_type') ?>' != 'SA')

	  {

	

	$("input#companies").attr("disabled", true);

	  }

	

	}

	   

	   

	   $('#employeeType').change(function(){

		

	if($(this).val() == 'A')

	{

        $('#companiesss').show();        

     

	}

	else

	{

		 $('#companiesss').hide(); 

	}

	

	

    

     });

	 



		 

		 

	 

    	

  });

  </script>



<?php $this->load->view('partial/footer');?>

    <?php

	  if($id != -1 )

	  {?>

	   <script type="text/javascript">

	 //  $('select[name="cid"]').;

	   $('select[name="cid"] option[value="<?php echo $empData->cid; ?>"]').attr("selected","selected");

	  //alert(v);



	   </script>

	   

	   <?php }	  ?>

	   

       

       <script type="text/javascript">

$(document).ready(function(){   



    $("#cid").change(function()

    {     

	     var val = $(this).val();

		 

		  $.ajax({

				 type: "POST",

				 url: '<?php echo base_url();?><?php echo index_page();?>'+"/admin/AceesCompaniesEmployee", 

				 data: {id: $(this).val()},

				 dataType:'json',		

				 success: 

					  function(data){

						  $txt = '';

						$.each(data, function(index,value){

								//process your data by index, in example

								

								$update = '<?php echo $id ?>';

								if($update ==-1)

								{

								   

								  $txt += '<input type="checkbox" name="reportAccess[]" id="reportAccess" value="'+index+'"   />'+ value;

								}

								else

								{

									if($update != index)

									{

									$txt += '<input type="checkbox" name="reportAccess[]" id="reportAccess" value="'+index+'"  />'+ value;

									}

								}

							});

							

							

							$('#accessCover').html($txt);

							 $("input[type=checkbox]").uniform();

					  }

		

			 

		 });

	  

	  

	});

	

	

});

</script>

       