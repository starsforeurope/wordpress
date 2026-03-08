jQuery(document).ready(function(){

	var repeaterObj = {

		init : function(){
			this.hideShowContent();
			this.sortRepeatableSections();
			this.deleteRepeaterSection();
			this.addNewRepeater();
			this.saveValueOnChangeEvent();
			this.initializeSelect2( '.kar_select:not(.kar_hide)' );
			this.initializeFontawesomeSelect2( '.kar_fontawesome:not(.kar_hide)' );
			this.initializeColorPicker( '.kar_color:not(.kar_hide)' );
			this.showImageUploadModal();
			this.removeImage();
			this.repeaterActiveCallback();
			this.initializeDatePicker( ".kar_date.datepicker:not(.kar_hide)" );
			this.initializeTimepicker( '.kar_time_hr:not(.kar_hide),.kar_time_min:not(.kar_hide)' );
		},

		initializeTimepicker : function( selector ){
			jQuery( selector ).select2();
		},

		initializeDatePicker : function( selector ){
			var $this = this;
			jQuery( selector ).datepicker({
	            dateFormat : "yy-mm-dd",
	            onSelect: function(dateText, inst) {
	            	jQuery(this).attr( 'data-value', dateText );
	            	$this.sortValues( jQuery(this).closest('.kar_wrapper') ); // Save the values

	            	var id = '#' + jQuery(this).closest('li.customize-control').attr('id');
					$this.checkActiveCallbackToHideShow( $this, id );
	            }
	        });
		},

		/**
		* Check if the data is json or not
		*/
		checkJsonData : function( tester ){
		    if(/^\s*$|undefined/.test(tester) || !(/number|object|array|string|boolean/.test(typeof tester))) 
		        {
		        return false;
		    };
			return true;
		},

		/**
		* Check all the active_callback to hide/show the fields
		*/
		checkActiveCallbackToHideShow : function( $this, id ){

			jQuery(id).find('.fields').each(function(){ // Loop all the fields section

				var thisField = jQuery(this);

				if( thisField.data('active-callback') != undefined ){

					var json_str = thisField.data('active-callback');

					if( $this.checkJsonData( json_str ) ){ // If valid json
						
						var parse_json = JSON.parse( JSON.stringify( json_str ) ); // return array	
						var relation,flag = [];

						// Check for relation
						if( parse_json.relation && parse_json.relation !== undefined ){					
							relation = parse_json.relation.toLowerCase();
						} else {
							relation = 'and';
						}

						jQuery.each(parse_json, function (key, data) { // Can be multiple conditions, loop through all

							var setting  = parse_json[key].setting;
							var operator = parse_json[key].operator;
							var value    = parse_json[key].value;
							
							var selected = thisField.closest('.kar_repeater_section').find('.fields[data-key="' + setting + '"]');
							var valueToCheckWith, valueToCheckFrom;

							switch( selected.data('type') ){

								case 'radio':
									valueToCheckWith = selected.find('.kar_radio:checked').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'checkbox':

									if( selected.find('.kar_checkbox').is(":checked") ){
										valueToCheckWith = true;
									} else {
										valueToCheckWith = false;
									}

									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'image':
									valueToCheckWith = selected.find('.kar_image').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'color':
									valueToCheckWith = selected.find('.kar_color').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'select':
									valueToCheckWith = selected.find('.kar_select').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'fontawesome':
									valueToCheckWith = selected.find('.kar_fontawesome').val().replace(/\s/g, '');
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'textarea':
									valueToCheckWith = selected.find('.kar_textarea').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'text':
									valueToCheckWith = selected.find('.kar_text').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'number':
									valueToCheckWith = selected.find('.kar_number').val();
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

								case 'date':
									valueToCheckWith = selected.find('.kar_date').attr('data-value');
									valueToCheckFrom = value;
									flag[key] = $this.checkWithOperator( valueToCheckWith, valueToCheckFrom, operator );
									break;

							}

						});

						if( relation == 'or' ){

							// If one value is true
							if( flag.includes(true) ){
								thisField.slideDown();
							} else {
								thisField.slideUp();
							}

						} else {

							// if all values are true then show the field
							if( flag.every(v => v === true) == true ){
								thisField.slideDown();
							} else {
								thisField.slideUp();
							}

						}						

					}	

				}

			})

		},

		/**
		* Get all the controls and check the active_callback
		*/
		repeaterActiveCallback : function(){

			var $this = this;

			wp.customize.control.each( function( control ) {

				if( control.params && control.params.type && control.params.type === 'advanced-repeater' ) {
					
					var id = '#customize-control-' + control.params.id;	

					$this.checkActiveCallbackToHideShow( $this, id );

				}

			});

		},

		checkWithOperator : function( valueToCheckWith, valueToCheckFrom, operator ){

			switch( operator ){

				case '==':
				case '=':
				case 'equals':
				case 'equal':
					return valueToCheckWith == valueToCheckFrom;
					break;

				case '===':
					return valueToCheckWith === valueToCheckFrom;
					break;

				case '!==':
					return valueToCheckWith !== valueToCheckFrom;
					break;

				case '!=':
				case 'not equal':
					return valueToCheckWith != valueToCheckFrom;
					break;

				case '>=':
				case 'greater or equal':
				case 'equal or greater':
					return valueToCheckWith >= valueToCheckFrom;
					break;

				case '<=':
				case 'smaller or equal':
				case 'equal or smaller':
					return valueToCheckWith <= valueToCheckFrom;
					break;

				case '>':
				case 'greater':
					return valueToCheckWith > valueToCheckFrom;
					break;

				case '<':
				case 'smaller':
					return valueToCheckWith < valueToCheckFrom;
					break;

				case 'contains':
				case 'in':
					return valueToCheckFrom.some( ele => valueToCheckWith.includes(ele) );
					break;

			}

		},

		/**
		* When click on remove image button remove the image and refresh the previewer
		*/

		removeImage : function(){

			jQuery(document).on( 'click' , '.kar_remove_image' , function(e){

				var id     = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				var parent = jQuery( e.target ).closest('.fields');
				parent.find( '.kar_image_preview' ).show();
				parent.find( 'img' ).removeAttr('src').hide();
				parent.find( '.kar_image' ).val('');
				jQuery( e.target ).hide();

				// Refresh the previewer
                this.sortValues( jQuery( e.target ).closest('.kar_wrapper') );

                this.checkActiveCallbackToHideShow( this, id );

			}.bind(this));

		},

		/**
		* Open the image popup to select the image
		*/

		showImageUploadModal : function(){

			var $thisObj = this;

			jQuery(document).on( 'click' , '.kar_select_image' , function(e){

				e.preventDefault();
				var $this = jQuery(this);
				var frame = wp.media({
                   	title : 'Choose Image',
                   	frame: 'select',
                   	library : {
                    	type : 'image',
                  	},
                   	button : { text : 'Insert' }
               	});

               	frame.on( 'select' , function() {

                  	var selection  = frame.state().get('selection').first(); // Get image attributes
                  	var image_link = selection.attributes.url; // Get image full url
                  	var image_id   = selection.id; // Get image id 
                  	var id         = '#' + $this.closest('li.customize-control').attr('id');

                  	$this.closest('.fields').find('.kar_image').val( image_id );
                  	$this.closest('.fields').find('img').attr( 'src' , image_link ).show();
                  	$this.closest('.fields').find('.kar_image_preview').hide();
                  	$this.closest('.fields').find('.kar_remove_image').show();

                  	// Refresh the previewer
                  	$thisObj.sortValues( $this.closest('.kar_wrapper') );

                  	$thisObj.checkActiveCallbackToHideShow( $thisObj, id );

               	});

                frame.on('open',function() {

                    //Preselect attachements from my hidden input
                    var selection = frame.state().get('selection');
                    id = $this.closest('.fields').find('.kar_image').val();
                    
                  	attachment = wp.media.attachment(id);
                  	attachment.fetch();
                  	selection.add( attachment ? [ attachment ] : [] );                   

                });

                frame.open();

			});

		},

		initializeColorPicker : function( selector ){
			var $this = this;
			var id;
			jQuery( selector ).wpColorPicker({
				change: function(event, ui) {
					var $this2 = jQuery(this);
					setTimeout(function(){
						$this.sortValues( $this2.closest('.kar_wrapper') );
						id = '#' + $this2.closest('li.customize-control').attr('id');
						$this.checkActiveCallbackToHideShow( $this, id );
					}, 100);					
				},
				clear: function() {
					var $this2 = jQuery(this);
					setTimeout(function(){
						$this.sortValues( $this2.closest('.kar_wrapper') );
						id = '#' + $this2.closest('li.customize-control').attr('id');
						$this.checkActiveCallbackToHideShow( $this, id );
					}, 100);
				}
			});
		},

		formatText : function(icon) {
		    return jQuery('<span></span>').append('<i class="' + jQuery(icon.element).attr('value') + '"></i> ').append(icon.text);
		},

		initializeFontawesomeSelect2 : function( selector ){
			var $this = this;
			jQuery( selector ).select2({
			    templateResult: $this.formatText // To show icons 'templateResult' is needed
			});
		},

		initializeSelect2 : function( selector ){
			jQuery( selector ).select2();
		},

		/**
 		* When same change event happens in the field, save the values
 		*/
		saveValueOnChangeEvent : function(){

			var id;

			// For input text
			jQuery(document).on( 'input', '.kar_text, .kar_number', function(e){
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

			// For textarea
			jQuery(document).on( 'input propertychange', '.kar_textarea', function(e){
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

			// For select2
			jQuery(document).on( 'select2:select select2:unselect select2-removed', '.kar_select', function(e){
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

			// For select2 timepicker
			jQuery(document).on( 'select2:select select2:unselect select2-removed', '.kar_time_hr, .kar_time_min', function(e){
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

			// For select2 fontawesome
			jQuery(document).on( 'select2:select', '.kar_fontawesome', function(e){
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

			// For radio & checkbox button
			jQuery(document).on( 'change' , '.kar_radio,.kar_checkbox' , function(e){
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

			// For date
			jQuery(document).on( 'input', '.kar_date', function(e){
				// Save only empty data from this event
				if( jQuery( e.target ).val().trim() == '' ){
					jQuery( e.target ).attr( 'data-value', '' );
				}
				id = '#' + jQuery( e.target ).closest('li.customize-control').attr('id');
				this.sortValues( jQuery( e.target ).closest('.kar_wrapper') ); // Save the values
				this.checkActiveCallbackToHideShow( this, id );
			}.bind(this));

		},

		/**
		* Stop adding repeater when it reaches the limit
		*/

		checkRepeaterLimit : function( parent ){
			var count_repeater = parent.find('.kar_repeater_section').length;
			var limit = parent.data('limit');
			if( limit != 0 && count_repeater >= limit ){
				parent.nextAll('.kar_repeater_limit').addClass('active');
				return true;
			}
			parent.nextAll('.kar_repeater_limit').removeClass('active');
			return false;
		},

		/**
 		* When clicked on add new button, add new content
 		*/
		addNewRepeater : function(){

			jQuery(document).on( 'click', '.kar_add_new_section' , function(e){

				// Check for limit
				var flag = this.checkRepeaterLimit( jQuery( e.target ).prevAll('.kar_wrapper') );
				if( flag == true ){ // IF limit exceeded donot add new row					
					return;
				}			

				var content = jQuery( e.target ).prevAll('.kar_new_repeater').html(); // Select content
				jQuery( e.target ).prevAll('.kar_wrapper').append( content ); // Paste the selected content
				jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last .kar_fields_wrapper').show(); // Open the section by default

				// Change the arrow
				var select_anchor = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last a');
				this.changeArrow( select_anchor );

				// Initialize select2 on new repeater
				var dropdown_select = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last select.kar_select');
				this.initializeSelect2( dropdown_select );

				// Initialize select2 timepicker on new repeater
				var dropdown_select_hr = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last select.kar_time_hr');
				this.initializeTimepicker( dropdown_select_hr );
				var dropdown_select_min = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last select.kar_time_min');
				this.initializeTimepicker( dropdown_select_min );

				// Initialize select2 fontawesome on new repeater
				var dropdown_select = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last select.kar_fontawesome');
				this.initializeFontawesomeSelect2( dropdown_select );

				// For Colorpicker
				var colorpicker = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last input.kar_color');
				this.initializeColorPicker( colorpicker );

				// For radio buttons
				var last_repeater = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last');
				this.regenerateRadioInputNames( last_repeater );

				// For datepicker
				var date_field = jQuery( e.target ).prevAll('.kar_wrapper').find('.kar_repeater_section:last input.kar_date');
				this.initializeDatePicker( date_field );

				this.sortValues( jQuery( e.target ).prevAll('.kar_wrapper') ); // Save the values

			}.bind(this));

		},

		/**
 		* Generate new names for radio input, if not it will not work
 		*/
		regenerateRadioInputNames : function( last_repeater ){

			var $this = this;
			last_repeater.find('.radio_fields').each( function(){				
				var name = 'radio_' + Math.floor((Math.random() * 100000) + 1);
				jQuery(this).find('input.kar_radio').attr( 'name' , name );
			});

		},

		/**
 		* When clicked on remove button, remove section
 		*/
		deleteRepeaterSection : function(){

			jQuery(document).on( 'click' , '.kar_remove_section' , function(e){

				var parent_div = jQuery( e.target ).closest( '.kar_wrapper' );
				var toRemove   = jQuery( e.target ).closest('.kar_repeater_section');
				var scrollToId = '#' + parent_div.prevAll('.kar_title_description_wrapper').attr('id');

				// Remove section with fadeout effect
				toRemove.fadeOut( 500 , function() {
			        
			        toRemove.remove();

			        // Scroll to div
			        jQuery( scrollToId )[0].scrollIntoView({
					  	behavior: 'smooth',
					  	block: 'start'
					});

			        this.sortValues( parent_div );

			        this.checkRepeaterLimit( parent_div ); // Check limit to remove class 'active'

			    }.bind(this));	
			    			
			}.bind(this));

		},

		/**
 		* Change the values and refresh the previewer
 		*/
		sortValues : function( parent_div ){

			var toStoreValue = [];

			parent_div.find('.kar_repeater_section').each(function( index, e ){ // Loop all sections

				toStoreValue[index] = {};

				jQuery(e).find('.count').text(index+1); // Rearrange numbers

				jQuery(e).find('.kar_fields_wrapper .fields').each(function( index2 ,e2 ){ // Loop all fields inside section

					var type = jQuery(e2).data('type'); // Text, textarea .... etc
					var key  = jQuery(e2).data('key'); // Value will be saved in this key

					switch( type ){

						case 'number':
							toStoreValue[index][key] = jQuery(e2).find('.kar_number').val();
							break;

						case 'text':
							toStoreValue[index][key] = jQuery(e2).find('.kar_text').val().trim();
							break;

						case 'textarea':
							toStoreValue[index][key] = jQuery(e2).find('.kar_textarea').val().trim();
							break;

						case 'select':
							toStoreValue[index][key] = jQuery(e2).find('.kar_select').val();
							break;

						case 'time':
						    toStoreValue[index][key] = {};
							toStoreValue[index][key]['h'] = jQuery(e2).find('.kar_time_hr').val();
							toStoreValue[index][key]['m'] = jQuery(e2).find('.kar_time_min').val();
							break;

						case 'fontawesome':
							toStoreValue[index][key] = jQuery(e2).find('.kar_fontawesome').val();
							break;

						case 'color':
							toStoreValue[index][key] = jQuery(e2).find('.kar_color').val();
							break;

						case 'image':
							toStoreValue[index][key] = jQuery(e2).find('.kar_image').val();
							break;

						case 'radio':
							toStoreValue[index][key] = jQuery(e2).find('.kar_radio:checked').val();
							break;

						case 'date':
							toStoreValue[index][key] = jQuery(e2).find('.kar_date').attr('data-value');
							break;

						case 'checkbox':
							if( jQuery(e2).find('.kar_checkbox').is(":checked") ){
								toStoreValue[index][key] = 'true';
							} else {
								toStoreValue[index][key] = 'false';
							}
							break;

					}
					
				});				

			}.bind(this));

			parent_div.find('.kar_repeater_save_db').val( JSON.stringify( toStoreValue ) ).change();

		},

		/**
 		* Initialize sortable library
 		*/
		sortRepeatableSections : function(){
			var $this = this;
			jQuery( ".kar_wrapper" ).sortable({
				handle: ".kar_label_wrapper",
				update: function(ev) {
			        $this.sortValues( jQuery( ev.originalEvent.target ).closest( '.kar_wrapper' ) );
			    }
			});
		},

		/**
 		* When click on title, show/hide the content
 		*/
		hideShowContent : function(){
			jQuery(document).on( 'click' , '.kar_label_wrapper', function(e){
				jQuery(e.target).closest('.kar_repeater_section').find('.kar_fields_wrapper').slideToggle('fast');
				this.changeArrow( jQuery(e.target) );
			}.bind(this));
		},

		/**
 		* When click on title, change the arrow(up/down)
 		*/
		changeArrow : function( $this ){
			var icon_select = $this.closest('.kar_repeater_section').find('a .icon');
			if( icon_select.hasClass('active') ){
				icon_select.removeClass('active');	
			} else {
				icon_select.addClass('active');
			}
		}

	}

	repeaterObj.init();

});