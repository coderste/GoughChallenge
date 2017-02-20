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
                                    // Store the first location
                                    var latlng1 = results[0].geometry.location;

                                    /**
                                     * Get the second location
                                     */
                                    GMaps.geocode({
                                        address: $('#other_loc').val(),
                                        callback: function( results, status ) {
                                            if ( status == 'OK' ) {
                                                // Store the second location
                                                var latlng2 = results[0].geometry.location;
                                                // Draw on the map the route
                                                map.drawRoute({
                                                    origin: [latlng1.lat(), latlng1.lng()],
                                                    destination: [latlng2.lat(), latlng2.lng()],
                                                    travelMode: 'driving',
                                                    strokeColor: '#131540',
                                                    strokeOpacity: 0.6,
                                                    strokeWeight: 6
                                                });
                                                // Store both locations in one an array
                                                var latlngs = [
                                                    {
                                                        lat: latlng1.lat(),
                                                        lng: latlng1.lng()
                                                    },
                                                    {
                                                        lat: latlng2.lat(),
                                                        lng: latlng2.lng()
                                                    }
                                                ];
                                                // Bounds is an empty array
                                                var bounds = [];
                                                // For each location in the latlngs array
                                                // add the markers and zoom the map out
                                                // to fit the boundaries
                                                for ( var i in latlngs ) {
                                                    var latlng = new google.maps.LatLng( latlngs[i].lat, latlngs[i].lng )
                                                    bounds.push( latlng );
                                                    map.addMarker({
                                                        lat: latlngs[i].lat,
                                                        lng: latlngs[i].lng
                                                    })
                                                }
                                                // Fir the LatLngBounds
                                                map.fitLatLngBounds(bounds);
                                            }
                                        }
                                    });
                                }
                            }
                        });

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