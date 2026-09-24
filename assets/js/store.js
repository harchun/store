(() => {
  'use strict';

  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

  const toggle = $('[data-menu-toggle]');
  const nav = $('[data-mobile-nav]');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    $$('a', nav).forEach((link) => link.addEventListener('click', () => {
      nav.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    }));
  }

  const searchForm = $('[data-store-search]');
  const searchInput = $('[data-store-search-input]');
  const searchResults = $('[data-store-search-results]');
  let timer = null;

  if (searchForm && searchInput && searchResults && window.storeTheme) {
    searchForm.addEventListener('submit', (event) => event.preventDefault());
    searchInput.addEventListener('input', () => {
      const term = searchInput.value.trim();
      clearTimeout(timer);
      if (term.length < 2) {
        searchResults.innerHTML = '';
        searchResults.hidden = true;
        return;
      }
      timer = setTimeout(async () => {
        try {
          const body = new URLSearchParams({ action:'store_search', term, nonce:storeTheme.searchNonce });
          const response = await fetch(storeTheme.ajaxUrl, { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}, body });
          const json = await response.json();
          if (!json.success) throw new Error('Search failed');
          searchResults.innerHTML = json.data.map((item) => `
            <a class="store-search-result" href="${escapeHtml(item.url)}">
              ${item.image ? `<img src="${escapeHtml(item.image)}" alt="" loading="lazy">` : ''}
              <span>${escapeHtml(item.title)}</span>
            </a>`).join('');
          searchResults.hidden = json.data.length === 0;
        } catch (error) {
          searchResults.innerHTML = '';
          searchResults.hidden = true;
        }
      }, 250);
    });
  }

  function escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value || '';
    return div.innerHTML;
  }
})();
