/**
 * Navigation Bar Mobile Toggle & Interaction
 * Shared across all pages of Magicnas
 */
(function () {
  'use strict';

  function initNav() {
    var toggle = document.querySelector('.nav-toggle');
    var navLinks = document.querySelector('.nav-links');

    if (!toggle || !navLinks) return;

    function openNav() {
      toggle.classList.add('is-active');
      toggle.setAttribute('aria-expanded', 'true');
      navLinks.classList.add('is-open');
      document.body.classList.add('nav-menu-open');
    }

    function closeNav() {
      toggle.classList.remove('is-active');
      toggle.setAttribute('aria-expanded', 'false');
      navLinks.classList.remove('is-open');
      document.body.classList.remove('nav-menu-open');
    }

    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      var isOpen = navLinks.classList.contains('is-open');
      if (isOpen) {
        closeNav();
      } else {
        openNav();
      }
    });

    // Close on any nav link click
    var links = navLinks.querySelectorAll('a');
    links.forEach(function (link) {
      link.addEventListener('click', function () {
        closeNav();
      });
    });

    // Close on click outside navbar
    document.addEventListener('click', function (e) {
      if (
        navLinks.classList.contains('is-open') &&
        !navLinks.contains(e.target) &&
        !toggle.contains(e.target)
      ) {
        closeNav();
      }
    });

    // Close on Escape key press
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navLinks.classList.contains('is-open')) {
        closeNav();
      }
    });

    // Close when resized back to desktop
    window.addEventListener('resize', function () {
      if (window.innerWidth > 768 && navLinks.classList.contains('is-open')) {
        closeNav();
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNav);
  } else {
    initNav();
  }
})();
