if($("#content1").css("display") == "block") {
    $("#homeIcon").css("fill", "#EC6FE4");
}

$("#homeIcon").on('click', function() {
    $("#content2, #content3, #content4, #content5, #content6").css("display", "none");
    $("#content1").css("display", "block");
    $("#homeIcon").css("fill", "#EC6FE4");
});

$("#elevIcon").on('click', function() {
    $("#content1, #content3, #content4, #content5, #content6").css("display", "none");
    $("#content2").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#foretagIcon").on('click', function() {
    $("#content1, #content2, #content4, #content5, #content6").css("display", "none");
    $("#content3").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#periodIcon").on('click', function() {
    $("#content1, #content2, #content3, #content5, #content6").css("display", "none");
    $("#content4").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#classIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content6").css("display", "none");
    $("#content5").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#platsIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content5").css("display", "none");
    $("#content6").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$('.navbar svg').click(function() {
    $(this).toggleClass('toggle-state');
    $('.navbar svg').not(this).removeClass('toggle-state');
});