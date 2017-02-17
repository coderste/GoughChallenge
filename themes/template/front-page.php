<?php
/**
 * Front page file controls the
 * static file for the website
 */
get_header(); ?>

    <!-- Where the magic happens -->
    <div class="location-distance clearfix">
        <div class="col-md-6 google-maps">
            <img src="https://placehold.it/550x550" alt="" />
        </div>
        <div class="col-md-6 user-input">
            <div class="input-wrap">
                <label for="user_location">Your Location: </label>
                <input type="text" name="user_location" />
            </div>
            <div class="input-wrap">
                <label for="other_location">Other Location: </label>
                <input type="text" name="other_location" />
            </div>
            <div class="submit-wrap">
                <button type="submit" class="btn btn-submit">Calculate Distance</button>
            </div>
        </div>
    </div>

<?php
get_footer(); ?>