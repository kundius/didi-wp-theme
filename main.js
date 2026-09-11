import 'normalize.css'
import './src/styles/main.css'
import './src/styles/btn.css'
import './src/styles/icons.css'
import './src/styles/modal.css'
import './src/styles/header.css'
import './src/styles/intro.css'
import './src/styles/services.css'
import './src/styles/landing-services.css'
import './src/styles/why.css'
import './src/styles/process.css'
import './src/styles/values.css'
import './src/styles/faq.css'
import './src/styles/approval.css'
import './src/styles/slideshow.css'
import './src/styles/footer.css'
import './src/styles/breadcrumbs.css'
import './src/styles/contacts.css'

import fslightbox from 'fslightbox'
import { Mask, MaskInput } from 'maska'

import { initStickyHeader } from './src/scripts/sticky-header'
import { initMobileMenu } from './src/scripts/mobile-menu'
import { initCallbackButton } from './src/scripts/callback-button'
import { initFeedbackForm } from './src/scripts/feedback-form'
import { initServicesTabs } from './src/scripts/services-tabs'
import { initSlideshow } from './src/scripts/slideshow'
new MaskInput('[data-maska]')

initStickyHeader()
initMobileMenu()
initCallbackButton()
initFeedbackForm()
initServicesTabs()
initSlideshow()
