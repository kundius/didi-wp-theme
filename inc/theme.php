<?php

define('DISALLOW_FILE_EDIT', true);

add_filter('excerpt_length', function () {
  return 15;
});

// Add the theme support basic elements
add_theme_support('align-wide');
// add_theme_support('title-tag');
add_theme_support('responsive-embeds');
add_theme_support('editor-styles');
add_theme_support('wp-block-styles');
add_theme_support('post-thumbnails');
add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'script', 'style']);

add_shortcode('partial', function ($atts, $content = null) {
  ob_start();
  get_template_part('partials/' . $atts[0]);
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
});

add_shortcode('sitemap', function () {
  $sitemap = '<section class="sitemap">';

  $sitemap .= '<div class="sitemap__group">';
  $sitemap .= '<h2 class="sitemap__title">Страницы</h2>';
  $sitemap .= '<ul class="sitemap__list">';
  $sitemap .= wp_list_pages([
    'title_li' => '',
    'echo' => 0,
    'sort_column' => 'menu_order, post_title',
  ]);
  $sitemap .= '</ul>';
  $sitemap .= '</div>';

  $sitemap_categories = get_categories(['hide_empty' => true]);
  if ($sitemap_categories) {
    $sitemap .= '<div class="sitemap__group">';
    $sitemap .= '<h2 class="sitemap__title">Рубрики</h2>';
    $sitemap .= '<ul class="sitemap__list">';
    foreach ($sitemap_categories as $sitemap_category) {
      $sitemap_posts = get_posts([
        'category' => $sitemap_category->term_id,
        'numberposts' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
      ]);
      if (empty($sitemap_posts)) {
        continue;
      }
      $sitemap .= '<li>';
      $sitemap .= '<a class="sitemap__link" href="' . esc_url(get_term_link($sitemap_category)) . '">' .
        esc_html($sitemap_category->name) . '</a>';
      $sitemap .= '<ul class="sitemap__sublist">';
      foreach ($sitemap_posts as $sitemap_post) {
        $sitemap .= '<li><a class="sitemap__link" href="' . esc_url(get_permalink($sitemap_post)) . '">' .
          esc_html(get_the_title($sitemap_post)) . '</a></li>';
      }
      $sitemap .= '</ul>';
      $sitemap .= '</li>';
    }
    $sitemap .= '</ul>';
    $sitemap .= '</div>';
  }

  $sitemap .= '</section>';

  return $sitemap;
});

function get_pagination($query)
{
  $links = paginate_links([
    'prev_text' => '<span class="icon icon-arrow-left"></span>',
    'next_text' => '<span class="icon icon-arrow-right"></span>',
    'total' => $query->max_num_pages,
    'current' => max(1, get_query_var('paged')),
  ]);

  if ($links) {
    return '<div class="pagination">' . $links . '</div>';
  }
}
