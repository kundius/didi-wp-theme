<?php
/*
Template Name: Услуга
*/

$svc_extended = get_extended(get_post_field('post_content', get_the_ID()));
$svc_main_content = trim($svc_extended['main']);
$svc_extended_content = trim($svc_extended['extended']);
$svc_parent_id = wp_get_post_parent_id(get_the_ID());
$svc_current_position = $svc_parent_id ? 3 : 2;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">

<head>
  <?php get_template_part('partials/head'); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="page-main">
    <?php get_template_part('partials/header'); ?>

    <div class="page-header">
      <ol class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList" aria-label="Хлебные крошки">
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
          <a class="breadcrumbs__link" itemprop="item" href="/">
            <span itemprop="name">Главная</span>
          </a>
          <meta itemprop="position" content="1">
        </li>
        <?php if ($svc_parent_id): ?>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
          <a class="breadcrumbs__link" itemprop="item" href="<?php echo esc_url(
            get_permalink($svc_parent_id),
          ); ?>">
            <span itemprop="name"><?php echo esc_html(get_the_title($svc_parent_id)); ?></span>
          </a>
          <meta itemprop="position" content="2">
        </li>
        <?php endif; ?>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
          <span class="breadcrumbs__text" itemprop="item" aria-current="page">
            <span itemprop="name"><?php the_title(); ?></span>
          </span>
          <meta itemprop="position" content="<?php echo esc_attr($svc_current_position); ?>">
        </li>
      </ol>

      <h1 class="page-title"><?php the_title(); ?></h1>
    </div>

    <?php if ($svc_main_content): ?>
    <div class="page-content page-content--before">
      <div class="container">
        <div class="page-content__inner content">
          <?php echo apply_filters('the_content', $svc_main_content); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php $crb_consult_title = carbon_get_theme_option('crb_consult_title'); ?>
    <?php $crb_consult_items = carbon_get_theme_option('crb_consult_items'); ?>
    <?php $crb_consult_note = carbon_get_theme_option('crb_consult_note'); ?>
    <?php $crb_consult_form_title = carbon_get_theme_option('crb_consult_form_title'); ?>
    <?php $crb_consult_btn_text = carbon_get_theme_option('crb_consult_btn_text'); ?>
    <?php if ($crb_consult_title || !empty($crb_consult_items) || $crb_consult_note || $crb_consult_form_title): ?>
    <section class="consult">
      <div class="container">
        <div class="consult__inner">
          <div class="consult__left">
            <?php if ($crb_consult_title): ?>
              <h2 class="consult__title"><?php echo esc_html($crb_consult_title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($crb_consult_items)): ?>
              <ul class="consult__list">
                <?php foreach ($crb_consult_items as $crb_consult_item): ?>
                  <?php if (empty($crb_consult_item['text'])) { continue; } ?>
                  <li class="consult__item">
                    <span class="consult__icon" aria-hidden="true">
                      <svg viewBox="0 0 32 32"><path d="M14 9l7 7-7 7"/></svg>
                    </span>
                    <span class="consult__item-text"><?php echo esc_html(
                      $crb_consult_item['text'],
                    ); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <?php if ($crb_consult_note): ?>
              <div class="consult__divider"></div>
              <p class="consult__note"><?php echo esc_html($crb_consult_note); ?></p>
            <?php endif; ?>
          </div>

          <div class="consult__right">
            <form class="consult-form"
              action="<?php echo admin_url('admin-ajax.php'); ?>"
              data-feedback-form
              data-feedback-form-goal="CALLBACK_CONSULT"
              data-feedback-form-action="feedback_form">
              <input type="hidden" name="submitted" value="">
              <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(
                'feedback-nonce',
              ); ?>">
              <input type="hidden" name="page" value="<?php echo esc_html(get_self_link()); ?>">
              <input type="hidden" name="subject" value="Получить консультацию: <?php echo esc_html(
                get_the_title(),
              ); ?>">

              <?php if ($crb_consult_form_title): ?>
                <div class="consult-form__title"><?php echo esc_html(
                  $crb_consult_form_title,
                ); ?></div>
              <?php endif; ?>

              <input class="consult-form__input" type="tel" name="phone"
                data-maska="+ 7 (###) - ### - ## - ##"
                placeholder="+7 (___) ___-__-__" required>

              <div class="consult-form__errors" data-feedback-form-errors></div>

              <button type="submit" class="consult-form__submit">
                <?php echo esc_html($crb_consult_btn_text); ?>
              </button>

              <label class="consult-form__consent">
                <input type="checkbox" value="1" name="consent" required>
                <span class="consult-form__check">
                  <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </span>
                <span>Соглашаюсь с политикой обработки персональных данных</span>
              </label>

              <div class="consult-form__success">
                <div class="consult-form__success-title">Заявка отправлена</div>
                <div class="consult-form__success-desc">Мы свяжемся с вами в ближайшее время</div>
                <button type="button" class="consult-form__success-close" data-feedback-form-reset>
                  Закрыть
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($svc_extended_content): ?>
    <div class="page-content">
      <div class="container">
        <div class="page-content__inner content">
          <?php echo apply_filters('the_content', $svc_extended_content); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php get_template_part('partials/feedback'); ?>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
