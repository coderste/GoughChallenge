<?php
/**
 * WordPress Footer file - contains mark-up
 * for the footer of the website
 */
?>

		<footer id="main-footer">
			<!-- Info -->
			<div class="site-info wrapper clearfix">
				<div class="col-md-6 social-icons">
					<a href="#" class="icons" target="_blank"><i class="fa fa-github"></i></a>
					<a href="#" class="icons" target="_blank"><i class="fa fa-stack-exchange"></i></a>
				</div>
				<div class="col-md-6 copyright">
					<p>Copyright &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</p>
				</div>
			</div>
		</footer>

	</div>
	<!-- ./Site Container -->

	<!-- WordPress Footer -->
	<?php wp_footer(); ?>
    <script type="text/javascript">
    jQuery(document).ready( function($) {

        map = new GMaps({
            div: '#map',
            lat: 52.3353884,
            lng: -2.0625768
        });

        $( function() {
            var locationForm = $( '#location_form' );

            var results = $( 'div#result' );
            var formMessage = $( 'div.form-message' );
            var inputFields = $( 'input.required' );

            var submitButton = $( 'button.btn-submit' );

            $( locationForm ).submit( function( eve ) {
                eve.preventDefault();
                eve.stopPropagation();

                // Disable button
                submitButton.attr( 'disabled', 'disabled' );
                submitButton.addClass( 'disabled' );

                var user_loc = $( '#user_loc' ).val();
                var other_loc = $( '#other_loc' ).val();

                var bounds = new google.maps.LatLngBounds();

                $.ajax({
                    type: 'POST',
                    url: locationAjax.ajaxurl,
                    data: {
                        'action': 'location_submit',
                        'user_location': user_loc,
                        'other_location': other_loc
                    },
                    success: function( data )
                    {
                        GMaps.geocode({
                            address: $('#user_loc').val(),
                            callback: function( results, status ) {
                                if ( status == 'OK' ) {
                                    var latlng = results[0].geometry.location;
                                    map.setCenter( latlng.lat(), latlng.lng() );
                                    map.addMarker( {
                                        lat: latlng.lat(),
                                        lng: latlng.lng()
                                    } )
                                }
                            }
                        });

                        GMaps.geocode({
                            address: $('#other_loc').val(),
                            callback: function( results, status ) {
                                if ( status == 'OK' ) {
                                    var latlng = results[0].geometry.location;
                                    map.addMarker( {
                                        lat: latlng.lat(),
                                        lng: latlng.lng()
                                    } )
                                }
                            }
                        });

                        console.log( map.markers )

                        $( formMessage ).remove();
                        $( results ).html( data );

                        submitButton.removeAttr('disabled');
                        submitButton.removeClass('disabled');
                    },
                    error: function( errorThrown )
                    {
                        submitButton.removeAttr('disabled');
                        submitButton.removeClass('disabled');

                        if ( errorThrown.responseText !== '' ) {
                            $( formMessage ).text( errorThrown.responseText );
                        } else {
                            $( formMessage ).text( 'Oops! An error occured and your message could not be sent.' );
                        }

                        console.log( errorThrown );
                    }
                })
            } );
        } )
    });
    </script>
</body>
</html>