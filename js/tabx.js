function scrollToTarget(id, parent_id) {
    jQuery("#" + id + ".tabx-category").css('display', 'inline-block');
    jQuery("#" + id).attr('back-target', parent_id);



    jQuery(".tabx-details").css('display', 'none');
    jQuery("#" + id + ".tabx-details[back-target=" + parent_id + "]").css('display', 'block');


    jQuery(".tabx-product").css('display', 'none');
    console.log(".tabx-product");
    jQuery("#" + parent_id + ".tabx-product").css('display', 'block');
    console.log("#" + id + ".tabx-product");
    jQuery("#" + id + ".tabx-product[back-target=" + parent_id + "]").css('display', 'block');
    console.log("#" + id + ".tabx-product[back-target=" + parent_id + "]");



    jQuery(".tabx-product.show").css('display', 'block');
    jQuery(".tabx-product.show .tabx-close").css('display', 'block !important');

    jQuery('html,body').animate({
            scrollTop: jQuery("#" + id).offset().top - 70
        },
        'slow');


}

function tabxClose(id) {
    var target_id = jQuery("#" + id).attr('back-target');
    jQuery("#" + id).css('display', 'none');
    jQuery(".tabx-details").css('display', 'none');

    jQuery('html,body').animate({
            scrollTop: jQuery("#" + target_id).offset().top - 70
        },
        'slow');
    jQuery(".tabx-product.show .tabx-close").css('display', 'none');
    jQuery(this).css('display', 'block');


}


window.onload = function() {

    jQuery('a.porto-sicon-read.xx').click(function() {
        jQuery("#naujienos .tabx-details").first().css('display', 'block');

        var str = jQuery(this).text();
        jQuery(this).text(str.substring(0, str.length - 2));
        jQuery('html,body').animate({
                scrollTop: jQuery("#naujienos .tabx-details").first().offset().top - 110
            },
            'slow');

        jQuery(".tabx-details .tabx-close").css('display', 'block');


    });


    jQuery(document).ready(function() {
        jQuery('.slideshow').slick({
            slidesToShow: 4,
            autoplay: true,
            responsive: [{
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                },
            }],

            nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa fa-long-arrow-right"></i></button>',
            prevArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa fa-long-arrow-left"></i></button>'
        });
    });

    jQuery(document).ready(function() {
        jQuery('.header-slides .vc_column-inner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            mobileFirst: true,
            nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa fa-long-arrow-right"></i></button>',
            prevArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa fa-long-arrow-left"></i></button>'
        });
    });




}