$(document).ready(function ($) {
    $('.default').click(function () {    
    $(this).toggleClass('active').next().find('.sub-table-wrap').slideToggle();
    $(".toggle-row").not($(this).next()).find('.sub-table-wrap').slideUp('fast');
  });
});