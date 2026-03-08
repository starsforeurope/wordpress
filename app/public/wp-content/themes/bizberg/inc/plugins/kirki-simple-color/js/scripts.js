jQuery(document).ready(function(){

	var simpleColor = {

		init : function(){
			this.showModalOnIconClick();
			this.hideModalWhenClickOutsideModal();
			this.saveToDatabase();
		},

		save : function( $this ){
			setTimeout(function(){ 
				var color = $this.closest('.customize-control-simple-color').find('.ksc_color').val();
				$this.closest('.customize-control-simple-color').find('.ksc-save-data-json').val( color ).change();
			}, 10);
		},

		/**
		* After color has been changed, refresh the previewer
		*/

		saveToDatabase : function(){
			var $this = this;
			jQuery('.ksc_color').wpColorPicker({
				change: function(event, ui) {
					$this.save( jQuery(this) );
				},
				clear: function() {
					$this.save( jQuery(this) );
				}
			});
		},

		/**
		* Show/hide modal when click on icon
		*/

		showModalOnIconClick : function(){

			jQuery(document).on( 'click' , '.ksc-adv-toggle-icon' , function(){

				var flag = jQuery(this).hasClass('open') ? true : false;

				jQuery('.customize-control-simple-color').find('.ksc-field-settings-wrap').hide(); // Hide all open modals, will open individually later
    			jQuery('.ksc-adv-toggle-icon').removeClass('open'); // Remove globally "open" class

    			if( flag ){
    				jQuery(this).closest('.customize-control-simple-color').find('.ksc-field-settings-wrap').hide();
    				jQuery(this).removeClass('open');
    				jQuery(this).closest('.customize-control-simple-color').removeClass('selected_item');
    			} else {
    				jQuery(this).closest('.customize-control-simple-color').find('.ksc-field-settings-wrap').show();
    				jQuery(this).addClass('open');
    				jQuery(this).closest('.customize-control-simple-color').addClass('selected_item');
    			}

			});

		},

		/**
		* When clicked outside of the modal close the modal
		*/

		hideModalWhenClickOutsideModal : function(){

			jQuery(document).on('click', function (e) {

				// If clicked outside the modal, close the modal tab
			    if ( jQuery( e.target ).closest( ".customize-control-simple-color.selected_item" ).length === 0 ) { 
			        jQuery('.ksc-field-settings-wrap').hide();
			        jQuery('.ksc-adv-toggle-icon').removeClass('open');
			        jQuery('.customize-control-simple-color').removeClass('selected_item');
			    }

			});

		}

	};

	simpleColor.init();

});