
let chat_boxToggler = document.querySelector(".chat_box-toggler");
let closeBtn = document.querySelector(".close-btn");

closeBtn.addEventListener("click", () => document.body.classList.remove("show-chat_box"));
chat_boxToggler.addEventListener("click", () => document.body.classList.toggle("show-chat_box"));

