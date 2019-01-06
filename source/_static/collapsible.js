$(document).ready(function() {
    // uncomment this line to start all collapsible containers open
    //$(".collapsible").addClass("open");

    // collapsible containers start closed unless they have class 'open'
    $(".collapsible:not(.open) > :not(p:first-child)").hide();

    // clicking on a header will toggle the container state
    $(".collapsible > p:first-child").click(function() {
        $(this).parent().children().not("p:first-child").toggle(400);
        $(this).parent().toggleClass("open");
    })
});
