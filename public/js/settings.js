document.addEventListener("DOMContentLoaded", function () {
  const THEMES = ["light", "dark", "hc"];
  const themeButtons = document.querySelectorAll(".theme-btn");
  const themeInput = document.getElementById("theme-input");

  function setTheme(theme) {
      const t = THEMES.includes(theme) ? theme : "dark";

      document.documentElement.setAttribute("data-theme", t);
      document.body.setAttribute("data-theme", t);

      if (themeInput) {
          themeInput.value = t;
      }

      const themeCss = document.getElementById("theme-css");
      if (themeCss) {
          themeCss.setAttribute("href", `/css/themes/${t}.css?v=${Date.now()}`);
      }

      themeButtons.forEach((btn) => {
          const isActive = btn.dataset.theme === t;
          btn.classList.toggle("active", isActive);
          btn.setAttribute("aria-pressed", isActive ? "true" : "false");
      });

      try {
          localStorage.setItem("fg_theme_preview", t);
      } catch (e) {}
  }

  themeButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
          setTheme(btn.dataset.theme);
      });
  });

  let initialTheme =
      (themeInput && themeInput.value) ||
      document.body.getAttribute("data-theme") ||
      document.documentElement.getAttribute("data-theme") ||
      "dark";

  try {
      const saved = localStorage.getItem("fg_theme_preview");
      if (saved && THEMES.includes(saved)) {
          initialTheme = saved;
      }
  } catch (e) {}

  setTheme(initialTheme);
});