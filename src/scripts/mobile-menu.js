export function applyMobileMenu(wrap) {
  const toggle = wrap.querySelector('[data-mobile-menu-toggle]')
  if (toggle) {
    toggle.addEventListener('click', (e) => {
      wrap.setAttribute(
        'data-mobile-menu',
        wrap.dataset.mobileMenu === 'opened' ? 'closed' : 'opened'
      )
    })
  }
}

export function initMobileMenu() {
  const items = document.querySelectorAll('[data-mobile-menu]') || []

  Array.from(items).forEach(applyMobileMenu)
}
