<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
(function () {
=======

(function () {
  // =========================
  // THEME PREVIEW (your code)
  // =========================
>>>>>>> fc7673c (frontend update and some new feature)
  const themeButtons = document.querySelectorAll(".theme-btn");
  const themeInput = document.getElementById("theme-input");
  const themeCss = document.getElementById("theme-css");

<<<<<<< HEAD
  if (!themeButtons.length) return;

  const THEMES = ["light", "dark", "colorblind"];

  function getCssDirFromHref(href) {
    if (!href) return "/css/themes/";
    const clean = href.split("?")[0].split("#")[0];
    return clean.substring(0, clean.lastIndexOf("/") + 1);
  }

  function applyTheme(t, opts = {}) {
    if (!THEMES.includes(t)) t = "dark";

    if (themeInput) themeInput.value = t;

    themeButtons.forEach((b) => {
      const isActive = b.dataset.theme === t;
      b.classList.toggle("active", isActive);
      b.setAttribute("aria-pressed", isActive ? "true" : "false");
    });

    document.documentElement.setAttribute("data-theme", t);
    document.body.setAttribute("data-theme", t);

    // EZ CSAK AKKOR FOG MŰKÖDNI, HA MINDEN OLDALON LÉTEZIK <link id="theme-css" ...>
    if (themeCss) {
      const dir = getCssDirFromHref(themeCss.href || themeCss.getAttribute("href"));
      const url = dir + t + ".css" + (opts.bust ? `?v=${Date.now()}` : "");
      themeCss.setAttribute("href", url);
    }

    try { localStorage.setItem("fg_theme_preview", t); } catch (e) {}
  }

  themeButtons.forEach((btn) => {
    btn.addEventListener("click", () => applyTheme(btn.dataset.theme, { bust: true }));
  });

  // induláskor preview
  try {
    const saved = localStorage.getItem("fg_theme_preview");
    if (saved && THEMES.includes(saved)) {
      applyTheme(saved);
      return;
    }
  } catch (e) {}

  const initial =
    (themeInput && themeInput.value) ||
    document.body.getAttribute("data-theme") ||
    document.documentElement.getAttribute("data-theme") ||
    "dark";

  applyTheme(initial);
=======
  if (themeButtons.length) {
    const THEMES = ["light", "dark", "hc"];

    function getCssDirFromHref(href) {
      if (!href) return "/css/themes/";
      const clean = href.split("?")[0].split("#")[0];
      return clean.substring(0, clean.lastIndexOf("/") + 1);
    }

    function applyTheme(t, opts = {}) {
      if (!THEMES.includes(t)) t = "dark";

      if (themeInput) themeInput.value = t;

      themeButtons.forEach((b) => {
        const isActive = b.dataset.theme === t;
        b.classList.toggle("active", isActive);
        b.setAttribute("aria-pressed", isActive ? "true" : "false");
      });
=======
=======
>>>>>>> 9e16f42 (Újabb push)
document.addEventListener("DOMContentLoaded", function () {
  const THEMES = ["light", "dark", "hc"];
  const themeButtons = document.querySelectorAll(".theme-btn");
  const themeInput = document.getElementById("theme-input");

  function setTheme(theme) {
      const t = THEMES.includes(theme) ? theme : "dark";
<<<<<<< HEAD
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)

      document.documentElement.setAttribute("data-theme", t);
      document.body.setAttribute("data-theme", t);

<<<<<<< HEAD
<<<<<<< HEAD
      // Works only if <link id="theme-css" ...> exists on the page
      if (themeCss) {
        const dir = getCssDirFromHref(themeCss.href || themeCss.getAttribute("href"));
        const url = dir + t + ".css" + (opts.bust ? `?v=${Date.now()}` : "");
        themeCss.setAttribute("href", url);
      }

      try { localStorage.setItem("fg_theme_preview", t); } catch (e) {}
    }

    themeButtons.forEach((btn) => {
      btn.addEventListener("click", () => applyTheme(btn.dataset.theme, { bust: true }));
    });

    // On load preview
    try {
      const saved = localStorage.getItem("fg_theme_preview");
      if (saved && THEMES.includes(saved)) {
        applyTheme(saved);
      }
    } catch (e) {}

    const initial =
=======
=======
>>>>>>> 9e16f42 (Újabb push)
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
<<<<<<< HEAD
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      (themeInput && themeInput.value) ||
      document.body.getAttribute("data-theme") ||
      document.documentElement.getAttribute("data-theme") ||
      "dark";

<<<<<<< HEAD
<<<<<<< HEAD
    applyTheme(initial);
  }

  // =========================
  // LANGUAGE SWITCH (NEW)
  // =========================
  const langSelect = document.getElementById("language-select");
  const langForm = document.getElementById("lang-form");
  const langHidden = document.getElementById("lang-hidden");

  if (!langSelect || !langForm || !langHidden) return;

  langSelect.addEventListener("change", function () {
    langHidden.value = langSelect.value;
    langForm.submit(); // saves + reloads
  });
>>>>>>> fc7673c (frontend update and some new feature)
})();
=======
=======
>>>>>>> 9e16f42 (Újabb push)
  try {
      const saved = localStorage.getItem("fg_theme_preview");
      if (saved && THEMES.includes(saved)) {
          initialTheme = saved;
      }
  } catch (e) {}

  setTheme(initialTheme);
<<<<<<< HEAD
});
>>>>>>> 5c55d34 (new features)
=======
});
>>>>>>> 9e16f42 (Újabb push)
