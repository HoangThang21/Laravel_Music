let dotuser = document.querySelectorAll(".chucnangUser");

dotuser.forEach(function (dotuser1, indexi) {
    dotuser1.addEventListener("click", () => {
        dotuser.forEach(function (dotuser2, indexi) {
            let dotul = dotuser2.querySelector(".chucnangUser .menu ul");
            dotul.style.display = "none";
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
// function toggleMenuFilter() {
//     var menuFilter = document.querySelector(".menufilter");
//     if (menuFilter) {
//         const isHidden1 =
//             menuFilter.style.display === "none" ||
//             getComputedStyle(menuFilter).display === "none";
//         menuFilter.style.display = isHidden1 ? "block" : "none";
//     }
// }
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
setInterval(function () {
    var searchBar = document.querySelector(".searchbar-input");
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
        document.querySelector(".delete-icon-wrapper").style.display = "none";
    }
}, 200);
