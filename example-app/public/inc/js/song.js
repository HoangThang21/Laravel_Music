const wave = document.querySelector(".left-master-play .wave");
const hinhnghenhac = document.querySelector(".IgMuSc");
const tenbaihat = document.querySelector(".NameBai");
const nghesi = document.querySelector(".subtitle");
let music = new Audio();
const time_curent_media = document.querySelectorAll(".time-curent-media");
const media = document.querySelectorAll(".media");
const load_nghe = document.querySelectorAll(".load-nghe");
const masterPlay = document.getElementById("masterPlay");
const rangeBar = document.getElementById("seek");
const seek_vol = document.getElementById("seek-vol");
const bar2 = document.getElementById("bar2");
const dot_music = document.getElementById("dot_music");
const currentStart = document.getElementById("currentStart");
const currentEnd = document.getElementById("currentEnd");
let setsavemusic = false;

function Playing() {
    music.play();
    wave.classList.add("active2");
}
function PlayingEnd() {
    music.pause();
    masterPlay.classList.remove("bi-pause-fill");
    masterPlay.classList.add("bi-play-fill");
    wave.classList.remove("active2");
}
var setsong = false;
var indexstartsong = -1;
var found = false;
var list = -1;
if (load_nghe) {
    load_nghe.forEach(function (playButton, indexi) {
        playButton.addEventListener("click", () => {
            const icon = playButton.querySelector("i");
            var id = playButton.getAttribute("data-song");
            load_nghe.forEach(function (playButtonca, indexica) {
                if (indexi != indexica) {
                    const icon2 = playButtonca.querySelector("i");
                    icon2.classList.remove("bi-pause-fill");
                    icon2.classList.add("bi-play-fill");
                    playButtonca.style.display = "";
                }
            });
            media.forEach(function (mediaitem, indexmedia) {
                if (indexi == indexmedia) {
                    mediaitem.classList.add("active");
                } else {
                    mediaitem.classList.remove("active");
                }
            });
            time_curent_media.forEach(function (
                time_curent_mediaindex,
                time_curent_mediaindexindexi
            ) {
                const icon2 = time_curent_mediaindex.querySelector("i");
                const span2 = time_curent_mediaindex.querySelector("span");
                if (indexi == time_curent_mediaindexindexi) {
                    if (icon.classList.contains("bi-pause-fill")) {
                        icon2.classList.remove("bi-pause-fill");
                        icon2.classList.add("bi-play-fill");
                    } else {
                        icon2.classList.remove("bi-play-fill");
                        icon2.classList.add("bi-pause-fill");
                    }
                } else {
                    icon2.classList.remove("bi-pause-fill");
                    icon2.classList.add("bi-play-fill");
                }
            });

            playButton.style.display = "flex";

            // if (icon.classList.contains("bi-pause-fill")) {

            // }
            // else {
            // }
            if (music.paused) {
                if (indexstartsong == indexi) {
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    icon.classList.remove("bi-play-fill");
                    icon.classList.add("bi-pause-fill");
                    music.play();
                } else {
                    console.log("2");
                    $.ajax({
                        type: "POST",
                        url: "/loadmusic/" + id,
                        dataType: "json",
                        data: { _token: csrfToken },
                        success: function (data) {
                            hinhnghenhac.src =
                                "../../images/" + data.success.imagemusic;
                            tenbaihat.innerText = data.success.tennhac;
                            nghesi.innerText = data.successns.tennghesi;

                            if (!myMusic.includes(data.success.nhaclink)) {
                                myMusic.push(data.success.nhaclink);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    icon.classList.remove("bi-play-fill");
                    icon.classList.add("bi-pause-fill");
                    // music.play();
                }
            } else {
                if (indexstartsong != indexi) {
                    music.pause();
                    $.ajax({
                        type: "POST",
                        url: "/loadmusic/" + id,
                        dataType: "json",
                        data: { _token: csrfToken },
                        success: function (data) {
                            hinhnghenhac.src =
                                "../../images/" + data.success.imagemusic;
                            tenbaihat.innerText = data.success.tennhac;
                            nghesi.innerText = data.successns.tennghesi;

                            if (!myMusic.includes(data.success.nhaclink)) {
                                console.log("vao1....");
                                myMusic.push(data.success.nhaclink);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;

                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    icon.classList.remove("bi-play-fill");
                    icon.classList.add("bi-pause-fill");
                } else {
                    icon.classList.remove("bi-pause-fill");
                    icon.classList.add("bi-play-fill");
                    masterPlay.classList.remove("bi-pause-fill");
                    masterPlay.classList.add("bi-play-fill");
                    wave.classList.remove("active2");
                    music.pause();
                    setsong = false;
                }
            }

            console.log(myMusic);
            console.log(setsong);

            // $.ajax({
            //     type: "POST",
            //     url: "/ln/" + id,
            //     dataType: "json",
            //     data: { _token: csrfToken },
            //     success: function (data) {
            //         console.log("wellcome to music");
            //     },
            //     error: function (error) {
            //         console.error("Đã xảy ra lỗi: ", error);
            //     },
            // });
        });
    });
}
let i = 0;
masterPlay.addEventListener("click", () => {
    if (i == 0) {

        i=1;
        $.ajax({
            type: "POST",
            url: "/loadmusic/" + baidau,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                music.src = "../../music/" + data.success.nhaclink;
                music.play();
                masterPlay.classList.remove("bi-play-fill");
                masterPlay.classList.add("bi-pause-fill");
                wave.classList.add("active2");
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    }

    if (masterPlay.classList.contains("bi-pause-fill")) {
        load_nghe.forEach(function (playButton, indexi) {
            if (indexstartsong == indexi) {
                const icon = playButton.querySelector("i");
                load_nghe.forEach(function (playButtonca, indexica) {
                    if (indexi != indexica) {
                        const icon2 = playButtonca.querySelector("i");
                        icon2.classList.remove("bi-pause-fill");
                        icon2.classList.add("bi-play-fill");
                        playButtonca.style.display = "";
                    }
                });
                media.forEach(function (mediaitem, indexmedia) {
                    if (indexi == indexmedia) {
                        mediaitem.classList.add("active");
                    } else {
                        mediaitem.classList.remove("active");
                    }
                });
                icon.classList.remove("bi-pause-fill");
                icon.classList.add("bi-play-fill");
            }
        });
        masterPlay.classList.remove("bi-pause-fill");
        masterPlay.classList.add("bi-play-fill");
        wave.classList.remove("active2");
        music.pause();
    } else {
        load_nghe.forEach(function (playButton, indexi) {
            if (indexstartsong == indexi) {
                const icon = playButton.querySelector("i");
                load_nghe.forEach(function (playButtonca, indexica) {
                    if (indexi != indexica) {
                        const icon2 = playButtonca.querySelector("i");
                        icon2.classList.remove("bi-pause-fill");
                        icon2.classList.add("bi-play-fill");
                        playButtonca.style.display = "";
                    }
                });
                media.forEach(function (mediaitem, indexmedia) {
                    if (indexi == indexmedia) {
                        mediaitem.classList.add("active");
                    } else {
                        mediaitem.classList.remove("active");
                    }
                });
                icon.classList.remove("bi-play-fill");
                icon.classList.add("bi-pause-fill");
            }
        });
        masterPlay.classList.remove("bi-play-fill");
        masterPlay.classList.add("bi-pause-fill");
        wave.classList.add("active2");
        music.play();
    }
    setplay = 1;
});
music.addEventListener("ended", () => {
    myMusic.splice(0, 1);
    setplay = 0;
    dem++;
    if (myMusic.length == 0) {
        PlayingEnd();
        dem = 0;
    } else {
        Playing();
        // $.ajax({
        //     type: "POST",
        //     url: "/ln/" + thuvienA[0],
        //     dataType: "json",
        //     data: { _token: csrfToken },
        //     success: function (data) {
        //         console.log("wellcome to diablu music");
        //     },
        //     error: function (error) {
        //         console.error("Đã xảy ra lỗi: ", error);
        //     },
        // });
        // $.ajax({
        //     type: "POST",
        //     url: "/loadmusic/" + thuvienA[0],
        //     dataType: "json",
        //     data: { _token: csrfToken },
        //     success: function (data) {
        //         IgMuSc.src = "../../images/" + data.success.imagemusic;
        //         NameBai.innerText = data.success.tennhac;
        //         NameNS.innerText = data.successns.tennghesi;
        //     },

        //     error: function (error) {
        //         console.error("Đã xảy ra lỗi: ", error);
        //     },
        // });
    }
});
//volum
var dot = document.getElementById("dot-music-vol");
var bar3 = document.getElementById("bar-vol");
seek_vol.addEventListener("input", function () {
    var value = seek_vol.value;
    var percent = value - seek_vol.min;
    bar3.style.width = percent + "%";
    dot.style.left = percent + "%";
    music.volume = seek_vol.value / 100;
});

if (rangeBar) {
    rangeBar.addEventListener("input", function () {
        var value = rangeBar.value;
        var percent = value - rangeBar.min;
        bar2.style.width = percent + "%";
        dot_music.style.left = percent + "%";
        const newTime = music.duration * (rangeBar.value / 100);
        music.currentTime = value;
        console.log(rangeBar.value, music.duration);
    });
}
music.addEventListener("timeupdate", displayTimer);
function displayTimer() {
    rangeBar.max = music.duration;
    currentEnd.textContent = formatTimer(
        (music.duration - music.currentTime) | "00:00"
    );
    if (!music.duration) {
        currentStart.textContent = "00:00";
    } else {
        currentStart.textContent = formatTimer(music.currentTime);
    }
    let pro = parseInt((music.currentTime / music.duration) * 100);

    let seek = pro;
    bar2.style.width = `${seek}%`;
    dot_music.style.left = `${seek}%`;
}
function formatTimer(time) {
    const m = Math.floor(time / 60);
    const s = Math.floor(time - m * 60);
    return `${m}:${s < 10 ? "0" : ""}${s}`;
}
var prniumlisti = document.querySelectorAll(".list-menu-rightsong i");
prniumlisti.forEach(function (prniumlistitem, indexi1) {
    prniumlistitem.addEventListener("click", () => {
        
        if(prenium==0){
            var loi = document.querySelector(".loi");
            loi.classList.add("active");
            loi.style.display = "flex";
            loi.querySelector(".tieude").textContent =
                "Vui lòng nâng vip để nghe.";
        }
    })})
setInterval(function () {
    if (setsavemusic) {
        if (list != -1) {
            $.ajax({
                url: "/save-my-music",
                method: "POST",
                data: {
                    myMusic: list,
                    type: "up",
                    _token: csrfToken,
                },
                success: function (response) {
                    var tmp = response.response;
                    console.log("Dữ liệu " + response.response);
                },
                error: function (xhr, status, error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
        }

        setsavemusic = false;
    }
}, 1000);
