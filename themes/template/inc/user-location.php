<?php
/**
 * Plugin Name: User Input Location
 * Plugin URI: https://www.stephenhinett.co.uk
 * Description: This Plugin adds a shortcode that calls an user Input form. This allows the user to enter their location and then a second location to work out the distance between the two
 * Version: 1.0
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Return the form for the user location input
 */
function locationForm()
{
    ?>
    <form id="location_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="user_location_form">
        <div class="input-wrap">
            <label for="user_location">Your Location: </label>
            <input id="user_loc" type="text" name="user_location" class="required" />
        </div>
        <div class="input-wrap">
            <label for="other_location">Other Location: </label>
            <input id="other_loc" type="text" name="other_location" class="required" />
        </div>
        <div class="submit-wrap">
            <button type="submit" class="btn btn-submit">Calculate Distance</button>
        </div>
        <div id="result"></div>
        <div class="form-message"></div>
    </form>
    <?php
}
add_shortcode( 'LocationForm', 'locationForm' );

function location_data()
{

    if ( $_SERVER['REQUEST_METHOD'] == "POST" )
    {
        /**
         * Get the forms fields
         */
        $user_loc = urlencode( $_POST['user_location'] );
        $other_loc = urlencode( $_POST['other_location'] );
        $data = file_get_contents( "http://maps.googleapis.com/maps/api/distancematrix/json?origins=$user_loc&destinations=$other_loc&language=en-EN&sensor=false" );
        $data = json_decode( $data );
        $distance = 0;

        if ( empty( $user_loc ) OR empty( $other_loc ) )
        {
            http_response_code(400);
            echo "Please fill in all the fields";
            die;
        }

        foreach ( $data->rows[0]->elements as $road )
        {
            $distance += $road->distance->value;
        }

        $distance = round( $distance / 1000 );

        // Output
        if ( $distance != 0 )
        {
            echo "<div id='result-generated'>";
            echo "Distance: " . $distance . " km(s)";
            echo "<br/>";
            echo "From: " . $data->origin_addresses[0];
            echo "<br/>";
            echo "To: ". $data->destination_addresses[0];
            echo "<br/>";
            echo "</div>";
        } else {
            die;
        }
    }

}
add_action( 'wp_ajax_location_submit', 'location_data' );
add_action( 'wp_ajax_nopriv_location_submit', 'location_data' );