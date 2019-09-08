;( function( $, undefined ) {

	/**
	 * Admin Panel MailChimp Metabox Interactions
	 * @since    2.2.0
	 * @version  3.1.0
	 */
	var LLMS_MC = function() {

		/**
		 * Initializer
		 * @return   void
		 * @since    2.2.0
		 * @version  2.2.0
		 */
		this.init = function() {

			this.bind();

		};

		/**
		 * Bind DOM events
		 * @return   void
		 * @since    2.2.0
		 * @version  3.1.0
		 */
		this.bind = function() {

			var self = this;

			$( '#_course_registration_list, #_membership_registration_list' ).on( 'change', function() {
				self.update_groups( $( this ), 'post' );
			} );

			$( '#llms_integration_mailchimp_default_list' ).on( 'change' ).on( 'change', function() {
				self.update_groups( $( this ), 'settings' );
			} );

		};

		/**
		 * Updates list of groups via AJAX based off the currently selected list
		 * @param    obj     $el     jQuery selector of the select element
		 * @param    string  screen  current screen type
		 * @return   void
		 * @since    2.2.0
		 * @version  3.1.0
		 */
		this.update_groups = function( $el, screen ) {

			var $group, $group_container;

			if ( 'post' === screen ) {
				$group = $( $el.attr( 'data-group' ) );
				$group_container = $group.closest( '.llms-mb-list' );
			} else if ( 'settings' === screen ) {
				$group = $( '#llms_integration_mailchimp_default_group' );
				$group_container = $group.closest( 'td' );
				$group_container.css( 'position', 'relative' );
			} else {
				return;
			}

			LLMS.Ajax.call( {
				data: {
					action: 'llms_mc_get_groups',
					list_id: $el.val(),
				},
				beforeSend: function() {

					LLMS.Spinner.start( $group_container );

				},
				success: function( r ) {

					if ( r.groups ) {

						var $none = $group.find( 'option' ).first();
						$group.html( '' );
						$group.append( $none );
						for ( var i in r.groups ) {
							if ( ! r.groups.hasOwnProperty( i ) ) {
								continue;
							}
							$group.append( '<option value="' + r.groups[ i ].key + '">' + r.groups[ i ].title + '</option>' );
						}

					}

					LLMS.Spinner.stop( $group_container );

				}

			} );

		};

		// go
		this.init();

		return this;

	};

	var mc = new LLMS_MC();

} )( jQuery );
