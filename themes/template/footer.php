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
        map = new GMaps({
            div: '#map',
            lat: 52.3353884,
            lng: -2.0625768
        });
        GMaps.geolocate({
            success: function( position )
            {
                map.setCenter( position.coords.latitude, position.coords.longitude );
                map.addMarker( {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                } );
            },
            error: function( error )
            {
                alert( 'Gelocation Failed! ' + error.message );
            },
            not_supported: function()
            {
                alert( 'Your browser does not support geolocation' );
            }
        })
    </script>
    <script type="text/javascript">
    jQuery(document).ready( function($) {

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