<section class="feedback">
  <form class="feedback-form"
    action="<?php echo admin_url('admin-ajax.php'); ?>"
    data-feedback-form
    data-feedback-form-goal="CALLBACK_CONTACTS"
    data-feedback-form-action="feedback_form">
    <input type="hidden" name="submitted" value="">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('feedback-nonce'); ?>">
    <input type="hidden" name="page" value="<?php echo esc_html(get_self_link()); ?>">
    <input type="hidden" name="subject" value="Обратная связь">

    <div class="feedback-form__info">
      <h2 class="feedback-form__title">ОБРАТНАЯ СВЯЗЬ</h2>
      <p class="feedback-form__desc">У вас есть вопросы или предложения?<br>
        Отправьте сообщение, мы с удовольствием выслушаем,<br>
        ответим и посоветуем</p>
    </div>

    <div class="feedback-form__fields">
      <div class="feedback-form__row">
        <div class="feedback-form__group">
          <input type="text" name="name" placeholder="Введите ваше имя">
        </div>
        <div class="feedback-form__group">
          <input type="email" name="email" placeholder="Введите ваш e-mail*" required>
        </div>
        <div class="feedback-form__group">
          <input type="tel" name="phone" placeholder="+7 (____) ___ - __ - __" data-maska="+ 7 (###) - ### - ## - ##" required>
        </div>
      </div>
      <div class="feedback-form__row">
        <div class="feedback-form__group">
          <textarea name="message" placeholder="Введите текст сообщения"></textarea>
        </div>
      </div>
      <div class="feedback-form__note">* - поля, обязательные для заполнения</div>
      <div class="feedback-form__errors" data-feedback-form-errors></div>
    </div>

    <div class="feedback-form__action">
      <button type="submit" class="feedback-form__submit">ОТПРАВИТЬ</button>
      <p class="feedback-form__privacy">
        Нажимая «Отправить», вы подтверждаете, что ознакомились с <a href="#">Политикой конфиденциальности</a> и даете согласие на <a href="#">Обработку персональных данных</a>
      </p>
    </div>

    <div class="feedback-form__success">
      <div class="feedback-form__success-title">Заявка отправлена</div>
      <div class="feedback-form__success-desc">Мы свяжемся с вами в ближайшее время</div>
      <button type="button" class="feedback-form__success-close" data-feedback-form-reset>Закрыть</button>
    </div>
  </form>
</section>
