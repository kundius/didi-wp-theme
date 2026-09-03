<footer class="footer">
  <div class="container">
    <?php $footer_site_name = carbon_get_theme_option('crb_theme_site_name'); ?>
    <h2 class="footer__title"><?php echo esc_html(
      $footer_site_name ?: get_bloginfo('name'),
    ); ?></h2>

    <div class="footer__contacts">
      <?php $footer_phone = carbon_get_theme_option('crb_theme_phone_number'); ?>
      <?php if ($footer_phone): ?>
        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $footer_phone); ?>">
          <?php echo esc_html($footer_phone); ?>
        </a>
      <?php endif; ?>

      <?php $footer_email = carbon_get_theme_option('crb_theme_email'); ?>
      <?php if ($footer_email): ?>
        <a href="mailto:<?php echo esc_attr($footer_email); ?>">
          Email: <?php echo esc_html($footer_email); ?>
        </a>
      <?php endif; ?>
    </div>

    <?php $footer_address = carbon_get_theme_option('crb_theme_address'); ?>
    <?php if ($footer_address): ?>
      <div class="footer__address"><?php echo nl2br(esc_html($footer_address)); ?></div>
    <?php endif; ?>

  </div>
</footer>

<div class="bottom-footer">
  <div class="bottom-footer__container">
    <div class="bottom-footer__copyright">
      <?php $bottom_copyright = carbon_get_theme_option('crb_theme_copyright'); ?>
      <?php echo esc_html(
        $bottom_copyright ?: '© ' . get_bloginfo('name') . ' ' . date('Y'),
      ); ?>
    </div>

    <div class="bottom-footer__links">
      <?php wp_nav_menu([
        'theme_location' => 'menu-footer',
        'container' => null,
        'menu_class' => 'bottom-footer__nav',
        'depth' => 1,
      ]); ?>

      <?php $footer_counters = carbon_get_theme_option('crb_theme_counters'); ?>
      <?php if ($footer_counters): ?>
        <div class="footer__counters"><?php echo $footer_counters; ?></div>
      <?php endif; ?>
    </div>

    <a href="https://domenart-studio.ru/" class="footer__creator" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url(get_theme_file_uri('assets/creator.png')); ?>"
        alt="creator" width="138" height="30">
    </a>
  </div>
</div>

<div id="modal-callback" aria-hidden="true" class="modal">
  <div class="modal__overlay" tabindex="-1" data-modal-close>
    <div class="modal__container modal__container--default" role="dialog" aria-modal="true">

      <div class="modal__dialog">
        <button class="modal__close" aria-label="Закрыть" data-modal-close></button>

        <div class="modal__title">Оставить заявку</div>

        <div class="modal__desc">Заполните форму, мы свяжемся с вами буквально через пару минут.</div>

        <form
          action="<?php echo admin_url('admin-ajax.php'); ?>"
          class="modal-form"
          data-feedback-form
          data-feedback-form-goal="CALLBACK"
          data-feedback-form-action="feedback_form">
          <input type="hidden" name="submitted" value="">
          <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(
            'feedback-nonce',
          ); ?>">
          <input type="hidden" name="page" value="<?php echo esc_html(get_self_link()); ?>">
          <input type="hidden" name="subject" value="Оставить заявку">

          <div class="modal-form__field">
            <label class="input-field">
              <span class="input-field__label">Ваш номер телефона<span>*</span></span>
              <input class="input-field__input" type="text" name="phone" value="" data-maska="+ 7 (###) - ### - ## - ##" placeholder="+ 7 (___)  - ___ - __ - __" required>
            </label>
          </div>

          <div class="modal-form__errors" data-feedback-form-errors></div>

          <div class="modal-form__submit">
            <button type="submit" class="modal-form__submit-button">
              Жду звонка
            </button>
          </div>

          <div class="modal-form__rules">
            Заполняя поля формы, Вы даете согласие на обработку персональных данных
          </div>

          <div class="modal-form-success">
            <div class="modal-form-success__title">
              Сообщение успешно отправлено
            </div>
            <div class="modal-form-success__desc">
              Мы свяжемся с вами в ближайшее время
            </div>
            <button type="button" class="modal-form-success__close" data-feedback-form-reset>Закрыть</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>

<?php wp_footer(); ?>
