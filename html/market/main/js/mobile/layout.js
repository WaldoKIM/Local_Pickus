$(document).ready(function () {
    //Mobile Title Back Button
    $('.my_location ol li:last-child i').click(function () {
        history.back()
    });
    //Sort List
    $('.cbp-vm-options_mobile .now_select').click(function () {
        $(this).next('.drop_list').slideToggle();
        $(this).toggleClass('open');
    });
    var drop_list_text = $('.cbp-vm-options_mobile .drop_list a.select').text();
    $('.cbp-vm-options_mobile .now_select').text(drop_list_text)
});