function scroll(id) {
    $("html,body").animate({
        scrollTop: $("#" + id).offset().top - 5
    });
}

function nav(parent, id) {
    $(".nav-link").removeClass("sidebar-item-active")
    $("#" + parent).addClass("sidebar-item-active");
    $(".sidebar-parent").css("display", "none");
    $("#" + id).css("display", "block");
    $("." + id).css("display", "block");
}