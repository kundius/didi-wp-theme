<?php
$category = get_queried_object();
$query_params = [
  'post_type' => 'post',
  'orderby' => [
    'is_sticky' => 'DESC',
    'date' => 'DESC',
  ],
  'paged' => get_query_var('paged') ?: 1,
  'cat' => $category->term_id
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

  <div class="page-layout">
    <?php get_template_part('partials/header'); ?>

    <div class="page-layout__body">
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
              <span itemprop="name"><?php single_term_title(); ?></span>
            </span>
            <meta itemprop="position" content="2">
          </li>
        </ol>

        <h1 class="page-title">
          <?php single_term_title(); ?>
        </h1>

        <div class="page-content">
          <?php echo term_description() ?>
        </div>

        <div class="news-grid">
          <?php while ($articles->have_posts()): ?>
            <?php $articles->the_post(); ?>
            <article class="news-grid__item">
              <?php if (has_post_thumbnail()): ?>
                <a class="news-card__image" href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('large'); ?>
                </a>
              <?php endif; ?>
              <div class="news-card__date"><?php echo get_the_date(); ?></div>
              <h2 class="news-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="news-card__excerpt"><?php the_excerpt(); ?></div>
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