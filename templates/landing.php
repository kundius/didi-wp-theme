<?php
/*
Template Name: Лендинг
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">

<head>
  <?php get_template_part('partials/head'); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="page-layout">
    <?php get_template_part('partials/header'); ?>

    <section class="intro">
      <?php if ($video_id = carbon_get_post_meta(get_the_ID(), 'intro_bg_video')): ?>
        <?php $poster_id = carbon_get_post_meta(get_the_ID(), 'intro_bg_image'); ?>
        <div class="intro__bg">
          <video class="intro__bg-video" autoplay muted loop playsinline poster="<?php echo $poster_id
            ? wp_get_attachment_image_url($poster_id, 'full')
            : ''; ?>">
            <source src="<?php echo wp_get_attachment_url($video_id); ?>" type="video/mp4">
          </video>
        </div>
      <?php elseif ($image_id = carbon_get_post_meta(get_the_ID(), 'intro_bg_image')): ?>
        <div class="intro__bg">
          <img class="intro__bg-image" src="<?php echo wp_get_attachment_image_url(
            $image_id,
            'full',
          ); ?>" alt="" />
        </div>
      <?php endif; ?>

      <div class="intro__container">
        <div class="intro__content">
          <?php if ($desc = carbon_get_post_meta(get_the_ID(), 'intro_desc')): ?>
            <p class="intro__eyebrow"><?php echo nl2br(wp_kses_post($desc)); ?></p>
          <?php endif; ?>

          <?php if ($title = carbon_get_post_meta(get_the_ID(), 'intro_title')): ?>
            <h1 class="intro__title"><?php echo nl2br(wp_kses_post($title)); ?></h1>
          <?php endif; ?>

          <?php $advantages = carbon_get_post_meta(get_the_ID(), 'intro_advantages'); ?>
          <?php if ($advantages): ?>
            <ul class="intro__features">
              <?php foreach ($advantages as $item): ?>
                <li class="intro__feature">
                  <span class="intro__bullet">
                    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </span>
                  <span class="intro__feature-text"><?php echo nl2br(
                    wp_kses_post($item['text']),
                  ); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php $btn_text = carbon_get_post_meta(get_the_ID(), 'intro_btn_text'); ?>
          <button type="button" class="intro__cta" data-callback-button data-callback-button-goal="CALLBACK_INTRO">
            <?php echo $btn_text ?: 'Бесплатная консультация'; ?>
          </button>
        </div>
      </div>
    </section>

    <?php $landsvc_title = carbon_get_post_meta(get_the_ID(), 'landsvc_title'); ?>
    <?php $landsvc_cards = carbon_get_post_meta(get_the_ID(), 'landsvc_cards'); ?>
    <?php if ($landsvc_cards): ?>
    <section class="landing-services">
      <div class="container">
        <?php if ($landsvc_title): ?>
          <h2 class="landing-services__title"><?php echo nl2br(wp_kses_post($landsvc_title)); ?></h2>
        <?php endif; ?>

        <div class="landing-services__grid">
          <?php foreach ($landsvc_cards as $card): ?>
            <div class="landing-services__card">
              <div class="landing-services__card-top">
                <?php if (!empty($card['image'])): ?>
                  <img class="landing-services__image"
                    src="<?php echo esc_url(wp_get_attachment_image_url($card['image'], 'large')); ?>"
                    alt="<?php echo esc_attr(wp_strip_all_tags($card['title'])); ?>" />
                <?php endif; ?>

                <div class="landing-services__info">
                  <div>
                    <h3 class="landing-services__card-title">
                      <?php echo nl2br(wp_kses_post($card['title'])); ?>
                    </h3>
                    <?php if (!empty($card['desc'])): ?>
                      <p class="landing-services__desc"><?php echo nl2br(wp_kses_post($card['desc'])); ?></p>
                    <?php endif; ?>
                  </div>

                  <div class="landing-services__buttons">
                    <?php if (!empty($card['more_url'])): ?>
                      <a href="<?php echo esc_url($card['more_url']); ?>"
                        class="landing-services__btn landing-services__btn--outline">Подробнее</a>
                    <?php endif; ?>
                    <button type="button"
                      class="landing-services__btn landing-services__btn--primary"
                      data-callback-button
                      data-callback-button-goal="CALLBACK_SERVICE"
                      data-callback-button-subject="Заказать услугу: <?php echo esc_attr(
                        wp_strip_all_tags($card['title']),
                      ); ?>">
                      Заказать услугу
                    </button>
                  </div>
                </div>
              </div>

              <?php if (!empty($card['features'])): ?>
              <div class="landing-services__features">
                <?php foreach ($card['features'] as $feature): ?>
                  <div class="landing-services__feature">
                    <?php if (!empty($feature['top_text'])): ?>
                      <div class="landing-services__feature-top"><?php echo nl2br(
                        esc_html($feature['top_text']),
                      ); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($feature['image'])): ?>
                    <div class="landing-services__feature-image">
                      <img
                        src="<?php echo esc_url(wp_get_attachment_image_url($feature['image'], 'medium')); ?>"
                        alt="" />
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($feature['bottom_text'])): ?>
                      <div class="landing-services__feature-bottom"><?php echo nl2br(
                        esc_html($feature['bottom_text']),
                      ); ?></div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php $why_cards = carbon_get_the_post_meta('why_cards'); ?>
    <?php if (
      !empty($why_cards) ||
      carbon_get_the_post_meta('why_title') ||
      carbon_get_the_post_meta('why_subtitle')
    ): ?>
    <section class="why">
      <div class="why__panel">
        <?php $why_bg = carbon_get_the_post_meta('why_bg_image'); ?>
        <?php if (!empty($why_bg)): ?>
          <div class="why__bg" style="background-image:url('<?php echo esc_url(
            wp_get_attachment_image_url($why_bg, 'full'),
          ); ?>');"></div>
        <?php endif; ?>

        <?php $why_title = carbon_get_the_post_meta('why_title'); ?>
        <?php if (!empty($why_title)): ?>
          <h2 class="why__title"><?php echo esc_html($why_title); ?></h2>
        <?php endif; ?>

        <?php $why_subtitle = carbon_get_the_post_meta('why_subtitle'); ?>
        <?php if (!empty($why_subtitle)): ?>
          <p class="why__subtitle"><?php echo esc_html($why_subtitle); ?></p>
        <?php endif; ?>

        <div class="why__grid">
          <?php foreach ($why_cards as $card): ?>
            <div class="why__card">
              <div class="why__icon-box">
                <?php if (!empty($card['image'])): ?>
                  <img src="<?php echo esc_url(wp_get_attachment_image_url($card['image'], 'medium')); ?>"
                    alt="" />
                <?php endif; ?>
              </div>
              <div class="why__content">
                <h3 class="why__card-title"><?php echo esc_html($card['title']); ?></h3>
                <p class="why__card-desc"><?php echo nl2br(esc_html($card['desc'])); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php $process_steps_top = carbon_get_the_post_meta('process_steps_top'); ?>
    <?php $process_steps_bottom = carbon_get_the_post_meta('process_steps_bottom'); ?>
    <?php if (
      carbon_get_the_post_meta('process_title') ||
      !empty($process_steps_top) ||
      !empty($process_steps_bottom)
    ): ?>
    <?php $process_bg = carbon_get_the_post_meta('process_bg_image'); ?>
    <section class="process"<?php echo $process_bg
      ? sprintf(
        ' style="--process-bg:url(%s)"',
        esc_url(wp_get_attachment_image_url($process_bg, 'full')),
      )
      : ''; ?>>
      <div class="process__container">
        <?php $process_title = carbon_get_the_post_meta('process_title'); ?>
        <?php if (!empty($process_title)): ?>
          <h2 class="process__title"><?php echo esc_html($process_title); ?></h2>
        <?php endif; ?>

        <?php foreach (
          [
            'top' => $process_steps_top,
            'bottom' => $process_steps_bottom,
          ] as $process_row_key => $process_row_steps): ?>
          <?php if (empty($process_row_steps)) {
            continue;
          } ?>
          <div class="process__row<?php echo $process_row_key === 'bottom'
            ? ' process__row--bottom'
            : ''; ?>">
            <?php foreach ($process_row_steps as $process_i => $process_step): ?>
              <?php if ($process_i > 0): ?>
                <div class="process__arrow">
                  <div class="process__arrow-line"></div>
                </div>
              <?php endif; ?>
              <div class="process__step">
                <div class="process__icon-box">
                  <?php if (!empty($process_step['image'])): ?>
                    <img src="<?php echo esc_url(
                      wp_get_attachment_image_url($process_step['image'], 'medium'),
                    ); ?>" alt="" />
                  <?php endif; ?>
                </div>
                <p class="process__step-text"><?php echo nl2br(esc_html($process_step['text'])); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>

        <?php $process_btn_text = carbon_get_the_post_meta('process_btn_text'); ?>
        <?php if (!empty($process_btn_text)): ?>
          <button type="button" class="process__cta"
            data-callback-button
            data-callback-button-goal="CALLBACK_PROCESS">
            <?php echo esc_html($process_btn_text); ?>
          </button>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php $values_cards = carbon_get_the_post_meta('values_cards'); ?>
    <?php if (carbon_get_the_post_meta('values_title') || !empty($values_cards)): ?>
    <section class="values">
      <div class="values__panel">
        <?php $values_bg = carbon_get_the_post_meta('values_bg_image'); ?>
        <?php if (!empty($values_bg)): ?>
          <div class="values__bg" style="background-image:url('<?php echo esc_url(
            wp_get_attachment_image_url($values_bg, 'full'),
          ); ?>');"></div>
        <?php endif; ?>

        <?php $values_title = carbon_get_the_post_meta('values_title'); ?>
        <?php if (!empty($values_title)): ?>
          <h2 class="values__title"><?php echo esc_html($values_title); ?></h2>
        <?php endif; ?>

        <div class="values__grid">
          <?php foreach ($values_cards as $values_i => $values_card): ?>
            <div class="values__card">
              <div class="values__badge"><?php echo esc_html($values_i + 1); ?></div>
              <h3 class="values__card-title"><?php echo esc_html($values_card['title']); ?></h3>
              <p class="values__card-desc"><?php echo nl2br(esc_html($values_card['desc'])); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php $faq_items = carbon_get_the_post_meta('faq_items'); ?>
    <?php if (carbon_get_the_post_meta('faq_title') || !empty($faq_items)): ?>
    <section class="faq">
      <?php $faq_title = carbon_get_the_post_meta('faq_title'); ?>
      <?php if (!empty($faq_title)): ?>
        <h2 class="faq__title"><?php echo nl2br(esc_html($faq_title)); ?></h2>
      <?php endif; ?>

      <div class="faq__columns">
        <div class="faq__content">
          <?php foreach ($faq_items as $faq_i => $faq_item): ?>
            <details class="faq__item"<?php echo $faq_i === 0 ? ' open' : ''; ?>>
              <summary class="faq__question">
                <span class="faq__icon"></span>
                <?php echo esc_html($faq_item['question']); ?>
              </summary>
              <div class="faq__answer"><?php echo nl2br(wp_kses_post($faq_item['answer'])); ?></div>
            </details>
          <?php endforeach; ?>
        </div>

        <?php $faq_image = carbon_get_the_post_meta('faq_image'); ?>
        <?php if (!empty($faq_image)): ?>
        <div class="faq__image-wrapper">
          <div class="faq__image-card">
            <img src="<?php echo esc_url(wp_get_attachment_image_url($faq_image, 'large')); ?>" alt="" />
            <div class="faq__overlay">
              <?php $faq_phone = carbon_get_theme_option('crb_theme_phone_number'); ?>
              <?php if (!empty($faq_phone)): ?>
                <a class="faq__overlay-phone"
                  href="tel:<?php echo preg_replace('/[^0-9+]/', '', $faq_phone); ?>">
                  <?php echo esc_html($faq_phone); ?>
                </a>
              <?php endif; ?>

              <?php $faq_email = carbon_get_theme_option('crb_theme_email'); ?>
              <?php if (!empty($faq_email)): ?>
                <div class="faq__overlay-email">Email: <?php echo esc_html($faq_email); ?></div>
              <?php endif; ?>

              <?php $faq_btn_text = carbon_get_the_post_meta('faq_btn_text'); ?>
              <button type="button" class="faq__cta"
                data-callback-button
                data-callback-button-goal="CALLBACK_FAQ">
                <?php echo esc_html($faq_btn_text ?: 'Задать свой вопрос'); ?>
              </button>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php $approval_features = carbon_get_the_post_meta('approval_features'); ?>
    <?php $approval_bullets = carbon_get_the_post_meta('approval_bullets'); ?>
    <?php if (
      carbon_get_the_post_meta('approval_title') ||
      !empty($approval_features) ||
      !empty($approval_bullets)
    ): ?>
    <section class="approval">
      <div class="approval__container">
        <?php $approval_title = carbon_get_the_post_meta('approval_title'); ?>
        <?php if (!empty($approval_title)): ?>
          <h2 class="approval__title"><?php echo esc_html($approval_title); ?></h2>
        <?php endif; ?>

        <div class="approval__wrapper">
          <div class="approval__left">
            <?php if (!empty($approval_features)): ?>
            <ul class="approval__features">
              <?php foreach ($approval_features as $approval_item): ?>
                <li class="approval__feature">
                  <span class="approval__check">
                    <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                  </span>
                  <span><?php echo nl2br(esc_html($approval_item['text'])); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <div class="approval__divider"></div>

            <?php if (!empty($approval_bullets)): ?>
            <ul class="approval__bullets">
              <?php foreach ($approval_bullets as $approval_item): ?>
                <li><?php echo nl2br(esc_html($approval_item['text'])); ?></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>

          <div class="approval__right">
            <form class="approval__form"
              action="<?php echo admin_url('admin-ajax.php'); ?>"
              data-feedback-form
              data-feedback-form-goal="CALLBACK_APPROVAL"
              data-feedback-form-action="feedback_form">
              <input type="hidden" name="submitted" value="">
              <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(
                'feedback-nonce',
              ); ?>">
              <input type="hidden" name="page" value="<?php echo esc_html(get_self_link()); ?>">
              <input type="hidden" name="subject" value="Одобрим сделку">

              <?php $approval_form_title = carbon_get_the_post_meta('approval_form_title'); ?>
              <?php if (!empty($approval_form_title)): ?>
                <div class="approval__form-title"><?php echo esc_html($approval_form_title); ?></div>
              <?php endif; ?>

              <input class="approval__input" type="text" name="phone"
                data-maska="+ 7 (###) - ### - ## - ##"
                placeholder="+7 ___ ___-__-__" required>

              <div class="approval__errors" data-feedback-form-errors></div>

              <?php $approval_btn_text = carbon_get_the_post_meta('approval_btn_text'); ?>
              <button type="submit" class="approval__submit">
                <?php echo esc_html($approval_btn_text ?: 'Оставить заявку'); ?>
              </button>

              <label class="approval__consent">
                <input type="checkbox" checked>
                <span class="approval__consent-check">
                  <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </span>
                <span>Соглашаюсь с политикой обработки персональных данных</span>
              </label>

              <div class="approval__success">
                <div class="approval__success-title">Заявка отправлена</div>
                <div class="approval__success-desc">Мы свяжемся с вами в ближайшее время</div>
                <button type="button" class="approval__success-close" data-feedback-form-reset>
                  Закрыть
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <div class="page-layout__body">
      <div class="container">
        <div class="page-content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <div class="page-layout__spacer"></div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
