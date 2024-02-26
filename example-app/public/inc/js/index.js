let myMusic = [];
let thuvienA = [];

let setplay = 0;
var idthuvien = 0;
var idthuvienall = 0;
var playButtonId = document.querySelectorAll(".songItem i");
var IgMuSc = document.querySelector(".IgMuSc");
var NameBai = document.querySelector(".NameBai");
var NameNS = document.querySelector(".NameNS");
var Add = document.querySelectorAll(".ItemGroup .Add");
var Xoa = document.querySelectorAll(".ItemGroup .Xoa");

let wave = document.querySelector(".wave");
let currentStart = document.getElementById("currentStart");
let currentEnd = document.getElementById("currentEnd");
let rangeBar = document.getElementById("seek");
let bar2 = document.getElementById("bar2");
let dot_music = document.getElementById("dot_music");
playButtonId.forEach(function (playButton, indexi) {
    playButton.addEventListener("click", () => {
        playButtonId.forEach(function (playButton, indexi) {
            playButton.classList.remove("bi-pause-circle-fill");
            playButton.classList.add("bi-play-circle-fill");
        });
        var playButtonIdplay = playButton.id;
        myMusic = [...myMusic, playButtonIdplay];

        if (myMusic.length > 0) {
            Playing();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            setplay = 1;
        } else {
            PlayingEnd();
            setplay = 0;
        }
        myMusic.splice(0, 1);

        playButton.classList.remove("bi-play-circle-fill");
        playButton.classList.add("bi-pause-circle-fill");
        var id = playButton.title;
        $.ajax({
            type: "POST",
            url: "/ln/" + id,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                console.log("wellcome to diablu music");
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
        $.ajax({
            type: "POST",
            url: "/loadmusic/" + id,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                IgMuSc.src = "../../images/" + data.success.imagemusic;
                NameBai.innerText = data.success.tennhac;
                NameNS.innerText = data.successns.tennghesi;
            },

            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    });
});

let timer = setInterval(displayTimer, 100);
let masterPlay = document.getElementById("masterPlay");
let music = new Audio();
var i = 0;
masterPlay.addEventListener("click", () => {
    if (i == 0) {
        myMusic = [...myMusic, baidau];
        i = 1;
        $.ajax({
            type: "POST",
            url: "/ln/" + idbaidau,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                console.log("wellcome to diablu music");
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    }
    if (setplay == 0) {
        if (myMusic.length === 0) {
            PlayingEnd();
        } else {
            Playing();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            setplay = 1;
            timer = setInterval(displayTimer, 100);
        }
    } else {
        PlayingEnd();
        setplay = 0;
    }
});
var dem = 0;
music.addEventListener("ended", () => {
    myMusic.splice(0, 1);
    thuvienA.splice(0, 1);
    setplay = 0;
    dem++;

    if (myMusic.length == 0) {
        PlayingEnd();
        dem = 0;
    } else {
        Playing();
        playButtonIdthuvien.forEach(function (playButton, indexi) {
            playButton.classList.remove("bi-pause-circle-fill");
            playButton.classList.add("bi-play-circle-fill");
            playButton.classList.remove("active");

            if (dem === indexi) {
                playButton.classList.remove("bi-play-circle-fill");
                playButton.classList.add("bi-pause-circle-fill");
                playButton.classList.add("active");
                wave.classList.add("active2");
                setplay = 1;
            }
        });

        $.ajax({
            type: "POST",
            url: "/ln/" + thuvienA[0],
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                console.log("wellcome to diablu music");
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
        $.ajax({
            type: "POST",
            url: "/loadmusic/" + thuvienA[0],
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                IgMuSc.src = "../../images/" + data.success.imagemusic;
                NameBai.innerText = data.success.tennhac;
                NameNS.innerText = data.successns.tennghesi;
            },

            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    }

    playButtonId.forEach(function (playButton1, indexi) {
        playButton1.classList.remove("bi-pause-circle-fill");
        playButton1.classList.add("bi-play-circle-fill");
    });
});
function Playing() {
    music.src = "../../music/" + myMusic[0];
    music.addEventListener("loadedmetadata", function () {
        rangeBar.max = music.duration;
    });
    music.play();
}
function PlayingEnd() {
    music.pause();
    masterPlay.classList.remove("bi-pause-fill");
    masterPlay.classList.add("bi-play-fill");
    wave.classList.remove("active2");
}
let setcurrenttime = 0;
rangeBar.addEventListener("change", handleChangeBar);
function handleChangeBar() {
    setcurrenttime = rangeBar.value;
    a = false;
}

let a = true;
music.addEventListener("timeupdate", displayTimer);

function displayTimer() {
    let { duration, currentTime } = music;
    rangeBar.max = music.duration;
    music.volume = 0.5;
    if (a == false) {
        currentTime = Number(setcurrenttime);
        a = true;
    }
    currentEnd.textContent = formatTimer((duration - currentTime) | "00:00");
    if (!duration) {
        currentStart.textContent = "00:00";
    } else {
        currentStart.textContent = formatTimer(currentTime);
    }
    let pro = parseInt((currentTime / duration) * 100);

    let seek = pro;
    bar2.style.width = `${seek}%`;
    dot_music.style.left = `${seek}%`;
}

function formatTimer(time) {
    const m = Math.floor(time / 60);
    const s = Math.floor(time - m * 60);
    return `${m}:${s < 10 ? "0" : ""}${s}`;
}
const imgdropdow = document.querySelector(".user");
const dropdow = document.querySelector(".user .dropdow");
const dropdo_login = document.querySelector(".user .dropdo_login");
imgdropdow.addEventListener("click", function () {
    if (dropdow) {
        const isHidden =
            dropdow.style.display === "none" ||
            getComputedStyle(dropdow).display === "none";
        dropdow.style.display = isHidden ? "block" : "none";
    }
    if (dropdo_login) {
        const isHidden1 =
            dropdo_login.style.display === "none" ||
            getComputedStyle(dropdo_login).display === "none";
        dropdo_login.style.display = isHidden1 ? "block" : "none";
    }
});
Add.forEach(function (addButton, indexi) {
    addButton.addEventListener("click", function () {
        var ida = addButton.title;

        $.ajax({
            type: "POST",
            url: "/addmusic/" + user + "-" + ida,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                alert("Thêm thành công");
            },

            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    });
});
Xoa.forEach(function (xoaButton, indexi) {
    xoaButton.addEventListener("click", function () {
        var ida = xoaButton.title;

        $.ajax({
            type: "POST",
            url: "/xoamusic/" + user + "-" + ida,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                alert("Thêm thành công");
            },

            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    });
});

// thu vien-----------------------------------------------------------------------------------------
var playButtonIdthuvien = document.querySelectorAll(".songItemALLlabary i");
var currentIndex = 0;
playButtonIdthuvien.forEach(function (playButton, indexi) {
    var playButtonIdplay = playButton.id;
    myMusic = [...myMusic, playButtonIdplay];
    thuvienA = [...thuvienA, playButton.title];

    playButton.addEventListener("click", () => {
        playButtonIdthuvien.forEach(function (playButton, indexiabc) {
            playButton.classList.remove("bi-pause-circle-fill");
            playButton.classList.add("bi-play-circle-fill");
            playButton.classList.remove("active");
        });
        myMusic = [];
        thuvienA = [];
        dem = indexi;
        // Lấy chỉ số của nút đã chọn trong danh sách
        currentIndex = Array.from(playButtonIdthuvien).indexOf(playButton);
        // Cập nhật danh sách nhạc từ vị trí đã chọn đến hết danh sách
        myMusic = Array.from(playButtonIdthuvien)
            .slice(currentIndex)
            .map((button) => button.id);
        thuvienA = Array.from(playButtonIdthuvien)
            .slice(currentIndex)
            .map((button) => button.title);
        if (myMusic.length > 0) {
            Playing();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            setplay = 1;
        } else {
            PlayingEnd();
            setplay = 0;
        }

        playButton.classList.remove("bi-play-circle-fill");
        playButton.classList.add("bi-pause-circle-fill");
        playButton.classList.add("active");
        idthuvien = playButton.title;

        $.ajax({
            type: "POST",
            url: "/ln/" + idthuvien,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                console.log("wellcome to diablu music");
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
        $.ajax({
            type: "POST",
            url: "/loadmusic/" + idthuvien,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                IgMuSc.src = "../../images/" + data.success.imagemusic;
                NameBai.innerText = data.success.tennhac;
                NameNS.innerText = data.successns.tennghesi;
            },

            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    });
});

var ProductDesignName = document.querySelector(".Urlinstru .ProductDesignName");
var ProductDesignImage = document.querySelector(
    ".Urlinstru .ProductDesignImage"
);
var info = document.querySelector(".info");
var image = document.querySelector(".image");
ProductDesignName.addEventListener("click", function () {
    if (info.style.display === "none" || info.style.display === "") {
        info.style.display = "block";

        ProductDesignName.classList.add("active");
    } else {
        info.style.display = "none";
        ProductDesignName.classList.remove("active");
    }
});
ProductDesignImage.addEventListener("click", function () {
    if (image.style.display === "none" || image.style.display === "") {
        image.style.display = "block";
        ProductDesignImage.classList.add("active");
    } else {
        image.style.display = "none";
        ProductDesignImage.classList.remove("active");
    }
});
$(document).ready(function () {
    $("#searchInput").keypress(function (event) {
        if (event.keyCode === 13) {
            // Kiểm tra nút Enter
            event.preventDefault(); // Ngăn chặn form tự động submit
            $("#searchForm").submit(); // Gửi form tìm kiếm
        }
    });
});
