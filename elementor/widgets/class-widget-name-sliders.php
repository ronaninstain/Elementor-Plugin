<?php

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    // Exit if accessed directly.
    exit;
}

class Latest_Posts_Widget_Sliders extends Widget_Base
{

    /**
     * Get the widget's name.
     *
     * @return string
     */
    public function get_name(): string
    {
        return 'pe-latest-posts-sliders';
    }

    /**
     * Get the widget's title.
     *
     * @return string
     */
    public function get_title(): string
    {
        return esc_html__('PE Latest Posts sliders', PE_PLUGIN_DOMAIN);
    }

    /**
     * Get the widget's icon.
     *
     * @return string
     */
    public function get_icon(): string
    {
        return 'eicon-post-list';
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
            'course_ids',
            [
                'label' => esc_html__('Style 1 Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'course_category_1',
            [
                'label' => esc_html__('Course Category 1', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_course_categories(),
                'default' => 'none',
            ]
        );

        $this->add_control(
            'course_ids_cat_1',
            [
                'label' => esc_html__('Cat 1 Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
            ]
        );

        // Cat 2

        $this->add_control(
            'course_category_2',
            [
                'label' => esc_html__('Course Category 2', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_course_categories(),
                'default' => 'none',
            ]
        );

        $this->add_control(
            'course_ids_cat_2',
            [
                'label' => esc_html__('Cat 2 Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
            ]
        );

        // Cat 3

        $this->add_control(
            'course_category_3',
            [
                'label' => esc_html__('Course Category 3', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_course_categories(),
                'default' => 'none',
            ]
        );

        $this->add_control(
            'course_ids_cat_3',
            [
                'label' => esc_html__('Cat 3 Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
            ]
        );


        // Cat 4

        $this->add_control(
            'course_category_4',
            [
                'label' => esc_html__('Course Category 4', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_course_categories(),
                'default' => 'none',
            ]
        );

        $this->add_control(
            'course_ids_cat_4',
            [
                'label' => esc_html__('Cat 4 Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
            ]
        );



        // Cat 5

        $this->add_control(
            'course_category_5',
            [
                'label' => esc_html__('Course Category 5', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_course_categories(),
                'default' => 'none',
            ]
        );

        $this->add_control(
            'course_ids_cat_5',
            [
                'label' => esc_html__('Cat 5 Course ID\'s', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::TEXT,
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
            'show_button',
            [
                'label' => esc_html__('Show Button', PE_PLUGIN_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', PE_PLUGIN_DOMAIN),
                'label_off' => esc_html__('Hide', PE_PLUGIN_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title',
            [
                'label' => esc_html__('Title', PE_PLUGIN_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('List Title', PE_PLUGIN_DOMAIN),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__('Content', PE_PLUGIN_DOMAIN),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('List Content', PE_PLUGIN_DOMAIN),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Facility List', PE_PLUGIN_DOMAIN),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__('Title #1', PE_PLUGIN_DOMAIN),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', PE_PLUGIN_DOMAIN),
                    ],
                    [
                        'list_title' => esc_html__('Title #2', 'plugin-name'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', PE_PLUGIN_DOMAIN),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function get_course_categories()
    {
        $categories = get_terms([
            'taxonomy' => 'course-cat',
            'hide_empty' => false,
        ]);

        $options = ['none' => esc_html__('None', PE_PLUGIN_DOMAIN)];

        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $quantity = $settings['quantity'];
        $student = $settings['show_students'];
        $list = $settings['list'];
        $button = $settings['show_button'];
        $styles = $settings['dropdown'];
        $course_ids = $settings['course_ids'];


        $selected_category_1 = $settings['course_category_1'];
        $course_ids_cat_1 = $settings['course_ids_cat_1'];

        $selected_category_2 = $settings['course_category_2'];
        $course_ids_cat_2 = $settings['course_ids_cat_2'];

        $selected_category_3 = $settings['course_category_3'];
        $course_ids_cat_3 = $settings['course_ids_cat_3'];

        $selected_category_4 = $settings['course_category_4'];
        $course_ids_cat_4 = $settings['course_ids_cat_4'];

        $selected_category_5 = $settings['course_category_5'];
        $course_ids_cat_5 = $settings['course_ids_cat_5'];

?>

        <?php if ($styles == 'Style1') {
        ?>
            <div class="Sh-bundle-area">
                <div class="container">
                    <div class="owl-carousel owl-theme owl-bundle">
                        <?php
                        $course_ID = explode(",", $course_ids);


                        $args = array(
                            'post_type' => 'course',
                            'post_status' => 'publish',
                            'posts_per_page' =>  $quantity,
                            'post__in' => $course_ID,
                            'orderby'        => 'post__in'
                        );

                        $loop = new WP_Query($args);

                        while ($loop->have_posts()) : $loop->the_post();

                        ?>
                            <div class="career-bundles-single">
                                <div class="course-img"><img src="<?php echo get_the_post_thumbnail_url(); ?>">
                                </div>
                                <div class="bundle-content">
                                    <div class="bundle-course-title"><a href="<?php echo get_the_permalink(); ?>">
                                            <h2><?php echo get_the_title(); ?></h2>
                                        </a></div>
                                    <div class="for-back-facility-list">
                                        <?php
                                        $facility_field_value = get_post_meta(get_the_ID(), '_facility_filed', true);
                                        if (!empty($facility_field_value)) {
                                            $facility_field_value = explode('/', $facility_field_value);

                                            echo '<ul class="features-from-back-end">';
                                            foreach ($facility_field_value as $facility) {
                                                echo '<li>' . $facility . '</li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                        ?>
                                            <ul class="bundle-course-features">
                                                <?php if ($list) {
                                                    echo '<dd>';
                                                    foreach ($settings['list'] as $item) {
                                                        echo '<li>' . $item['list_content'] . '</li>';
                                                    }
                                                    echo '</dd>';
                                                } ?>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="bundle-course-price">
                                        <?php

                                        $product_id = get_post_meta(get_the_ID(), 'vibe_product', true);

                                        $currency_symble = get_woocommerce_currency_symbol();
                                        $price = get_post_meta($product_id, '_regular_price', true);
                                        $sale = get_post_meta($product_id, '_sale_price', true);

                                        if (!bp_is_my_profile()) {

                                            if (!empty($sale)) {
                                        ?>
                                                <div class="bundle-course-amm">
                                                    <strong>
                                                        <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo $currency_symble; ?></span><?php echo $price; ?></span></del>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo $currency_symble; ?></span><?php echo $sale; ?></span></ins>
                                                    </strong>
                                                </div>
                                            <?php
                                            } elseif (empty($sale) && !empty($price)) {
                                            ?>
                                                <div class="bundle-course-amm">
                                                    <strong>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo $currency_symble; ?></span><?php echo $price; ?></span></ins>
                                                    </strong>
                                                </div>
                                            <?php
                                            } elseif (empty($sale) && empty($price)) {
                                            ?>
                                                <div class="bundle-course-amm">
                                                    <strong>
                                                        <ins><span class="woocommerce-Price-amount amount">free</span></ins>
                                                    </strong>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        <?php

                                        } else {
                                            the_course_button(get_the_ID());
                                        }

                                        ?>
                                        <?php
                                        if ($student) {
                                        ?>
                                            <div class="bundle-course-std"><img src="">
                                                <?php
                                                echo get_post_meta(get_the_ID(), 'vibe_students', true);
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if ($button) { ?>
                                            <div class="athc-buntton">
                                                <a href="">Enquire Now</a>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="bundle-course-reviews">
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
                                        <div><a href="<?php echo get_site_url();  ?>/cart/?add-to-cart=<?php echo $product_id; ?>">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </div>
        <?php
        } elseif ($styles == 'Style2') {
        ?>
            <?php

            $course_ID_Cat_1 = explode(",", $course_ids_cat_1);
            $course_ID_Cat_2 = explode(",", $course_ids_cat_2);
            $course_ID_Cat_3 = explode(",", $course_ids_cat_3);
            $course_ID_Cat_4 = explode(",", $course_ids_cat_4);
            $course_ID_Cat_5 = explode(",", $course_ids_cat_5);

            $resultArray = array(
                $selected_category_1 => $course_ID_Cat_1,
                $selected_category_2 => $course_ID_Cat_2,
                $selected_category_3 => $course_ID_Cat_3,
                $selected_category_4 => $course_ID_Cat_4,
                $selected_category_5 => $course_ID_Cat_5,

            );

            $selected_category = array_filter($resultArray, function ($key) {
                return $key !== 'none';
            }, ARRAY_FILTER_USE_KEY);

            $args = array(
                'post_type' => 'course',
                'post_status' => 'publish',
                'posts_per_page' =>  $quantity,
                'post__in' =>  $course_ID_Cat_1,
                'orderby' => 'post__in',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'course-cat',
                        'field'    => 'id',
                        'terms'    =>   $selected_category_1,
                    ),
                ),
            );
            ?>
            <div class="title-section-sh-23-bundle">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="title-con">
                                <h6>EXPLORE PROGRAMS</h6>
                                <h4>Premium Courses</h4>
                                <p>Discover our most popular courses, handpicked by our team of experts. Enrol now and take the first step towards success.</p>
                            </div>
                        </div>
                        <div class="col-md-3 flexing-for-loader-23-bundle">
                            <label for="course-id-ele-plug-2" class="course-id-ele-plug-2-label"><i class="fa fa-th" aria-hidden="true"></i> Categories:</label>
                            <select name="" id="course-id-ele-plug-2">
                                <?php foreach ($selected_category as $catId => $categorySingle) {
                                    $selected_cat_name =  get_term($catId, 'course-cat');
                                    $selected_course_id = implode(",", $categorySingle);
                                ?>
                                    <option courseid="<?php echo $selected_course_id; ?>" value="<?php echo $catId; ?>"><?php echo $selected_cat_name->name; ?></option>
                                <?php
                                } ?>
                            </select>
                            <img src="<?php echo PE_PLUGIN_URL . 'elementor/assets/img/loader4.gif'; ?>" class="sh-23-loader" alt="sh-23-loader">
                        </div>
                    </div>
                </div>
            </div>
            <div id="owl-sh-23-bundle" class="owl-carousel owl-sh-23-bundle owl-theme owl-bundle">
                <?php
                $loop = new WP_Query($args);
                while ($loop->have_posts()) : $loop->the_post();
                ?>
                    <?php
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
                ?>
            </div>
        <?php
        } ?>
<?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Latest_Posts_Widget_Sliders());
