<?php

remove_action('wp_head', 'rel_canonical');
add_action('wp_head', function () {
  if (!is_singular()) {
    return;
  }

  $id = get_queried_object_id();

  if (0 === $id) {
    return;
  }

  $url = wp_get_canonical_url($id);

  if (!empty($url)) {
    echo '<link rel="canonical" itemprop="url" href="' . esc_url($url) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
  }
});

add_action('wp_head', function () {
  $title = '';
  $description = '';
  $keywords = '';

  if (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      $title = carbon_get_term_meta($term->term_id, 'crb_seo_title');
      if (empty($title)) {
        $title = $term->name;
      }
      $description = carbon_get_term_meta($term->term_id, 'crb_seo_description');
      $keywords = carbon_get_term_meta($term->term_id, 'crb_seo_keywords');
    } elseif (is_post_type_archive()) {
      $title = get_queried_object()->labels->name;
    } elseif (is_day()) {
      $title = sprintf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      $title = sprintf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      $title = sprintf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      $title = sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
    } else {
      $title = single_cat_title('', false);
    }
  } elseif (is_search()) {
    $title = sprintf(__('Search Results for %s', 'roots'), get_search_query());
  } elseif (is_404()) {
    $title = 'Not Found';
  } else {
    $title = carbon_get_the_post_meta('crb_seo_title');
    if (empty($title)) {
      $title = get_the_title();
    }
    $description = carbon_get_the_post_meta('crb_seo_description');
    $keywords = carbon_get_the_post_meta('crb_seo_keywords');
  }

  echo '<meta property="og:type" content="website">' . "\n";
  echo '<meta property="og:site_name" content="' . get_bloginfo('blogname') . '">' . "\n";
  echo '<meta property="og:locale" content="ru_RU">' . "\n";

  if (!empty($title)) {
    echo '<title>' . $title . '</title>' . "\n";
    echo '<meta property="og:title" content="' . $title . '">' . "\n";
  }

  if (!empty($keywords)) {
    echo '<meta name="keywords" content="' . $keywords . '">' . "\n";
  }

  if (!empty($description)) {
    echo '<meta name="description" content="' . $description . '">' . "\n";
    echo '<meta property="og:description" content="' . $description . '">' . "\n";
  }

  $og_image = '';

  if (is_singular() && has_post_thumbnail()) {
    $og_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
  }

  if (empty($og_image)) {
    $crb_og_image = carbon_get_theme_option('crb_theme_og_image');

    if (!empty($crb_og_image)) {
      $og_image = wp_get_attachment_image_url(intval($crb_og_image), 'large');
    }
  }

  if (empty($og_image)) {
    $og_image = get_site_icon_url();
  }

  if (!empty($og_image)) {
    $og_image_meta = wp_getimagesize($og_image);

    echo '<meta property="og:image" content="' . esc_url($og_image) . '" />' . "\n";

    if (!empty($og_image_meta[0]) && !empty($og_image_meta[1])) {
      echo '<meta property="og:image:width" content="' . intval($og_image_meta[0]) . '">' . "\n";
      echo '<meta property="og:image:height" content="' . intval($og_image_meta[1]) . '">' . "\n";
    }
  }
});

add_action('wp_head', function () {
  $site_name = carbon_get_theme_option('crb_theme_site_name');

  if (empty($site_name)) {
    $site_name = get_bloginfo('name');
  }

  $phone = carbon_get_theme_option('crb_theme_phone_number');
  $email = carbon_get_theme_option('crb_theme_email');
  $address = carbon_get_theme_option('crb_theme_address');

  $organization = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $site_name,
    'url' => home_url('/'),
  ];

  if (!empty($phone)) {
    $organization['telephone'] = $phone;
  }

  if (!empty($email)) {
    $organization['email'] = $email;
  }

  if (!empty($address)) {
    $organization['address'] = [
      '@type' => 'PostalAddress',
      'streetAddress' => trim(strip_tags($address)),
      'addressCountry' => 'RU',
    ];
  }

  echo '<script type="application/ld+json">' . "\n";
  echo wp_json_encode($organization, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
  echo '</script>' . "\n";
});
