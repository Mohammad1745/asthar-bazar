/* =================================
===  EXPAND COLLAPSE            ====
=================================== */
$(document).ready(function(){
    $('#toggle-switcher').click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open');
            $('#switch-content').animate({'right':'-400px'});
            $('#toggle-switcher').css({
                "right" : "400px"
            });
        }else{
            $(this).addClass('open');
            $('#switch-content').animate({'right':'0'});
            if($( window ).width()<=1100){
                $('#toggle-switcher').css({
                    "right" : "299px"
                });
            }
        }
    });
});
