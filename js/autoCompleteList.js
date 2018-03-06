(function ($) {
  
	
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}	
	

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
	
	function addvalue(textBox,ResultClass,RemoveClass,multi,id,name)
	{
		var checkDoublicate = checkDublicate(id,'wanted');
		
if(multi ==true)
		{
		      if(checkDoublicate == true)
					{
	/*	textBox.before('<div id="cover" class="' + ResultClass +'">'+name+'<input type="hidden" value ="'+id+'" id="wanted" name="wanted[]" /><span id="remove" class="'+RemoveClass+'">X</span></div>');*/
	                 // textBox.
					 
					 $metter = '<li><label>'+name+'</label><input type="hidden" value ="'+id+'" id="wanted" name="wanted[]" /><span id="remove" class="'+RemoveClass+'">X</span></li>';
					  textBox.parent('li').before($metter);
	
					}
					else
					{
						
					 // $('#wanted[val="'+id+'"]').parent('li').addClass('match');
					 $("input[type='hidden'][id*='wanted'][value='"+id+"']:hidden").parent('li').addClass('match');
                    
					}
					
					
					
		   }
		   else
		   {
			   if($(textBox.parent('li').parent('ul').find('li')).size() ==1)
					 {
				   	 /*textBox.before('<div id="cover" class="' + ResultClass +'"><label>'+name+'</label><input type="hidden" value ="'+
					 id+'" id="wanted" name="wanted" /><span id="remove" class="'+RemoveClass+'">X</span></div>');*/
					 $metter = '<li><label>'+name+'</label><input type="hidden" value ="'+id+'" id="wanted" name="wanted" /><span id="remove" class="'+RemoveClass+'">X</span></li>';
					 textBox.parent('li').before($metter);
					 
					 
					 }
					 else
					 {
						 textBox.parent('li').prev().find('label').text(name);
						  textBox.parent('li').prev().find('input #wanted').val(id);
					  
					 }
		   }
					
					// $('#remove').die('click');
					 $( "#remove" ).live('click',function(){
						 
						 $(this).parent().remove();
						 });
				//textBox.val();
		
	}
    $.fn.AutoListPlugin = function (options) {
		 var textBox = $(this);
		$(this).addClass('txtbox');
		$(this).before('<ul id="autoBox" class="autoBoxCover"><li id="TextBoxField"></li></ul>');
		$(this).appendTo('ul[id="autoBox"] li[id="TextBoxField"]');
		$('ul[id="autoBox"]').click(function(){
			textBox .focus();
			textBox.parent('li').parent('ul').find('li').removeClass('match');
			});
       var  setting = $.extend({}, $.fn.AutoListPlugin.config, options);
   
        
		 
         this.bind( "keyup", function( event ) {
			
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "ui-autocomplete" ).menu.active ) {
					event.preventDefault();
				}
				if(event.keyCode !=8)
				   {
					   $(this).parent('li').prev('li').removeClass('slected'); 
				   }
				if($(this).val() =='')
				{
				   if(event.keyCode ==8)
				   {
					  if($(this).parent('li').parent('ul').find('li').size() >1)
					  {     if($(this).parent('li').parent('ul').find('li.slected').size() ==0)
					            {
					    	       $(this).parent('li').prev('li').addClass('slected'); 
								}
								else
								{
									$(this).parent('li').parent('ul').find('li.slected').remove();
								}
					  }
				   }	
			   }
				
			
			})
			.autocomplete({
				minLength: setting.afterCharecter,
			
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				 source: function(request, response) {
					$.ajax({
						type: "POST",
					 url: setting.url,
					 dataType: "json",
					 data: {
					 searchKey:textBox.val()
					 },
					  beforeSend: function(){
					
					 loaderImg(textBox,setting.loader);
				      },
					 success: function(data) {
						 						 
					  response($.map(data, function(item) {
							   return {
								label: item.name,
								id:item.id,
								user_type:item.u_type
							   }
							  }));
					    },
				 complete: function(){
					removeLoader();
				     }
					}) //ajax
				   }, // end Source 
   
				select: function( event, ui ) {
					//alert(ui.item.id);
					if(ui.item.label !='No Result')
					{
					addvalue(textBox,setting.resultClass,setting.removeButtonClass,setting.multiple,ui.item.id,
					ui.item.label);
					textBox.val('');
					return false;
					}
					else
					{
						textBox.val('');
						return false;
					}
				
				}
			})
			.data("ui-autocomplete")._renderItem = function (ul, item) {
//ul.removeClass();
        ul.addClass(setting.listClass); //Ul custom class here

        return $("<li></li>")
        .addClass(item.customClass) //item based custom class to li here
        .append("<a href='javascript:void()'>" + item.label + " <i>("+item.user_type+")</i></a>")
        .data("ui-autocomplete-item", item)
        .appendTo(ul);
            };

			
		
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