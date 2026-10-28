document.addEventListener("DOMContentLoaded", function () {

  // Smooth scroll for in-page links, leaving room for the sticky header
  var header = document.querySelector(".site-header");

  document.querySelectorAll('a[href^="#"]').forEach(function (link) {
    link.addEventListener("click", function (e) {
      var targetId = this.getAttribute("href");
      if (targetId.length < 2) return;

      var target = document.querySelector(targetId);
      if (!target) return;

      e.preventDefault();

      var offset = (header ? header.offsetHeight : 0) + 20;
      var top = target.getBoundingClientRect().top + window.pageYOffset - offset;

      window.scrollTo({ top: top, behavior: "smooth" });
    });
  });


  // YouTube videos: show the thumbnail, open the video on YouTube
  document.querySelectorAll("[data-youtube]").forEach(function (box) {
    var link = box.getAttribute("data-youtube");
    var match = link.match(/(?:youtu\.be\/|v=|embed\/|shorts\/|live\/)([A-Za-z0-9_-]{11})/);
    if (!match) return;

    var id = match[1];
    var title = box.getAttribute("data-title") || "YouTube video";

    box.href = "https://www.youtube.com/watch?v=" + id;
    box.target = "_blank";
    box.rel = "noopener";
    box.setAttribute("aria-label", "Watch " + title + " on YouTube");

    var img = document.createElement("img");
    img.src = "https://i.ytimg.com/vi/" + id + "/hqdefault.jpg";
    img.alt = title;
    img.loading = "lazy";

    var play = document.createElement("span");
    play.className = "video-play";

    var badge = document.createElement("span");
    badge.className = "video-badge";
    badge.textContent = "YouTube ↗";

    box.appendChild(img);
    box.appendChild(play);
    box.appendChild(badge);
  });

});