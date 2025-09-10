/**
* Show/hide popup when click on icon
*/

jQuery(document).on('click','.ksg-adv-toggle-icon',function(){

	var flag = jQuery(this).hasClass('open') ? true : false;

	jQuery('.customize-control-simple-gradient').find('.ksg-field-settings-wrap').hide(); // Hide all open modals, will open individually later
    jQuery('.ksg-adv-toggle-icon').removeClass('open'); // Remove globally "open" class

	if( flag ){
		jQuery(this).closest('.ksg-color-tabs-wrapper').find('.ksg-field-settings-wrap').hide();
		jQuery(this).removeClass('open');
		jQuery(this).closest('.customize-control-simple-gradient').removeClass('selected_item');
	} else {		
		jQuery(this).closest('.ksg-color-tabs-wrapper').find('.ksg-field-settings-wrap').show();
		jQuery(this).addClass('open');
		jQuery(this).closest('.customize-control-simple-gradient').addClass('selected_item');
	}


});

/**
* When clicked outside of the popup close the popup
*/

jQuery(document).on('click', function (e) {

	// If clicked outside the gradient modal, close the modal tab
    if ( jQuery(e.target).closest(".customize-control-simple-gradient.selected_item").length === 0 ) { 
        jQuery('.ksg-field-settings-wrap').hide();
        jQuery('.ksg-adv-toggle-icon').removeClass('open');
        jQuery('.customize-control-simple-gradient').removeClass('selected_item');
    }
});

/**
* When angle is changed, show/hide the input
*/

jQuery(document).on( 'change' , '.ksg_gradient_options', function(){
	var selected = jQuery(this).val();
	if( selected == 'radial-gradient' ){
		jQuery(this).closest('.ksg_colors_options').find('.ksg_anglerange').hide();
	} else {
		jQuery(this).closest('.ksg_colors_options').find('.ksg_anglerange').show();
	}
});

/**
* Save data in change event
*/

jQuery(document).on('keyup keydown change click input','.ksg_anglerange',function(){
	ksg_get_gradient_color( jQuery(this) );
});

/**
* Save data in change event
*/

jQuery(document).on('change','.ksg_gradient_options',function(){
	ksg_get_gradient_color( jQuery(this) );
});

function ksg_get_gradient_color( $this ){
	var parent_div = $this.closest('.ksg-fields-wrap');
	var color_1    = parent_div.find('.ksg_color_1 input').val();
	var color_2    = parent_div.find('.ksg_color_2 input').val();
	var gradient   = parent_div.find('.ksg_colors_options select.ksg_gradient_options').val();
	var angle      = parent_div.find('.ksg_colors_options .ksg_anglerange').val().replace(/[^0-9]/g, '');

	if( gradient == 'radial-gradient' ){
		angle = 'circle';
	} else {
		angle = (angle=='') ? 0 : angle; 
		angle = angle + 'deg';
	}

	var join_all = gradient + '(' + angle + ',' + color_1 + ',' + color_2 + ')';
	parent_div.find('.gradient-preview').css( 'background',join_all );
	$this.closest('.ksg-color-tabs-wrapper').find('.ksg-save-data-json').val(join_all).change();
}