$('.tabs_slider').on('mouseenter', '.catalog_item', function () {
    $(this).find('.footer_button, .fast_view_block').show();
});
$('.tabs_slider').on('mouseleave', '.catalog_item', function () {
    $(this).find('.footer_button, .fast_view_block').hide();
});
$(document).ready(function () {
    $('.tabs_slider .price.discount .values_wrapper').each(function () {
        if (!($(this).is(':visible'))) {
            $(this).closest('.price.discount').hide();
        }
    });
});