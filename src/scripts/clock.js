export function initClock() {
  const el = document.querySelector('[data-clock]')
  if (!el) return

  const timeEl = el.querySelector('[data-clock-time]')
  const dateEl = el.querySelector('[data-clock-date]')

  const update = () => {
    const now = new Date()
    timeEl.textContent = now.toLocaleTimeString('ru-RU', {
      hour: '2-digit',
      minute: '2-digit',
    })
    dateEl.textContent = now.toLocaleDateString('ru-RU', {
      day: '2-digit',
      month: '2-digit',
    })
  }

  update()
  setInterval(update, 15000)
}
