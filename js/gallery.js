var items = document.querySelectorAll(".gallery-item");
var filterButtons = document.querySelectorAll(".filters button");
var modal = document.getElementById("modal");
var modalMedia = document.getElementById("modalMedia");
var modalTitle = document.getElementById("modalTitle");

// Category filtering for photos and videos
filterButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    var filter = button.getAttribute("data-filter");

    filterButtons.forEach(function (b) { b.classList.remove("active"); });
    button.classList.add("active");

    items.forEach(function (item) {
      var cat = item.getAttribute("data-category") || item.getAttribute("data-type") || "";

      if (filter === "all" || cat === filter || cat.indexOf(filter) !== -1) {
        item.style.display = "";
      } else {
        item.style.display = "none";
      }
    });
  });
});

// Lightbox modal popup
items.forEach(function (item) {
  item.addEventListener("click", function () {
    var img = item.querySelector("img");
    var ytId = item.getAttribute("data-youtube-id");
    var title = item.getAttribute("data-title") || "";

    if (!modalMedia) return;

    modalMedia.innerHTML = "";
    if (modalTitle) {
      modalTitle.textContent = title;
    }

    if (ytId) {
      var iframe = document.createElement("iframe");
      iframe.src = "https://www.youtube-nocookie.com/embed/" + encodeURIComponent(ytId) + "?autoplay=1&rel=0";
      iframe.title = title || "YouTube Video";
      iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
      iframe.allowFullscreen = true;
      iframe.style.width = "100%";
      iframe.style.height = "100%";
      iframe.style.border = "none";
      modalMedia.appendChild(iframe);
    } else if (img) {
      var bigImg = document.createElement("img");
      bigImg.src = img.src;
      bigImg.alt = title;
      modalMedia.appendChild(bigImg);
    }

    if (modal) {
      modal.classList.add("open");
      document.body.style.overflow = "hidden";
    }
  });
});

// Close modal popup
function closeModal() {
  if (modal) {
    modal.classList.remove("open");
  }
  if (modalMedia) {
    modalMedia.innerHTML = "";
  }
  document.body.style.overflow = "";
}

var modalClose = document.getElementById("modalClose");
if (modalClose) {
  modalClose.addEventListener("click", closeModal);
}

if (modal) {
  modal.addEventListener("click", function (e) {
    if (e.target === modal) {
      closeModal();
    }
  });
}

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && modal && modal.classList.contains("open")) {
    closeModal();
  }
});