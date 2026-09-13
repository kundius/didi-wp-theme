<?php
$category = get_queried_object();
$query_params = [
  'post_type' => 'post',
  'orderby' => 'date',
  'order' => 'DESC',
  'paged' => max(1, get_query_var('paged')),
  'cat' => $category->term_id,
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
            <span itemprop="name"><?php single_term_title(); ?></span>
          </span>
          <meta itemprop="position" content="2">
        </li>
      </ol>

      <h1 class="page-title"><?php single_term_title(); ?></h1>
    </div>

    <div class="page-content">
      <div class="container">
        <?php if (term_description()): ?>
          <div class="page-content__inner content">
            <?php echo wpautop(term_description()); ?>
          </div>
        <?php endif; ?>

        <div class="news-grid">
          <?php while ($articles->have_posts()): ?>
            <?php $articles->the_post(); ?>
            <article class="news-grid__item">
              <?php if (has_post_thumbnail()): ?>
                <div class="news-card__image">
                  <?php the_post_thumbnail('large'); ?>
                </div>
              <?php endif; ?>
              <div class="news-card__date"><?php echo get_the_date(); ?></div>
              <h2 class="news-card__title"><?php the_title(); ?></h2>
              <div class="news-card__excerpt"><?php the_excerpt(); ?></div>
              <a class="news-card__more" href="<?php the_permalink(); ?>">
                Подробнее
                <span class="icon icon-arrow-right"></span>
              </a>
            </article>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>

        <?php echo get_pagination($articles); ?>
      </div>
    </div>

    <?php get_template_part('partials/feedback'); ?>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>