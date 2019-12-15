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
}