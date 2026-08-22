<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">

<head>
  <?php get_template_part('partials/head'); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="page-layout">
    <?php get_template_part('partials/header'); ?>

    <div class="page-layout__body">
      <div class="container">
        <h1 class="page-title">404</h1>

        <div class="page-content">
          Страница не найдена
        </div>
      </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>