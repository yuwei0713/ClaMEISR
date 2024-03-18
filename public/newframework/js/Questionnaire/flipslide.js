$(function() {
    $(".flip").click(function() {
        $(this).next(".panel").slideToggle(300);
        $(this).toggleClass('active');
    });
});