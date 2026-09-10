<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action('after_setup_theme', function () {
  \Carbon_Fields\Carbon_Fields::boot();
});

add_action('admin_head', function () {
  echo '<style>
    [data-type^="carbon-fields/"] {
      padding: 16px;
      background: #f0f0f0;
      border: 2px solid #007cba;
    }

    [data-type^="carbon-fields/"] .cf-complex__tabs--tabbed-horizontal .cf-complex__tabs-list {
      padding-left: 0;
    }

    [data-type^="carbon-fields/"] .cf-field.cf-media-gallery .cf-field__body {
      background: #ffffff;
    }

    [data-type^="carbon-fields/"] .cf-field.cf-separator .cf-field__body h3 {
      font-size: 20px;
      color: #000;
      font-weight: 500;
    }
  </style>';
});

add_action('carbon_fields_register_fields', 'register_carbon_fields_blocks');
function register_carbon_fields_blocks()
{
  Container::make('post_meta', 'SEO')
    ->where('post_type', '=', 'page')
    ->or_where('post_type', '=', 'post')
    ->add_fields([
      Field::make('text', 'crb_seo_title', 'Заголовок'),
      Field::make('text', 'crb_seo_keywords', 'Ключевые слова'),
      Field::make('textarea', 'crb_seo_description', 'Описание'),
    ]);

  Container::make('theme_options', 'Параметры')->add_tab('Общее', [
    Field::make('textarea', 'crb_theme_site_name', 'Название сайта')->set_rows(2),
    Field::make('text', 'crb_theme_phone_number', 'Телефон / Номер'),
    Field::make('text', 'crb_theme_phone_time', 'Телефон / Время работы'),
    Field::make('text', 'crb_theme_phone_caption', 'Телефон / Подпись'),
    Field::make('text', 'crb_theme_max_link', 'MAX'),
    Field::make('text', 'crb_theme_email', 'E-mail'),
    Field::make('text', 'crb_theme_email_caption', 'E-mail / Подпись'),
    Field::make('textarea', 'crb_theme_address', 'Адерс')->set_rows(2),
    Field::make(
      'complex',
      'crb_theme_working_hours',
      'Контакты / Время работы',
    )->add_fields([
      Field::make('text', 'day', 'Дни'),
      Field::make('text', 'hours', 'Часы'),
    ]),
    Field::make('textarea', 'crb_theme_counters', 'Счетчики')->set_rows(2),
    Field::make('textarea', 'crb_theme_copyright', 'Копирайт')->set_rows(2),
    Field::make('textarea', 'crb_theme_map_html', 'Карта / HTML код')->set_rows(4),
  ]);

  Container::make('post_meta', 'Лендинг')
    ->where('post_type', '=', 'page')
    ->where('post_template', '=', 'templates/landing.php')
    ->add_tab('Начальный экран', [
      Field::make('image', 'intro_bg_image', 'Фоновое изображение'),
      Field::make('file', 'intro_bg_video', 'Фоновое видео'),
      Field::make('textarea', 'intro_title', 'Заголовок')->set_rows(2),
      Field::make('textarea', 'intro_desc', 'Надзаголовок')->set_rows(2),
      Field::make('text', 'intro_btn_text', 'Текст кнопки'),
      Field::make('complex', 'intro_advantages', 'Преимущества')->add_fields([
        Field::make('textarea', 'text', 'Текст')->set_rows(2),
      ]),
    ])
    ->add_tab('Услуги', [
      Field::make('text', 'landsvc_title', 'Заголовок секции'),
      Field::make('complex', 'landsvc_cards', 'Карточки услуг')->add_fields([
        Field::make('image', 'image', 'Изображение'),
        Field::make('text', 'title', 'Заголовок'),
        Field::make('textarea', 'desc', 'Описание')->set_rows(2),
        Field::make('text', 'more_url', 'Ссылка «Подробнее»'),
        Field::make('complex', 'features', 'Особенности (колонки)')->add_fields([
          Field::make('textarea', 'top_text', 'Верхний текст')->set_rows(2),
          Field::make('image', 'image', 'Иконка'),
          Field::make('textarea', 'bottom_text', 'Нижний текст')->set_rows(2),
        ]),
      ]),
    ])
    ->add_tab('Почему мы', [
      Field::make('text', 'why_title', 'Заголовок секции'),
      Field::make('text', 'why_subtitle', 'Подзаголовок'),
      Field::make('image', 'why_bg_image', 'Фоновое изображение')->set_help_text(
        'Подложка под градиент панели.'
      ),
      Field::make('complex', 'why_cards', 'Карточки')->add_fields([
        Field::make('image', 'image', 'Иконка'),
        Field::make('text', 'title', 'Заголовок'),
        Field::make('textarea', 'desc', 'Описание')->set_rows(2),
      ]),
    ])
    ->add_tab('Как мы работаем', [
      Field::make('text', 'process_title', 'Заголовок секции'),
      Field::make('image', 'process_bg_image', 'Фоновое изображение')->set_help_text(
        'Фото на тёмном фоне секции. Без него остаётся только затемнение.'
      ),
      Field::make('text', 'process_btn_text', 'Текст кнопки'),
      Field::make('complex', 'process_steps_top', 'Верхний ряд (шаги)')->add_fields([
        Field::make('image', 'image', 'Иконка'),
        Field::make('textarea', 'text', 'Текст шага')->set_rows(2),
      ]),
      Field::make('complex', 'process_steps_bottom', 'Нижний ряд (шаги, по центру)')->add_fields([
        Field::make('image', 'image', 'Иконка'),
        Field::make('textarea', 'text', 'Текст шага')->set_rows(2),
      ]),
    ])
    ->add_tab('Ценности', [
      Field::make('text', 'values_title', 'Заголовок секции'),
      Field::make('image', 'values_bg_image', 'Фоновое изображение')->set_help_text(
        'Подложка под градиент панели.'
      ),
      Field::make('complex', 'values_cards', 'Карточки')->add_fields([
        Field::make('text', 'title', 'Заголовок'),
        Field::make('textarea', 'desc', 'Описание')->set_rows(2),
      ]),
    ])
    ->add_tab('FAQ', [
      Field::make('textarea', 'faq_title', 'Заголовок секции')->set_rows(2),
      Field::make('image', 'faq_image', 'Изображение в карточке'),
      Field::make('text', 'faq_btn_text', 'Текст кнопки')->set_help_text(
        'По умолчанию: «Задать свой вопрос».'
      ),
      Field::make('complex', 'faq_items', 'Вопросы и ответы')->add_fields([
        Field::make('text', 'question', 'Вопрос'),
        Field::make('textarea', 'answer', 'Ответ')->set_rows(4),
      ]),
    ])
    ->add_tab('Одобрим сделку', [
      Field::make('text', 'approval_title', 'Заголовок секции'),
      Field::make('image', 'approval_bg_image', 'Фоновое изображение')->set_help_text(
        'Подложка под градиент панели.'
      ),
      Field::make('complex', 'approval_features', 'Список с галочками')->add_fields([
        Field::make('textarea', 'text', 'Текст')->set_rows(2),
      ]),
      Field::make('complex', 'approval_bullets', 'Список с точками')->add_fields([
        Field::make('textarea', 'text', 'Текст')->set_rows(2),
      ]),
      Field::make('text', 'approval_form_title', 'Заголовок формы'),
      Field::make('text', 'approval_btn_text', 'Текст кнопки')->set_help_text(
        'По умолчанию: «Оставить заявку».'
      ),
    ]);

  // ----- Blocks -----

  Block::make('partials_services', 'Блок "Услуги"')
    ->add_fields([
      Field::make('separator', 'separator', 'Блок "Услуги"'),
      Field::make('textarea', 'services_title', 'Заголовок секции')->set_rows(2),
      Field::make('textarea', 'services_callback_title', 'Текст контактов')->set_rows(2),
      Field::make('complex', 'services_tabs', 'Вкладки услуг')->add_fields([
        Field::make('textarea', 'label', 'Ярлык вкладки')->set_rows(2),
        Field::make('textarea', 'subtitle', 'Заголовок вкладки')->set_rows(2),
        Field::make('image', 'image', 'Изображение'),
        Field::make('complex', 'items', 'Услуги')->add_fields([
          Field::make('text', 'name', 'Название'),
          Field::make('text', 'price', 'Цена'),
        ]),
      ]),
    ])
    ->set_category('layout')
    ->set_mode('edit')
    ->set_icon('shortcode')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
      get_template_part('partials/services', null, [
        'fields' => $fields,
        'attributes' => $attributes,
        'inner_blocks' => $inner_blocks,
      ]);
    });

  Block::make('partials_slidwshow', 'Блок "Слайдшоу"')
    ->add_fields([
      Field::make('separator', 'separator', 'Блок "Слайдшоу"'),
      Field::make('text', 'aspect_ratio', 'Соотношение сторон'),
      Field::make('media_gallery', 'gallery', 'Фотогалерея'),
    ])
    ->set_category('layout')
    ->set_mode('edit')
    ->set_icon('shortcode')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
      get_template_part('partials/slidwshow', null, [
        'fields' => $fields,
        'attributes' => $attributes,
        'inner_blocks' => $inner_blocks,
      ]);
    });
}
