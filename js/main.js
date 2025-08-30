(function ($) {
  "use strict";

  /* =========================
   * Sticky Navbar
   * ========================= */
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 40) {
      $(".navbar").addClass("sticky-top");
    } else {
      $(".navbar").removeClass("sticky-top");
    }
  });

  /* =========================
   * Back to top button
   * ========================= */
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").on("click", function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  /* =========================
   * Facts counter (counterUp)
   * ========================= */
  if ($.fn.counterUp) {
    $('[data-toggle="counter-up"]').counterUp({ delay: 10, time: 2000 });
  }

  /* =========================
   * Owl Carousels
   * ========================= */
  if ($.fn.owlCarousel) {
    $(".product-carousel").owlCarousel({
      autoplay: true,
      smartSpeed: 1000,
      margin: 45,
      dots: false,
      loop: true,
      nav: true,
      navText: ['<i class="bi bi-arrow-left"></i>', '<i class="bi bi-arrow-right"></i>'],
      responsive: { 0:{items:1}, 768:{items:2}, 992:{items:3}, 1200:{items:4} },
    });

    $(".testimonial-carousel").owlCarousel({
      autoplay: true,
      smartSpeed: 1000,
      items: 1,
      dots: false,
      loop: true,
      nav: true,
      navText: ['<i class="bi bi-arrow-left"></i>', '<i class="bi bi-arrow-right"></i>'],
    });
  }

})(jQuery);

/* ======================================================================
 * Dropdown Navbar (robusto: funciona con y sin Bootstrap JS)
 * - Click SIEMPRE abre/cierra (Chrome, Firefox, y Firefox RDM)
 * - Si Bootstrap está, usa su API; si no, fallback manual con .show
 * ====================================================================== */
(function () {
  var hasBs = !!(window.bootstrap && bootstrap.Dropdown);

  function hideAll() {
    document.querySelectorAll(".navbar .dropdown").forEach(function (li) {
      var toggle = li.querySelector(".dropdown-toggle");
      var menu   = li.querySelector(".dropdown-menu");
      if (!menu) return;
      if (hasBs && toggle) {
        try { bootstrap.Dropdown.getOrCreateInstance(toggle).hide(); } catch(e){}
      }
      menu.classList.remove("show");
      if (toggle) toggle.setAttribute("aria-expanded", "false");
    });
  }

  function toggleDropdown(toggleEl) {
    var li   = toggleEl.closest(".dropdown");
    var menu = li ? li.querySelector(".dropdown-menu") : null;
    if (!menu) return;

    if (hasBs) {
      try {
        var dd = bootstrap.Dropdown.getOrCreateInstance(toggleEl, { autoClose: "outside" });
        dd.toggle();
        return;
      } catch (e) {}
    }

    var isOpen = menu.classList.contains("show");
    hideAll();
    if (!isOpen) {
      menu.classList.add("show");
      toggleEl.setAttribute("aria-expanded", "true");
    }
  }

  // Click en el padre SIEMPRE togglea
  document.addEventListener("click", function (e) {
    var toggle = e.target.closest(".navbar .dropdown-toggle");
    if (!toggle) return;
    e.preventDefault();
    e.stopPropagation();
    toggleDropdown(toggle);
  });

  // Cerrar al click fuera
  document.addEventListener("click", function (e) {
    if (e.target.closest(".navbar")) return;
    hideAll();
  });

  // Cerrar al redimensionar
  var rt;
  window.addEventListener("resize", function () {
    clearTimeout(rt);
    rt = setTimeout(hideAll, 150);
  });
})();
