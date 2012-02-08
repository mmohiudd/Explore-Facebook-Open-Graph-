/************************************************
 *
 *  File     :  Validajtor.js
 *  Desc     :  Form validation
 *  Version  :  0.5
 *  Author   :  BNOTIONS (c) 2011 // 'drej
 *  Rights   :  GNU Public License
 *
 ************************************************/

(function( $ ){
	$.fn.validate = function(options) {
		var settings = {
			'labelpos' : 'relative',
			'ajax' : false
		}
		
		$.extend(settings, options)
		
		this.live('submit', function(e) {
			var valid = true;
			var ct = 0;
			var $form = $(this);
			var action = $form.attr('action');
			
			// reset previous failed states
			$('.failed', $form).removeClass('failed');
			$('.error', $form).fadeOut().remove();
			
			$('input:not([type=submit]), select, textarea', $form).each(function() {
				var params = {
					required: false,
					type: 'text',
					match: false,
					message: 'This is a required field'
				}
				
				var $el = $(this);
				var o = $.extend(params, $el.data('validation'));
				var msg = o.message;
				var failed = false;
				
				console.log(o)
				
				// required
					// text inputs
					if(o.required == true && !$el.val()) {
						failed = true;
					}
					
					// radio and checkbox
					if(o.required == true && $el.is(':radio, :checkbox')) {
						var group = $el.attr('name');
						if (!$('input[name='+group+']:checked').length > 0) {
							failed = true; 
						}
					}
					
					// select inputs
					if(o.required == true && $el.is('select') && $el.val() == '') {
						failed = true;
					}
				
				// type
					// email
					if(o.type == 'email') {
						var regexp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9][a-zA-Z0-9.-]*[\.]{1}[a-zA-Z]{2,4}$/;
						if ($el.val().search(regexp) == -1) {
							failed = true;
						}
					}
				
				// match
					if(o.match) {
						var $label = $('label[for=' + $el.attr('id') + ']');
						var txt = $label.text().replace(':','');
						var $tomatch = $('#' + o.match);
						
						if ($el.val() != $tomatch.val()) {
							failed = true;
							msg = $('label[for=' + $el.attr('id') + ']').text() + ' needs to match';
							$tomatch.parent().addClass('failed'); 
						}
					}

				// regexp
					if(o.regexp) {
						if ($el.val().search(o.regexp) == -1) {
							failed = true;
						}
					}
					
				// build error message and fail state
				if(failed == true) {
					$el.parent().addClass('failed'); 
					$el.parent().append('<div class="error">' + msg + '</div>')
					
					if (settings.labelpos == 'absolute') {
						var loffset = $el.outerWidth() + $('label[for=' + $el.attr('id') + ']').outerWidth() + 5;
						$el.siblings('.error').css('left',loffset + 'px')
					}
					
					ct++
				}
			})
			
			// check if there are any failed items per counter
			if (ct > 0) valid = false;
			
			if (valid == true) {
				// submit form
				
				if (settings.ajax == true) { // ajax submit
					$.post(action, $form.serialize(), function(data) {
	
						/* the following relies on a JSON object response from the server, can be enabled if need be, but needs some normalization before it should be implemented permanently.
	
						if ( data.status == 'success') {
							if (data.rel) {
								if (data.rel.indexOf("http://") != -1) {
									window.location = target;
								}
								
								else {
									$form.hide();
									$(data.rel).show();
								}
							}
						}
						
						else if ( data.status == 'failed') {
							$form.append('<div id="response errormsg">'+data+'</div>')
						}
						
						else if ( data.status == 'redirect') {
							window.open(data.message, '_blank')
						}
						*/
						
						$form.append('<div id="response">'+data+'</div>')
						$('button[type="submit"]', $form).hide();
					} /*, "json" */) 

					e.preventDefault();
					return false;

				}
				else { // non ajax submit
					return true;
				}
				
			}
			
			else {
				$('.error').fadeIn();
				
				$('.failed input').eq(0).focus();
				
				// prevent submit
				e.preventDefault();
				return false;
			}
		})

	};
})( jQuery );