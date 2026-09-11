<?php
$query_params = [
  'post_type' => 'review',
  'orderby' => [
    'is_sticky' => 'DESC',
    'date' => 'DESC',
  ],
  'paged' => get_query_var('paged') ?: 1,
];
$articles = new WP_Query($query_params);
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

    <div class="page-content">
      <div class="container">
        <ol class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList" aria-label="Хлебные крошки">
          <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <a class="breadcrumbs__link" itemprop="item" href="/">
              <span itemprop="name">Главная</span>
            </a>
            <meta itemprop="position" content="1">
          </li>
          <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <span class="breadcrumbs__text" itemprop="item" aria-current="page">
              <span itemprop="name">Отзывы</span>
            </span>
            <meta itemprop="position" content="2">
          </li>
        </ol>

        <h1 class="page-title">
          Отзывы
        </h1>

        <div class="reviews-grid">
          <?php while ($articles->have_posts()): ?>
            <?php $articles->the_post(); ?>
            <article class="reviews-grid__item">
              <?php if (has_post_thumbnail()): ?>
                <div class="review-card__image"><?php the_post_thumbnail('medium'); ?></div>
              <?php endif; ?>
              <h2 class="review-card__title"><?php the_title(); ?></h2>
              <div class="review-card__text"><?php the_content(); ?></div>
            </article>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>

        <?php echo get_pagination($articles); ?>
      </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
