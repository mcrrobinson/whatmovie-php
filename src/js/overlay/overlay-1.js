jQuery.fn.center = function () {
    var w = $(window);
    this.css("position", "absolute");
    this.css("top", Math.max(0, ((w.height() - $(this).outerHeight()) / 2) +
        w.scrollTop()) + "px");
    this.css("left", Math.max(0, ((w.width() - $(this).outerWidth()) / 2) +
        w.scrollLeft()) + "px");
    return this;
}

var hasReadAnnouncement = localStorage.getItem("hasReadAnnouncement");
if (!hasReadAnnouncement) {
    $('<div>', {
        id: 'overlay'
    }).appendTo('body');
    $("#announcement").fadeIn('slow').center();
}

$("#close").click(function (e) {
    localStorage.setItem("hasReadAnnouncement", "true");
    $("#announcement").remove();
    $("#overlay").remove();
    e.preventDefault();
});

$("button").on("click", function () {
    localStorage.removeItem("hasReadAnnouncement");
    alert("Storage cleared");
})