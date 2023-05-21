<link href="../css/loading.css" rel="stylesheet" type="text/css">
<div id="loader-container" class='loader-container'>
  <div class='loader'>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--text'></div>
  </div>
</div>
<script>
    setTimeout(function () {
        $(document).ready(function () {
            document.getElementById("loader-container").style.display = "none";
            document.getElementById("actualpage").style.display = "block";
        });
     }, 2000);
</script>
