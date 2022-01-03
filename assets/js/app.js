window.addEventListener("load", function(){
    document.querySelector(".signee-list-show-all").addEventListener("click", event => {
        document.querySelectorAll(".signee-list-rest-block").forEach(element => {
            element.classList.remove("d-none");
        });
        event.target.classList.add("d-none");
    })
});
