@if(session()->has('message'))
<div class="alert alert-success" role="alert" id="alert">
        <ul class="list-unstyled mb-0">
            <li>{{ session('message') }}</li>
        </ul>
</div>
@elseif(session()->has('errormessage'))
<div class="alert alert-warning" role="alert" id="alert">
        <ul class="list-unstyled mb-0">
            <li>{{ session('errormessage') }}</li>
        </ul>
</div>
@endif
<script src="../newframework/js/messagealert.js"></script>
