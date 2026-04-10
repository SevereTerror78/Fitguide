// =========================================================
  //  HAMBURGER MENU
  // =========================================================
  function wireHamburgerMenu() {
    const toggle  = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');   // csak EZT kezeljük
    if (!toggle || !navMenu) return;

    toggle.setAttribute('aria-expanded', 'false');

    toggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('open');
      toggle.classList.toggle('active', isOpen);
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      toggle.innerHTML = isOpen
        ? '<i class="fa-solid fa-xmark"></i>'
        : '<i class="fa-solid fa-bars"></i>';
    });
  }
