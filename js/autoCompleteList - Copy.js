(function ($) {
    // local globals go here - referenced via closure

       
	   $dataList = [];
	  
	   $empty = false;
	   
	 
	   
	 
	   
	   /* check duplicate value */
	   
	   function loaderImg(at,url)
	   {
		   $(at).parent().append('<img alt="load" src="'+url+'" id="loadImg" class="loadImage" />');
	     }
		 function removeLoader()
		 {
		   $('img#loadImg').remove();	 
		}
		function checkDublicate(val,result)
		{
			//return true;
			var isPresent = false;
			var size = $("input[type='hidden'][id*="+result+"]:hidden").size();
			if(size != 0)
			{
			  $("input[type='hidden'][id*="+result+"]:hidden").each(function() {
                 //alert($(this).val());
				 if(val == $(this).val())
				 {
				   isPresent = true;	 
				 }
				 
              });
			  
			}
			else
			{
				return true;
			}
			
			if(isPresent == false)
			{
			 return true	
			}
			else
			{
			  return false;	
			}
			
			
		}
		
		/*End Duplicate*/
        
		/*find Data*/
		function FindData(data)
		{
		 	if(data.length >0)
			{  $empty = false;
			   $listing ='';
			   $.each(data, function (key, value) {
				   $listing += '<li id="listClick"><b id="ShowVal">'+value.name+'</b><input type="hidden" id="passKey" value="'+value.id+'" /></li>';
					
				});
				return $listing;
			}
			else
			{
				$empty = true;
			  return '<li id="notClick">No Data Found</li>';	
			 //alert('ok');
			}
			
		
			
		}
		
		/*End Find Data*/
		
		
		/**Add Data And Make listing**/
		
		function Listing(AddTo,Value,Class)
			{
				
				if($('ul#list').size() ==0)
				{
				AddTo.after('<ul id="list"></ul>');
				$( "#list" ).addClass(Class);
				}
				$('ul#list').fadeIn(200);
				
				$('#list').empty();
			    $( "#list" ).append(Value);
			}
			
			function searching(AddTo,Class,minm)
			{
				if($('ul#list').size() ==0)
				{
				AddTo.after('<ul id="list"></ul>');
				$( "#list" ).addClass(Class);
				}
				$('ul#list').fadeIn(200);
				$('#list').empty();
				
				$( "#list" ).append('<li id="notClick">Enter min '+minm+' Character</li>');
			}
		
	
		/**End Add Data**/
		
		function add(textBox,ResultClass,RemoveClass,multi)
		{
		       
		}
		
		function ClickList(textBox,ResultClass,RemoveClass,multi)
		{
			
		
		  $( "#list li#listClick" ).unbind( "click" );
		  		
			//unBindEvent('#list li','click');
			
			$( "#list li#listClick" ).bind( "click", function(e) {
				
				if($empty == false)
				{
				e.stopPropagation();
				//alert($(this).html());
				textBox.val('');
				
				$id = $(this).find('#passKey').val();
				$showVal = $(this).find('#ShowVal').text();	
				 
				 if(multi ==true)
				 {
				 
					var checkDoublicate = checkDublicate($id,'wanted');
					
					if(checkDoublicate == true)
					{
					textBox.before('<div id="cover" class="' + ResultClass +'">'+$showVal+'<input type="hidden" value ="'+$id+'" id="wanted" name="wanted[]" /><span id="remove" class="'+RemoveClass+'">X</span></div>');
					
					}
					else
					{
					  alert('Duplicate not allow');	
					}
				 }
				 else
				 {
					 if($('#cover').size() ==0)
					 {
				   	 textBox.before('<div id="cover" class="' + ResultClass +'">'+$showVal+'<input type="hidden" value ="'+$id+'" id="wanted" name="wanted" /><span id="remove" class="'+RemoveClass+'">X</span></div>');
					 }
					 else
					 {
					  alert('only one Allow');	 
					 }
				 }	
				
				
				//$( "#remove" ).die("click");
				unBindEvent('#remove','click');
				$('#remove').live('click',function(e){
			
			         $(this).parent().remove();
					// alert('remove');
		          });
				  
				} //End Empty Condi
				
				else
				{
				 alert('Enter A valid name');	
				}
				  
				  
				
			});	
		}
		
		
		function unBindEvent(name,Ename)
		{
			$(name).die(Ename);
		}
		function notice()
		{
		  if($('#list li[id="notClick"]').size() ==0)
		  {
			$('#list').prepend('<li id="notClick">Searching...</li>');
		  }
		  else
		  {
			  $('#list li[id="notClick"]').text('Searching...');
		  }	
		}
		

    $.fn.AutoListPlugin = function (options) {
		
       var  setting = $.extend({}, $.fn.AutoListPlugin.config, options);

          this.keydown(function(e){
			 //alert('dfs')
			
			 
			 });
        return this.keyup(function (e) {
            // initialize the elements in the collection
			
			
			
			var textBox = $(this);
			  
			
			var url = setting.url;
			var lClass = setting.listClass;
			
			if($(this).val().length >=setting.afterCharecter)
			{
			 $.ajax({
				 type: "POST",
				 url: url, 
				 data: {SearchKey: textBox.val()},
				 dataType: "json",  
				 cache:false,
				 beforeSend: function(){
					notice();
					 loaderImg(textBox,setting.loader);
				 },
				 success: 
					  function(data){
						  $l = FindData(data);
						  Listing(textBox,$l,lClass);
						ClickList(textBox,setting.resultClass,setting.removeButtonClass,setting.multiple);
					  }  ,
					  complete: function(){
					removeLoader();
				}
		
			 
		          });
			
			}
			else
			{
			  searching(textBox,lClass,setting.afterCharecter);	
			}
			
			
			
			
			
			
			
			
			
        });
    };

    $.fn.AutoListPlugin.config = {
        // set values and custom functions
		listClass: 'autolist',
		resultClass: 'ResultParents',
		removeButtonClass: 'removeName',
		url:'url',
		loader:'dfdhf',
		afterCharecter:3,
		multiple:true
		
    };

}(jQuery));