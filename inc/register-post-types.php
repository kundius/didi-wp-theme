<?php
add_action('init', 'register_post_types');

function register_post_types()
{
  register_post_type('review', [
    'label' => null,
    'labels' => [
      'name' => 'Отзыв',
      'singular_name' => 'Отзыв',
      'add_new' => 'Добавить Отзыв',
      'add_new_item' => 'Добавить Отзыв',
      'edit_item' => 'Редактировать Отзыв',
      'new_item' => 'Новая Отзыв',
      'view_item' => 'Смотреть Отзыв',
      'search_items' => 'Искать Отзыв',
      'not_found' => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon' => '',
      'menu_name' => 'Отзывы',
    ],
    'description' => '',
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-media-document',
    'supports' => ['title', 'editor', 'thumbnail'],
    'query_var' => false,
    'show_ui' => true,
  ]);
}
