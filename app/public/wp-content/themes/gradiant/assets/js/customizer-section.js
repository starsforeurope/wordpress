( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['plugin-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );


function gradiantfrontpagesectionsscroll( section_id ){
    var scroll_section_id = "slider-section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        case 'accordion-section-info_setting':
        scroll_section_id = "info-section";
        break;

        case 'accordion-section-service_setting':
        scroll_section_id = "service-section";
        break;
		
		case 'accordion-section-cta_setting':
        scroll_section_id = "cta-section";
        break;
		
		case 'accordion-section-client_setting':
        scroll_section_id = "client-section";
        break;
		
		case 'accordion-section-blog_setting':
        scroll_section_id = "post-section";
    }

    if( $contents.find('#'+scroll_section_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + scroll_section_id ).offset().top
        }, 1000);
    }
}

 jQuery('body').on('click', '#sub-accordion-panel-gradiant_frontpage_sections .control-subsection .accordion-section-title', function(event) {
        var section_id = jQuery(this).parent('.control-subsection').attr('id');
        gradiantfrontpagesectionsscroll( section_id );
});

(function($) {
	$(document).ready(function($) {
		if($("select").hasClass("contact-icon-picker")){
			$('.contact-icon-picker.iconPicker').fontIconPicker();
		}
	});
	
})(jQuery);