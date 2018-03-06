<script type="text/javascript" charset="utf-8" src="<?php echo base_url('assets/data-tables/data/media/js/jquery.dataTables.js'); ?>"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url('assets/data-tables/data/extras/TableTools/media/js/ZeroClipboard.js');?>"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url('assets/data-tables/data/extras/TableTools/media/js/TableTools.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){   


$('#notiRead').click(function(){
	
	
	 $read = $(this).find('span.badge').text();
	 
	 if($read >0)
	 {
	$.ajax({
				 type: "POST",
				 url: '<?php echo site_url();?>'+"/notification/ReadNotice", 
				 data: {id: 'readKrleMereYaar'},
				 dataType: "text",  
				 cache:false,
				 success: 
					  function(data){
						
					  }
		
			 
		 });
	 }
	});
    
	$("#global_company").change(function()
    {     
	          $val =$(this).val();
			  if($val !='')
			  {
			 $.ajax({
				 type: "POST",
				 url: '<?php echo base_url();?><?php echo index_page();?>'+"/admin/globalCompany", 
				 data: {id: $(this).val()},
				 dataType: "text",  
				 cache:false,
				 success: 
					  function(data){
						location.reload(); 
					  }
		
			 
		 });
			  }
			  else
			  {
				  alert('Please Choose a Company');
			  }
		 
	
     });
	 
	
	 
 }); 
</script>
   <!--   <script type="text/javascript">
	jQuery(document).ready(function() {
	
				
					oTable = $('#example').dataTable({ "aLengthMenu": [
        [10,25, 50, 100, 200, -1],
        [10,25, 50, 100, 200, "All"]
    ], 
	


"iDisplayLength" : 50,
"bSort" : false


 }

);
		
		$('#msgTable').dataTable({
			"bPaginate": false,
			 "bSort" : false
		});
		});
	</script>-->
    
    <script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				$('#example').dataTable( {
					"sDom": 'T<"clear">lfrtip',
					"oTableTools": {
						"sSwfPath": "<?php echo base_url('assets/data-tables/data/extras/TableTools/media/swf/copy_csv_xls_pdf.swf'); ?>"
					},
					"aLengthMenu": [
        [10,25, 50, 100, 200, -1],
        [10,25, 50, 100, 200, "All"]
    ], 
	"iDisplayLength" : 50,
					"aaSorting": []
			 
				} );
				$('#msgTable').dataTable( {
					"sDom": 'T<"clear">lfrtip',
					"oTableTools": {
						"sSwfPath": "<?php echo base_url('assets/data-tables/data/extras/TableTools/media/swf/copy_csv_xls_pdf.swf'); ?>"
					},
					"bPaginate": false,
					"aaSorting": []
			 
				} );
				
				
				
				
			} );
		</script>

    

	<!-- BEGIN FOOTER -->
	<div class="footer">
		<?php echo date('Y');?> &copy; CPR ADMIN PANEL
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
</body>
<!-- END BODY -->
</html>