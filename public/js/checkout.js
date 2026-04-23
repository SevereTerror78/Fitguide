(function () {
  const page = document.getElementById('checkoutPage');
  if (!page) return;

  const quoteUrl = page.dataset.quoteUrl || '';
  const currency = page.dataset.currency || 'HUF';

  const radios = Array.from(document.querySelectorAll('input[name="payment_method"]'));
  const shippingFields = Array.from(document.querySelectorAll('[data-shipping-field]'));
  const requiredInputs = Array.from(document.querySelectorAll('[data-shipping-required]'));
  const stars = Array.from(document.querySelectorAll('[data-reqstar]'));
  const btn = document.getElementById('checkoutSubmitBtn');
  const pickupBox = document.getElementById('pickupBox');
  const pickupSelect = document.getElementById('pickup_location');
  const countrySelect = document.getElementById('country');

  const sumSubtotal = document.getElementById('sumSubtotal');
  const sumShipping = document.getElementById('sumShipping');
  const sumTotal = document.getElementById('sumTotal');

  function getSelectedMethod() {
    const checked = document.querySelector('input[name="payment_method"]:checked');
    return checked ? checked.value : 'card';
  }

  function formatMoneyFromHuf(n) {
    const num = Number(n || 0);

    if (currency === 'EUR') {
      return '€' + (num / 381).toFixed(2);
    }

    return num.toLocaleString('hu-HU', {
      minimumFractionDigits: 0,
      maximumFractionDigits: 0,
    }) + ' Ft';
  }

  function applyMode(mode) {
    const isPickup = mode === 'pickup';

    shippingFields.forEach(el => el.style.display = isPickup ? 'none' : '');

    requiredInputs.forEach(inp => {
      inp.required = !isPickup;
      if (isPickup) inp.value = '';
    });

    stars.forEach(s => s.style.display = isPickup ? 'none' : 'inline');

    if (pickupBox) pickupBox.style.display = isPickup ? 'block' : 'none';

    if (pickupSelect) {
      pickupSelect.required = isPickup;
      if (!isPickup) pickupSelect.value = '';
    }

    if (btn) {
      const labels = {
        card: btn.dataset.labelCard,
        cod: btn.dataset.labelCod,
        pickup: btn.dataset.labelPickup,
      };
      btn.textContent = labels[mode] || labels.card || btn.textContent;
    }
  }

  let quoteAbort = null;

  async function fetchQuoteAndUpdate() {
    if (!quoteUrl) return;

    const method = getSelectedMethod();
    const country = countrySelect ? (countrySelect.value || 'HU') : 'HU';

    if (quoteAbort) quoteAbort.abort();
    quoteAbort = new AbortController();

    const url = new URL(quoteUrl, window.location.origin);
    url.searchParams.set('country', country);
    url.searchParams.set('method', method);

    try {
      const res = await fetch(url.toString(), {
        method: 'GET',
        headers: { 'Accept': 'application/json' },
        credentials: 'same-origin',
        signal: quoteAbort.signal,
      });

      if (!res.ok) return;

      const data = await res.json();

      if (sumSubtotal) sumSubtotal.textContent = formatMoneyFromHuf(data.subtotal);
      if (sumShipping) sumShipping.textContent = formatMoneyFromHuf(data.shipping);
      if (sumTotal) sumTotal.textContent = formatMoneyFromHuf(data.total);
    } catch (e) {
      // abort normális gyors váltásnál
    }
  }

  applyMode(getSelectedMethod());

  radios.forEach(r => r.addEventListener('change', e => {
    applyMode(e.target.value);
    fetchQuoteAndUpdate();
  }));

  if (countrySelect) {
    countrySelect.addEventListener('change', () => {
      fetchQuoteAndUpdate();
    });

    let buffer = '';
    let lastTypeTime = 0;
    const timeout = 700;

    countrySelect.addEventListener('keydown', (e) => {
      const now = Date.now();
      if (now - lastTypeTime > timeout) buffer = '';

      if (e.key.length === 1 && /[a-zA-Z]/.test(e.key)) {
        buffer += e.key.toLowerCase();
        lastTypeTime = now;

        const opts = Array.from(countrySelect.options);
        let match = opts.find(o => o.text.toLowerCase().trim().startsWith(buffer));
        if (!match) match = opts.find(o => o.text.toLowerCase().includes(buffer));

        if (match) {
          countrySelect.value = match.value;
          fetchQuoteAndUpdate();
        }
      }
    });
  }
})();