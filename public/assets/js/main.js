$(document).ready(() => {
    
    $("#toggle-menu").on("click", function(){
        if($("#navbar-menu").is(":visible")){
            $("#navbar-menu").hide();
            $("#toggle-menu").text("Menu");
        }else{
            $("#navbar-menu").show();
            $("#toggle-menu").text("X");
            $('#navbar-menu').css('display', 'fixed');
        }
    });



});