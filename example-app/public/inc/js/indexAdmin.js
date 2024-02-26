let dotuser = document.querySelectorAll(".chucnangUser");

dotuser.forEach(function (dotuser1, indexi) {
    dotuser1.addEventListener("click", () => {
        let dotul = dotuser1.querySelector(".chucnangUser .menu ul");
        if (dotul) {
            const isHidden1 =
                dotul.style.display === "none" ||
                getComputedStyle(dotul).display === "none";
            dotul.style.display = isHidden1 ? "block" : "none";
        }
    });
});
