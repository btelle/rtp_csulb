/**
 * rtp.validate.js
 * 
 * RTP form validation rules
 * 
 * @author Brandon Telle, Chris Hines
 */

$(document).ready(function() { 
    
    // Validate Contact Us form
    $('form#contact').validate({ 
		rules: {
			name: "required",
			email: {
				required: true,
				email: true 
			},
			comment: "required"
		}
	});
        
    $('form#create_new').validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			password: "required",
                        confirm: "required"
		}
	});
    
});
