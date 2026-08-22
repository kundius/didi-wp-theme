import EmblaCarousel from 'embla-carousel'
import { addPrevNextBtnsClickHandlers } from './EmblaCarouselArrowButtons'

export function initSlideshow() {
  const nodes = document.querySelectorAll('[data-slideshow]') || []

  Array.from(nodes).forEach((node) => {
    const container = node.querySelector('.slideshow__container')
    const prevBtn = node.querySelector('[data-slideshow-prev]')
    const nextBtn = node.querySelector('[data-slideshow-next]')

    if (!container) return

    const emblaApi = EmblaCarousel(container, { loop: false })

    if (prevBtn && nextBtn) {
      addPrevNextBtnsClickHandlers(emblaApi, prevBtn, nextBtn)
    }
  })
}
