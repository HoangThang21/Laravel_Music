document.addEventListener("DOMContentLoaded", () => {
    const search_icon_wrapper = document.querySelector(".search-icon-wrapper");
    if (search_icon_wrapper) {
        search_icon_wrapper.addEventListener("click", function (event) {
            event.preventDefault(); // Ngăn chặn form tự động submit
            $("#searchForm").submit(); // Gửi form tìm kiếm
        });
    }
    var searchBar = document.querySelector(".delete-icon-wrapper");
    if (searchBar) {
        searchBar.addEventListener("click", function () {
            document.querySelector(".searchbar-input").value = "";
        });
    }
    const search = document.querySelector(".searchbar-input");
    if (search) {
        search.addEventListener("keypress", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault(); // Ngăn chặn form tự động submit
                $("#searchForm").submit(); // Gửi form tìm kiếm
            }
        });
    }
    const regis_in_btn = document.querySelector(".regis-in_btn");
    if (regis_in_btn) {
        regis_in_btn.addEventListener("click", function (event) {
            console.log("a");
            event.preventDefault(); // Ngăn chặn form tự động submit
            $("#form_container_register").submit(); // Gửi form tìm kiếm
        });
    }
    setInterval(function () {
        var searchBar = document.querySelector(".searchbar-input");
        if (searchBar) {
            if (searchBar.value.trim() != "") {
                document.querySelector(".delete-icon-wrapper").style.display =
                    "block";
            } else {
                document.querySelector(".delete-icon-wrapper").style.display =
                    "none";
            }
        }
    }, 500);
    // document.addEventListener('contextmenu', function(event) {
    //     event.preventDefault();
    // });
    var pre = document.querySelector(".pre");
    if (pre) {
        pre.addEventListener("click", function () {
            var list = document.querySelector(".list-item");
            var firstItem = list.firstElementChild;
            list.removeChild(firstItem);
            list.appendChild(firstItem);
        });
    }

    var next = document.querySelector(".next");
    if (next) {
        next.addEventListener("click", function () {
            var list = document.querySelector(".list-item");
            var lastItem = list.lastElementChild;
            list.removeChild(lastItem);
            list.insertBefore(lastItem, list.firstElementChild);
        });
    }
    //chạy slider
    // setInterval(function () {
    //     var list = document.querySelector(".list-item");
    //     var lastItem = list.lastElementChild;
    //     list.removeChild(lastItem);
    //     list.insertBefore(lastItem, list.firstElementChild);
    // }, 6000);
    var create_account = document.querySelector(".create-account");
    var form_container_register = document.querySelector(
        ".form_container_register"
    );
    var form_container = document.querySelector(".login-form");
    create_account.addEventListener("click", function () {
        form_container_register.classList.add("active");
        form_container_register.style.display = "flex";
        form_container.classList.remove("active");
        form_container.style.display = "none";
    });
    const container = document.querySelector(".list-menu-contenter_ns");
    let isMouseDown = false;
    let startX;
    let currentTranslateX = 0;
    let prevTranslateX = 0;
    if (container) {
        container.addEventListener("mousedown", (e) => {
            isMouseDown = true;
            startX = e.pageX;
            container.style.cursor = "grabbing";
        });

        window.addEventListener("mouseup", () => {
            isMouseDown = false;
            container.style.cursor = "grab";
        });

        container.addEventListener("mouseleave", () => {
            isMouseDown = false;
        });

        container.addEventListener("mousemove", (e) => {
            if (!isMouseDown) return;
            e.preventDefault();
            container.scrollLeft += startX - e.pageX;
        });
    }

    var myfirstchart = document.getElementById("myfirstchart");
    if (myfirstchart) {
        var tmp = rank[0];
        rank[0] = rank[2];
        rank[2] = tmp;
        var rankchart = new Morris.Line({
            element: "myfirstchart",
            lineColors: ["#4a90e2", "#27bd9c", "#e35050"],
            poinFillColors: ["#fff"],
            poinStrokeColors: ["#000"],
            fillOpacity: 0.6,
            hodeHover: true,
            parseTime: false,
            behaveLikeLine: true,
            data: rank,
            xkey: "thoigian",
            ykeys: ["phantram1", "phantram2", "phantram3"],
            labels: [rank[0].tensong1, rank[0].tensong2, rank[0].tensong3],
            hoverCallback: function (index, options, content, row) {
                return (
                    `<div class="rank-menu-list-top-3"> <div className="menu-list-t1" style=" color: var(--backgroundmain);">Top 1:` +
                    row.tensong1 +
                    `</div><div className="menu-list-t2" style=" color: var(--backgroundmain);">Top 2:` +
                    row.tensong2 +
                    `</div><div className="menu-list-t3" style=" color: var(--backgroundmain);">Top 3:` +
                    row.tensong3 +
                    `</div></div>`
                );
            },
            resize: true,
        });
    }

    var menuFilter = document.querySelectorAll(".body-topic-item");
    var cbcontent = document.querySelectorAll(".bottom-topic .item-xthem");
    var cb = document.querySelectorAll(".bottom-topic i");
    cbcontent.forEach(function (cbcontent1, indexcbcontent1) {
        cbcontent1.addEventListener("click", function () {
            menuFilter.forEach(function (menuFilter1, indexmenuFilter1) {
                if (indexcbcontent1 == indexmenuFilter1) {
                    cb.forEach(function (cb1, indexcb1) {
                        if (indexcb1 == indexmenuFilter1) {
                            if (menuFilter1) {
                                const isHidden1 =
                                    menuFilter1.style.height == "180px" ||
                                    getComputedStyle(menuFilter1).height ==
                                        "180px";
                                menuFilter1.style.height = isHidden1
                                    ? "100%"
                                    : "180px";
                            }
                            if (cbcontent1.textContent.includes("Rút gọn")) {
                                cbcontent1.textContent = "Xem thêm";
                                cb1.classList.remove("bi-caret-up-fill");
                                cb1.classList.add("bi-caret-down-fill");
                            } else if (
                                cbcontent1.textContent.includes("Xem thêm")
                            ) {
                                cbcontent1.textContent = "Rút gọn";
                                cb1.classList.remove("bi-caret-down-fill");
                                cb1.classList.add("bi-caret-up-fill");
                            }
                        }
                    });
                }
            });
        });
    });

    var menuFilter_ttuser_top = document.querySelectorAll(
        ".item-top-body-ttuser"
    );
    var cbcontent_ttuser_top = document.querySelectorAll(
        ".form-bottom-body-user"
    );
    var changeImageText = document.querySelector(".changeImageText");
    const inputImage = document.getElementById("inputImage");
    if (inputImage) {
        document
            .getElementById("changeImageText")
            .addEventListener("click", function () {
                inputImage.click();
                inputImage.addEventListener("input", function (e) {
                    var file = e.target.files[0];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document
                            .getElementById("imagePreview")
                            .setAttribute("src", e.target.result);
                    };

                    reader.readAsDataURL(file);
                    console.log(inputImage.value);
                });
            });
    }
    if (menuFilter_ttuser_top) {
        menuFilter_ttuser_top.forEach(function (menuFilter1, indexcbcontent1) {
            menuFilter1.addEventListener("click", function () {
                cbcontent_ttuser_top.forEach(function (
                    cbcontent_ttuser_top1,
                    indexcbcontent_ttuser_top
                ) {
                    if (indexcbcontent1 == 0) {
                        changeImageText.style.display = "block";
                    } else {
                        changeImageText.style.display = "none";
                    }
                    if (indexcbcontent1 == indexcbcontent_ttuser_top) {
                        menuFilter1.classList.add("active");
                        cbcontent_ttuser_top1.classList.add("active");
                    } else {
                        cbcontent_ttuser_top1.classList.remove("active");
                    }
                    menuFilter_ttuser_top.forEach(function (
                        menuFilter2,
                        indexcbcontent2
                    ) {
                        if (indexcbcontent1 != indexcbcontent2) {
                            menuFilter2.classList.remove("active");
                        }
                    });
                });
            });
        });
    }
    const prenium = document.querySelector(".prenium i");
    if (prenium) {
        prenium.addEventListener("click", function () {
            console.log("a");
            window.location.href = "/prenium";
        });
    }
    const name_music = document.querySelectorAll(".name-music");
    if (name_music) {
        name_music.forEach(function (name_music1, indexcbcontent1) {
            name_music1.addEventListener("click", function () {
                var musicUrl = name_music1.getAttribute("data-nhacredict");
                window.location.href = "/album/" + musicUrl;
            });
        });
    }

    const all = document.getElementById("all");
    if (all) {
        all.addEventListener("click", function () {
            history.forward();
        });
    }
    const backBtn = document.getElementById("backBtn");
    if (backBtn) {
        backBtn.addEventListener("click", function () {
            history.back();
        });
    }
    var yeuthich_music = document.querySelectorAll(".yeuthich-music");
    if (yeuthich_music) {
        yeuthich_music.forEach(function (menuFilter1, indexcbcontent1) {
            menuFilter1.addEventListener("click", function () {
                $.ajax({
                    type: "get",
                    url:
                        "/addmusic/" +
                        menuFilter1.getAttribute("data-yeutich") +
                        "-addLabary",
                    success: function (data) {
                        window.location.href = currentUrl;
                    },

                    error: function (error) {
                        console.error("Đã xảy ra lỗi: ", error);
                    },
                });
            });
        });
    }
    var quenmatkhau = document.querySelector(".quenmatkhau");
    if (quenmatkhau) {
        quenmatkhau.addEventListener("click", function () {
            var loi = document.querySelector(".loi");
            loi.classList.add("active");
            loi.style.display = "flex";
            loi.querySelector(".tieude").textContent =
                "Vui lòng liên hệ admin qua Email: mobifone@gmail.com.";
        });
    }
    var DivSubmitCommentBtn = document.querySelector(".DivSubmitCommentBtn");
    var NhPBNhLuNCABN = document.querySelector(".NhPBNhLuNCABN");
    if (DivSubmitCommentBtn) {
        DivSubmitCommentBtn.addEventListener("click", function () {
            if (NhPBNhLuNCABN.value != "") {
                $.ajax({
                    type: "get",
                    url:
                        "/commentmusic/" +
                        DivSubmitCommentBtn.getAttribute("data-songcomment"),
                    data: {
                        query: NhPBNhLuNCABN.value,
                    },
                    success: function (data) {
                        if (data.response == "no") {
                            var loi = document.querySelector(".loi");
                            loi.classList.add("active");
                            loi.style.display = "flex";
                            loi.querySelector(".tieude").textContent =
                                "Vui lòng đăng nhập để bình luận.";
                        } else {
                            window.location.href = currentUrl;
                        }
                    },

                    error: function (error) {
                        console.error("Đã xảy ra lỗi: ", error);
                    },
                });
            }
        });
    }
    var tlnhac = document.querySelectorAll(".body-topic-item .item");
    if (tlnhac) {
        tlnhac.forEach(function (tlnhac1, indexcbcontent1) {
            tlnhac1.addEventListener("click", function () {
                window.location.href =
                    "/the-loai/" + tlnhac1.getAttribute("data-tl");
                
                
            });
        });
        
    }
    var item_body_content = document.querySelectorAll(".item-body-content");
    if (item_body_content) {
        item_body_content.forEach(function (menuFilter1, indexcbcontent1) {
            menuFilter1.addEventListener("click", function () {
                window.location.href =
                    "/album-nghesi/" + menuFilter1.getAttribute("data-album");
            });
        });
    }
    var item_list_info_user = document.querySelectorAll(".item-list-info-user");
    if (item_list_info_user) {
        item_list_info_user.forEach(function (menuFilter1, indexcbcontent1) {
            menuFilter1.addEventListener("click", function () {
                window.location.href =
                    "/album-nghesi/" + menuFilter1.getAttribute("data-album");
            });
        });
    }
    var quantam = document.querySelectorAll(".quantam");
    if (quantam) {
        quantam.forEach(function (menuFilter1, indexcbcontent1) {
            menuFilter1.addEventListener("click", function () {
                console.log(menuFilter1.getAttribute("data-quantam"));
                $.ajax({
                    type: "get",
                    url:
                        "/addquantam/" +
                        menuFilter1.getAttribute("data-quantam") +
                        "-addQuantam",
                    success: function (data) {
                        if(data.success=='no'){
                            var loi = document.querySelector(".loi");
                            loi.classList.add("active");
                            loi.style.display = "flex";
                            loi.querySelector(".tieude").textContent =
                                "Vui lòng đăng nhập để yêu thích nghệ sĩ";
                        }else{
                            window.location.href = currentUrl;
                        }
                        
                    },

                    error: function (error) {
                        console.error("Đã xảy ra lỗi: ", error);
                    },
                });
            });
        });
    }
    var topright_tacgia = document.querySelectorAll(".topright-tacgia");
    if (topright_tacgia) {
        topright_tacgia.forEach(function (menuFilter1, indexcbcontent1) {
            menuFilter1.addEventListener("click", function () {
                console.log(menuFilter1.getAttribute("data-quantam"));
                $.ajax({
                    type: "get",
                    url:
                        "/addquantam/" +
                        menuFilter1.getAttribute("data-quantam") +
                        "-addQuantam",
                    success: function (data) {
                        window.location.href = currentUrl;
                    },

                    error: function (error) {
                        console.error("Đã xảy ra lỗi: ", error);
                    },
                });
            });
        });
    }
    const alls = document.querySelector(".all");
    const song = document.querySelector(".song");
    const album = document.querySelector(".album");
    const nghesi = document.querySelector(".nghesi");
    const all_search = document.querySelector(".all-search");
    const song_search_click = document.querySelector(".song-search-click");
    const alblum_search_click = document.querySelector(".album-search-click");
    const nghesi_search_click = document.querySelector(".nghesi-search-click");
    const song_search = document.querySelector(".song-search");
    const alblum_search = document.querySelector(".album-search");
    const nghesi_search = document.querySelector(".nghesi-search");
    if (alls) {
        alls.addEventListener("click", function () {
            alls.classList.add("active");
            song.classList.remove("active");
            album.classList.remove("active");
            nghesi.classList.remove("active");
            all_search.style.display = "block";
            song_search_click.style.display = "none";
            alblum_search_click.style.display = "none";
            nghesi_search_click.style.display = "none";
        });
    }
    if (song) {
        song.addEventListener("click", function () {
            alls.classList.remove("active");
            song.classList.add("active");
            album.classList.remove("active");
            nghesi.classList.remove("active");
            all_search.style.display = "none";
            song_search_click.style.display = "block";
            alblum_search_click.style.display = "none";
            nghesi_search_click.style.display = "none";
        });
    }
    if (song_search) {
        song_search.addEventListener("click", function () {
            alls.classList.remove("active");
            song.classList.add("active");
            album.classList.remove("active");
            nghesi.classList.remove("active");
            all_search.style.display = "none";
            song_search_click.style.display = "block";
            alblum_search_click.style.display = "none";
            nghesi_search_click.style.display = "none";
        });
    }
    if (album) {
        album.addEventListener("click", function () {
            alls.classList.remove("active");
            song.classList.remove("active");
            album.classList.add("active");
            nghesi.classList.remove("active");
            all_search.style.display = "none";
            song_search_click.style.display = "none";
            alblum_search_click.style.display = "block";
            nghesi_search_click.style.display = "none";
        });
    }
    if (alblum_search) {
        alblum_search.addEventListener("click", function () {
            alls.classList.remove("active");
            song.classList.remove("active");
            album.classList.add("active");
            nghesi.classList.remove("active");
            all_search.style.display = "none";
            song_search_click.style.display = "none";
            alblum_search_click.style.display = "block";
            nghesi_search_click.style.display = "none";
        });
    }
    if (nghesi) {
        nghesi.addEventListener("click", function () {
            alls.classList.remove("active");
            song.classList.remove("active");
            album.classList.remove("active");
            nghesi.classList.add("active");
            all_search.style.display = "none";
            song_search_click.style.display = "none";
            alblum_search_click.style.display = "none";
            nghesi_search_click.style.display = "block";
        });
    }
    if (nghesi_search) {
        nghesi_search.addEventListener("click", function () {
            alls.classList.remove("active");
            song.classList.remove("active");
            album.classList.remove("active");
            nghesi.classList.add("active");
            all_search.style.display = "none";
            song_search_click.style.display = "none";
            alblum_search_click.style.display = "none";
            nghesi_search_click.style.display = "block";
        });
    }
});
function toggleMenu(name) {
    var menuFilter = document.querySelector("." + name);
    if (menuFilter) {
        const isHidden1 =
            menuFilter.style.display === "none" ||
            getComputedStyle(menuFilter).display === "none";
        menuFilter.style.display = isHidden1 ? "block" : "none";
    }
}
function toggleMenuFlex(name) {
    var menuFilter = document.querySelector("." + name);
    if (menuFilter) {
        const isHidden1 =
            menuFilter.style.display === "none" ||
            getComputedStyle(menuFilter).display === "none";
        menuFilter.style.display = isHidden1 ? "flex" : "none";
    }
}
function ClickNghesi(name) {
    window.location.href = "/nghe-si/" + name;
}
