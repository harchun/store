(() => {
  const toggle = document.querySelector('[data-menu-toggle]');
  const nav = document.querySelector('[data-mobile-nav]');
  if (toggle && nav) toggle.addEventListener('click', () => nav.classList.toggle('is-open'));
})();
