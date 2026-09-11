<?php
/*
Template Name: Контакты
*/
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
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
          <span class="breadcrumbs__text" itemprop="item" aria-current="page">
            <span itemprop="name"><?php the_title(); ?></span>
          </span>
          <meta itemprop="position" content="2">
        </li>
      </ol>

      <h1 class="page-title"><?php the_title(); ?></h1>
    </div>

    <?php
    $contacts_phone = carbon_get_theme_option('crb_theme_phone_number');
    $contacts_email = carbon_get_theme_option('crb_theme_email');
    $contacts_address = carbon_get_theme_option('crb_theme_address');
    $contacts_schedules = carbon_get_theme_option('crb_theme_working_hours');
    ?>

    <?php if (
      $contacts_phone ||
      $contacts_email ||
      $contacts_address ||
      !empty(trim($contacts_schedules))
    ): ?>
    <section class="contacts-cards">
      <div class="contacts-cards__grid">
        <?php if ($contacts_phone): ?>
        <div class="contacts-card">
          <div class="contacts-card__icon"><img src="<?php echo esc_url(get_theme_file_uri('assets/contacts-1.png')); ?>"
            alt="" width="76" height="81"></div>
          <h3 class="contacts-card__title">Телефон</h3>
          <p class="contacts-card__bold"><?php echo esc_html($contacts_phone); ?></p>
          <?php $contacts_phone_caption = carbon_get_theme_option(
            'crb_theme_phone_caption',
          ); ?>
          <?php if ($contacts_phone_caption): ?>
            <p class="contacts-card__light"><?php echo nl2br(
              esc_html($contacts_phone_caption),
            ); ?></p>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ($contacts_email): ?>
        <div class="contacts-card">
          <div class="contacts-card__icon"><img src="<?php echo esc_url(get_theme_file_uri('assets/contacts-2.png')); ?>"
            alt="" width="74" height="72"></div>
          <h3 class="contacts-card__title">Наш E-mail</h3>
          <p class="contacts-card__bold"><?php echo esc_html($contacts_email); ?></p>
          <?php $contacts_email_caption = carbon_get_theme_option(
            'crb_theme_email_caption',
          ); ?>
          <?php if ($contacts_email_caption): ?>
            <p class="contacts-card__light"><?php echo nl2br(
              esc_html($contacts_email_caption),
            ); ?></p>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ($contacts_address): ?>
        <div class="contacts-card">
          <div class="contacts-card__icon"><img src="<?php echo esc_url(get_theme_file_uri('assets/contacts-3.png')); ?>"
            alt="" width="58" height="71"></div>
          <h3 class="contacts-card__title">Наш адрес</h3>
          <div class="contacts-card__light">
            <?php echo nl2br(wp_kses_post($contacts_address)); ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if (!empty(trim($contacts_schedules))): ?>
        <div class="contacts-card">
          <div class="contacts-card__icon"><img src="<?php echo esc_url(get_theme_file_uri('assets/contacts-4.png')); ?>"
            alt="" width="60" height="60"></div>
          <h3 class="contacts-card__title">Время работы</h3>
          <div class="contacts-card__light">
            <?php echo nl2br(wp_kses_post($contacts_schedules)); ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php get_template_part('partials/feedback'); ?>

    <?php $contacts_map_html = carbon_get_theme_option('crb_theme_map_html'); ?>
    <?php if (!empty(trim($contacts_map_html))): ?>
    <section class="contacts-map">
      <div class="contacts-map__inner">
        <?php echo $contacts_map_html; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (trim(get_post_field('post_content', get_the_ID()))): ?>
    <div class="page-content">
      <div class="container">
        <div class="page-content__inner content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
