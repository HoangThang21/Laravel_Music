document.addEventListener("DOMContentLoaded", () => {
    let dotuser = document.querySelectorAll(".chucnangUser");
    var inputrangemusic = document.getElementById("inputrangemusic"); // Sử dụng getElementById thay vì querySelector vì chúng ta đã cung cấp id
    var msa = document.getElementById("msa"); // Sử dụng getElementById thay vì querySelector vì chúng ta đã cung cấp id
    if (inputrangemusic) {
        inputrangemusic.addEventListener("input", () => {
            var value = inputrangemusic.value;
            // Đặt value là inputrangemusic.value thay vì rangeInput.value
            msa.currentTime = parseInt(value);
            console.log(typeof parseInt(value), typeof msa.currentTime);
        });
    }

    dotuser.forEach(function (dotuser1, indexi1) {
        dotuser1.addEventListener("click", () => {
            dotuser.forEach(function (dotuser2, indexi2) {
                let dotul = dotuser2.querySelector(".chucnangUser .menu ul");
                if (indexi1 != indexi2) {
                    dotul.style.display = "none";
                }
            });
            let dotul = dotuser1.querySelector(".chucnangUser .menu ul");

            if (dotul) {
                const isHidden1 =
                    dotul.style.display === "none" ||
                    getComputedStyle(dotul).display === "none";
                dotul.style.display = isHidden1 ? "block" : "none";
            }
        });
    });

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
                // Kiểm tra nút Enter
                event.preventDefault(); // Ngăn chặn form tự động submit
                $("#searchForm").submit(); // Gửi form tìm kiếm
            }
        });
    }

    const search_icon_wrapper = document.querySelector(".search-icon-wrapper");
    if (search_icon_wrapper) {
        search_icon_wrapper.addEventListener("click", function (event) {
            // Kiểm tra nút Enter
            event.preventDefault(); // Ngăn chặn form tự động submit
            $("#searchForm").submit(); // Gửi form tìm kiếm
        });
    }
    const iconsucess = document.querySelector(".iconsucess");
    const card_success = document.querySelector(".card_success");
    if (iconsucess) {
        iconsucess.addEventListener("click", function (event) {
            card_success.style.display = "none";
        });
    }

    const textloginGoogle = document.querySelector(".textloginGoogle");
    if (textloginGoogle) {
        textloginGoogle.addEventListener("click", function (event) {
            const textloginGooglei =
                document.querySelector(".textloginGoogle i");
            const khungthu = document.querySelector(".khungthu");
            if (textloginGooglei.classList.contains("bi-caret-up-fill")) {
                textloginGooglei.classList.remove("bi-caret-up-fill");
                textloginGooglei.classList.add("bi-caret-down-fill");
                khungthu.style.display = "none";
            } else if (
                textloginGooglei.classList.contains("bi-caret-down-fill")
            ) {
                textloginGooglei.classList.remove("bi-caret-down-fill");
                textloginGooglei.classList.add("bi-caret-up-fill");
                khungthu.style.display = "block";
            }
        });
    }
    const textloginGoogleus = document.querySelector(".textloginGoogleius");
    if (textloginGoogleus) {
        textloginGoogleus.addEventListener("click", function (event) {
            const textloginGoogleius = document.querySelector(
                ".textloginGoogleius i"
            );
            const khungthuus = document.querySelector(".khungthuus");
            if (textloginGoogleius.classList.contains("bi-caret-up-fill")) {
                textloginGoogleius.classList.remove("bi-caret-up-fill");
                textloginGoogleius.classList.add("bi-caret-down-fill");
                khungthuus.style.display = "none";
            } else if (
                textloginGoogleius.classList.contains("bi-caret-down-fill")
            ) {
                textloginGoogleius.classList.remove("bi-caret-down-fill");
                textloginGoogleius.classList.add("bi-caret-up-fill");
                khungthuus.style.display = "block";
            }
        });
    }
    const submitchat = document.querySelector(".submitchat");
    if (submitchat) {
        submitchat.addEventListener("click", function (event) {
            setloadchat = true;
        });
    }
    var setloadchat = false;
    setInterval(function () {
        var searchBar = document.querySelector(".searchbar-input");
        var ContenFilter = document.querySelector(".ContenFilter");
        if (searchBar) {
            searchBar.addEventListener("input", function () {
                if (searchBar.value.trim() != "") {
                    document.querySelector(
                        ".delete-icon-wrapper"
                    ).style.display = "block";
                } else {
                    document.querySelector(
                        ".delete-icon-wrapper"
                    ).style.display = "none";
                }
            });
            if (searchBar.value == "") {
                document.querySelector(".delete-icon-wrapper").style.display =
                    "none";
            }

            if (contentFilter == 0) {
                ContenFilter.textContent = "Tất cả";
            } else if (contentFilter == 1) {
                ContenFilter.textContent = "Nhân viên";
            } else if (contentFilter == 2) {
                ContenFilter.textContent = "Người dùng";
            } else if (contentFilter == 3) {
                ContenFilter.textContent = "Nghệ sĩ";
            }
        }
        if (setloadchat) {
            $.ajax({
                type: "GET",
                url: "/Administrator/loadchat",
                success: function (response) {
                    $(".messages").empty();
                    setloadchat = false;
                    var theload = ``;
                    response.chat.forEach(function (chat) {
                        if (chat.iduser == response.ttnguoidung.id) {
                            theload += `
                            <div class="right message">
                            <div class="listdot">
                                <div class="menudot">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </div>
                                <div class="item-list-dot">
                                    <a href="/Administrator/xoachat&${chat.id}"><i
                                            class="bi bi-trash-fill"></i>Xóa</a>
                                </div>
                            </div>
                            <div class="bodymessage">
                                <div class="topmessage">
                                    <div class="timeup">${chat.time}</div>
                                    <div class="namemessage">${chat.tenuser}</div>
                                </div>
                                <div class="middlemessage">
                                    <div class="noidung">${chat.noidung}</div>
                                </div>
                                `;
                            if (chat.idnhac) {
                                response.nhac.forEach(function (nhac) {
                                    if (chat.idnhac == nhac.id) {
                                        theload += `
                                                    <div class="bottomessage">
                                                        <i class="bi bi-music-note-beamed"></i>
                                                        <div class="nhac"><a target="_black"
                                                                href="../../music/${nhac.nhaclink}">${nhac.tennhac}</a></div>
                                                        
                                                    </div>
                                        `;
                                    }
                                });
                            }
                            theload += `
                            </div>
                                <div class="img">
                                    <img src="../../images/${chat.hinhuser}" alt="">
                                </div>    </div>
                            `;
                        } else {
                            theload += `
                            <div class="left message">
                                <div class="img">
                                    <img src="../../images/${chat.hinhuser}" alt="">
                                </div>
                          
                            <div class="bodymessage">
                                <div class="topmessage">
                                    <div class="namemessage">${chat.tenuser}</div>
                                    <div class="timeup">${chat.time}</div>
                                   
                                </div>
                                <div class="middlemessage">
                                    <div class="noidung">${chat.noidung}</div>
                                </div>
                                `;
                            if (chat.idnhac) {
                                response.nhac.forEach(function (nhac) {
                                    if (chat.idnhac == nhac.id) {
                                        theload += `
                                                    <div class="bottomessage">
                                                        <div class="nhac"><a target="_black"
                                                                href="../../music/${nhac.nhaclink}">${nhac.tennhac}</a></div>
                                                        <i class="bi bi-music-note-beamed"></i>
                                                    </div>
                                        `;
                                    }
                                });
                            }
                            theload += `
                            </div>
                            <div class="listdot">
                                <div class="menudot">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </div>
                                <div class="item-list-dot">
                                    <a href="/Administrator/xoachat&${chat.id}"><i
                                            class="bi bi-trash-fill"></i>Xóa</a>
                                </div>
                            </div> </div>
                            `;
                        }
                    });
                    $(".messages").append(theload);
                    var contentDiv1 = $(".messages");
                    contentDiv1.scrollTop(contentDiv1.prop("scrollHeight"));
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi khi gợi ý dữ liệu: " + error);
                },
            });
        }
    }, 1000);
    $("#your-input").on("input", function () {
        var query = $(this).val();
        if (query.trim() != "") {
            $.ajax({
                type: "GET",
                url: "/Administrator/qlnghesi/suggest-data",
                data: {
                    query: query,
                },
                success: function (response) {
                    $("#suggestions").empty();
                    response.forEach(function (arr) {
                        if (Array.isArray(arr) && arr.length > 0) {
                            arr.forEach(function (email) {
                                $("#suggestions").append(
                                    $("<option>", {
                                        value: email,
                                        text: email,
                                    })
                                );
                            });
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi khi gợi ý dữ liệu: " + error);
                },
            });
        } else {
            $("#suggestions").empty();
        }
    });

    var deleteLinks = document.querySelectorAll(".delete-link");

    deleteLinks.forEach(function (deleteLink) {
        deleteLink.addEventListener("click", function (event) {
            event.preventDefault(); // Ngăn chặn chuyển hướng mặc định

            var confirmation = confirm("Bạn có chắc muốn xóa?");

            if (confirmation) {
                window.location.href = deleteLink.getAttribute("href");
            }
        });
    });

    $("#message-input").on("input", function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
    let menudot = document.querySelectorAll(".menudot");
    var itemlistdot = document.querySelectorAll(".item-list-dot");
    menudot.forEach(function (menudot1, indexi1) {
        menudot1.addEventListener("click", () => {
            itemlistdot.forEach(function (itemlistdot1, indexi2) {
                if (indexi1 == indexi2) {
                    const isHidden1 =
                        itemlistdot1.style.display === "none" ||
                        getComputedStyle(itemlistdot1).display === "none";
                    itemlistdot1.style.display = isHidden1 ? "block" : "none";
                } else {
                    itemlistdot1.style.display = "none";
                }
            });
        });
    });
    var contentDiv = $(".messages");
    contentDiv.scrollTop(contentDiv.prop("scrollHeight"));
    var pusher = new Pusher("0e5ab1838c755a5b0547", {
        cluster: "ap1",
    });
    var channel = pusher.subscribe("my-channel");
    channel.bind("my-event", function (data) {
        if (data.message == "Success") {
            setloadchat = true;
        }
        //   console.log(data);
    });

    var messagesDiv = $("#messages");
    var scrollButton = $("#scrollButton");

    messagesDiv.scroll(function () {
        if (messagesDiv.prop("scrollHeight") - messagesDiv.scrollTop() > 1000) {
            scrollButton.fadeIn();
        } else {
            scrollButton.fadeOut();
        }
    });

    scrollButton.click(function () {
        messagesDiv.animate(
            { scrollTop: messagesDiv.prop("scrollHeight") },
            500
        );
    });
    var delete_comment = document.querySelector(".delete_comment");
    if (delete_comment) {
        delete_comment.addEventListener("click", function () {
            $.ajax({
                type: "get",
                url:
                    "/Administrator/deletecommentAdmin/" +
                    delete_comment.getAttribute("data-comment"),
                success: function (data) {
                    window.location.href = currentUrl;
                },

                error: function (error) {
                    console.error("Đã xảy ra lỗi: ", error);
                },
            });
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
                        "/Administrator/commentmusicAdmin/" +
                        DivSubmitCommentBtn.getAttribute("data-songcomment"),
                    data: {
                        query: NhPBNhLuNCABN.value,
                    },
                    success: function (data) {
                        window.location.href = "/Administrator/qlnhac";
                    },

                    error: function (error) {
                        console.error("Đã xảy ra lỗi: ", error);
                    },
                });
            }
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
