jQuery(function(){
	
	function aw_overwrite(src,label)
	{
		jQuery('.pop-up-awesome-outer').show();
		jQuery('.pop-up-awesome-outer').find('img.awesome-img').attr('src',src);
		jQuery('.pop-up-awesome-outer').find('p:eq(1)').text(label);
		 
	}
	
  jQuery('#awesome-works-inner-container').mixItUp();
  		
  jQuery(document).on('click','.pop-up-awesome-outer .head .close',function(){
	 jQuery('.pop-up-awesome-outer').hide(); 
  });
  
  
  jQuery(document).on('click','.pop-up-awesome-outer .prev',function(){
	  
	  fg= jQuery('.aw-selected').index();
	  if(fg)
		  {
		  q=jQuery('.awesome-post-section:eq('+(fg-1)+')').find('.awesome-post-title span').text();
		  w=jQuery('.awesome-post-section:eq('+(fg-1)+')').find('img').attr('src');
		  aw_overwrite(w,q);
		  jQuery('.awesome-post-section:eq('+(fg)+')').removeClass('aw-selected');
		  jQuery('.awesome-post-section:eq('+(fg-1)+')').addClass('aw-selected');
		  }
  });
  
 jQuery(document).on('click','.pop-up-awesome-outer .next',function(){
	  
	 fg= jQuery('.aw-selected').index();
	  ln= jQuery('.awesome-post-section').length;
	  
	  if( fg<(ln-1) )
		  {
		  q=jQuery('.awesome-post-section:eq('+(fg+1)+')').find('.awesome-post-title span').text();
		  w=jQuery('.awesome-post-section:eq('+(fg+1)+')').find('img').attr('src');
		  aw_overwrite(w,q);
		  jQuery('.awesome-post-section:eq('+(fg)+')').removeClass('aw-selected');
		  jQuery('.awesome-post-section:eq('+(fg+1)+')').addClass('aw-selected');
		  }
  });
  
 
	  jQuery('.awesome-post-section').on('click',function(){
		  
		  button=jQuery(this);
		  jQuery('.awesome-post-section').removeClass('aw-selected');
		  button.addClass('aw-selected');
		  
		  work_label = button.find('.awesome-post-title span').text();
		  img_src = button.find('img').attr('src');
		  console.log( work_label );
		  
		  if(jQuery('.pop-up-awesome-outer').length == 0)
			  jQuery('body').append('<div class="pop-up-awesome-outer"><div class="awesome-inner"><p class="head"> <span class="close"><img src="wp-content/plugins/awesome/close-black.svg" /></span> </p><img class="awesome-img" src="'+img_src+'" /> <p class="work_text">'+work_label+'</p> <img src="wp-content/plugins/awesome/left_arrow.svg" class="prev" /><img src="wp-content/plugins/awesome/right_arrow.svg" class="next" /></div></div>');
		  else
			  {
			  aw_overwrite(img_src,work_label);
			  }
		  
	  });


});


