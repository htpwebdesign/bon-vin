const filters = document.querySelectorAll(".filter");
const filterTitle = document.querySelector(".filter-title");

filters.forEach((filter) => {
  filter.addEventListener("click", function () {
    let selectedFilter = filter.getAttribute("data-filter");

    if (selectedFilter == "wine") {
      itemsToHide = document.querySelectorAll(`.products .product:not(.product_cat-wine)`);
      itemsToShow = document.querySelectorAll(`.products .product.product_cat-wine`);
      filterTitle.innerHTML = "Wine";
    }
    if (selectedFilter == "not-wine") {
      itemsToHide = document.querySelectorAll(`.products .product.product_cat-wine`);
      itemsToShow = document.querySelectorAll(`.products .product:not(.product_cat-wine)`);
      filterTitle.innerHTML = "Not Wine";
    }
    if (selectedFilter == "all") {
      itemsToHide = [];
      itemsToShow = document.querySelectorAll(".products .product");
      filterTitle.innerHTML = "All";
    }

    itemsToHide.forEach((el) => {
      el.classList.add("hide");
      el.classList.remove("show");
    });

    itemsToShow.forEach((el) => {
      el.classList.remove("hide");
      el.classList.add("show");
    });
  });
});
