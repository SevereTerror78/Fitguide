(function () {
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
  if (window.__FG_STORE_JS_LOADED) return;
  window.__FG_STORE_JS_LOADED = true;

  const CART_COUNT_URL = (window.FG && window.FG.cartCountUrl) || null;
  const STORE_URL = window.STORE_URL || '/store';
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const currency = document.body?.dataset?.currency || 'HUF';

>>>>>>> fc7673c (frontend update and some new feature)
  const cartLink = document.querySelector('.nav-cart');

  function getBadgeEl() {
    return cartLink ? cartLink.querySelector('.cart-badge') : null;
  }
<<<<<<< HEAD
  function getBadgeCount() {
    const b = getBadgeEl();
    const n = b ? parseInt(b.textContent, 10) : 0;
    return Number.isFinite(n) ? n : 0;
  }
=======

>>>>>>> fc7673c (frontend update and some new feature)
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
=======

>>>>>>> fc7673c (frontend update and some new feature)
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
>>>>>>> fc7673c (frontend update and some new feature)
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
    // build url úgy, hogy a jelenlegi URL paramjai alapból megmaradjanak
    // és csak amit felülírsz, azt írja át
=======
>>>>>>> fc7673c (frontend update and some new feature)
    function buildUrl(base, params) {
      const current = new URL(window.location.href);
      const url = new URL(base, window.location.origin);

<<<<<<< HEAD
      // kiindulás: a current search paramjai
=======
>>>>>>> fc7673c (frontend update and some new feature)
      current.searchParams.forEach((val, key) => {
        url.searchParams.set(key, val);
      });

<<<<<<< HEAD
      // felülírás: a params
=======
>>>>>>> fc7673c (frontend update and some new feature)
      Object.entries(params).forEach(([k, v]) => {
        if (v == null || v === '' || v === 'all') url.searchParams.delete(k);
        else url.searchParams.set(k, v);
      });

      return url.toString();
    }

    async function loadProducts(url) {
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

        wirePagination();
        list.classList.remove('loading');
        window.scrollTo({ top: list.offsetTop - 40, behavior: 'smooth' });
      } catch (e) {
        console.error(e);
        list.classList.remove('loading');
        window.location.href = url;
      }
    }

<<<<<<< HEAD
    // -------- FILTER BUTTONS (megőrzi a search-t)
=======
>>>>>>> fc7673c (frontend update and some new feature)
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
            page: '' // reset page filter váltáskor
=======
            page: ''
>>>>>>> fc7673c (frontend update and some new feature)
          });

          loadProducts(url);
        });
      });
    }

<<<<<<< HEAD
    // -------- SELECT (megőrzi a search-t)
=======
>>>>>>> fc7673c (frontend update and some new feature)
    function wireSelect() {
      if (!filterSelect) return;
      filterSelect.addEventListener('change', () => {
        const type = filterSelect.value;
        setActiveBySlug(type);

        const url = buildUrl(STORE_URL, {
          type,
          search: getSearchValue(),
<<<<<<< HEAD
          page: '' // reset page
=======
          page: ''
>>>>>>> fc7673c (frontend update and some new feature)
        });

        loadProducts(url);
      });
    }

<<<<<<< HEAD
    // -------- PAGINATION (ha valamiért nincs benne search/type, hozzáadjuk)
=======
>>>>>>> fc7673c (frontend update and some new feature)
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

          const page = u.searchParams.get('page');

          const url = buildUrl(STORE_URL, {
            page, // ✅ EZ A KULCS
=======
          const page = u.searchParams.get('page');

          const url = buildUrl(STORE_URL, {
            page,
>>>>>>> fc7673c (frontend update and some new feature)
            type: (new URL(window.location.href)).searchParams.get('type') || (filterSelect?.value || 'all'),
            search: getSearchValue()
          });

<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
          loadProducts(url);
        });
      });
    }

