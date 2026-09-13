<?php
$nf_services_pages = get_pages([
  'meta_key' => '_wp_page_template',
  'meta_value' => 'templates/services.php',
  'number' => 1,
]);
$nf_contacts_pages = get_pages([
  'meta_key' => '_wp_page_template',
  'meta_value' => 'templates/contacts.php',
  'number' => 1,
]);

$nf_routes = [];
if (!empty($nf_services_pages)) {
  $nf_routes[] = [
    'href' => get_permalink($nf_services_pages[0]),
    'icon' => 'briefcase',
    'label' => 'Услуги',
  ];
}

$nf_categories = get_categories(['hide_empty' => true, 'number' => 1]);
if (!empty($nf_categories)) {
  $nf_news_link = get_term_link($nf_categories[0]);
  if (!is_wp_error($nf_news_link)) {
    $nf_routes[] = [
      'href' => $nf_news_link,
      'icon' => 'file-text',
      'label' => 'Новости',
    ];
  }
}

if (!empty($nf_contacts_pages)) {
  $nf_routes[] = [
    'href' => get_permalink($nf_contacts_pages[0]),
    'icon' => 'phone',
    'label' => 'Контакты',
  ];
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
    <main class="notfound">
      <div class="notfound__bg" aria-hidden="true">
        <span class="notfound__grid"></span>
        <span class="notfound__blob notfound__blob--1"></span>
        <span class="notfound__blob notfound__blob--2"></span>
      </div>

      <div class="container notfound__container">
        <div class="notfound__inner">
          <p class="notfound__badge">404 &middot; страница не найдена</p>

          <div class="notfound__code" aria-hidden="true">
            <svg class="notfound__radar" viewBox="0 0 200 200">
              <circle class="notfound__radar-ring" cx="100" cy="100" r="90"></circle>
              <circle class="notfound__radar-ring" cx="100" cy="100" r="58"></circle>
              <line class="notfound__radar-line" x1="100" y1="6" x2="100" y2="194"></line>
              <line class="notfound__radar-line" x1="6" y1="100" x2="194" y2="100"></line>
            </svg>
            <span class="notfound__pulse"></span>
            <span class="notfound__digit notfound__digit--1">4</span>
            <span class="notfound__digit notfound__digit--2">0</span>
            <span class="notfound__digit notfound__digit--3">4</span>
          </div>

          <h1 class="notfound__title">Похоже, вы сбились с пути</h1>
          <p class="notfound__lead">Дорога к этой странице заросла, но нужные разделы рядом — выбирайте маршрут.</p>

          <div class="notfound__trail" aria-hidden="true"></div>

          <div class="notfound__action">
            <a class="btn" href="<?php echo esc_url(home_url('/')); ?>">На главную</a>
          </div>

          <?php if ($nf_routes): ?>
            <ul class="notfound__routes">
              <?php foreach ($nf_routes as $nf_route): ?>
                <li>
                  <a class="notfound__route" href="<?php echo esc_url($nf_route['href']); ?>">
                    <span class="icon icon-<?php echo esc_attr($nf_route['icon']); ?>"></span>
                    <?php echo esc_html($nf_route['label']); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </div>
</body>

</html>
