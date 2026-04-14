(function () {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  // =========================================================
  //  CONFIG
  // =========================================================
  const CART_COUNT_URL = (window.FG && window.FG.cartCountUrl) || null;
  const STORE_URL = window.STORE_URL || '/store';
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';

  // =========================================================
  //  CART BADGE HELPERS
  // =========================================================
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  if (window.__FG_STORE_JS_LOADED) return;
  window.__FG_STORE_JS_LOADED = true;

  const CART_COUNT_URL = (window.FG && window.FG.cartCountUrl) || null;
  const STORE_URL = window.STORE_URL || '/store';
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const currency = document.body?.dataset?.currency || 'HUF';

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  const cartLink = document.querySelector('.nav-cart');

  function getBadgeEl() {
    return cartLink ? cartLink.querySelector('.cart-badge') : null;
  }
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  function getBadgeCount() {
    const b = getBadgeEl();
    const n = b ? parseInt(b.textContent, 10) : 0;
    return Number.isFinite(n) ? n : 0;
  }
=======

>>>>>>> fc7673c (frontend update and some new feature)
=======

>>>>>>> 5c55d34 (new features)
=======

>>>>>>> 9e16f42 (Újabb push)
  function setBadgeCount(n) {
    if (!cartLink) return;
    let b = getBadgeEl();
    if (!b) {
      b = document.createElement('span');
      b.className = 'cart-badge';
      cartLink.appendChild(b);
    }
    b.textContent = Math.max(0, n);
    b.classList.remove('bump');
    void b.offsetWidth;
    b.classList.add('bump');
  }
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
=======

>>>>>>> 5c55d34 (new features)
=======

>>>>>>> 9e16f42 (Újabb push)
  async function refreshCartBadge() {
    if (!CART_COUNT_URL) return;
    try {
      const res = await fetch(CART_COUNT_URL, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin'
      });
      if (!res.ok) return;
      const data = await res.json();
      if (typeof data.count === 'number') setBadgeCount(data.count);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    } catch (_) { /* ignore */ }
  }

  // =========================================================
  //  AJAX FILTERING + PAGINATION + SEARCH (STORE OLDAL)
  // =========================================================
  function wireAjaxFiltering() {
    const list = document.getElementById('product-list');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const filterSelect = document.getElementById('product-filter');

    // Search UI (optional - ha nincs a DOM-ban, nem crash-el)
    const searchInput = document.getElementById('storeSearch');
    const clearBtn = document.getElementById('searchClear');

    // -------- helpers
    function getSearchValue() {
      const v = (searchInput?.value || '').trim();
      return v;
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    } catch (_) {}
  }

  function wireAjaxFiltering() {
    const list = document.getElementById('product-list');
    if (!list) return;

    const filterBtns = document.querySelectorAll('.filter-btn');
    const filterSelect = document.getElementById('product-filter');
    const searchInput = document.getElementById('storeSearch');
    const clearBtn = document.getElementById('searchClear');

    function getSearchValue() {
      return (searchInput?.value || '').trim();
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    }

    function setSearchValue(v) {
      if (!searchInput) return;
      searchInput.value = v || '';
      toggleClear();
    }

    function toggleClear() {
      if (!clearBtn) return;
      const has = getSearchValue().length > 0;
      clearBtn.classList.toggle('show', has);
      clearBtn.style.display = has ? '' : 'none';
    }

    function debounce(fn, ms = 320) {
      let t;
      return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), ms);
      };
    }

    function setActiveBySlug(slug) {
      filterBtns.forEach(a => {
        const href = a.getAttribute('href') || '';
        const u = new URL(href, window.location.origin);
        const t = u.searchParams.get('type') || 'all';
        a.classList.toggle('active', t === slug);
      });
      if (filterSelect) filterSelect.value = slug;
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // build url úgy, hogy a jelenlegi URL paramjai alapból megmaradjanak
    // és csak amit felülírsz, azt írja át
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    function buildUrl(base, params) {
      const current = new URL(window.location.href);
      const url = new URL(base, window.location.origin);

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      // kiindulás: a current search paramjai
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      current.searchParams.forEach((val, key) => {
        url.searchParams.set(key, val);
      });

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      // felülírás: a params
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      Object.entries(params).forEach(([k, v]) => {
        if (v == null || v === '' || v === 'all') url.searchParams.delete(k);
        else url.searchParams.set(k, v);
      });

      return url.toString();
    }

    async function loadProducts(url) {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      if (!list) { window.location.href = url; return; }
      try {
        list.classList.add('loading');

        // Nálad a controller ajax()-ot néz, de te ajax=1-et is adsz.
        // Ez oké, nem zavar be, és a X-Requested-With is ott van.
=======
      try {
        list.classList.add('loading');

>>>>>>> fc7673c (frontend update and some new feature)
=======
      try {
        list.classList.add('loading');

>>>>>>> 5c55d34 (new features)
=======
      try {
        list.classList.add('loading');

>>>>>>> 9e16f42 (Újabb push)
        const ajaxUrl = (url.includes('?') ? url + '&' : url + '?') + 'ajax=1';

        const res = await fetch(ajaxUrl, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          credentials: 'same-origin'
        });
        if (!res.ok) throw new Error('Bad response');

        const html = await res.text();
        list.innerHTML = html;

        const cleanUrl = ajaxUrl
          .replace(/([?&])ajax=1(&|$)/, '$1')
          .replace(/[?&]$/, '');

        window.history.pushState({}, '', cleanUrl);

<<<<<<< HEAD
<<<<<<< HEAD
        wirePagination();
        list.classList.remove('loading');
        window.scrollTo({ top: list.offsetTop - 40, behavior: 'smooth' });
=======
=======
>>>>>>> 9e16f42 (Újabb push)
      wirePagination();
      list.classList.remove('loading');

      document.querySelector('.section-cards')?.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
<<<<<<< HEAD
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      } catch (e) {
        console.error(e);
        list.classList.remove('loading');
        window.location.href = url;
      }
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // -------- FILTER BUTTONS (megőrzi a search-t)
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    function wireFilterButtons() {
      filterBtns.forEach(a => {
        a.addEventListener('click', (e) => {
          e.preventDefault();

          const href = a.getAttribute('href') || STORE_URL;
          const u = new URL(href, window.location.origin);
          const type = u.searchParams.get('type') || 'all';

          setActiveBySlug(type);

          const url = buildUrl(STORE_URL, {
            type,
            search: getSearchValue(),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            page: '' // reset page filter váltáskor
=======
            page: ''
>>>>>>> fc7673c (frontend update and some new feature)
=======
            page: ''
>>>>>>> 5c55d34 (new features)
=======
            page: ''
>>>>>>> 9e16f42 (Újabb push)
          });

          loadProducts(url);
        });
      });
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // -------- SELECT (megőrzi a search-t)
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    function wireSelect() {
      if (!filterSelect) return;
      filterSelect.addEventListener('change', () => {
        const type = filterSelect.value;
        setActiveBySlug(type);

        const url = buildUrl(STORE_URL, {
          type,
          search: getSearchValue(),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
          page: '' // reset page
=======
          page: ''
>>>>>>> fc7673c (frontend update and some new feature)
=======
          page: ''
>>>>>>> 5c55d34 (new features)
=======
          page: ''
>>>>>>> 9e16f42 (Újabb push)
        });

        loadProducts(url);
      });
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // -------- PAGINATION (ha valamiért nincs benne search/type, hozzáadjuk)
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    function wirePagination() {
      const listEl = document.getElementById('product-list');
      if (!listEl) return;

      listEl.querySelectorAll('.pagination a, .fitguide-pagination a').forEach(a => {
        a.addEventListener('click', (e) => {
          e.preventDefault();

          const href = a.getAttribute('href');
          if (!href) return;

          const u = new URL(href, window.location.origin);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

          const page = u.searchParams.get('page');

          const url = buildUrl(STORE_URL, {
            page, // ✅ EZ A KULCS
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
          const page = u.searchParams.get('page');

          const url = buildUrl(STORE_URL, {
            page,
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
            type: (new URL(window.location.href)).searchParams.get('type') || (filterSelect?.value || 'all'),
            search: getSearchValue()
          });

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
          loadProducts(url);
        });
      });
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // -------- SEARCH (debounce + clear + enter + esc)
    function wireSearch() {
      if (!searchInput) return;

      // init: ha URL-ben van search, töltsük vissza
=======
    function wireSearch() {
      if (!searchInput) return;

>>>>>>> fc7673c (frontend update and some new feature)
=======
    function wireSearch() {
      if (!searchInput) return;

>>>>>>> 5c55d34 (new features)
=======
    function wireSearch() {
      if (!searchInput) return;

>>>>>>> 9e16f42 (Újabb push)
      const fromUrl = (new URL(window.location.href)).searchParams.get('search') || '';
      if (fromUrl && !searchInput.value) searchInput.value = fromUrl;
      toggleClear();

      const doSearch = () => {
        const type = (new URL(window.location.href)).searchParams.get('type') || (filterSelect?.value || 'all');
        const url = buildUrl(STORE_URL, {
          type,
          search: getSearchValue(),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
          page: '' // kereséskor reset
=======
          page: ''
>>>>>>> fc7673c (frontend update and some new feature)
=======
          page: ''
>>>>>>> 5c55d34 (new features)
=======
          page: ''
>>>>>>> 9e16f42 (Újabb push)
        });
        loadProducts(url);
      };

      const debounced = debounce(doSearch, 320);

      searchInput.addEventListener('input', () => {
        toggleClear();
        debounced();
      });

      searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
          e.preventDefault();
          doSearch();
        }
        if (e.key === 'Escape') {
          e.preventDefault();
          setSearchValue('');
          doSearch();
        }
      });

      if (clearBtn) {
        clearBtn.addEventListener('click', () => {
          setSearchValue('');
          doSearch();
          searchInput.focus();
        });
      }
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // init active type from URL
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    const currentType = new URL(window.location.href).searchParams.get('type') || 'all';
    setActiveBySlug(currentType);

    wireFilterButtons();
    wireSelect();
    wirePagination();
    wireSearch();

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    // back/forward: UI sync
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    window.addEventListener('popstate', () => {
      const u = new URL(window.location.href);
      const type = u.searchParams.get('type') || 'all';
      const s = u.searchParams.get('search') || '';

      setActiveBySlug(type);
      setSearchValue(s);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      loadProducts(u.toString());
    }, { once: false });
  }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  // =========================================================
  //  ADD TO CART (AJAX)
  // =========================================================
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  let BADGE_VERSION = 0;

  document.addEventListener('submit', async (e) => {
    const form = e.target;
    if (!form.matches('.add-to-cart-form')) return;
    if (!window.fetch) return;

    e.preventDefault();

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    if (form.dataset.submitting === '1') return;
    form.dataset.submitting = '1';

>>>>>>> fc7673c (frontend update and some new feature)
=======
    if (form.dataset.submitting === '1') return;
    form.dataset.submitting = '1';

>>>>>>> 5c55d34 (new features)
=======
    if (form.dataset.submitting === '1') return;
    form.dataset.submitting = '1';

>>>>>>> 9e16f42 (Újabb push)
    const qtyInput = form.querySelector('input[name="qty"]');
    const qty = qtyInput ? Math.max(1, parseInt(qtyInput.value || '1', 10)) : 1;

    const btn = form.querySelector('.add-btn') || form.querySelector('.btn.pill');
    if (btn) { btn.classList.add('adding'); btn.disabled = true; }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    const before = (function(){
      const b = document.querySelector('.nav-cart .cart-badge');
      return b ? parseInt(b.textContent || '0', 10) || 0 : 0;
    })();
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    const before = (() => {
      const b = document.querySelector('.nav-cart .cart-badge');
      return b ? (parseInt(b.textContent || '0', 10) || 0) : 0;
    })();

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    setBadgeCount(before + qty);

    const thisVersion = ++BADGE_VERSION;

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json'
        },
        body: new FormData(form),
        credentials: 'same-origin'
      });

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      let data = null;
      try { data = await res.json(); } catch (_) {}
=======
      const data = await res.json().catch(() => null);
>>>>>>> fc7673c (frontend update and some new feature)
=======
      const data = await res.json().catch(() => null);
>>>>>>> 5c55d34 (new features)
=======
      const data = await res.json().catch(() => null);
>>>>>>> 9e16f42 (Újabb push)

      if (!res.ok || !data || data.ok !== true || typeof data.count !== 'number') {
        throw new Error('Add to cart failed');
      }

      if (thisVersion === BADGE_VERSION) setBadgeCount(data.count);
    } catch (err) {
      setBadgeCount(before);
      console.error(err);
      alert('Sajnos nem sikerült a kosárhoz adni. Próbáld újra.');
    } finally {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
      delete form.dataset.submitting;

>>>>>>> fc7673c (frontend update and some new feature)
=======
      delete form.dataset.submitting;

>>>>>>> 5c55d34 (new features)
=======
      delete form.dataset.submitting;

>>>>>>> 9e16f42 (Újabb push)
      setTimeout(() => {
        if (btn) { btn.classList.remove('adding'); btn.disabled = false; }
      }, 180);
    }
  });

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  // =========================================================
  //  CART PAGE: QTY HANDLING, OPTIMISTIC TOTALS
  // =========================================================
  const fmt = (n) => Number(n).toLocaleString('de-DE', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  }) + ' €';

  function getDiscountPercent(){
    const card = document.querySelector('.summary-card');
    if(!card) return 0;
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  function fmtFromHuf(n) {
    const num = Number(n || 0);

    if (currency === 'EUR') {
      return '€' + (num / 381).toFixed(2);
    }

    return num.toLocaleString('hu-HU', {
      minimumFractionDigits: 0,
      maximumFractionDigits: 0,
    }) + ' Ft';
  }

  function getDiscountPercent() {
    const card = document.querySelector('.summary-card');
    if (!card) return 0;
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    const p = parseFloat(card.dataset.discountPercent || '0');
    return Number.isFinite(p) ? Math.max(0, Math.min(100, p)) : 0;
  }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  function setDiscountPercent(p){
    const card = document.querySelector('.summary-card');
    if(!card) return;
    card.dataset.discountPercent = String(p || 0);
  }

  function updateRowLineTotal(row){
    if(!row) return;
    const priceEl = row.querySelector('.line-total') || row.querySelector('[data-price]');
    const unitPrice = parseFloat(priceEl?.dataset.price || '0');
    const qty = parseInt(row.querySelector('.qty-input')?.value || '1', 10);
    if(priceEl) priceEl.textContent = fmt(unitPrice * qty);
  }

  function recalcCartTotals(){
    let subtotal = 0;
    document.querySelectorAll('.cart-row').forEach(row=>{
      const priceHolder = row.querySelector('.line-total') || row.querySelector('[data-price]');
      const unitPrice = parseFloat(priceHolder?.dataset.price || '0');
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  function setDiscountPercent(p) {
    const card = document.querySelector('.summary-card');
    if (!card) return;
    card.dataset.discountPercent = String(p || 0);
  }

  function updateRowLineTotal(row) {
    if (!row) return;
    const priceEl = row.querySelector('.line-total');
    const unitPrice = parseFloat(priceEl?.dataset.priceHuf || '0');
    const qty = parseInt(row.querySelector('.qty-input')?.value || '1', 10);
    if (priceEl) priceEl.textContent = fmtFromHuf(unitPrice * qty);
  }

  function recalcCartTotals() {
    let subtotal = 0;

    document.querySelectorAll('.cart-row').forEach(row => {
      const priceHolder = row.querySelector('.line-total');
      const unitPrice = parseFloat(priceHolder?.dataset.priceHuf || '0');
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      const qty = parseInt(row.querySelector('.qty-input')?.value || '1', 10);
      subtotal += unitPrice * qty;
    });

    const shipEl = document.getElementById('cart-shipping');
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    const shipping = shipEl ? parseFloat((shipEl.textContent || '').replace(/[^\d.]/g,'') || '0') : 0;

    const percent = getDiscountPercent();
    const discount = percent > 0 ? (subtotal * (percent / 100)) : 0;

=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    const shipping = shipEl?.dataset.shippingHuf ? parseFloat(shipEl.dataset.shippingHuf) : 0;

    const percent = getDiscountPercent();
    const discount = percent > 0 ? (subtotal * (percent / 100)) : 0;
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    const total = Math.max(0, subtotal + shipping - discount);

    const subEl = document.getElementById('cart-subtotal');
    const totEl = document.getElementById('cart-total');
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    if(subEl) subEl.textContent = fmt(subtotal);
    if(totEl) totEl.textContent = fmt(total);

    const dLine = document.getElementById('discount-line');
    const dEl = document.getElementById('cart-discount');
    if(dLine && dEl){
      if(percent > 0){
        dLine.style.display = 'flex';
        dEl.textContent = fmt(discount);
      } else {
        dLine.style.display = 'none';
        dEl.textContent = fmt(0);
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)

    if (subEl) subEl.textContent = fmtFromHuf(subtotal);
    if (totEl) totEl.textContent = fmtFromHuf(total);

    const dLine = document.getElementById('discount-line');
    const dEl = document.getElementById('cart-discount');

    if (dLine && dEl) {
      if (percent > 0) {
        dLine.style.display = 'flex';
        dEl.textContent = fmtFromHuf(discount);
      } else {
        dLine.style.display = 'none';
        dEl.textContent = fmtFromHuf(0);
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      }
    }
  }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  async function persistQty(form, qty){
    const url = form?.dataset?.updateUrl;
    if(!url) return;

    try{
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  async function persistQty(form, qty) {
    const url = form?.dataset?.updateUrl;
    if (!url) return;

    try {
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      const fd = new FormData();
      fd.append('qty', qty);

      const res = await fetch(url, {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        method:'POST',
        headers:{ 'X-Requested-With':'XMLHttpRequest', 'X-CSRF-TOKEN':CSRF, 'Accept':'application/json' },
        body: fd,
        credentials:'same-origin'
      });

      const data = await res.json().catch(()=>null);
      if(!data || typeof data !== 'object') return;

      const row = form.closest('.cart-row');

      if(row && typeof data.lineTotal === 'string'){
        const lt = row.querySelector('.line-total');
        if(lt) lt.textContent = fmt(parseFloat(data.lineTotal));
      }

      if(typeof data.subtotal === 'string'){
        const subEl = document.getElementById('cart-subtotal');
        if(subEl) subEl.textContent = fmt(parseFloat(data.subtotal));
      }

      if(typeof data.shipping === 'string'){
        const shipEl = document.getElementById('cart-shipping');
        if(shipEl) shipEl.textContent = fmt(parseFloat(data.shipping));
      }

      if(typeof data.discount === 'string'){
        const disc = parseFloat(data.discount);
        const dLine = document.getElementById('discount-line');
        const dEl = document.getElementById('cart-discount');

        if(dLine && dEl){
          if(disc > 0){
            dLine.style.display = 'flex';
            dEl.textContent = fmt(disc);
          } else {
            dLine.style.display = 'none';
            dEl.textContent = fmt(0);
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json'
        },
        body: fd,
        credentials: 'same-origin'
      });

      const data = await res.json().catch(() => null);
      if (!data || typeof data !== 'object') return;

      const row = form.closest('.cart-row');

      if (row && typeof data.lineTotal !== 'number') {
        const lt = row.querySelector('.line-total');
        if (lt) lt.textContent = fmtFromHuf(data.lineTotal);
      }

      if (typeof data.subtotal !== 'undefined') {
        const subEl = document.getElementById('cart-subtotal');
        if (subEl) subEl.textContent = fmtFromHuf(data.subtotal);
      }

      if (typeof data.shipping !== 'undefined') {
        const shipEl = document.getElementById('cart-shipping');
        if (shipEl) {
          shipEl.dataset.shippingHuf = data.shipping;
          shipEl.textContent = fmtFromHuf(data.shipping);
        }
      }

      if (typeof data.discount !== 'undefined') {
        const disc = Number(data.discount);
        const dLine = document.getElementById('discount-line');
        const dEl = document.getElementById('cart-discount');

        if (dLine && dEl) {
          if (disc > 0) {
            dLine.style.display = 'flex';
            dEl.textContent = fmtFromHuf(disc);
          } else {
            dLine.style.display = 'none';
            dEl.textContent = fmtFromHuf(0);
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
          }
        }
      }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      if(typeof data.total === 'string'){
        const totEl = document.getElementById('cart-total');
        if(totEl) totEl.textContent = fmt(parseFloat(data.total));
      }

    }catch(e){
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      if (typeof data.total !== 'undefined') {
        const totEl = document.getElementById('cart-total');
        if (totEl) totEl.textContent = fmtFromHuf(data.total);
      }
    } catch (e) {
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      console.warn('cart.update error, keeping optimistic totals', e);
    }
  }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  function wireCartQty(){
    const table = document.querySelector('.cart-table');
    if(!table) return;

    table.addEventListener('click', (e)=>{
      const btn = e.target.closest('.qty-btn');
      if(!btn) return;
      const form = btn.closest('.qty-form');
      const input = form?.querySelector('.qty-input');
      const row = btn.closest('.cart-row');
      if(!input || !row) return;

      const min = parseInt(input.getAttribute('min') || '1', 10);
      let val = parseInt(input.value || '1', 10);
      if(btn.classList.contains('plus')) val += 1;
      if(btn.classList.contains('minus')) val = Math.max(min, val - 1);
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  function wireCartQty() {
    const table = document.querySelector('.cart-table');
    if (!table) return;

    table.addEventListener('click', (e) => {
      const btn = e.target.closest('.qty-btn');
      if (!btn) return;

      const form = btn.closest('.qty-form');
      const input = form?.querySelector('.qty-input');
      const row = btn.closest('.cart-row');
      if (!input || !row) return;

      const min = parseInt(input.getAttribute('min') || '1', 10);
      let val = parseInt(input.value || '1', 10);

      if (btn.classList.contains('plus')) val += 1;
      if (btn.classList.contains('minus')) val = Math.max(min, val - 1);

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      input.value = val;
      updateRowLineTotal(row);
      recalcCartTotals();
      persistQty(form, val);
    });

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    table.addEventListener('input', (e)=>{
      const input = e.target.closest('.qty-input');
      if(!input) return;
      const form = input.closest('.qty-form');
      const row = input.closest('.cart-row');
      let val = Math.max(parseInt(input.getAttribute('min')||'1',10), parseInt(input.value||'1',10) || 1);
      input.value = val;
      updateRowLineTotal(row);
      recalcCartTotals();
      clearTimeout(input._t);
      input._t = setTimeout(()=> persistQty(form, val), 300);
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    table.addEventListener('input', (e) => {
      const input = e.target.closest('.qty-input');
      if (!input) return;

      const form = input.closest('.qty-form');
      const row = input.closest('.cart-row');
      let val = Math.max(parseInt(input.getAttribute('min') || '1', 10), parseInt(input.value || '1', 10) || 1);

      input.value = val;
      updateRowLineTotal(row);
      recalcCartTotals();

      clearTimeout(input._t);
      input._t = setTimeout(() => persistQty(form, val), 300);
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    });

    recalcCartTotals();
  }
<<<<<<< HEAD
<<<<<<< HEAD

<<<<<<< HEAD
  function wireDiscountBox(){
    const input = document.getElementById('discount-code');
    const btn = document.getElementById('apply-discount');
    const msg = document.getElementById('discount-message');
    if(!input || !btn || !msg) return;

    const showMsg = (text, ok) => {
      msg.textContent = text;
      msg.classList.remove('ok','err');
=======
=======
=======
>>>>>>> 9e16f42 (Újabb push)
  function wireStoreQtyPickers() {
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('.qty-minus, .qty-plus');
      if (!btn) return;

      const picker = btn.closest('[data-qty-picker]');
      if (!picker) return;

      const input = picker.querySelector('.qty-input');
      if (!input) return;

      const min = parseInt(input.min || '1', 10);
      const max = parseInt(input.max || '9999', 10);
      let value = parseInt(input.value || '1', 10);

      if (Number.isNaN(value)) value = min;

      if (btn.classList.contains('qty-minus')) {
        value = Math.max(min, value - 1);
      }

      if (btn.classList.contains('qty-plus')) {
        value = Math.min(max, value + 1);
      }

      input.value = value;
      input.dispatchEvent(new Event('input', { bubbles: true }));
    });

    document.addEventListener('input', (e) => {
      const input = e.target.closest('.qty-input');
      if (!input) return;

      const min = parseInt(input.min || '1', 10);
      const max = parseInt(input.max || '9999', 10);
      let value = parseInt(input.value || '1', 10);

      if (Number.isNaN(value)) value = min;
      value = Math.max(min, Math.min(max, value));
      input.value = value;
    });
  }

<<<<<<< HEAD
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  function wireDiscountBox() {
    const input = document.getElementById('discount-code');
    const btn = document.getElementById('apply-discount');
    const msg = document.getElementById('discount-message');
    if (!input || !btn || !msg) return;

    const elSubtotal = document.getElementById('cart-subtotal');
    const elShipping = document.getElementById('cart-shipping');
    const elTotal = document.getElementById('cart-total');
    const dLine = document.getElementById('discount-line');
    const dEl = document.getElementById('cart-discount');

    const labelApply = btn.dataset.labelApply || 'Apply';
    const labelRemove = btn.dataset.labelRemove || 'Remove';

    const I18N = {
      enter: msg.dataset.msgEnter || 'Enter a code.',
      failed: msg.dataset.msgFailed || 'Failed.',
      network: msg.dataset.msgNetwork || 'Network error.',
    };

    const showMsg = (text, ok) => {
      msg.textContent = text;
      msg.classList.remove('ok', 'err');
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      msg.classList.add(ok ? 'ok' : 'err');
      msg.style.display = 'block';
    };

    const postJson = async (url, payload) => {
      const res = await fetch(url, {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'X-CSRF-TOKEN':CSRF,
          'Accept':'application/json',
          'X-Requested-With':'XMLHttpRequest'
        },
        body: JSON.stringify(payload || {}),
        credentials:'same-origin'
      });
      const data = await res.json().catch(()=>null);
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(payload || {}),
        credentials: 'same-origin'
      });

      const data = await res.json().catch(() => null);
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
      return { res, data };
    };

    const applyUrl = '/cart/discount/apply';
    const removeUrl = '/cart/discount/remove';

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    btn.addEventListener('click', async () => {
      const isRemove = (btn.textContent || '').toLowerCase().includes('remove');

      btn.disabled = true;

      try{
        if(isRemove){
          const { data } = await postJson(removeUrl, {});
          if(!data || !data.ok) return showMsg(data?.msg || 'Failed.', false);

          setDiscountPercent(0);
          input.value = '';
          btn.textContent = 'Apply';

          document.getElementById('cart-subtotal').textContent = fmt(parseFloat(data.subtotal));
          document.getElementById('cart-shipping').textContent = fmt(parseFloat(data.shipping));
          document.getElementById('cart-total').textContent = fmt(parseFloat(data.total));

          const dLine = document.getElementById('discount-line');
          if(dLine) dLine.style.display = 'none';
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    const safeSetMoney = (el, value) => {
      if (!el) return;
      const n = Number(value);
      if (Number.isFinite(n)) el.textContent = fmtFromHuf(n);
    };

    btn.addEventListener('click', async () => {
      const mode = btn.dataset.mode || 'apply';

      btn.disabled = true;

      try {
        if (mode === 'remove') {
          const { data } = await postJson(removeUrl, {});
          if (!data || !data.ok) {
            showMsg(data?.msg || 'Failed.', false);
            return;
          }

          setDiscountPercent(0);
          input.value = '';
          btn.dataset.mode = 'apply';
          btn.textContent = labelApply;

          safeSetMoney(elSubtotal, data.subtotal);
          safeSetMoney(elShipping, data.shipping);
          safeSetMoney(elTotal, data.total);

          if (dLine) dLine.style.display = 'none';
          if (dEl) dEl.textContent = fmtFromHuf(0);
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)

          showMsg(data.msg, true);
          recalcCartTotals();
          return;
        }

        const code = (input.value || '').trim();
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        if(!code) return showMsg('Enter a code.', false);

        const { data } = await postJson(applyUrl, { code });

        if(!data || !data.ok){
          return showMsg(data?.msg || 'Failed.', false);
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        if (!code) {
          showMsg(I18N.enter, false);
          return;
        }

        const { data } = await postJson(applyUrl, { code });

        if (!data || !data.ok) {
          showMsg(data?.msg || I18N.failed, false);
          return;
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        }

        const percent = parseFloat(data.percent || '0');
        setDiscountPercent(percent);

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        document.getElementById('cart-subtotal').textContent = fmt(parseFloat(data.subtotal));
        document.getElementById('cart-shipping').textContent = fmt(parseFloat(data.shipping));
        document.getElementById('cart-total').textContent = fmt(parseFloat(data.total));

        const dLine = document.getElementById('discount-line');
        const dEl = document.getElementById('cart-discount');
        if(dLine && dEl){
          dLine.style.display = 'flex';
          dEl.textContent = fmt(parseFloat(data.discount));
        }

        btn.textContent = 'Remove';
        showMsg(data.msg, true);
        recalcCartTotals();

      }catch(e){
        showMsg('Network error.', false);
      }finally{
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        safeSetMoney(elSubtotal, data.subtotal);
        safeSetMoney(elShipping, data.shipping);
        safeSetMoney(elTotal, data.total);

        if (dLine && dEl) {
          dLine.style.display = 'flex';
          safeSetMoney(dEl, data.discount);
        }

        btn.dataset.mode = 'remove';
        btn.textContent = labelRemove;

        showMsg(data.msg, true);
        recalcCartTotals();
      } catch (e) {
        console.error(e);
        showMsg(I18N.network, false);
      } finally {
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        btn.disabled = false;
      }
    });

    recalcCartTotals();
  }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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

  // =========================================================
  //  STARTUP
  // =========================================================
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
  document.addEventListener('DOMContentLoaded', () => {
    wireAjaxFiltering();
    refreshCartBadge();
    wireCartQty();
    wireDiscountBox();
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    wireHamburgerMenu();
  });
})();
=======
=======
    wireStoreQtyPickers();
>>>>>>> 5c55d34 (new features)
=======
    wireStoreQtyPickers();
>>>>>>> 9e16f42 (Újabb push)

    if (typeof wireHamburgerMenu === 'function') {
      wireHamburgerMenu();
    }
  });
})();
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
