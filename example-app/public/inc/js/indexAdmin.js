document.addEventListener("DOMContentLoaded", () => {
    let dotuser = document.querySelectorAll(".chucnangUser");

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
    searchBar.addEventListener("click", function () {
        document.querySelector(".searchbar-input").value = "";
    });

    const search = document.querySelector(".searchbar-input");
    search.addEventListener("keypress", function (event) {
        if (event.keyCode === 13) {
            // Kiểm tra nút Enter
            event.preventDefault(); // Ngăn chặn form tự động submit
            $("#searchForm").submit(); // Gửi form tìm kiếm
        }
    });
    const search_icon_wrapper = document.querySelector(".search-icon-wrapper");
    search_icon_wrapper.addEventListener("click", function (event) {
        // Kiểm tra nút Enter
        event.preventDefault(); // Ngăn chặn form tự động submit
        $("#searchForm").submit(); // Gửi form tìm kiếm
    });
    const textloginGoogle = document.querySelector(".textloginGoogle");
    textloginGoogle.addEventListener("click", function (event) {
        const textloginGooglei = document.querySelector(".textloginGoogle i");
        const khungthu = document.querySelector(".khungthu");
        if (textloginGooglei.classList.contains("bi-caret-up-fill")) {
            textloginGooglei.classList.remove("bi-caret-up-fill");
            textloginGooglei.classList.add("bi-caret-down-fill");
            khungthu.style.display = "none";
        } else if (textloginGooglei.classList.contains("bi-caret-down-fill")) {
            textloginGooglei.classList.remove("bi-caret-down-fill");
            textloginGooglei.classList.add("bi-caret-up-fill");
            khungthu.style.display = "block";
        }
    });
    const textloginGoogleus = document.querySelector(".textloginGoogleius");
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
    setInterval(function () {
        var searchBar = document.querySelector(".searchbar-input");
        var ContenFilter = document.querySelector(".ContenFilter");
        searchBar.addEventListener("input", function () {
            if (searchBar.value.trim() != "") {
                document.querySelector(".delete-icon-wrapper").style.display =
                    "block";
            } else {
                document.querySelector(".delete-icon-wrapper").style.display =
                    "none";
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
        }
    }, 200);
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
