var playlist = document.querySelectorAll(".playlist .itemmenu");
playlist.forEach(function (playlist, index) {
    if (index == activemenu) {
        playlist.classList.add("active");
    } else {
        playlist.classList.remove("active");
    }
});
if (activemenu == 2) {
    $("#searchForm").hide();
} else {
    $("#searchForm").show();
}
