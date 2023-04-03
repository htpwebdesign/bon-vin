document.addEventListener("click", (event) => {
  const shopFilter = document.querySelector(".filter-wrapper");
  const filterDropdown = document.querySelector(".filter-dropdown");
  if (event.target == filterDropdown) {
    shopFilter.classList.toggle("show");
  } else {
    shopFilter.classList.remove("show");
  }
});
