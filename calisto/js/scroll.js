
const footer = document.getElementById("footer");

if (document.body.scrollHeight > window.innerHeight) {
  footer.classList.add("footer");
} else {
  footer.classList.add("footer2");
}
