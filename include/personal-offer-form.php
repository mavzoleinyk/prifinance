<?php
$link = get_field('privacy_link', 'option');
if ($link):
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self';
endif;
?>
<section class="application">
  <div class="container-xl">
    <div class="row align-items-center">
      <div class="col-lg-4">
        <img src="<?= IMAGES_URI ?>application-img.svg" class="d-none d-lg-block img-fluid" alt="">
      </div>
      <div class="col-lg-8">
        <div class="form-wrapper">
          <h2><?= __('Application', 'prifinance') ?></h2>
          <div class="d-flex">
            <div>
              <h3><?= __('Request a Personal Offer', 'prifinance') ?></h3>
              <p
                class="application-subtitle"><?= __('Send your request now and receive our personalized offer!', 'prifinance') ?></p>
            </div>
            <img src="<?= IMAGES_URI ?>application-img.svg" class="d-lg-none img-fluid align-self-end" alt="">
          </div>
          <form class="form personal-form" id="personal-form">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-4">
                  <div class="form-input">
                    <label for="email" class="form-label"><?= __('Email Address', 'prifinance') ?>*</label>
                    <input type="email" class="form-control" name="email" id="email"
                           placeholder="<?= __('Enter your email here', 'prifinance') ?>" required>
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-input">
                    <label for="tel" class="form-label"><?= __('Phone number', 'prifinance') ?></label>
                    <input type="tel" class="form-control" name="phone" required="true" id="tel"
                           placeholder="<?= __('Enter your phone number here', 'prifinance') ?>">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-4">
                  <label for="serviceType" class="form-label"><?= __('Service type', 'prifinance') ?>
                    <sup>*</sup></label>
                  <div class="form-input">
                    <select class="form-select" id="chain-serviceType"
                            aria-label="<?= __('Select the type Service', 'prifinance') ?>" required
                            name="type-service">
                      <option value=""><?= __('Select the type Service', 'prifinance') ?></option>
                    </select>
                  </div>
                </div>
                <div class="mb-4">
                  <label for="country" class="form-label"><?= __('Country', 'prifinance') ?><sup>*</sup></label>
                  <div class="form-input">
                    <select class="form-select" id="chain-country"
                            aria-label="<?= __('Country select', 'prifinance') ?>" required name="country">
                      <option value=""><?= __('Country select', 'prifinance') ?></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-4">
                <div class="form-private-policy">
                  <div class="form-input">
                    <p><input required="true" type="checkbox" name="private-policy" checked="checked"
                              name="private-check"> <?= sprintf(__(' I agree with the %s for the processing and storage of personal data.', 'prifinance'), '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '">' . esc_html($link_title) . '</a>'); ?>
                    </p>
                  </div>
                </div>
                <div class="result-ajax"></div>
              </div>
              <div class="col-12 d-flex justify-content-lg-end mt-4">

                <button class="btn btn-orange btn-arrow"><?= __('Send Request', 'prifinance') ?></button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
$proposition_countries = get_field('proposition_countries');
$serviceCountries = [];
if($proposition_countries){
    foreach ($proposition_countries as $item) {
        if (!empty($item['loop'])) {
            $serviceCountries[$item['title']] = array_map(function ($item) {
                return $item['title'];
            }, $item['loop']);
        }
    }
}

$serviceCountriesEncoded = json_encode($serviceCountries);
?>
<script>
    let chainCountryService = document.getElementById("personal-form");
    if (chainCountryService) {
        var serviceCountries = JSON.parse('<?= $serviceCountriesEncoded ?>');
        (function () {
            var chainCountry = document.getElementById("chain-country");
            var chainService = document.getElementById("chain-serviceType");
            for (var x in serviceCountries) {
                chainService.options[chainService.options.length] = new Option(x, x);
            }
            chainService.onchange = function () {
                //empty Chapters- and Topics- dropdowns
                chainCountry.length = 1;
                //display correct values
                serviceCountries[this.value].forEach((item) => (chainCountry.options[chainCountry.options.length] = new Option(item, item)));
            };
        })();
    }
</script>
