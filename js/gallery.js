var items = document.querySelectorAll(".gallery-item");
var filterButtons = document.querySelectorAll(".filters button");
var modal = document.getElementById("modal");
var modalMedia = document.getElementById("modalMedia");
var modalTitle = document.getElementById("modalTitle");


// Filter buttons
filterButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    var filter = button.getAttribute("data-filter");

    filterButtons.forEach(function (b) { b.classList.remove("active"); });
    button.classList.add("active");

    items.forEach(function (item) {
      var types = item.getAttribute("data-type");

      if (filter === "all" || types.indexOf(filter) !== -1) {
        item.style.display = "";
      } else {
        item.style.display = "none";
      }
    });
  });
});


// Open popup
items.forEach(function (item) {
  item.addEventListener("click", function () {
    var img = item.querySelector("img");
    var source = item.querySelector("video source");

    modalMedia.innerHTML = "";
    modalTitle.textContent = item.getAttribute("data-title");

    if (source) {
      var video = document.createElement("video");
      video.src = source.getAttribute("src");
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      modalMedia.appendChild(video);
    } else if (img) {
      var bigImg = document.createElement("img");
      bigImg.src = img.src;
      bigImg.alt = img.alt;
      modalMedia.appendChild(bigImg);
    }

    modal.classList.add("open");
    document.body.style.overflow = "hidden";
  });
});


// Close popup
function closeModal() {
  modal.classList.remove("open");
  modalMedia.innerHTML = "";
  document.body.style.overflow = "";
}

document.getElementById("modalClose").addEventListener("click", closeModal);

modal.addEventListener("click", function (e) {
  if (e.target === modal) {
    closeModal();
  }
});

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closeModal();
  }
});