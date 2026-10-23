document.addEventListener('DOMContentLoaded', () => {
  // Smooth scroll for anchor jump links
  const jumpLinks = document.querySelectorAll('a[href^="#"]');
  jumpLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId.length > 1 && document.querySelector(targetId)) {
        e.preventDefault();
        const targetElement = document.querySelector(targetId);
        const headerOffset = 110;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // Pause background video elements when not in viewport to save resources
  const videos = document.querySelectorAll('video');
  if ('IntersectionObserver' in window) {
    const videoObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting && !entry.target.paused) {
          entry.target.pause();
        }
      });
    }, { threshold: 0.25 });

    videos.forEach(v => videoObserver.observe(v));
  }
});