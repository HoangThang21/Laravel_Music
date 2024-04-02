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
    setInterval(function () {
        var searchBar = document.querySelector(".searchbar-input");
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
        }
    }, 1000);
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
                console.log(options);
                return (
                    `<div class="rank-menu-list-top-3"> <div className="menu-list-t1" style=" color: var(--menu-list-t1);">Top 1:` +
                    row.tensong1 
                    +
                    `</div><div className="menu-list-t2" style=" color: var(--menu-list-t2);">Top 2:`+row.tensong2
                    +
                    `</div><div className="menu-list-t3" style=" color: var(--menu-list-t3);">Top 3:`+row.tensong3
                    +
                    `</div></div>`
                );
            },
            resize: true,
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
