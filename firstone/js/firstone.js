jQuery(document).ready(function()
{
	$window 		= jQuery(window); 
	$navbar			= jQuery('#navbar');
	$arrow_up 		= jQuery('#arrow-up');
	$header_image 	= jQuery('#header-image');
	$container 		= jQuery('#container'); 
	$myCarousel		= jQuery('#myCarousel');	
	$slider_info	= jQuery('#slider-info');
	$carousel_inner	= jQuery('#carousel-inner');
	$info_icon		= jQuery('#slider-info-icon');
	$stop_icon		= jQuery('#slider-stop-icon');
	$logo 			= jQuery('.custom-logo');

	var logoWidth	= $logo.css('width');
	var logoHeight	= $logo.css('height');
	var hiding 		= false;
	var showing 	= false;
	var imageHeight = $header_image.height(); 
	var arrowTrig	= 50;
	var logoTrig	= 5;

	// update image height on window resize
	$window.on('resize',function () 
	{    
		imageHeight = $header_image.height(); 
	});

//console.log ( 'imageHeight' + imageHeight );

	///////////////////////////////////////////////////////////////////////////
	// navbar fade in/out
	// header image fade out on scroll down
	///////////////////////////////////////////////////////////////////////////
	$window.scroll(function () 
	{    
		var scrollTop	= $window.scrollTop(); 
		var winHeight	= $window.height();
		var offsetTop	= $container.offset().top; 
		var elemTop	= imageHeight - scrollTop;
		var fade = 1-(scrollTop/imageHeight);
		if ( fade < 0 )
		{
			fade = 0;
		}

		// arrow icon visibility trigger
		if ( scrollTop > arrowTrig ) 
		{
			$arrow_up.fadeIn(500);
		}
		else
		{
			$arrow_up.fadeOut(500);
		}

		// logo trigger
		if ( scrollTop > logoTrig ) 
		{
			//$logo.css({'width':'30%','height':'30%'});
		}
		else
		{
			//$logo.css({'width':logoWidth,'height':logoHeight});
		}

		// navbar and header image -fading
		if (elemTop < 0) 
		{
			if ( showing )
			{
				$navbar.finish();	
			}

			hiding = true;
			$navbar.hide(1000, function()
			{
				hiding = false;
			});
		} 
		else
		{
			$header_image.css(
			{
				'-webkit-filter': 'brightness('+fade+')',
				   '-moz-filter': 'brightness('+fade+')',
					'-ms-filter': 'brightness('+fade+')',
					 '-o-filter': 'brightness('+fade+')',
						'filter': 'brightness('+fade+')'

			});

			if ( hiding )
			{
				$navbar.finish();	
			}
			
			showing = true;
			$navbar.show(1000,function()
			{
				showing=false;
			});
		}
	});

	///////////////////////////////////////////////////////////////////////////
	// smooth scrolling
	///////////////////////////////////////////////////////////////////////////
	jQuery('a[href*="#"]:not([href="#"])').click(function() 
	{
		// check for bootstrap carousel
		if ( jQuery('.carousel').length || 
			 jQuery('.panel-group').length )
		{
			//console.log( 'return' );
			return true;
		}
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && 
			location.hostname == this.hostname) 
		{
			var target = jQuery(this.hash);
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			if (target.length) 
			{
				jQuery('html, body').animate(
				{
			  		scrollTop: target.offset().top-30
				}, 1000);
				return false;
			}
		}
	});
	
	///////////////////////////////////////////////////////////////////////////
	// general scroll up function
	///////////////////////////////////////////////////////////////////////////
	jQuery('a[href="#"]').click(function() 
	{
		jQuery('html, body').animate(
		{
			scrollTop: 0
		}, 500);
		return false;
	});

	///////////////////////////////////////////////////////////////////////////
	// bootstrap slider functions
	///////////////////////////////////////////////////////////////////////////
	$stop_icon.mouseenter(function() 
	{
		$myCarousel.carousel('pause');	
	});

	$stop_icon.mouseleave(function() 
	{
		$myCarousel.carousel('cycle');	
	});

	$info_icon.mouseenter(function() 
	{
		$myCarousel.carousel('pause');	
		$info_icon.removeClass('jello');
		$slider_info.finish();
		$slider_info.fadeIn(500);
		$carousel_inner.css(
		{
			'-webkit-filter': 'blur(2px) brightness(0.5)',
			   '-moz-filter': 'blur(2px) brightness(0.5)',
				'-ms-filter': 'blur(2px) brightness(0.5)',
				 '-o-filter': 'blur(2px) brightness(0.5)',
					'filter': 'blur(2px) brightness(0.5)'

		});
	});

	$info_icon.mouseleave(function() 
	{
		$myCarousel.carousel('cycle');	
		$info_icon.addClass('jello');
		$slider_info.finish();
		$slider_info.fadeOut(500);
		$carousel_inner.css(
		{
			'-webkit-filter': 'blur(0) brightness(1)',
			   '-moz-filter': 'blur(0) brightness(1)',
				'-ms-filter': 'blur(0) brightness(1)',
				 '-o-filter': 'blur(0) brightness(1)',
					'filter': 'blur(0) brightness(1)'

		});
	});
});		
