function count_age() {
    try {
        var $datepicker = $('#age_datepicker').datepicker();

        var today = new Date();
        var birthDate = new Date($datepicker.value());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        document.getElementById("child_age").value = age;
    } catch(e) { }
}
$(document).ready(function () {
    var maxdate = new Date(new Date().getFullYear() - 2, new Date().getMonth(), new Date().getDate());
    var defaultdate = new Date(new Date().getFullYear() - 2, new Date().getMonth(), new Date().getDate());
    var formattedDate = defaultdate.toISOString().split('T')[0];
    $('#age_datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd',
        maxDate: maxdate,
        value: formattedDate, // Set the default date directly during initialization
        change: function () {
            count_age();
        }
    });
    count_age();
});
