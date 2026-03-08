jQuery(document).on( 'click' , '.install_activate_recommended_plugins' , function(){

    var to_install_activate_plugins = [];
    var nonce = jQuery(this).data('nonce');
    jQuery('.tb_recommended_plugins_wrapper ul li').each(function() {
        to_install_activate_plugins.push( jQuery(this).attr('id') );
    });

	jQuery.ajax({
        type : "post",
        url  : bizberg.ajaxUrl,
        data : {
         	action                     : "bizberg_install_plugins_customizer",
            nonce                      : nonce,
            to_install_activate_plugin : JSON.stringify( to_install_activate_plugins )
        },
        beforeSend: function() {
	        jQuery('.bizberg_spinner').show();
	        jQuery('.install_activate_recommended_plugins .text').text('Installing & Activating ...');
	    },
        success: function(response) {
        	jQuery('.install_activate_recommended_plugins').hide();
        	location.reload(); // Refresh page
        }
    })

});

jQuery(document).on( 'click' , '.bizberg_remove_install_notice' , function(){

	jQuery.ajax({
        type : "post",
        url : bizberg.ajaxUrl,
        data : {
         	action: "bizberg_hide_install_plugins_notice"
        },
        success: function() {
        	jQuery('#accordion-section-recommended-plugins-customizer').attr('style','display:none !important');
        }
    })

});