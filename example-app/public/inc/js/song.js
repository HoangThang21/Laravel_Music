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
const parrotElement = document.getElementById("parrot");
const randomElement = document.getElementById("random");
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
var dem = 0;
var baihientai = -1;
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
            if (music.paused) {
                if (indexstartsong == indexi) {
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    icon.classList.remove("bi-play-fill");
                    icon.classList.add("bi-pause-fill");
                    music.play();
                } else {
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;

                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
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
if (time_curent_media) {
    time_curent_media.forEach(function (playButton, indexi) {
        playButton.addEventListener("click", () => {
            const icon = playButton.querySelector("i");
            var id = playButton.getAttribute("data-song");
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
            media.forEach(function (mediaitem, indexmedia) {
                if (indexi == indexmedia) {
                    mediaitem.classList.add("active");
                } else {
                    mediaitem.classList.remove("active");
                }
            });
            load_nghe.forEach(function (
                menuhayngheindex,
                menuhayngheindexindexi
            ) {
                const icon2 = menuhayngheindex.querySelector("i");
                if (indexi == menuhayngheindexindexi) {
                    if (icon.classList.contains("bi-pause-fill")) {
                        icon2.classList.remove("bi-play-fill");
                        icon2.classList.add("bi-pause-fill");
                    } else {
                        icon2.classList.remove("bi-pause-fill");
                        icon2.classList.add("bi-play-fill");
                    }
                    menuhayngheindex.style.display = "flex";
                } else {
                    icon2.classList.remove("bi-pause-fill");
                    icon2.classList.add("bi-play-fill");
                    menuhayngheindex.style.display = "";
                }
            });

            if (music.paused) {
                if (indexstartsong == indexi) {
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    icon.classList.remove("bi-play-fill");
                    icon.classList.add("bi-pause-fill");
                    music.play();
                } else {
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;

                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
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
    if (i == 0 && myMusic.length == 0) {
        i = 1;
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
parrotElement.addEventListener("click", function () {
    var isActive = parrotElement.classList.contains("active");
    if (isActive) {
        parrotElement.classList.remove("active");
    } else {
        parrotElement.classList.add("active");
        randomElement.classList.remove("active");
    }
});
randomElement.addEventListener("click", function () {
    var isActive = randomElement.classList.contains("active");
    if (isActive) {
        randomElement.classList.remove("active");
    } else {
        randomElement.classList.add("active");
        parrotElement.classList.remove("active");
    }
});
var list_memu = document.querySelector(".menu-list-right-setup #list-memu");
if (list_memu) {
    list_memu.addEventListener("click", function () {
        var right_menu_setup = document.querySelector(
            ".menu-list-right-setup .right-menu-setup"
        );
        var isActive = list_memu.classList.contains("active");
        if (isActive) {
            right_menu_setup.classList.remove("active");
            list_memu.classList.remove("active");
        } else {
            right_menu_setup.classList.add("active");
            list_memu.classList.add("active");
        }
    });
}
music.addEventListener("ended", () => {
    let indexArray = myMusic
        .map((element, index) => (element === list ? index : -1))
        .filter((index) => index !== -1);
    var baixoa = indexArray[0];
    demnext = indexArray[0] + 1;
    // myMusic.splice(baixoa, 1);
    setplay = 0;
    dem++;
    if (myMusic.length == 0) {
        PlayingEnd();
        dem = 0;
    } else {
        var isActive = parrotElement.classList.contains("active");
        if (isActive) {
            Playing();
        } else {
            var isActiverandom = randomElement.classList.contains("active");
            if (isActiverandom) {
                if (indexArray.length > 0) {
                    if (demnext < myMusic.length) {
                        $.ajax({
                            type: "POST",
                            url: "/loadmusic/" + myMusic[demnext],
                            dataType: "json",
                            data: { _token: csrfToken },
                            success: function (data) {
                                hinhnghenhac.src =
                                    "../../images/" + data.success.imagemusic;
                                tenbaihat.innerText = data.success.tennhac;
                                nghesi.innerText = data.successns.tennghesi;

                                if (!myMusic.includes(data.success.id)) {
                                    myMusic.push(data.success.id);
                                }

                                list = data.success.id;
                                setsavemusic = true;
                                music.src =
                                    "../../music/" + data.success.nhaclink;
                                let indexArray = myMusic
                                    .map((element, index) =>
                                        element === list ? index : -1
                                    )
                                    .filter((index) => index !== -1);

                                if (indexArray.length > 0) {
                                    let vi_tri = indexArray[0];
                                    demnext = vi_tri;
                                    console.log(
                                        `Vị trí của số ${list} trong mảng là: ${demnext}`
                                    );
                                } else {
                                    console.log(
                                        `Số ${list} không tồn tại trong mảng.`
                                    );
                                }
                                music.play();

                                // music.play();
                            },
                            error: function (error) {
                                console.error("Đã xảy ra lỗi: ", error);
                            },
                        });
                    } else {
                        demnext = 0;
                        console.log("end dem");
                        $.ajax({
                            type: "POST",
                            url: "/loadmusic/" + myMusic[demnext],
                            dataType: "json",
                            data: { _token: csrfToken },
                            success: function (data) {
                                hinhnghenhac.src =
                                    "../../images/" + data.success.imagemusic;
                                tenbaihat.innerText = data.success.tennhac;
                                nghesi.innerText = data.successns.tennghesi;

                                if (!myMusic.includes(data.success.id)) {
                                    myMusic.push(data.success.id);
                                }
                                list = data.success.id;
                                setsavemusic = true;
                                music.src =
                                    "../../music/" + data.success.nhaclink;
                                let indexArray = myMusic
                                    .map((element, index) =>
                                        element === list ? index : -1
                                    )
                                    .filter((index) => index !== -1);

                                if (indexArray.length > 0) {
                                    let vi_tri = indexArray[0];
                                    demnext = vi_tri;
                                    console.log(
                                        `Vị trí của số ${list} trong mảng là: ${demnext}`
                                    );
                                } else {
                                    console.log(
                                        `Số ${list} không tồn tại trong mảng.`
                                    );
                                }
                                music.play();

                                // music.play();
                            },
                            error: function (error) {
                                console.error("Đã xảy ra lỗi: ", error);
                            },
                        });
                    }
                } else {
                    console.log(`Số ${list} không tồn tại trong mảng.`);
                }
                masterPlay.classList.remove("bi-play-fill");
                masterPlay.classList.add("bi-pause-fill");
                wave.classList.add("active2");
            }
        }

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
var prniumlisti = document.querySelectorAll(".viprenium i");
prniumlisti.forEach(function (prniumlistitem, indexi1) {
    prniumlistitem.addEventListener("click", () => {
        if (prenium == 0) {
            var loi = document.querySelector(".loi");
            loi.classList.add("active");
            loi.style.display = "flex";
            loi.querySelector(".tieude").textContent =
                "Vui lòng nâng vip để nghe.";
        }
    });
});
var prniumlisti = document.querySelectorAll(".topluotnghe i");
prniumlisti.forEach(function (prniumlistitem, indexi1) {
    prniumlistitem.addEventListener("click", () => {
        var id = prniumlistitem.getAttribute("data-song");
        $.ajax({
            type: "POST",
            url: "/loadmusic/" + id,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                hinhnghenhac.src = "../../images/" + data.success.imagemusic;
                tenbaihat.innerText = data.success.tennhac;
                nghesi.innerText = data.successns.tennghesi;

                if (!myMusic.includes(data.success.id)) {
                    myMusic.push(data.success.id);
                }
                list = data.success.id;

                setsavemusic = true;
                music.src = "../../music/" + data.success.nhaclink;
                music.play();
                indexstartsong = indexi1;
                let indexArray = myMusic
                    .map((element, index) => (element === list ? index : -1))
                    .filter((index) => index !== -1);

                if (indexArray.length > 0) {
                    let vi_tri = indexArray[0];
                    demnext = vi_tri;
                    console.log(
                        `Vị trí của số ${list} trong mảng là: ${demnext}`
                    );
                } else {
                    console.log(`Số ${list} không tồn tại trong mảng.`);
                }
                // music.play();
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    });
});
let demnext = 0;
const next = document.getElementById("next");
if (next) {
    next.addEventListener("click", function () {
        if (myMusic.length != 0) {
            let indexArray = myMusic
                .map((element, index) => (element === list ? index : -1))
                .filter((index) => index !== -1);
            demnext = indexArray[0] + 1;
            if (indexArray.length > 0) {
                if (demnext < myMusic.length) {
                    $.ajax({
                        type: "POST",
                        url: "/loadmusic/" + myMusic[demnext],
                        dataType: "json",
                        data: { _token: csrfToken },
                        success: function (data) {
                            hinhnghenhac.src =
                                "../../images/" + data.success.imagemusic;
                            tenbaihat.innerText = data.success.tennhac;
                            nghesi.innerText = data.successns.tennghesi;

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }

                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();

                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                } else {
                    demnext = 0;
                    console.log("end dem");
                    $.ajax({
                        type: "POST",
                        url: "/loadmusic/" + myMusic[demnext],
                        dataType: "json",
                        data: { _token: csrfToken },
                        success: function (data) {
                            hinhnghenhac.src =
                                "../../images/" + data.success.imagemusic;
                            tenbaihat.innerText = data.success.tennhac;
                            nghesi.innerText = data.successns.tennghesi;

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();

                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                }
            } else {
                console.log(`Số ${list} không tồn tại trong mảng.`);
            }
            music.play();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
        }
    });
}
const back = document.getElementById("back");
if (back) {
    back.addEventListener("click", function () {
        if (myMusic.length != 0) {
            let indexArray = myMusic
                .map((element, index) => (element === list ? index : -1))
                .filter((index) => index !== -1);
            demnext = indexArray[0] - 1;
            if (indexArray.length > 0) {
                if (demnext >= 0) {
                    $.ajax({
                        type: "POST",
                        url: "/loadmusic/" + myMusic[demnext],
                        dataType: "json",
                        data: { _token: csrfToken },
                        success: function (data) {
                            hinhnghenhac.src =
                                "../../images/" + data.success.imagemusic;
                            tenbaihat.innerText = data.success.tennhac;
                            nghesi.innerText = data.successns.tennghesi;

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }

                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();

                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                } else {
                    demnext = myMusic[myMusic.length - 1];
                    console.log("end dem", demnext);
                    $.ajax({
                        type: "POST",
                        url: "/loadmusic/" + myMusic[myMusic.length - 1],
                        dataType: "json",
                        data: { _token: csrfToken },
                        success: function (data) {
                            hinhnghenhac.src =
                                "../../images/" + data.success.imagemusic;
                            tenbaihat.innerText = data.success.tennhac;
                            nghesi.innerText = data.successns.tennghesi;

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();

                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                }
            } else {
                console.log(`Số ${list} không tồn tại trong mảng.`);
            }
            music.play();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
        }
    });
}
const nextforward = document.getElementById("nextforward");
if (nextforward) {
    nextforward.addEventListener("click", function () {
        if (myMusic[myMusic.length - 1]) {
            $.ajax({
                type: "POST",
                url: "/loadmusic/" + myMusic[myMusic.length - 1],
                dataType: "json",
                data: { _token: csrfToken },
                success: function (data) {
                    hinhnghenhac.src =
                        "../../images/" + data.success.imagemusic;
                    tenbaihat.innerText = data.success.tennhac;
                    nghesi.innerText = data.successns.tennghesi;

                    if (!myMusic.includes(data.success.id)) {
                        myMusic.push(data.success.id);
                    }

                    list = data.success.id;
                    setsavemusic = true;
                    music.src = "../../music/" + data.success.nhaclink;
                    music.play();

                    // music.play();
                },
                error: function (error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
        }
    });
}
const backward = document.getElementById("backward");
if (backward) {
    backward.addEventListener("click", function () {
        if (myMusic[0]) {
            $.ajax({
                type: "POST",
                url: "/loadmusic/" + myMusic[0],
                dataType: "json",
                data: { _token: csrfToken },
                success: function (data) {
                    hinhnghenhac.src =
                        "../../images/" + data.success.imagemusic;
                    tenbaihat.innerText = data.success.tennhac;
                    nghesi.innerText = data.successns.tennghesi;

                    if (!myMusic.includes(data.success.id)) {
                        myMusic.push(data.success.id);
                    }

                    list = data.success.id;
                    setsavemusic = true;
                    music.src = "../../music/" + data.success.nhaclink;
                    music.play();

                    // music.play();
                },
                error: function (error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
        }
        masterPlay.classList.remove("bi-play-fill");
        masterPlay.classList.add("bi-pause-fill");
        wave.classList.add("active2");
    });
}
const discoveri = document.querySelector(".discover i");
var demloadlistnhac = 0;
if (discoveri) {
    discoveri.addEventListener("click", function () {
        if (discoveri.classList.contains("bi-pause-fill")) {
            discoveri.classList.add("bi-play-fill");
            discoveri.classList.remove("bi-pause-fill");
            masterPlay.classList.add("bi-play-fill");
            masterPlay.classList.remove("bi-pause-fill");
            wave.classList.remove("active2");
            music.pause();
        } else {
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            discoveri.classList.remove("bi-play-fill");
            discoveri.classList.add("bi-pause-fill");
            if (baihatall) {
                baihatall.classList.add("bi-play-fill");
                baihatall.classList.remove("bi-pause-fill");
            }
            demloadlistnhacall = 0;
            wave.classList.add("active2");
            music.play();
        }

        media.forEach(function (mediaitem, indexmedia) {
            mediaitem.classList.remove("active");
        });
        if (demloadlistnhac == 0) {
            myMusic = [];
            media.forEach(function (mediaitem, indexmedia) {
                var mediaParent = mediaitem.querySelector(".media .load-nghe");
                if (mediaParent) {
                    if (
                        !myMusic.includes(
                            parseInt(mediaParent.getAttribute("data-song"))
                        )
                    ) {
                        myMusic.push(
                            parseInt(mediaParent.getAttribute("data-song"))
                        );
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "/loadmusic/" + myMusic[0],
                dataType: "json",
                data: { _token: csrfToken },
                success: function (data) {
                    hinhnghenhac.src =
                        "../../images/" + data.success.imagemusic;
                    tenbaihat.innerText = data.success.tennhac;
                    nghesi.innerText = data.successns.tennghesi;

                    if (!myMusic.includes(data.success.id)) {
                        myMusic.push(data.success.id);
                    }

                    list = data.success.id;
                    setsavemusic = true;
                    music.src = "../../music/" + data.success.nhaclink;
                    let indexArray = myMusic
                        .map((element, index) =>
                            element === list ? index : -1
                        )
                        .filter((index) => index !== -1);

                    if (indexArray.length > 0) {
                        let vi_tri = indexArray[0];
                        demnext = vi_tri;
                        console.log(
                            `Vị trí của số ${list} trong mảng là: ${demnext}`
                        );
                    } else {
                        console.log(`Số ${list} không tồn tại trong mảng.`);
                    }
                    music.play();

                    // music.play();
                },
                error: function (error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            discoveri.classList.remove("bi-play-fill");
            discoveri.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            demloadlistnhac++;
        }

        console.log(myMusic);
    });
}
const baihatall = document.querySelector(".baihatall i");
var demloadlistnhacall = 0;
if (baihatall) {
    baihatall.addEventListener("click", function () {
        if (baihatall.classList.contains("bi-pause-fill")) {
            baihatall.classList.add("bi-play-fill");
            baihatall.classList.remove("bi-pause-fill");
            masterPlay.classList.add("bi-play-fill");
            masterPlay.classList.remove("bi-pause-fill");
            wave.classList.remove("active2");
            music.pause();
        } else {
            masterPlay.classList.remove("bi-play-fill");
            discoveri.classList.add("bi-play-fill");
            discoveri.classList.remove("bi-pause-fill");
            masterPlay.classList.add("bi-pause-fill");
            baihatall.classList.remove("bi-play-fill");
            baihatall.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            demloadlistnhac = 0;
            music.play();
        }

        media.forEach(function (mediaitem, indexmedia) {
            mediaitem.classList.remove("active");
        });
        if (demloadlistnhacall == 0) {
            myMusic = [];
            media.forEach(function (mediaitem, indexmedia) {
                var mediaParent = mediaitem.querySelector(
                    ".mediaallnhac .load-nghe"
                );
                if (mediaParent) {
                    if (
                        !myMusic.includes(
                            parseInt(mediaParent.getAttribute("data-song"))
                        )
                    ) {
                        myMusic.push(
                            parseInt(mediaParent.getAttribute("data-song"))
                        );
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: "/loadmusic/" + myMusic[0],
                dataType: "json",
                data: { _token: csrfToken },
                success: function (data) {
                    hinhnghenhac.src =
                        "../../images/" + data.success.imagemusic;
                    tenbaihat.innerText = data.success.tennhac;
                    nghesi.innerText = data.successns.tennghesi;

                    if (!myMusic.includes(data.success.id)) {
                        myMusic.push(data.success.id);
                    }

                    list = data.success.id;
                    setsavemusic = true;
                    music.src = "../../music/" + data.success.nhaclink;
                    let indexArray = myMusic
                        .map((element, index) =>
                            element === list ? index : -1
                        )
                        .filter((index) => index !== -1);

                    if (indexArray.length > 0) {
                        let vi_tri = indexArray[0];
                        demnext = vi_tri;
                        console.log(
                            `Vị trí của số ${list} trong mảng là: ${demnext}`
                        );
                    } else {
                        console.log(`Số ${list} không tồn tại trong mảng.`);
                    }
                    music.play();

                    // music.play();
                },
                error: function (error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            baihatall.classList.remove("bi-play-fill");
            baihatall.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            demloadlistnhacall++;
        }

        console.log(myMusic);
    });
}
const phatdshaynghe = document.querySelector(".phatdshaynghe");
var demloadlistnhachaynghe = 0;
if (phatdshaynghe) {
    phatdshaynghe.addEventListener("click", function () {
        if (phatdshaynghe.classList.contains("bi-pause-fill")) {
            phatdshaynghe.classList.add("bi-play-fill");
            phatdshaynghe.classList.remove("bi-pause-fill");
            masterPlay.classList.add("bi-play-fill");
            masterPlay.classList.remove("bi-pause-fill");
            wave.classList.remove("active2");
            music.pause();
        } else {
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            phatdshaynghe.classList.remove("bi-play-fill");
            phatdshaynghe.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            music.play();
        }
        media.forEach(function (mediaitem, indexmedia) {
            mediaitem.classList.remove("active");
        });
        if (demloadlistnhachaynghe == 0) {
            myMusic = [];
            info_media_bottom.forEach(function (mediaitem, indexmedia) {
                var mediaParent = mediaitem.querySelector(
                    ".img-media .load-nghe-bottom"
                );
                if (mediaParent) {
                    myMusic.push(
                        parseInt(mediaParent.getAttribute("data-song"))
                    );
                }
            });
            $.ajax({
                type: "POST",
                url: "/loadmusic/" + myMusic[0],
                dataType: "json",
                data: { _token: csrfToken },
                success: function (data) {
                    hinhnghenhac.src =
                        "../../images/" + data.success.imagemusic;
                    tenbaihat.innerText = data.success.tennhac;
                    nghesi.innerText = data.successns.tennghesi;

                    if (!myMusic.includes(data.success.id)) {
                        myMusic.push(data.success.id);
                    }

                    list = data.success.id;
                    setsavemusic = true;
                    music.src = "../../music/" + data.success.nhaclink;
                    let indexArray = myMusic
                        .map((element, index) =>
                            element === list ? index : -1
                        )
                        .filter((index) => index !== -1);

                    if (indexArray.length > 0) {
                        let vi_tri = indexArray[0];
                        demnext = vi_tri;
                        console.log(
                            `Vị trí của số ${list} trong mảng là: ${demnext}`
                        );
                    } else {
                        console.log(`Số ${list} không tồn tại trong mảng.`);
                    }
                    music.play();

                    // music.play();
                },
                error: function (error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            discoveri.classList.remove("bi-play-fill");
            discoveri.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            demloadlistnhachaynghe++;
        }

        console.log(myMusic);
    });
}
function ListMusic(name) {
    $.ajax({
        url: "/save-my-music",
        method: "POST",
        data: {
            myMusic: name,
            type: "up",
            _token: csrfToken,
        },
        success: function (response) {
            var loi = document.querySelector(".loi");
            loi.classList.add("active");
            loi.style.display = "flex";
            loi.querySelector(".tieude").textContent =
                "Đã thêm vào danh sách nghe nhạc.";
                setTimeout(function(){
                    window.location.href = currentUrl;
                },2000);
               
        },
        error: function (xhr, status, error) {
            console.error("Đã xảy ra lỗi: ", error);
        },
    });
}
function DeleteListMusic(name) {
    $.ajax({
        url: "/delete-my-music",
        method: "POST",
        data: {
            myMusic: name,
            type: "up",
            _token: csrfToken,
        },
        success: function (response) {
            var loi = document.querySelector(".loi");
            loi.classList.add("active");
            loi.style.display = "flex";
            loi.querySelector(".tieude").textContent =
                "Đã xóa nhạc khỏi danh sách.";
                setTimeout(function(){
                    window.location.href = currentUrl;
                },2000);
        },
        error: function (xhr, status, error) {
            console.error("Đã xảy ra lỗi: ", error);
        },
    });
}
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
                    console.log("succes");
                },
                error: function (xhr, status, error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
        }

        setsavemusic = false;
    }
}, 1000);
const load_nghe_bottom = document.querySelectorAll(".load-nghe-bottom");
const menuhaynghe = document.querySelectorAll(".menuhaynghe");
const info_media_bottom = document.querySelectorAll(".info-media-bottom");
if (load_nghe_bottom) {
    load_nghe_bottom.forEach(function (playButton, indexi) {
        playButton.addEventListener("click", () => {
            const icon = playButton.querySelector("i");
            var id = playButton.getAttribute("data-song");
            load_nghe_bottom.forEach(function (playButtonca, indexica) {
                if (indexi != indexica) {
                    const icon2 = playButtonca.querySelector("i");
                    icon2.classList.remove("bi-pause-fill");
                    icon2.classList.add("bi-play-fill");
                    playButtonca.style.display = "";
                }
            });
            info_media_bottom.forEach(function (mediaitem, indexmedia) {
                if (indexi == indexmedia) {
                    mediaitem.classList.add("active");
                } else {
                    mediaitem.classList.remove("active");
                }
            });
            menuhaynghe.forEach(function (
                menuhayngheindex,
                menuhayngheindexindexi
            ) {
                if (indexi == menuhayngheindexindexi) {
                    if (icon.classList.contains("bi-pause-fill")) {
                        menuhayngheindex.classList.remove("bi-pause-fill");
                        menuhayngheindex.classList.add("bi-play-fill");
                    } else {
                        menuhayngheindex.classList.remove("bi-play-fill");
                        menuhayngheindex.classList.add("bi-pause-fill");
                    }
                } else {
                    menuhayngheindex.classList.remove("bi-pause-fill");
                    menuhayngheindex.classList.add("bi-play-fill");
                }
            });
            playButton.style.display = "flex";
            if (music.paused) {
                if (indexstartsong == indexi) {
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    icon.classList.remove("bi-play-fill");
                    icon.classList.add("bi-pause-fill");
                    music.play();
                } else {
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;

                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
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
if (menuhaynghe) {
    menuhaynghe.forEach(function (playButton, indexi) {
        playButton.addEventListener("click", () => {
            var id = playButton.getAttribute("data-song");
            menuhaynghe.forEach(function (playButtonca, indexica) {
                if (indexi != indexica) {
                    playButtonca.classList.remove("bi-pause-fill");
                    playButtonca.classList.add("bi-play-fill");
                    playButtonca.style.display = "";
                }
            });
            info_media_bottom.forEach(function (mediaitem, indexmedia) {
                if (indexi == indexmedia) {
                    mediaitem.classList.add("active");
                } else {
                    mediaitem.classList.remove("active");
                }
            });
            load_nghe_bottom.forEach(function (
                menuhayngheindex,
                menuhayngheindexindexi
            ) {
                const icon = menuhayngheindex.querySelector("i");
                if (indexi == menuhayngheindexindexi) {
                    if (playButton.classList.contains("bi-pause-fill")) {
                        icon.classList.remove("bi-pause-fill");
                        icon.classList.add("bi-play-fill");
                    } else {
                        icon.classList.remove("bi-play-fill");
                        icon.classList.add("bi-pause-fill");
                    }
                } else {
                    icon.classList.remove("bi-pause-fill");
                    icon.classList.add("bi-play-fill");
                }
            });
            playButton.style.display = "flex";
            if (music.paused) {
                if (indexstartsong == indexi) {
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    playButton.classList.remove("bi-play-fill");
                    playButton.classList.add("bi-pause-fill");
                    music.play();
                } else {
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;

                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    playButton.classList.remove("bi-play-fill");
                    playButton.classList.add("bi-pause-fill");
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

                            if (!myMusic.includes(data.success.id)) {
                                myMusic.push(data.success.id);
                            }
                            list = data.success.id;
                            setsavemusic = true;
                            music.src = "../../music/" + data.success.nhaclink;
                            music.play();
                            indexstartsong = indexi;
                            let indexArray = myMusic
                                .map((element, index) =>
                                    element === list ? index : -1
                                )
                                .filter((index) => index !== -1);

                            if (indexArray.length > 0) {
                                let vi_tri = indexArray[0];
                                demnext = vi_tri;
                                console.log(
                                    `Vị trí của số ${list} trong mảng là: ${demnext}`
                                );
                            } else {
                                console.log(
                                    `Số ${list} không tồn tại trong mảng.`
                                );
                            }
                            // music.play();
                        },
                        error: function (error) {
                            console.error("Đã xảy ra lỗi: ", error);
                        },
                    });
                    masterPlay.classList.remove("bi-play-fill");
                    masterPlay.classList.add("bi-pause-fill");
                    wave.classList.add("active2");
                    playButton.classList.remove("bi-play-fill");
                    playButton.classList.add("bi-pause-fill");
                } else {
                    playButton.classList.remove("bi-pause-fill");
                    playButton.classList.add("bi-play-fill");
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
