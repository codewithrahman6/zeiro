/* ===============================
   GALLERY FILTER
================================*/

const filterButtons = document.querySelectorAll(".filter-bar button");
const items = document.querySelectorAll(".gallery-grid .item");

filterButtons.forEach(btn => {
    btn.addEventListener("click", () => {

        filterButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        let filter = btn.getAttribute("data-filter");

        items.forEach(item => {
            if (filter === "all" || item.getAttribute("data-category") === filter) {
                item.style.display = "block";
                setTimeout(() => item.style.opacity = "1", 100);
            } else {
                item.style.opacity = "0";
                setTimeout(() => item.style.display = "none", 200);
            }
        });
    });
});
