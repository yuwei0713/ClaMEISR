document.getElementById("prebutton").addEventListener('click', function(){
    var action = this.getAttribute("data-action");
    if( action == "front"){
        window.location.href='/front';
    }
    if( action == "back"){
        history.back();
    }
});