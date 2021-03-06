$(document).ready(function(){
	// show popup when you click on the link
	$(document).on('click', '.show-popup', function(event){
		event.preventDefault(); 
		
                if(!$.trim($('#loginFormOverlay').html()))
                  $.get($(this).data('url'), function(data){
                        $('#loginFormOverlay').append(data); 
						checkMid('#loginFormOverlay');
                    });
            // disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

		$('.overlay-bg').fadeIn('slow').css({'height' : docHeight}); //display your popup and set height to the page height
		$('.popup'+selectedPopup).show(); // show the appropriate popup
		$('.overlay-content').css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
	});
 
	// hide popup when user clicks on close button
	$(document).on('click', '.close-btn', function(){
            $('.overlay-bg').fadeOut('slow'); // hide the overlay
	});
	
	// hides the popup if user clicks anywhere outside the container
	$(document).on('click', '.overlay-bg', function(){
	$('.overlay-bg').fadeOut('slow');
	})
	
	// prevents the overlay from closing if user clicks inside the popup overlay
	$(document).on('click', '.overlay-content', function(e){
		e.stopPropagation();
	});
 
});

$(document).ready(function(){
	// show popup when you click on the link
	$(document).on('click', '.show-popup-signup', function(event){
		event.preventDefault();
                if(!$.trim($('#signupFormOverlay').html()))
                  $.get($(this).data('url'), function(data){
                        $('#signupFormOverlay').append(data); 
						checkMid('#signupFormOverlay');
                    });// disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

		$('.overlay-bg-signup').fadeIn('slow').css({'height' : docHeight}); //display your popup and set height to the page height
		$('.popup'+selectedPopup).show(); // show the appropriate popup
		$('.overlay-content-signup').css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
	});
 
	// hide popup when user clicks on close button
	$(document).on('click', '.close-btn-signup', function(){
	$('.overlay-bg-signup').fadeOut('slow'); // hide the overlay
	});
	
	// hides the popup if user clicks anywhere outside the container
	$(document).on('click', '.overlay-bg-signup', function(){
	$('.overlay-bg-signup').fadeOut('slow');
	})
	
	// prevents the overlay from closing if user clicks inside the popup overlay
	$(document).on('click', '.overlay-content-signup', function(e){
	e.stopPropagation();
	});
 
});

$(document).ready(function(){
	// show popup when you click on the link
	$('.show-popup-best-price').click(function(event){
		event.preventDefault(); // disable normal link function so that it doesn't refresh the page
		if($('#login').length)
			$('#login').trigger('click');
		else{
		checkMid('#bestPriceFormOverlay');
		var productImg = $('#img_zoom').attr('src');
		var title = $('.itmTitle a').text();
		$('#registerAlert').attr('data-pid', $(this).attr('data-pid'));
		$('#alertItmImg img').attr('src', productImg);
		$('#alertItmName p').text(title);
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

		$('.overlay-bg-best-price').fadeIn('slow').css({'height' : docHeight}); //display your popup and set height to the page height
		$('.popup'+selectedPopup).show(); // show the appropriate popup
		$('.overlay-content-best-price').css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
		}
	});
 
	// hide popup when user clicks on close button
	$('.close-btn-best-price').click(function(){
	$('.overlay-bg-best-price').fadeOut('slow'); // hide the overlay
	});
	
	// hides the popup if user clicks anywhere outside the container
	$('.overlay-bg-best-price').click(function(){
	$('.overlay-bg-best-price').fadeOut('slow');
	})
	
	// prevents the overlay from closing if user clicks inside the popup overlay
	$('.overlay-content-best-price').click(function(){
	return false;
	});
 
});
$(document).ready(function(){
	// show popup when you click on the link
	$(document).on('click','.show-popup-signup-1', function(event){
		$('.overlay-bg').fadeOut('slow'); // hide the overlay
		event.preventDefault();
		
                if(!$.trim($('#signupFormOverlay').html()))
                  $.get($('#register').data('url'), function(data){
                        $('#signupFormOverlay').append(data); 
						checkMid('#signupFormOverlay');
                    });// disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

		$('.overlay-bg-signup').fadeIn('slow').css({'height' : docHeight}); //display your popup and set height to the page height
		$('.popup'+selectedPopup).show(); // show the appropriate popup
		$('.overlay-content-signup').css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
	});
 
});

$(document).ready(function(){
	// show popup when you click on the link
	$(document).on('click', '.show-popup-1', function(event){
		$('.overlay-bg-signup').fadeOut('slow'); // hide the overlay
		
		event.preventDefault();
                if(!$.trim($('#loginFormOverlay').html()))
                  $.get($('#login').data('url'), function(data){
                        $('#loginFormOverlay').append(data); 
						checkMid('#loginFormOverlay');
                    });// disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

		$('.overlay-bg').fadeIn('slow').css({'height' : docHeight}); //display your popup and set height to the page height
		$('.popup'+selectedPopup).show(); // show the appropriate popup
		$('.overlay-content').css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
	});
 
});

function checkMid(id){
	var aHeight = $(window).height() - $(id).height()-60;
	var fHeight = aHeight/2;
	//console.log(id);console.log($(window).height());console.log($(id).height());console.log(fHeight);
	$('#loginFormOverlay, #signupFormOverlay, #bestPriceFormOverlay').css('margin-top', fHeight + "px");
}