$("#trangchu").click(function (e) {
    e.preventDefault();

    $("#song_side").empty();
    $.ajax({
        url: "/trangchu",
        type: "GET",
        success: function (data) {
            $("#song_side").append(data.content);
            $("#yeuthich").removeClass("active");
            $("#livechat").removeClass("active");
            $("#Mchart").removeClass("active");
            $("#ranksong").removeClass("active");
            $("#topic").removeClass("active");
            $("#trangchu").addClass("active");
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
            $("#trangchu").addClass("active");
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
            $("#livechat").removeClass("active");
            $("#Mchart").removeClass("active");
            $("#ranksong").removeClass("active");
            $("#topic").removeClass("active");
            $("#trangchu").removeClass("active");
            $("#yeuthich").addClass("active");
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
            $("#Mchart").removeClass("active");
            $("#ranksong").removeClass("active");
            $("#topic").removeClass("active");
            $("#trangchu").removeClass("active");
            $("#yeuthich").removeClass("active");
            $("#livechat").addClass("active");
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
            $("#ranksong").removeClass("active");
            $("#topic").removeClass("active");
            $("#trangchu").removeClass("active");
            $("#yeuthich").removeClass("active");
            $("#livechat").removeClass("active");
            $("#Mchart").addClass("active");
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
            $("#Mchart").removeClass("active");
            $("#topic").removeClass("active");
            $("#trangchu").removeClass("active");
            $("#yeuthich").removeClass("active");
            $("#livechat").removeClass("active");
            $("#ranksong").addClass("active");
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
            $("#Mchart").removeClass("active");
            $("#ranksong").removeClass("active");
            $("#trangchu").removeClass("active");
            $("#yeuthich").removeClass("active");
            $("#livechat").removeClass("active");
            $("#topic").addClass("active");
        },
    });
});
