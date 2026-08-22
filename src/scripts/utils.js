export function disableScroll() {
  if (document.getElementById('removed-body-scroll-bar-style')) return

  const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth

  const styles = `
  body {
    --removed-body-scroll-bar-size: ${scrollbarWidth}px;
    overflow: hidden !important;
    position: relative !important;
    padding-left: 0px;
    padding-top: 0px;
    padding-right: 0px;
    margin-left: 0;
    margin-top: 0;
    margin-right: ${scrollbarWidth}px !important;
  }
  `
  const styleSheet = document.createElement('style')
  styleSheet.innerHTML = styles
  styleSheet.id = 'removed-body-scroll-bar-style'
  document.head.appendChild(styleSheet)
}

export function enableScroll() {
  const styleSheet = document.getElementById('removed-body-scroll-bar-style')
  styleSheet?.parentNode?.removeChild(styleSheet)
}

export const chunkArray = (array, chunkSize) => {
  const numberOfChunks = Math.ceil(array.length / chunkSize)

  return [...Array(numberOfChunks)].map((value, index) => {
    return array.slice(index * chunkSize, (index + 1) * chunkSize)
  })
}

export function truncateString(str, maxLength = 10, separator = '...') {
  const sepLength = separator.length

  if (str.length <= maxLength) return str

  const availableLength = maxLength - sepLength

  const headLength = Math.ceil(availableLength / 2)
  const tailLength = Math.floor(availableLength / 2)

  return str.slice(0, headLength) + separator + str.slice(-tailLength)
}
