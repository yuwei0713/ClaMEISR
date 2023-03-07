function count_age() {
    var $datepicker = $('#age_datepicker').datepicker();

    var today = new Date();
    var birthDate = new Date($datepicker.value());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    document.getElementById("child_age").value = age;
}