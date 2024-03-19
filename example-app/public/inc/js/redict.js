$("#trangchu").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/trangchu",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});

$("#home_rec").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/trangchu",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});
$("#yeuthich").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/yeuthich",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});
$("#livechat").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/livechat",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});
$("#Mchart").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/Mchart",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});
$("#ranksong").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/ranksong",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});
$("#topic").click(function (e) {
    e.preventDefault();
    $("#song_side").empty();
    $.ajax({
        url: "/topic",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
        },
    });
});
