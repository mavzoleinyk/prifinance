<?php

if (defined('ICL_LANGUAGE_CODE')) {
  $lang = ICL_LANGUAGE_CODE;
}

?>

<div class="bankform">
  <div class="afterbankform">
    <p class="nameformbank"><?php _e('Send an application', 'prifinance'); ?></p>
    <p class="deskformbank"><?php _e('Send your request now and receive our personalized offer!', 'prifinance'); ?></p>
  </div>
  <form class="form" name="form">
    <div class="form-group">
      <div class="form-input">
        <input
          class="form-control phone"
          type="tel"
          placeholder="<?php _e('Phone number', 'prifinance'); ?>*"
          name="phone"
          required="true"
        >
      </div>
      <div class="form-input">
        <input
          type="email"
          class="form-control email email-icon"
          aria-describedby="emailHelp"
          placeholder="<?php _e('E-mail', 'prifinance'); ?>*"
          name="email"
          required="true"
        >
      </div>
      <div class="form-input">
            <textarea
              class="form-control message"
              placeholder="<?php _e('Your message', 'prifinance'); ?>*"
              rows="3"
              name="massage"
              required="true"
            ></textarea>
      </div>
    </div>

    <div class="form-private-policy">
      <div class="form-input">
        
        <?php if ($lang === 'ru'): ?> <p><input required="true" type="checkbox" name="private-policy" checked="checked"
                                                name="private-check"> Я согласен с <a href="/privacy-policy/"
                                                                                      target="_blank">правилами
            компании</a> по обработке и хранению персональных данных.</p> <?php endif; ?>
        
        <?php if ($lang === 'en'): ?> <p><input required="true" type="checkbox" name="private-policy" checked="checked"
                                                name="private-check">I agree with the <a href="/en/privacy-policy/"
                                                                                         target="_blank">terms &
            conditions</a> for the processing and storage of personal data.</p> <?php endif; ?>

      </div>
    </div>

    <button type="submit" class="btn btn-primary"><?php _e('SEND REQUEST', 'prifinance'); ?></button>
    <div class="result-ajax">
    </div>
  </form>

</div>
