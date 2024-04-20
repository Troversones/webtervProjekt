function filterProducts(category) {
    document.querySelectorAll(".product-box").forEach(box => {
        box.style.display = (box.querySelector(".category").value === category) ? "block" : "none";
    });
}

function handleListItemClick(item) {
    document.querySelector("#store-left-nav li.selected")?.classList.remove("selected");
    item.classList.add("selected");
    filterProducts(item.textContent);
}

document.querySelectorAll("#store-left-nav li").forEach(item => {
    item.addEventListener("click", () => handleListItemClick(item));
});

window.addEventListener("load", () => handleListItemClick(document.querySelector("#store-left-nav li[data-category='Sör']")));
