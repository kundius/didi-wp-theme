<?php

add_action('wp_enqueue_scripts', 'ajax_data', 99);

function ajax_data()
{
  wp_localize_script('scripts', 'theme_ajax', [
    'url' => admin_url('admin-ajax.php'),
  ]);
}

/**
 * feedback_form
 */
add_action('wp_ajax_feedback_form', 'feedback_form_callback');
add_action('wp_ajax_nopriv_feedback_form', 'feedback_form_callback');
function feedback_form_callback()
{
  $errors = [];
  if (!wp_verify_nonce($_POST['nonce'], 'feedback-nonce')) {
    wp_die('Данные отправлены с неподдерживаемого адреса');
  }
  if (!empty($_POST['submitted'])) {
    $errors['submitted'] = 'Что?';
  }
  if (empty($_POST['phone'])) {
    $errors['phone'] = 'Укажите Ваш телефон.';
  }
  if ($errors) {
    wp_send_json_error($errors);
  } else {
    $email_to = get_option('admin_email');
    $rows = [];
    $rows[] = 'Имя: ' . sanitize_text_field($_POST['name']);
    $rows[] = 'E-mail: ' . sanitize_text_field($_POST['email']);
    $rows[] = 'Телефон: ' . sanitize_text_field($_POST['phone']);
    $rows[] = 'Сообщение: ' . sanitize_text_field($_POST['message']);
    $rows[] = 'Страница: ' . sanitize_text_field($_POST['page']);
    $body = implode("\n", $rows);
    $subject = $_POST['subject'];
    wp_mail($email_to, $subject, $body);
    wp_send_json_success();
  }
  wp_die();
}
