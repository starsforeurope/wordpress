jQuery(document).on( 'click', '.ravi-font-awesome-6-wrap a', function() {

    // Add / remove class
    jQuery(this).closest('.ravi-font-awesome-6-icon-wrap').find('a').removeClass('active');
    jQuery(this).addClass( 'active' );

    var save_db = jQuery(this).closest('.ravi-font-awesome-6-wrap').find('.ravi-font-awesome-6-db'),
    new_value   = jQuery(this).find('i').attr('class');
    save_db.val( new_value ).change();

});

jQuery(document).on( 'keyup' , '.ravi-font-awesome-6-wrap input.search_icon', function(){
    var search_text = jQuery(this).val();
    jQuery(this).closest('.ravi-font-awesome-6-wrap').find('.ravi-font-awesome-6-icon-wrap a').each(function(){
        var item_text = jQuery(this).data('search-text');
        if ( item_text.toLowerCase().indexOf(search_text) >= 0 ){
            jQuery(this).show();
        } else {
            jQuery(this).hide();    
        }
    });
})