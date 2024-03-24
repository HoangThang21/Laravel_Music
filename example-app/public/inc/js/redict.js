var playlist = document.querySelectorAll(".playlist .itemmenu");
playlist.forEach(function (playlist, index) {
    if (index == activemenu) {
        playlist.classList.add("active");
    } else {
        playlist.classList.remove("active");
    }
});
if (activemenu == 2) {
    $("#searchForm").hide();
} else {
    $("#searchForm").show();
}
var thongbao = document.querySelector(".thongbao");
var tieudeDiv = document.querySelector(".tieude");
var nhaccholist = document.querySelectorAll(".nhaccho");
nhaccholist.forEach(function (nhaccholistitem, index) {
    nhaccholistitem.addEventListener("click", function () {
        var dataChoValue = nhaccholistitem.getAttribute("data-cho");
        var dataChoValueGia = parseFloat(nhaccholistitem.getAttribute("data-gia"));
        var giaFormatted = dataChoValueGia.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        thongbao.style.display = "block";
        tieudeDiv.textContent = "Soạn: CHON " + dataChoValue + " gửi 9224 ( "+giaFormatted+")" ;
    });
});
var downloadButton = document.querySelector(".menu-right-media .download");
downloadButton.addEventListener("click", function () {
    var musicUrl = this.getAttribute("data-downloadmusic");
    var downloadLink = document.createElement("a");
    downloadLink.href = "../../music/" + musicUrl;
    downloadLink.download =  musicUrl;
    downloadLink.click();
});
function menuAll(itemcha,itemcon){
    let menudot = document.querySelectorAll("."+itemcha);
    var itemlistdot = document.querySelectorAll("."+itemcon);
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
}
menuAll('dot-3','menu-right-media');
setInterval(function () {
    thongbao.style.display = "none";
}, 30000);
