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

    <div class="page-main__body">
      <div class="page-content">
        <div class="container">
          <div class="page-content__inner content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>

      <?php get_template_part('partials/feedback'); ?>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
