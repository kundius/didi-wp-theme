export function applyFeedbackForm(form) {
  const submit = form.querySelector('[type="submit"]')
  const errors = form.querySelector('[data-feedback-form-errors]')
  const reset = form.querySelector('[data-feedback-form-reset]')

  form.addEventListener('submit', (e) => {
    e.preventDefault()

    errors.innerHTML = ''
    form.setAttribute('data-feedback-form-status', 'loading')
    submit.setAttribute('disabled', '')

    const formData = new FormData(e.target)
    formData.append('action', form.dataset.feedbackFormAction)

    fetch(e.target.action, {
      method: 'post',
      body: formData
    })
      .then((response) => response.json())
      .then((result) => {
        if (!result.success) {
          errors.innerHTML = Object.values(result.data).join('<br>')
          form.setAttribute('data-feedback-form-status', 'failure')
        } else {
          form.setAttribute('data-feedback-form-status', 'success')
          form.reset()

          if (typeof ym !== 'undefined') {
            const elYmId = document.querySelector('[data-ym-id]')
            if (elYmId && elYmId.dataset.ymId) {
              ym(elYmId.dataset.ymId, 'reachGoal', 'FORM_SENDED')
              console.log('goal', elYmId.dataset.ymId, 'FORM_SENDED')
              if (form.dataset.feedbackFormGoal) {
                ym(elYmId.dataset.ymId, 'reachGoal', form.dataset.feedbackFormGoal)
                console.log('goal', elYmId.dataset.ymId, form.dataset.feedbackFormGoal)
              }
            }
          }

          setTimeout(() => {
            form.removeAttribute('data-feedback-form-status')
          }, 4000)
        }

        submit.removeAttribute('disabled', '')
      })
      .catch((error) => console.error(error))
  })

  reset.addEventListener('click', () => {
    form.removeAttribute('data-feedback-form-status')
  })
}

export function initFeedbackForm() {
  const items = document.querySelectorAll('[data-feedback-form]') || []

  Array.from(items).forEach(applyFeedbackForm)
}
