$(document).ready(function() {
    //	$("nav ul.child").removeClass("child");
    //	$("nav ul.grandchild").removeClass("grandchild");

    $("nav li").has("ul").hover(function() {
//       ("nav li.current").removeClass("current");
        $(this).addClass("current").children("ul").slideDown();
    }, function() {
        $(this).removeClass("current").children("ul").stop(true, true).slideUp();
    });
}) ;
