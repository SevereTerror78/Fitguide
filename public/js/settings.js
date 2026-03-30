(function () {
  const themeButtons = document.querySelectorAll(".theme-btn");
  const themeInput = document.getElementById("theme-input");
  const themeCss = document.getElementById("theme-css");

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
})();
