<div class="header-anchor" data-sticky-header-anchor></div>

<div class="header" data-sticky-header data-mobile-menu="closed">
  <div class="header__container">
    <div class="header-layout">
      <a href="/" class="header-logo">
        <span class="header-logo__name">Лизинг ДиДи</span>
        <span class="header-logo__tagline">Лизинговое агентство</span>
      </a>

      <button type="button" class="header-toggle" data-mobile-menu-toggle aria-label="Меню">
        <span class="icon icon-menu"></span>
        <span class="icon icon-close"></span>
      </button>

      <div class="header-overlay">
        <?php wp_nav_menu([
          'theme_location' => 'menu-main',
          'container' => null,
          'menu_class' => 'header-nav',
        ]); ?>
      </div>

      <div class="header-contacts">
        <?php $phone = carbon_get_theme_option('crb_theme_phone_number'); ?>
        <?php if ($phone): ?>
        <a class="header-phone" href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>">
          <span class="header-phone__icon icon icon-phone"></span>
          <span class="header-phone__number"><?php echo $phone; ?></span>
        </a>
        <?php endif; ?>

        <button type="button" class="header-request" data-callback-button>Оставить заявку</button>

        <?php $max_link = carbon_get_theme_option('crb_theme_max_link'); ?>
        <?php if ($max_link): ?>
        <a class="header-max" href="<?php echo esc_url($max_link); ?>">
          <span class="header-max__icon icon icon-max"></span>
          <span class="header-max__text">MAX</span>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
