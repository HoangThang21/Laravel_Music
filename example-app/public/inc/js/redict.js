document.addEventListener("DOMContentLoaded", () => {
    var playlist = document.querySelectorAll(".playlist .itemmenu");
    playlist.forEach(function (playlist, index) {
        if (index == activemenu) {
            playlist.classList.add("active");
        } else {
            playlist.classList.remove("active");
        }
    });
    var list_memu = document.querySelector(".menu-list-right-setup #list-memu");
    var active_right_menu_setup = true;
    if (list_memu) {
        list_memu.addEventListener("click", function () {
            var right_menu_setup = document.querySelector(
                ".menu-list-right-setup .right-menu-setup"
            );
            if (active_right_menu_setup) {
                right_menu_setup.classList.add("active");
                active_right_menu_setup = false;
            } else {
                right_menu_setup.classList.remove("active");
                active_right_menu_setup = true;
            }
        });
    }

    if (activemenu == 2) {
        $("#searchForm").hide();
    } else {
        $("#searchForm").show();
    }
    var thongbao = document.querySelector(".thongbao");
    var tieudeDiv = document.querySelector(".tieude");
    var nhaccholist = document.querySelectorAll(".nhaccho");
    nhaccholist.forEach(function (nhaccholistitem, index) {
        nhaccholistitem.addEventListener("click", function () {
            var dataChoValue = nhaccholistitem.getAttribute("data-cho");
            var dataChoValueGia = parseFloat(
                nhaccholistitem.getAttribute("data-gia")
            );
            var giaFormatted = dataChoValueGia.toLocaleString("vi-VN", {
                style: "currency",
                currency: "VND",
            });
            thongbao.style.display = "block";
            tieudeDiv.textContent =
                "Soạn: CHON " +
                dataChoValue +
                " gửi 9224 ( " +
                giaFormatted +
                ")";
        });
    });
    var downloadButton = document.querySelector(".menu-right-media .download");
    downloadButton.addEventListener("click", function () {
        var musicUrl = this.getAttribute("data-downloadmusic");
        var downloadLink = document.createElement("a");
        downloadLink.href = "../../music/" + musicUrl;
        downloadLink.download = musicUrl;
        downloadLink.click();
    });
    function menuAll(itemcha, itemcon) {
        let menudot = document.querySelectorAll("." + itemcha);
        var itemlistdot = document.querySelectorAll("." + itemcon);
        menudot.forEach(function (menudot1, indexi1) {
            menudot1.addEventListener("click", () => {
                itemlistdot.forEach(function (itemlistdot1, indexi2) {
                    if (indexi1 == indexi2) {
                        const isHidden1 =
                            itemlistdot1.style.display === "none" ||
                            getComputedStyle(itemlistdot1).display === "none";
                        itemlistdot1.style.display = isHidden1
                            ? "flex"
                            : "none";
                    } else {
                        itemlistdot1.style.display = "none";
                    }
                });
            });
        });
    }
    var seekVol = document.getElementById("seek-vol");
    var bar2 = document.getElementById("bar-vol");
    var dot = document.getElementById("dot-music");
    seekVol.addEventListener("input", function () {
        var value = seekVol.value;
        var percent = value - seekVol.min;
        bar2.style.width = percent + "%";
        dot.style.left = percent + "%";
        console.log(percent);
    });
    var seek = document.getElementById("seek");
    var bar2_seek = document.getElementById("bar2");
    var dot_seek = document.getElementById("dot_music");
    seek.addEventListener("input", function () {
        var value = seek.value;
        var percent = value - seek.min;
        bar2_seek.style.width = percent + "%";
        dot_seek.style.left = percent + "%";
        console.log(percent);
    });
    menuAll("dot-3", "menu-right-media");
    setInterval(function () {
        thongbao.style.display = "none";
    }, 30000);
});
