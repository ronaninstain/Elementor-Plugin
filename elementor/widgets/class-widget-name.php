<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Plugin;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    // Exit if accessed directly.
    exit;
}

class Latest_Posts_Widget extends Widget_Base
{

    /**
     * Get the widget's name.
     *
     * @return string
     */
    public function get_name(): string
    {
        return 'pe-latest-posts';
    }

    /**
     * Get the widget's title.
     *
     * @return string
     */
    public function get_title(): string
    {
        return esc_html__('PE Latest Posts', PE_PLUGIN_DOMAIN);
    }

    /**
     * Get the widget's icon.
     *
     * @return string
     */
    public function get_icon(): string
    {
        return 'fa fa-clipboard';
    }

    /**
     * Add the widget to a category.
     * Previously setup in the class-widgets.php file.
     *
     * @return string[]
     */
    public function get_categories(): array
    {
        return ['pe-category'];
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Dynamic Course Assign', PE_PLUGIN_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'course_ids',
            [
                'label' => esc_html__('Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'dropdown',
            [
                'label' => esc_html__('Styles', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'Style1' => esc_html__('Style1', PE_PLUGIN_DOMAIN),
                    'Style2' => esc_html__('Style2', PE_PLUGIN_DOMAIN),
                ],
                'default' => 'Style1',
            ]
        );

        $this->add_control(
            'quantity',
            [
                'label' => esc_html__('Quantity', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'timer',
            [
                'label' => esc_html__('Timer Link', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'timer_shortcode',
            [
                'label' => esc_html__('Timer Shortcode', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'timer_title',
            [
                'label' => esc_html__('Timer Title', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'show_students',
            [
                'label' => esc_html__('Show Students', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', PE_PLUGIN_DOMAIN),
                'label_off' => esc_html__('Hide', PE_PLUGIN_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'bulk_purchase',
            [
                'label' => esc_html__('Bulk Purchase', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', PE_PLUGIN_DOMAIN),
                'label_off' => esc_html__('Hide', PE_PLUGIN_DOMAIN),
                'return_value' => 'no',
                'default' => 'no',
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $course_ids = $settings['course_ids'];
        $styles = $settings['dropdown'];
        $quantity = $settings['quantity'];
        $timer = $settings['timer'];
        $student = $settings['show_students'];

        $timer_shortcode = $settings['timer_shortcode'];
        $timer_title = $settings['timer_title'];

        $bulk_purchase = $settings['bulk_purchase'];



?>
        <?php if ($styles == 'Style1') {
        ?>
            <div class="row">

                <?php
                $course_ID = explode(",", $course_ids);
                $args = array(
                    'post_type' => 'course',
                    'post_status' => 'publish',
                    'posts_per_page' => $quantity,
                    'post__in' => $course_ID,
                    'orderby'  => 'post__in'
                );

                $loop = new WP_Query($args);

                while ($loop->have_posts()) : $loop->the_post();

                ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="course-cart1">

                            <div class="course-img">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small'); ?>" alt="">
                                <div class="view-more-link">
                                    <a href="<?php echo get_the_permalink(); ?>"><i class="fa fa-eye" aria-hidd3en="true"></i>View Details</a>
                                </div>
                            </div>
                            <div class="course-content">
                                <h3 class="title"> <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                                <div class="students">
                                    <div class="<?php echo $student ? "for-sandah-flexing" : "for-sandah-center"; ?>">

                                        <?php if ($student) { ?>
                                            <div class="s-icon">
                                                <img src="" alt="" class="img-icon">
                                                <span>
                                                    <?php
                                                    echo get_post_meta(get_the_ID(), 'vibe_students', true);
                                                    ?>
                                                </span>
                                            </div>
                                        <?php
                                        } ?>
                                        <?php $average_rating = get_post_meta(get_the_ID(), 'average_rating', true); ?>
                                        <div class="rating_sh_content">
                                            <div class="sh_rating">
                                                <div class="sh_rating-upper" style="width:<?php echo $average_rating ? 20 * $average_rating : 0; ?>%">
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                </div>
                                                <div class="sh_rating-lower">
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                    <span>★</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oneEduTimer">

                                        <?php if ($timer_title) {
                                        ?>
                                            <h4 class="timer_title"><?php echo esc_html($timer_title) ?></h4>
                                        <?php
                                        }
                                        ?>

                                        <?php if ($timer) {
                                        ?>
                                            <img src="<?php echo $timer; ?>" alt="timer" style="display: block;" />
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($timer_shortcode) {
                                            echo do_shortcode("$timer_shortcode");
                                        }
                                        ?>


                                    </div>
                                    <div class="course-btn-div">
                                        <?php

                                        $product_id = get_post_meta(get_the_ID(), 'vibe_product', true);

                                        $currency_symble = get_woocommerce_currency_symbol();
                                        $price = get_post_meta($product_id, '_regular_price', true);
                                        $sale = get_post_meta($product_id, '_sale_price', true);

                                        if (!bp_is_my_profile()) {

                                            if (!empty($sale)) {
                                        ?>
                                                <div class="offer-bg">
                                                    <img src="" alt="">
                                                    <strong>
                                                        <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo $currency_symble; ?></span><?php echo $price; ?></span></del>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo $currency_symble; ?></span><?php echo $sale; ?></span></ins>
                                                    </strong>
                                                </div>
                                            <?php
                                            } elseif (empty($sale) && !empty($price)) {
                                            ?>
                                                <div class="offer-bg">
                                                    <img src="" alt="">
                                                    <strong>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo $currency_symble; ?></span><?php echo $price; ?></span></ins>
                                                    </strong>
                                                </div>
                                            <?php
                                            } elseif (empty($sale) && empty($price)) {
                                            ?>
                                                <div class="offer-bg">
                                                    <img src="" alt="">
                                                    <strong>
                                                        <ins><span class="woocommerce-Price-amount amount">free</span></ins>
                                                    </strong>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <!-- <a class="view-details" href="<?php echo get_site_url();  ?>/cart/?add-to-cart=<?php echo $product_id; ?>">Add to Cart</a> -->

                                            <!-- Bulk Purchase -->
                                            <?php
                                            if ($bulk_purchase) {
                                            ?>
                                                <div class="qty-wrapper">
                                                    <input type="button" value="-" class="qty-minus">
                                                    <input type="number" value="1" class="qty" min="1" readonly>
                                                    <input type="button" value="+" class="qty-plus">
                                                    <a href="<?php echo get_site_url();  ?>/cart/?add-to-cart=<?php echo $product_id; ?>" class="cart-btn">Add To Cart</a>
                                                </div>
                                            <?php
                                            }
                                            ?>





                                            <a class="view-details" href="<?php echo get_the_permalink(); ?>">View Details</a>
                                            <br>
                                            <!-- <a class="sa-more-info" href="<?php echo get_the_permalink(get_the_ID());  ?>">More Info</a> -->
                                        <?php

                                        } else {
                                            the_course_button(get_the_ID());
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();

                ?>


            </div>
        <?php
        } elseif ($styles == 'Style2') {
        ?>
            <div class="row the-parent-for-back">
                <?php
                $course_ID = explode(",", $course_ids);
                $arg = array(
                    'post_type' => 'course',
                    'post_status' => 'publish',
                    'post_per_page' => $quantity,
                    'post__in' => $course_ID,
                    'orderby' => 'post__in'
                );
                $courseQuery = new Wp_Query($arg);

                while ($courseQuery->have_posts()) : $courseQuery->the_post();

                ?>
                    <?php
                    $courseID = get_the_ID();
                    $product_id = get_post_meta($courseID, 'vibe_product', true);
                    $terms = get_the_terms($courseID, 'level');
                    $termsPopularity = get_the_terms($courseID, 'popularity');
                    $filterTermsPopularity = array_filter(
                        $termsPopularity,
                        function ($filteredPopularity) {
                            return $filteredPopularity->term_id === 54566 ||
                                $filteredPopularity->term_id === 54571 ||
                                $filteredPopularity->term_id === 54570;
                        }
                    );
                    $course_duration = get_post_meta($courseID, 'vibe_duration', true);
                    $average_rating = get_post_meta($courseID, 'average_rating', true);
                    $countRating = get_post_meta($courseID, 'rating_count', true);
                    $full_stars = floor($average_rating);
                    $remaining_rating = $average_rating - $full_stars;
                    $course_features_list = get_post_meta($courseID, '_course_feature_filed', true);
                    $course_feature_list = explode('/', $course_features_list);
                    ?>
                    <div class="col-xs-12 col-md-3 col-sm-6">
                        <div class="sh23-card">
                            <div class="sh23-card-front">
                                <div class="sh23-card-image">
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url($courseID, 'medium')); ?>" alt="course-tumb"></a>
                                </div>
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
                                    <p class="course-review">
                                        <?php echo $average_rating; ?>
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
                            <div class="sh23-card-back">
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
                                <ul class="course-inner-details">
                                    <li>
                                        <?php
                                        echo  number_format((float)($course_duration / 24), 2, '.', '');
                                        ?> hours total
                                    </li>
                                    <?php if ($terms && !is_wp_error($terms)) {
                                        foreach ($terms as $term) {
                                    ?>
                                            <li><?php echo $term->name; ?></li>
                                    <?php
                                        }
                                    } ?>
                                </ul>
                                <div class="course-exerpt"><?php esc_html(the_excerpt()); ?></div>
                                <i class="triangle"></i>
                                <?php
                                if (!empty($course_features_list)) {
                                    foreach ($course_feature_list as $feature_list) {
                                ?>
                                        <ul class="feauture-facility">
                                            <li><?php echo $feature_list; ?></li>
                                        </ul>
                                <?php
                                    }
                                } ?>

                                <?php
                                if ($product_id) {
                                ?>
                                    <a href="<?php echo esc_url(get_site_url());  ?>/cart/?add-to-cart=<?php echo $product_id; ?>" class="add-to-cart">Add to Cart</a>
                                <?php
                                } else {
                                    echo 'Private';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php
        } ?>

<?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Latest_Posts_Widget());
