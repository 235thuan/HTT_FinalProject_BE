document.querySelectorAll(".fa-heart").forEach((icon) => {
  icon.addEventListener("click", () => {
    icon.classList.toggle("liked");
    if (icon.classList.contains("liked")) {
      icon.style.color = "red";
    } else {
      icon.style.color = "";
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const menuIcon = document.querySelector(".menu-icon");
  const navMenu = document.querySelector(".nav-menu");

  menuIcon.addEventListener("click", () => {
    navMenu.classList.toggle("show");
  });
});
