const itemmenu = document.querySelectorAll('.menu .itemmenu');
const content = document.querySelectorAll('.content');
itemmenu.forEach(function (itemmenui, indexi) {
    itemmenui.addEventListener("click", () => {
        console.log('a');
        itemmenu.forEach(function (itemmenui, ides) {
            itemmenui.classList.remove("active");
        })
        content.forEach(function (itemmenuicontent, indexicontent) {
            if(indexi==indexicontent){
                itemmenui.classList.add("active");
                itemmenuicontent.style.display="block";
            }
            else{
                itemmenuicontent.style.display="none";
            }
        });
    })})