function loadPageContent(postId, panel, cache) {
  const content = panel.querySelector('.landing-services__content')
  if (cache.has(postId)) {
    content.innerHTML = cache.get(postId)
    return
  }
  if (panel.dataset.loading) return
  panel.dataset.loading = '1'
  content.textContent = 'Загрузка…'

  const formData = new FormData()
  formData.append('action', 'get_page_content')
  formData.append('post_id', postId)

  fetch(window.theme_ajax.url, {
    method: 'post',
    body: formData
  })
    .then((response) => response.json())
    .then((result) => {
      if (result.success && result.data && result.data.content) {
        content.innerHTML = result.data.content
        cache.set(postId, result.data.content)
      } else {
        content.innerHTML = ''
      }
    })
    .catch((error) => console.error(error))
    .finally(() => {
      delete panel.dataset.loading
    })
}

export function initServicesTabs() {
  const items = document.querySelectorAll('[data-services-tabs]') || []
  const cache = new Map()

  Array.from(items).forEach((tabs) => {
    const radios = tabs.querySelectorAll('.landing-services__radio') || []

    Array.from(radios).forEach((radio) => {
      radio.addEventListener('change', () => {
        if (!radio.checked || !radio.dataset.svcPageId) return

        const panel = tabs.querySelector(
          '.landing-services__panel[data-svc-page-id="' + radio.dataset.svcPageId + '"]'
        )
        if (!panel) return

        loadPageContent(radio.dataset.svcPageId, panel, cache)
      })
    })

    const checked = tabs.querySelector('.landing-services__radio:checked[data-svc-page-id]')
    if (checked) {
      checked.dispatchEvent(new Event('change'))
    }
  })
}