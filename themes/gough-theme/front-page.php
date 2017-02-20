<?php
/**
 * Front page file controls the
 * static file for the website
 */
get_header(); ?>

    <!-- Where the magic happens -->
    <div class="location-distance clearfix">
        <div class="col-md-6 google-maps">
            <div id="map"></div>
        </div>
        <div class="col-md-6 user-input">
            <?php if ( have_posts() ): ?>

                <?php while ( have_posts() ): the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; ?>

            <?php endif; ?>
        </div>
    </div>

<?php
get_footer(); ?>