<<<<<<< HEAD
    // -------- SEARCH (debounce + clear + enter + esc)
    function wireSearch() {
      if (!searchInput) return;

      // init: ha URL-ben van search, töltsük vissza
=======
    function wireSearch() {
      if (!searchInput) return;

>>>>>>> fc7673c (frontend update and some new feature)
      const fromUrl = (new URL(window.location.href)).searchParams.get('search') || '';
      if (fromUrl && !searchInput.value) searchInput.value = fromUrl;
      toggleClear();

      const doSearch = () => {
        const type = (new URL(window.location.href)).searchParams.get('type') || (filterSelect?.value || 'all');
        const url = buildUrl(STORE_URL, {
          type,
          search: getSearchValue(),
<<<<<<< HEAD
          page: '' // kereséskor reset
=======
          page: ''
>>>>>>> fc7673c (frontend update and some new feature)
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
    // init active type from URL
=======
>>>>>>> fc7673c (frontend update and some new feature)
    const currentType = new URL(window.location.href).searchParams.get('type') || 'all';
    setActiveBySlug(currentType);

    wireFilterButtons();
    wireSelect();
    wirePagination();
    wireSearch();

<<<<<<< HEAD
    // back/forward: UI sync
=======
>>>>>>> fc7673c (frontend update and some new feature)
    window.addEventListener('popstate', () => {
      const u = new URL(window.location.href);
      const type = u.searchParams.get('type') || 'all';
      const s = u.searchParams.get('search') || '';

      setActiveBySlug(type);
      setSearchValue(s);
<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
      loadProducts(u.toString());
    }, { once: false });
  }

<<<<<<< HEAD
  // =========================================================
  //  ADD TO CART (AJAX)
  // =========================================================
=======
>>>>>>> fc7673c (frontend update and some new feature)
  let BADGE_VERSION = 0;

  document.addEventListener('submit', async (e) => {
    const form = e.target;
    if (!form.matches('.add-to-cart-form')) return;
    if (!window.fetch) return;

    e.preventDefault();

<<<<<<< HEAD
=======
    if (form.dataset.submitting === '1') return;
    form.dataset.submitting = '1';

>>>>>>> fc7673c (frontend update and some new feature)
    const qtyInput = form.querySelector('input[name="qty"]');
    const qty = qtyInput ? Math.max(1, parseInt(qtyInput.value || '1', 10)) : 1;

    const btn = form.querySelector('.add-btn') || form.querySelector('.btn.pill');
    if (btn) { btn.classList.add('adding'); btn.disabled = true; }

<<<<<<< HEAD
    const before = (function(){
      const b = document.querySelector('.nav-cart .cart-badge');
      return b ? parseInt(b.textContent || '0', 10) || 0 : 0;
    })();
=======
    const before = (() => {
      const b = document.querySelector('.nav-cart .cart-badge');
      return b ? (parseInt(b.textContent || '0', 10) || 0) : 0;
    })();

>>>>>>> fc7673c (frontend update and some new feature)
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
      let data = null;
      try { data = await res.json(); } catch (_) {}
=======
      const data = await res.json().catch(() => null);
>>>>>>> fc7673c (frontend update and some new feature)

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
=======
      delete form.dataset.submitting;

>>>>>>> fc7673c (frontend update and some new feature)
      setTimeout(() => {
        if (btn) { btn.classList.remove('adding'); btn.disabled = false; }
      }, 180);
    }
  });

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
>>>>>>> fc7673c (frontend update and some new feature)
    const p = parseFloat(card.dataset.discountPercent || '0');
    return Number.isFinite(p) ? Math.max(0, Math.min(100, p)) : 0;
  }

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
>>>>>>> fc7673c (frontend update and some new feature)
      const qty = parseInt(row.querySelector('.qty-input')?.value || '1', 10);
      subtotal += unitPrice * qty;
    });

    const shipEl = document.getElementById('cart-shipping');
