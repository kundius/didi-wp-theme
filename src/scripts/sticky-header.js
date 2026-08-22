export function initStickyHeader() {
  const header = document.querySelector('[data-sticky-header]')
  const headerAnchor = document.querySelector('[data-sticky-header-anchor]')

  if (!header || !headerAnchor) return

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          header.dataset.stickyHeader = ''
        } else {
          header.dataset.stickyHeader = 'active'
        }
      })
    },
    {
      root: null,
      threshold: 0.5
    }
  )

  observer.observe(headerAnchor)
}
