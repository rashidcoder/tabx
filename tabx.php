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


function test($attr)
{ ?>


    <style>
        .tabx {
            width: 100% !important;
            max-width: -webkit-fill-available !important;
            text-align: center;
        }

        .tabx .tab {
            border: 2px solid transparent;
            width: 20%;
            box-shadow: 3px 6px 20px #ccc;
            display: inline-block;
            background-color: white;
            margin: 15px;
            cursor: pointer;
            border-radius: 10px;
            transition-property: border-color;
            transition-duration: 0.3s;
            -moz-transition-property: border-color;
            -moz-transition-duration: 0.3s;
            -webkit-transition-property: border-color;
            -webkit-transition-duration: 0.3s;
            -o-transition-property: border-color;
            -o-transition-duration: 0.3s;
            -ms-transition-property: border-color;
            -ms-transition-duration: 0.3s;
            -ms-transition-timing-function: ease-out;
            -webkit-transition-timing-function: ease-out;
            -moz-transition-timing-function: ease-out;
            -o-transition-timing-function: ease-out;
            transition-timing-function: ease-out;
        }

        .tabx .tab:hover {

            border: 2px solid #2f8dba;
        }

        .tabx .the-image img {
            border-radius: 10px;
        }

        .tabx .the-label h3 {
            font-weight: 500;
            color: #000000;
            font-size: 17px;
            line-height: 25px;
        }

        .tabx .the-link {
            text-align: center;
            padding-bottom: 10px;
        }

        .tabx .the-link a {
            color: #2f8dba;
            text-decoration: none;
        }
    </style>
    <div class="tabx" id="<?php echo $attr['id']; ?>">

        <?php
            $cats =  explode(',', $attr['categories']);
            foreach ($cats as $key => $value) { ?>

            <!-- single tab -->
            <div class="tab">
                <div class="the-image"> <img src="https://peak.begaak.com/wp-content/uploads/2019/11/img1.jpg" alt=""></div>
                <div class="the-label">
                    <h3><?php echo $value; ?></h3>
                </div>
                <div class="the-link"><a>Plačiau <i class="fa fa-long-arrow-right"></i></a></div>
            </div>
            <!-- single tab ends -->

        <?php }

            ?>



    </div>

<?php
    # code...

    // print_r($attr);
}

add_shortcode('doit', 'test');
