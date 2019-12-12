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
    // wp_enqueue_script('semantic-ui-script',  plugin_dir_url(__FILE__) .  'js/semantic.min.js', ['jquery'], '', true);
}
add_action('wp_enqueue_scripts', 'loadStylesandScripts');

function catView($attr)
{ ?>

    <div class="tabx" id="<?php echo $attr['id']; ?>">

        <?php

            $cats = getCategories();
            // $cats =  explode(',', $attr['categories']);
            // foreach ($cats as $key => $value) { 

            foreach ($cats as $cat) {
                if ($cat->category_parent == 0) { ?>
                <!-- single tab -->
                <div class="tab">
                    <div class="the-image"> <?php getCatImg($cat->term_id); ?> </div>
                    <div class="the-label">
                        <h3><?php echo $cat->name; ?></h3>
                    </div>
                    <div class="the-link"><a>Plačiau <i class="fa fa-long-arrow-right"></i></a></div>
                </div>
                <!-- single tab ends -->



        <?php productView($cat->slug);
                }
            }
            ?>



        <?php
            // }
            ?>



    </div>


<?php  }


function productView($slug)
{
    // Get shirts.
    $args = array(
        'category' => array($slug),
    );
    $products = wc_get_products($args);
   
    echo `length of products`. sizeof($products);
    
    foreach ($products as $product) { ?>
  <!-- print_r($product->category_ids[0])  -->
   
     
    <?php }
   
    ?>

    <script type="text/javascript">
        var products = <?php echo json_encode($products); ?>;
        window['products'] = products;
    </script>

<?php }

function getCategories()
{


    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no  
    $title        = '';
    $empty        = 0;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
    );
    $all_categories = get_categories($args);
    // print_r($all_categories);
    ?>
    <script type="text/javascript">
        var cats = <?php echo json_encode($all_categories); ?>;
        window['cats'] = cats;
    </script>
<?php
    return $all_categories;
    // foreach ($all_categories as $cat) {
    //     if ($cat->category_parent == 0) {
    // $category_id = $cat->term_id;
    // print_r($cat);
    // echo '<br /><a href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a>';
    // echo getCatImg($cat->term_id);
    // $args2 = array(
    //     'taxonomy'     => $taxonomy,
    //     'child_of'     => 0,
    //     'parent'       => $category_id,
    //     'orderby'      => $orderby,
    //     'show_count'   => $show_count,
    //     'pad_counts'   => $pad_counts,
    //     'hierarchical' => $hierarchical,
    //     'title_li'     => $title,
    //     'hide_empty'   => $empty
    // );
    // $sub_cats = get_categories($args2);
    // if ($sub_cats) {
    //     foreach ($sub_cats as $sub_category) {
    //         echo  $sub_category;
    //     }
    // }
    //     }
    // }
}

function getCatImg($term_id)
{

    $cat_thumb_id = get_woocommerce_term_meta($term_id, 'thumbnail_id', true);
    $cat_thumb_url = wp_get_attachment_url($cat_thumb_id);
    ?>
    <img src="<?php echo $cat_thumb_url; ?>" />
<?php
}

add_shortcode('doit', 'catView');
