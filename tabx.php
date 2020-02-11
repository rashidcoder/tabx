<?php
/*
Plugin Name: Tabx
Plugin URI:  https://begaak.com
Description: WordPress plugin for tabs 
Version:     0.1
Author:     Rashid Iqbal
Author URI:  https://begaak.com/our-team/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: tabx
Domain Path: /languages
*/
// 1) arrows not changed yet
// 2) body background color -> #fff
// 3) min-height of birds section
// 4) add same margin/padding between last bird and gallery,
// as it's between first bird and filter -> photo attached

function loadStylesandScripts()
{

    wp_enqueue_style('tabx-css',  plugin_dir_url(__FILE__) . 'css/tabx.css');
    wp_enqueue_script('tabx-script',  plugin_dir_url(__FILE__) .  'js/tabx.js', ['jquery'], '', true);
    wp_enqueue_script('diyslider-script',  'https://pioul.fr/ext/jquery-diyslider/jquery.diyslider.min.js', ['jquery'], '', true);
    wp_enqueue_script('slick-script',  'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', ['jquery'], '', true);
}
add_action('wp_enqueue_scripts', 'loadStylesandScripts');

function get_cat_view($attrs)
{ ?>

    <div class="tabx tabx-category" id="<?php echo $attrs['id']; ?>">

        <?php

        $json_data = json_decode($attrs['categories']);

        foreach ($json_data as $cat => $target) {
            $cat = get_term_by('slug', trim($cat), 'product_cat');
        ?>


            <!-- single tab -->
            <div class="tab" onClick="scrollToTarget('<?php echo $target; ?>','<?php echo $attrs['id']; ?>')">
                <div class="the-image">
                    <?php getCatImg($cat->term_id); ?> </div>
                <div class="the-label">
                    <h3>
                        <?php echo $cat->name; ?>
                    </h3>
                </div>
                <div class="the-link"><a>Plačiau <i class="fa fa-long-arrow-right"></i></a></div>
            </div>
            <!-- single tab -->
        <?php

        } ?>
    </div>
<?php
}


function get_product_view($attrs)
{   ?>
    <div class="tabx tabx-product <?php echo $attrs['class']; ?>" id="<?php echo $attrs['id']; ?>">
        <div class="tabx-close" onclick="tabxClose('<?php echo $attrs['id']; ?>')">
            <div class="grid-title">
                <h3>
                    <?php
                    if (isset($attrs['title'])) {
                        echo $attrs['title'];
                    }
                    ?>
                </h3>
                <div class="close">x</div>
            </div>
        </div>
        <?php
        $json_data = json_decode($attrs['ids']);
        // print_r($json_data);  ;
        ?>


        <div class="<?php echo strpos($attrs['class'], 'slides')?'slideshow':''; ?>">
            <?php
            foreach ($json_data as $post_id => $details_html_id) {
                $post = get_post(trim($post_id)); ?>
                <!-- single tab -->
                <div class="tab" onClick="scrollToTarget('<?php echo $details_html_id; ?>','<?php echo $attrs['id']; ?>')">
                    <div class="the-image">
                        <?php getProductImg($post->ID); ?> </div>
                    <div class="the-label">
                        <h3>
                            <?php echo $post->post_title; ?>
                        </h3>
                    </div>
                    <div class="the-link"><a>Plačiau <i class="fa fa-long-arrow-right"></i></a></div>
                </div>
                <!-- single tab -->


            <?php
            }  ?>
        </div>
    </div>
<?php

}

function get_details($attrs)
{   ?>
    <div class="tabx tabx-details" id="<?php echo $attrs['id']; ?>">


        <div class="tabx-close" onclick="tabxClose('<?php echo $attrs['id']; ?>')">
            <div class="grid-title">
                <h3>
                    <?php
                    if (isset($attrs['title'])) {
                        echo $attrs['title'];
                    }
                    ?>
                </h3>
                <div class="close">x</div>
            </div>
        </div>

        <!-- single tab -->
        <div class="tab-content">

            <div class="the-content">
                <?php
                $query = get_post($attrs['post_id']);
                $content = apply_filters('the_content', $query->post_content);
                echo $content;
                ?>
            </div>
        </div>


    </div>
<?php

} ?>



<?php


function getCatImg($term_id)
{

    $cat_thumb_id = get_woocommerce_term_meta($term_id, 'thumbnail_id', true);
    $cat_thumb_url = wp_get_attachment_url($cat_thumb_id);
    if ($cat_thumb_url == "") {
        $cat_thumb_url = "https://i0.wp.com/aakp.org/wp-content/uploads/woocommerce-placeholder.png?resize=1024%2C1024&ssl=1";
    }
?>
    <img src="<?php echo $cat_thumb_url; ?>" />
<?php
}

function getProductImg($id)
{
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'single-post-thumbnail');

?>
    <img src="<?php echo $image[0]; ?>" data-id="<?php echo $id; ?>">
<?php
}

add_shortcode('get_cats', 'get_cat_view');
add_shortcode('get_products', 'get_product_view');
add_shortcode('get_details', 'get_details');