<<<<<<< HEAD
    const shipping = shipEl ? parseFloat((shipEl.textContent || '').replace(/[^\d.]/g,'') || '0') : 0;

    const percent = getDiscountPercent();
    const discount = percent > 0 ? (subtotal * (percent / 100)) : 0;

=======
    const shipping = shipEl?.dataset.shippingHuf ? parseFloat(shipEl.dataset.shippingHuf) : 0;

    const percent = getDiscountPercent();
    const discount = percent > 0 ? (subtotal * (percent / 100)) : 0;
>>>>>>> fc7673c (frontend update and some new feature)
    const total = Math.max(0, subtotal + shipping - discount);

    const subEl = document.getElementById('cart-subtotal');
    const totEl = document.getElementById('cart-total');
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
>>>>>>> fc7673c (frontend update and some new feature)
      }
    }
  }

<<<<<<< HEAD
  async function persistQty(form, qty){
    const url = form?.dataset?.updateUrl;
    if(!url) return;

    try{
=======
  async function persistQty(form, qty) {
    const url = form?.dataset?.updateUrl;
    if (!url) return;

    try {
>>>>>>> fc7673c (frontend update and some new feature)
      const fd = new FormData();
      fd.append('qty', qty);

      const res = await fetch(url, {
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
>>>>>>> fc7673c (frontend update and some new feature)
          }
        }
      }

<<<<<<< HEAD
      if(typeof data.total === 'string'){
        const totEl = document.getElementById('cart-total');
        if(totEl) totEl.textContent = fmt(parseFloat(data.total));
      }

    }catch(e){
=======
      if (typeof data.total !== 'undefined') {
        const totEl = document.getElementById('cart-total');
        if (totEl) totEl.textContent = fmtFromHuf(data.total);
      }
    } catch (e) {
>>>>>>> fc7673c (frontend update and some new feature)
      console.warn('cart.update error, keeping optimistic totals', e);
    }
  }

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

>>>>>>> fc7673c (frontend update and some new feature)
      input.value = val;
      updateRowLineTotal(row);
      recalcCartTotals();
      persistQty(form, val);
    });

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
>>>>>>> fc7673c (frontend update and some new feature)
    });

    recalcCartTotals();
  }

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
>>>>>>> fc7673c (frontend update and some new feature)
      msg.classList.add(ok ? 'ok' : 'err');
      msg.style.display = 'block';
    };

    const postJson = async (url, payload) => {
      const res = await fetch(url, {
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
>>>>>>> fc7673c (frontend update and some new feature)
      return { res, data };
    };

    const applyUrl = '/cart/discount/apply';
    const removeUrl = '/cart/discount/remove';

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
>>>>>>> fc7673c (frontend update and some new feature)

          showMsg(data.msg, true);
          recalcCartTotals();
          return;
        }

        const code = (input.value || '').trim();
<<<<<<< HEAD
        if(!code) return showMsg('Enter a code.', false);

        const { data } = await postJson(applyUrl, { code });

        if(!data || !data.ok){
          return showMsg(data?.msg || 'Failed.', false);
=======
        if (!code) {
          showMsg(I18N.enter, false);
          return;
        }

        const { data } = await postJson(applyUrl, { code });

        if (!data || !data.ok) {
          showMsg(data?.msg || I18N.failed, false);
          return;
>>>>>>> fc7673c (frontend update and some new feature)
        }

        const percent = parseFloat(data.percent || '0');
        setDiscountPercent(percent);

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
>>>>>>> fc7673c (frontend update and some new feature)
        btn.disabled = false;
      }
    });

    recalcCartTotals();
  }

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
  document.addEventListener('DOMContentLoaded', () => {
    wireAjaxFiltering();
    refreshCartBadge();
    wireCartQty();
    wireDiscountBox();
<<<<<<< HEAD
    wireHamburgerMenu();
  });
})();
=======

    if (typeof wireHamburgerMenu === 'function') {
      wireHamburgerMenu();
    }
  });
})();
>>>>>>> fc7673c (frontend update and some new feature)
