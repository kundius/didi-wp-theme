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
