let myMusic = ["a.mp3"];

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
music.src = "../../music/" + myMusic[0];
function Playing() {
    music.addEventListener("loadedmetadata", function () {
        rangeBar.max = music.duration;
    });
    music.play();
    wave.classList.add("active2");
}
function PlayingEnd() {
    music.pause();
    masterPlay.classList.remove("bi-pause-fill");
    masterPlay.classList.add("bi-play-fill");
    wave.classList.remove("active2");
}
if (load_nghe) {
    load_nghe.forEach(function (playButton, indexi) {
        playButton.addEventListener("click", () => {
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
            time_curent_media.forEach(function (
                time_curent_mediaindex,
                time_curent_mediaindexindexi
            ) {
                const icon2 = time_curent_mediaindex.querySelector("i");
                const span2 = time_curent_mediaindex.querySelector("span");
                if (indexi == time_curent_mediaindexindexi) {
                    icon2.classList.remove("bi-play-fill");
                    icon2.classList.add("bi-pause-fill");
                    icon2.style.display = "block";
                    span2.style.display = "none";
                } else {
                    icon2.classList.remove("bi-pause-fill");
                    icon2.classList.add("bi-play-fill");
                    icon2.style.display = "none";
                    span2.style.display = "block";
                }
            });
           
            playButton.style.display = "flex";
            var id = icon.getAttribute("data-song");
            Playing();
            if (icon.classList.contains("bi-pause-fill")) {
                icon.classList.remove("bi-pause-fill");
                icon.classList.add("bi-play-fill");
                masterPlay.classList.remove("bi-pause-fill");
                masterPlay.classList.add("bi-play-fill");
                wave.classList.remove("active2");
                music.pause();
            } else {
                masterPlay.classList.remove("bi-play-fill");
                masterPlay.classList.add("bi-pause-fill");
                wave.classList.add("active2");
                icon.classList.remove("bi-play-fill");
                icon.classList.add("bi-pause-fill");
                music.play();
            }
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
            // $.ajax({
            //     type: "POST",
            //     url: "/loadmusic/" + id,
            //     dataType: "json",
            //     data: { _token: csrfToken },
            //     success: function (data) {
            //         hinhnghenhac.src = "../../images/" + data.success.imagemusic;
            //         tenbaihat.innerText = data.success.tennhac;
            //         nghesi.innerText = data.successns.tennghesi;
            //     },

            //     error: function (error) {
            //         console.error("Đã xảy ra lỗi: ", error);
            //     },
            // });
        });
    });
}
masterPlay.addEventListener("click", () => {
    // if (i == 0) {
    //     myMusic = [...myMusic, baidau];
    //     i = 1;
    //     // $.ajax({
    //     //     type: "POST",
    //     //     url: "/ln/" + idbaidau,
    //     //     dataType: "json",
    //     //     data: { _token: csrfToken },
    //     //     success: function (data) {
    //     //         console.log("wellcome to diablu music");
    //     //     },
    //     //     error: function (error) {
    //     //         console.error("Đã xảy ra lỗi: ", error);
    //     //     },
    //     // });
    // }

    if (masterPlay.classList.contains("bi-pause-fill")) {
        masterPlay.classList.remove("bi-pause-fill");
        masterPlay.classList.add("bi-play-fill");
        wave.classList.remove("active2");
        music.pause();
    } else {
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
seek_vol.addEventListener("input", function () {
    music.volume = seek_vol.value / 100;
});

music.addEventListener("timeupdate", displayTimer);
function displayTimer() {
    let { duration, currentTime } = music;
    rangeBar.max = music.duration;

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
