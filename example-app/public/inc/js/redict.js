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
        $("#Noidung").each(function () {
            $(this).append("<p>Live chat</p>");
        });
    } else {
        $("#searchForm").show();
        $("#Noidung p").remove();
    }
    var thongbao = document.querySelector(".thongbao");
    var tieudeDiv = document.querySelector(".tieude");
    var nhaccholist = document.querySelectorAll(".nhaccho");
    var sendchat = document.querySelectorAll(".sendchat");
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
    sendchat.forEach(function (sendchatitem, index) {
        sendchatitem.addEventListener("click", function () {
            var dataChoValue = sendchatitem.getAttribute("data-sendchat");
            window.location.href = "/livechat/" + dataChoValue;
        });
    });
    var downloadButton = document.querySelector(".menu-right-media .download");
    if (downloadButton) {
        downloadButton.addEventListener("click", function () {
            if (prenium == 1) {
                var musicUrl = this.getAttribute("data-downloadmusic");
                var downloadLink = document.createElement("a");
                downloadLink.href = "../../music/" + musicUrl;
                downloadLink.download = musicUrl;
                downloadLink.click();
            } else {
                var loi = document.querySelector(".loi");
                loi.classList.add("active");
                loi.style.display = "flex";
                loi.querySelector(".tieude").textContent =
                    "Vui lòng nâng vip để tải.";
            
            }
        });
    }
   
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

    menuAll("dot-3", "menu-right-media");
    setInterval(function () {
        thongbao.style.display = "none";
    }, 30000);
    var contentDiv1 = $(".messages");
    contentDiv1.scrollTop(contentDiv1.prop("scrollHeight"));
    $("#message-input").on("input", function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
    const submitchat = document.querySelector(".submitchat");
    if (submitchat) {
        submitchat.addEventListener("click", function (event) {
            event.preventDefault();
            $("#formchat").submit();
            setloadchat = true;
        });
    }
    const rightsong = document.querySelector(".rightsong");
    if (rightsong) {
        if (rightsong_var == 1) {
            rightsong.style.display = "none";
        } else {
            rightsong.style.display = "block";
        }
    }

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
    var setloadchat = false;
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
    setInterval(function () {
        if (setloadchat) {
            $.ajax({
                type: "GET",
                url: "/loadchat",
                success: function (response) {
                    $(".messages").empty();
                    setloadchat = false;
                    var theload = ``;
                    response.chat.forEach(function (chat) {
                        if (chat.iduser == response.ttnguoidung.id) {
                            theload += `
                            <div class="right message">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                    viewBox="0 0 22 22" fill="none">
                                                    <path
                                                        d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                        stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                        stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                        stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7.15393 9.21108L21.0001 5.36493"
                                                        stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <defs>
                                                        <linearGradient id="paint0_linear_141_94" x1="0.20658" y1="13.6489"
                                                            x2="9.13768" y2="14.1966" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                        <linearGradient id="paint1_linear_141_94" x1="14.0526" y1="9.80279"
                                                            x2="22.9837" y2="10.3505" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                        <linearGradient id="paint2_linear_141_94" x1="5.36874" y1="-1.56502"
                                                            x2="25.4871" y2="-0.540493" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                        <linearGradient id="paint3_linear_141_94" x1="5.36874" y1="4.77321"
                                                            x2="24.602" y2="9.01904" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
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
                        } else if (chat.idusergg == response.ttnguoidung.id) {
                            theload += `
                            <div class="right message">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                    viewBox="0 0 22 22" fill="none">
                                                    <path
                                                        d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                        stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                        stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                        stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7.15393 9.21108L21.0001 5.36493"
                                                        stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <defs>
                                                        <linearGradient id="paint0_linear_141_94" x1="0.20658" y1="13.6489"
                                                            x2="9.13768" y2="14.1966" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                        <linearGradient id="paint1_linear_141_94" x1="14.0526" y1="9.80279"
                                                            x2="22.9837" y2="10.3505" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                        <linearGradient id="paint2_linear_141_94" x1="5.36874" y1="-1.56502"
                                                            x2="25.4871" y2="-0.540493" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                        <linearGradient id="paint3_linear_141_94" x1="5.36874" y1="4.77321"
                                                            x2="24.602" y2="9.01904" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#B5179E" />
                                                            <stop offset="1" stop-color="#7209B7" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
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
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                                viewBox="0 0 22 22" fill="none">
                                                                <path
                                                                    d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                                    stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                                    stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                                    stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M7.15393 9.21108L21.0001 5.36493"
                                                                    stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <defs>
                                                                    <linearGradient id="paint0_linear_141_94" x1="0.20658" y1="13.6489"
                                                                        x2="9.13768" y2="14.1966" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#B5179E" />
                                                                        <stop offset="1" stop-color="#7209B7" />
                                                                    </linearGradient>
                                                                    <linearGradient id="paint1_linear_141_94" x1="14.0526" y1="9.80279"
                                                                        x2="22.9837" y2="10.3505" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#B5179E" />
                                                                        <stop offset="1" stop-color="#7209B7" />
                                                                    </linearGradient>
                                                                    <linearGradient id="paint2_linear_141_94" x1="5.36874" y1="-1.56502"
                                                                        x2="25.4871" y2="-0.540493" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#B5179E" />
                                                                        <stop offset="1" stop-color="#7209B7" />
                                                                    </linearGradient>
                                                                    <linearGradient id="paint3_linear_141_94" x1="5.36874" y1="4.77321"
                                                                        x2="24.602" y2="9.01904" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#B5179E" />
                                                                        <stop offset="1" stop-color="#7209B7" />
                                                                    </linearGradient>
                                                                </defs>
                                                            </svg>
                                                    </div>
                                        `;
                                    }
                                });
                            }
                            theload += `
                            </div>
                            </div>
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
});
