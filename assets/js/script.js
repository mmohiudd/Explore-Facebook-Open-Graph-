$(function(){

    // External links with rel="external"
	    $('a[rel="external"]').live('click', function(e) {
	    	e.preventDefault();
	    	window.open( $(this).attr('href') )
	    })
	
	// Login state trigger
		$('a[href="#signin"], header form button[type=button]').click(function(e) {
			
			e.preventDefault();
			$form = $('header form').eq(0);
			
			$('fieldset', $form).stop(true,true).fadeToggle();
			$('p', $form).stop(true,true).fadeToggle();
		})
	});