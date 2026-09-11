<?php
/*
Template Name: Услуги
*/

$svc_children = get_posts([
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC',
]);

$svc_service_pages = [];
$svc_info_pages = [];

foreach ($svc_children as $svc_child) {
  $svc_child_template = get_post_meta($svc_child->ID, '_wp_page_template', true);
  if ($svc_child_template === 'templates/service.php') {
    $svc_service_pages[] = $svc_child;
  } else {
    $svc_info_pages[] = $svc_child;
  }
}

$svc_groups = [];
foreach ($svc_service_pages as $svc_service_page) {
  $svc_type = carbon_get_post_meta($svc_service_page->ID, 'crb_service_type')
    ?: 'Лизинг';

  $svc_image_id = carbon_get_post_meta($svc_service_page->ID, 'crb_service_image');
  if (!$svc_image_id) {
    $svc_image_id = get_post_thumbnail_id($svc_service_page->ID);
  }
  $svc_card = [
    'image' => $svc_image_id,
    'title' => get_the_title($svc_service_page->ID),
    'desc' => carbon_get_post_meta($svc_service_page->ID, 'crb_service_desc'),
    'more_url' => get_permalink($svc_service_page->ID),
    'features' => carbon_get_post_meta($svc_service_page->ID, 'crb_service_features'),
  ];

  $svc_group_found = false;
  foreach ($svc_groups as &$svc_group) {
    if ($svc_group['label'] === $svc_type) {
      $svc_group['cards'][] = $svc_card;
      $svc_group_found = true;
      break;
    }
  }
  unset($svc_group);

  if (!$svc_group_found) {
    $svc_groups[] = [
      'label' => $svc_type,
      'cards' => [$svc_card],
    ];
  }
}

$svc_tabs = [];
foreach ($svc_groups as $svc_group_index => $svc_group) {
  $svc_tabs[] = [
    'id' => 'type-' . $svc_group_index,
    'panel' => 'type-' . $svc_group_index,
    'label' => $svc_group['label'],
  ];
}
foreach ($svc_info_pages as $svc_info_page) {
  $svc_tabs[] = [
    'id' => 'page-' . $svc_info_page->ID,
    'panel' => 'page-' . $svc_info_page->ID,
    'page_id' => $svc_info_page->ID,
    'label' => get_the_title($svc_info_page->ID),
  ];
}

