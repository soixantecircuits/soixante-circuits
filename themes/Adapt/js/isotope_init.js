jQuery(function($){
	$(window).load(function() {

		// cache container
		var $container = $('.portfolio-content');
		
		// initialize isotope
		$container.imagesLoaded(function(){
			$container.isotope({
				itemSelector: '.portfolio-item',
				transformsEnabled: false,
            	animationOptions: {
					duration: 400,
					easing: 'swing',
					queue: false
				}
			});
		});
		
		
		// filter items when filter link is clicked
		$('.filter a').click(function(){
			
		  var selector = $(this).attr('data-filter');
		  	$container.isotope({ filter: selector });
			$(this).parents('ul').find('a').removeClass('active');
			$(this).addClass('active');
		  return false;
		});
		
		$(window).resize(function () {
		
			// cache container
			var $container = $('.portfolio-content');
			// initialize isotope
			$container.isotope({ });
		
		}); // END resize
		
		
	}); // END window ready
}); // END function

