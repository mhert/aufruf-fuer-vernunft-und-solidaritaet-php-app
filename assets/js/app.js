window.addEventListener("load", function(){
    document.querySelectorAll(".signee-list-show-all").forEach(button => {
        button.addEventListener("click", event => {
            button.parentNode.parentNode.querySelectorAll(".signee-list .d-none").forEach(signee => {
                signee.classList.remove("d-none");
            });
            event.target.classList.add("d-none");
        })
    })
});
