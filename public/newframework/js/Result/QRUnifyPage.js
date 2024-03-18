$(document).ready(function ($) {
    $('.default').click(function () {    
    $(this).toggleClass('active').next().find('.sub-table-wrap').slideToggle();
    $(".toggle-row").not($(this).next()).find('.sub-table-wrap').slideUp('fast');
  });
});
try{
  var backButton = document.getElementById("backButton").addEventListener("click", function() {
    // Navigate back in history when the button is clicked
    history.back();
  });
}catch(e){}