<?php

/* For Ele plugin 2 by Shoive */

// AJAX callback function to process the selected option value
add_action('wp_ajax_process_selected_option', 'process_selected_option');
add_action('wp_ajax_nopriv_process_selected_option', 'process_selected_option');

function process_selected_option()
{
    // Get the selected option value from the AJAX request
    $selected_value = $_GET['selected_value'];
    $courseIDs = explode(",", $_GET['courseIDs']);


    $args = array(
        'post_type' => 'course',
        'post_status' => 'publish',
        'posts_per_page' =>  count($courseIDs),
        'post__in' => $courseIDs,
        // 'orderby' => 'post__in',
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'course-cat',
        //         'field'    => 'id',
        //         'terms'    =>   $selected_value,
        //     ),
        // ),
    );
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
        // Declarations starts
        $courseID = get_the_ID();
        $termsPopularity = get_the_terms($courseID, 'popularity');
        $filterTermsPopularity = array_filter(
            $termsPopularity,
            function ($filteredPopularity) {
                return $filteredPopularity->term_id === 54566 ||
                    $filteredPopularity->term_id === 54571 ||
                    $filteredPopularity->term_id === 54570;
            }
        );
        $average_rating = get_post_meta($courseID, 'average_rating', true);
        $countRating = get_post_meta($courseID, 'rating_count', true);
        $full_stars = floor($average_rating);
        $remaining_rating = $average_rating - $full_stars;
        $product_id = get_post_meta($courseID, 'vibe_product', true);
        // Declarations ends
        ?>

        <div class="sh-23-bundle-item">
            <div class="sh-bundle-image">
                <a href=""><img src="<?php echo esc_url(get_the_post_thumbnail_url($courseID, 'medium')); ?>" alt="course-tumb"></a>
            </div>
            <div class="sh-23-bundle-content">
                <div class="sh23-card-content">
                    <ul class="course-tags">
                        <?php if ($filterTermsPopularity && !is_wp_error($filterTermsPopularity)) {
                            foreach ($filterTermsPopularity as $popularity) {
                        ?>
                                <li><?php echo $popularity->name; ?></li>
                        <?php
                            }
                        } ?>
                    </ul>
                    <h4 class="course-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
                    <p class="course-review"><?php echo $average_rating; ?>
                        <?php
                        for ($i = 0; $i < $full_stars; $i++) {
                            echo '<span style="color: #ffa800;">★</span>';
                        }

                        if ($remaining_rating >= 0.25 && $remaining_rating < 0.75) {
                            echo '<span style="position: relative; display: inline-block; color: #ffa800;">';
                            echo '★<span style="position: absolute; top: 0; left: 0; overflow: hidden; width: 50%;">★</span>';
                            echo '</span>';
                        }
                        ?>
                        <span><?php echo '(' . $countRating . ')'; ?></span>
                    </p>
                    <h3 class="course-price"><?php echo esc_html(bp_course_credits()); ?></h3>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
    wp_die();
}