if (!function_exists('didi_render_svc_card')) {
  function didi_render_svc_card($svc_card)
  {
  ?>
  <div class="landing-services__card">
    <div class="landing-services__card-top">
      <?php if (!empty($svc_card['image'])): ?>
        <img class="landing-services__image"
          src="<?php echo esc_url(
            wp_get_attachment_image_url($svc_card['image'], 'large'),
          ); ?>"
          alt="<?php echo esc_attr(wp_strip_all_tags($svc_card['title'])); ?>" />
      <?php endif; ?>

      <div class="landing-services__info">
        <div>
          <h3 class="landing-services__card-title">
            <?php echo nl2br(wp_kses_post($svc_card['title'])); ?>
          </h3>
          <?php if (!empty($svc_card['desc'])): ?>
            <p class="landing-services__desc"><?php echo nl2br(
              wp_kses_post($svc_card['desc']),
            ); ?></p>
          <?php endif; ?>
        </div>

        <div class="landing-services__buttons">
          <?php if (!empty($svc_card['more_url'])): ?>
            <a href="<?php echo esc_url($svc_card['more_url']); ?>"
              class="landing-services__btn landing-services__btn--outline">Подробнее</a>
          <?php endif; ?>
          <button type="button"
            class="landing-services__btn landing-services__btn--primary"
            data-callback-button
            data-callback-button-goal="CALLBACK_SERVICE"
            data-callback-button-subject="Заказать услугу: <?php echo esc_attr(
              wp_strip_all_tags($svc_card['title']),
            ); ?>">
            Заказать услугу
          </button>
        </div>
      </div>
    </div>

    <?php if (!empty($svc_card['features'])): ?>
      <div class="landing-services__features">
        <?php foreach ($svc_card['features'] as $svc_feature): ?>
          <div class="landing-services__feature">
            <?php if (!empty($svc_feature['top_text'])): ?>
              <div class="landing-services__feature-top"><?php echo nl2br(
                esc_html($svc_feature['top_text']),
              ); ?></div>
            <?php endif; ?>

            <?php if (!empty($svc_feature['image'])): ?>
              <div class="landing-services__feature-image">
                <img
                  src="<?php echo esc_url(
                    wp_get_attachment_image_url($svc_feature['image'], 'medium'),
                  ); ?>"
                  alt="" />
              </div>
            <?php endif; ?>

            <?php if (!empty($svc_feature['bottom_text'])): ?>
              <div class="landing-services__feature-bottom"><?php echo nl2br(
                esc_html($svc_feature['bottom_text']),
              ); ?></div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php
  }
}
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

    <?php if ($svc_children): ?>
    <section class="landing-services" data-services-tabs>
      <div class="container">
        <?php
        $svc_tab_index = 0;
        foreach ($svc_tabs as $svc_tab):
        ?>
          <input type="radio" class="landing-services__radio"
            id="svc-<?php echo esc_attr($svc_tab['id']); ?>"
            name="services-page-tabs"
            <?php echo $svc_tab_index === 0 ? 'checked' : ''; ?>
            <?php if (!empty($svc_tab['page_id'])): ?>
              data-svc-page-id="<?php echo esc_attr($svc_tab['page_id']); ?>"
            <?php endif; ?>>
          <?php $svc_tab_index++; ?>
        <?php endforeach; ?>

        <style>
          <?php foreach ($svc_tabs as $svc_tab): ?>
          #svc-<?php echo esc_attr($svc_tab['id']); ?>:checked ~ .landing-services__tabs label[for='svc-<?php echo esc_attr($svc_tab['id']); ?>'] {
            --svc-tab-active-bg: #0c0c64;
            --svc-tab-active-border: #0c0c64;
            --svc-tab-active-color: #ffffff;
            --svc-tab-active-font-size: 36px;
            --svc-tab-active-border-radius: 36px;
            --svc-tab-active-min-height: 72px;
            --svc-tab-hover-bg: #0c0c64;
            --svc-tab-hover-color: #ffffff;
            --svc-tab-active-opacity: 1;
          }
          #svc-<?php echo esc_attr($svc_tab['id']); ?>:checked ~ .landing-services__panels .landing-services__panel[data-svc-panel="<?php echo esc_attr($svc_tab['panel']); ?>"] {
            display: block;
          }
          <?php endforeach; ?>
        </style>

        <div class="landing-services__tabs">
          <?php foreach ($svc_tabs as $svc_tab): ?>
            <label class="landing-services__tab" for="svc-<?php echo esc_attr($svc_tab['id']); ?>">
              <?php echo nl2br(esc_html($svc_tab['label'])); ?>
            </label>
          <?php endforeach; ?>
        </div>

        <div class="landing-services__panels">
          <?php foreach ($svc_groups as $svc_group_index => $svc_group): ?>
            <div class="landing-services__panel" data-svc-panel="type-<?php echo esc_attr($svc_group_index); ?>">
              <div class="landing-services__grid">
                <?php foreach ($svc_group['cards'] as $svc_card): ?>
                  <?php didi_render_svc_card($svc_card); ?>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>

          <?php foreach ($svc_info_pages as $svc_info_page): ?>
            <div class="landing-services__panel"
              data-svc-panel="page-<?php echo esc_attr($svc_info_page->ID); ?>"
              data-svc-page-id="<?php echo esc_attr($svc_info_page->ID); ?>">
              <div class="landing-services__content content"></div>
            </div>
          <?php endforeach; ?>
        </div>
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

    <?php get_template_part('partials/feedback'); ?>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
