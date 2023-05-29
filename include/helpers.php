<?php
function team_multilanguage() {
  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);
  foreach (apply_filters('wpml_active_languages', NULL) as $lang => $item) {
    if($item['code']==ICL_LANGUAGE_CODE){
        add_filter('acf/settings/current_language', function () use ($lang) {
            return $lang;
        });
        get_template_part('parts/team', null, ['prefix' => 'company_team']);
    }
  }

  add_filter('acf/settings/current_language', function () {
    return ICL_LANGUAGE_CODE;
  });
}

function get_initial_language() {
  return defined('ICL_LANGUAGE_CODE') && (!empty(ICL_LANGUAGE_CODE)) ? ICL_LANGUAGE_CODE : 'en';
}

//It is not clear what this logic is for.
function selectedCodeByUserCountry($countryCode) {
  $result = $countryCode;
  $countries = [];
  if ('en' == ICL_LANGUAGE_CODE) {
    $countries['EE'] = ['EE', 'FI', 'LT', 'LV'];
  } else if ('ru' == ICL_LANGUAGE_CODE) {
    $countries['EE'] = ['EE', 'FI', 'LT', 'BY', 'TJ', 'UZ', 'TM', 'MD', 'AZ', 'AM', 'KZ', 'GE'];
  }
  foreach ($countries as $code => $countrySet) {
    if (in_array($countryCode, $countrySet)) {
      $result = $code;
      break;
    }
  }
  return $result;
}

function renderPhoneMenu($is_mobile = false) {

  $activePhone = '';
  $activeIcon = '';
  $defaultPhoneCode = getOption('default_phone') ?: 'GB';
  $defaultPhone = '';
  $defaultIcon = '';
  $codeByUserCountry = COUNTRY_CODE;
  if (have_rows('top-nav-second_phones', 'option')): while (have_rows('top-nav-second_phones', 'option')) : the_row();
    $phone = get_sub_field('phone');
    $icon = get_sub_field('icon');
    $countryCode = countryCodeByPhone($phone);
    if (empty($activePhone)) {
      if ($codeByUserCountry == $countryCode) {
        $activePhone = $phone;
        $activeIcon = $icon;
      }
      if ($countryCode == $defaultPhoneCode) {
        $defaultPhone = $phone;
        $defaultIcon = $icon;
      }
    }
  endwhile;
  else : endif;
if ($is_mobile) { ?>
    <a id="phoneNumberByCountry" class="link-white has-arrow text-decoration-none link-child-menu link-child-menu--not-modify" data-value="<?= $activePhone ?: $defaultPhone ?>" href="tel:<?= str_replace(" ","",$activePhone) ?: str_replace(" ","",$defaultPhone) ?>"
       aria-expanded="false"><span class="list-icon"><img src="<?= IMAGES_URI ?>icon-24.svg" alt=""></span><img
        src="<?= $activeIcon ?: $defaultIcon ?>" alt=""><?= $activePhone ?: $defaultPhone ?></a>
  <?php } else { ?>
    <a id="phoneNumberByCountry" class="link-white has-arrow text-decoration-none" href="tel:<?= str_replace(" ","",$activePhone) ?: str_replace(" ","",$defaultPhone) ?>" data-value="<?= $activePhone ?: $defaultPhone ?>" aria-expanded="false"><img
        src="<?= $activeIcon ?: $defaultIcon ?>" alt=""><?= $activePhone ?: $defaultPhone ?></a>
  <?php } ?>
  <ul class="list-unstyled inner-list mm-collapse">
    <?php if (have_rows('top-nav-second_phones', 'option')): while (have_rows('top-nav-second_phones', 'option')) : the_row(); ?>
      <li><a href="tel:<?= preg_replace('/[^0-9\+]/', '', get_sub_field('phone')); ?>"><img
            src="<?php the_sub_field('icon'); ?>" alt=""><?php the_sub_field('phone'); ?></a></li>
    <?php endwhile; else : endif; ?>
  </ul>
<?php }

function getTranslatedUrlByCountry() {
  if (!defined("COUNTRY_CODE") || !defined("ICL_LANGUAGE_CODE")) return;
  $active_languages = apply_filters('wpml_active_languages', null);
  $result = false;
  $language_country_codes = [
    'ru' => [
      'RU', 'UA', 'BY', 'TJ', 'UZ', 'TM', 'MD', 'AZ', 'AM', 'KZ', 'GE'
    ]
  ];

  if (in_array(COUNTRY_CODE, $language_country_codes['ru'])) {
    $result = -1;
    if ('ru' !== ICL_LANGUAGE_CODE) {
      $result = $active_languages['ru']['url'];
    }
  }
  return $result;
}

function getTranslatedUrlByBrowserLanguage() {
  if (!defined("BROWSER_LANGUAGE_CODE") || !defined("ICL_LANGUAGE_CODE")) return;
  $active_languages = apply_filters('wpml_active_languages', null);
  $result = false;
  if ('ru' === BROWSER_LANGUAGE_CODE) {
    if ('ru' !== ICL_LANGUAGE_CODE) {
      $result = $active_languages[BROWSER_LANGUAGE_CODE]['url'];
    }
  } else if ('en' !== ICL_LANGUAGE_CODE) {
    $result = $active_languages['en']['url'];
  }
  return $result;
}

function countryCodeByPhone($phone) {
  $phone = str_replace([' ', '+'], '', $phone);
  $result = '';
  $codes = array(
    '7' => 'RU',
    '370' => 'LT',
    '371' => 'LV',
    '372' => 'EE',
    '44' => 'GB',
    '380' => 'UA',
    '971' => 'AE'
  );
  foreach ($codes as $phoneCode => $countryCode) {
    if (substr($phone, 0, strlen($phoneCode)) == $phoneCode) {
      $result = $countryCode;
      break;
    }
  }
  return $result;
}

function getRedirectUrl() {
  $redirectUrl = '';
  if (is_front_page()) {
    $redirectUrl = getTranslatedUrlByCountry();
    if (empty($redirectUrl)) $redirectUrl = getTranslatedUrlByBrowserLanguage();
  }
  return $redirectUrl;
}

// Press Center functions
if (!function_exists('getMediaUl')) {
  function getMediaUl($getMediaLiArray) {
    return '<div class="press-slider-wrapper"><ul class="press-slider press">' . implode($getMediaLiArray) . '</ul></div>';
  }
}
if (!function_exists('getMediaLi')) {
  function getMediaLi($item) {
    $image = is_numeric($item['image']) ? wp_get_attachment_url($item['image']) : $item['image'];
    ob_start();
    $type = $item['type'];
    ?>
    <li class="press-slider-item">
      <div class="news-box h-100">
        <a href="<?= $type === 'video' ? 'https://www.youtube.com/embed/' . str_replace("////","//",$item['link']) : str_replace("////","//",$item['link']); ?>"
           class="d-flex flex-column h-100"
           about="_blank" <?php if ($type === 'video') {
          echo "data-fancybox";
        } ?>>
          <div class="img-wrapper"
               style="background-image: url('<?= $type === 'video' ? '//img.youtube.com/vi/' . $item['link'] . '/mqdefault.jpg' : $image; ?>')"></div>
          <div class="news-info flex-grow-1">
            <div class="news-icon"><img class="img-fluid" src="<?= IMAGES_URI . $type ?>.svg" alt=""></div>
            <div class="news-type">
              <?= ($type === 'video') ? 'Видео' : 'Статья' ?>
            </div>
            <div class="news-text"><?= $item['text'] ?></div>
          </div>
        </a>
      </div>
    </li>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
  }
}

function get_media_items_query($limit = 11) {
  $page = get_requested_page();

  $args = [
    'post_type' => 'media',
    'post_status' => 'publish',
    'posts_per_page' => $limit,
    'paged' => $page,
  ];

  $result = new WP_Query($args);
  return $result;
}

function get_press_media_items($posts) {
  $result = [];
  while ($posts->have_posts()): $posts->the_post();
    $result[] = get_fields();
  endwhile;
  wp_reset_postdata();
  return $result;
}

// Pagination
function get_requested_page() {
  return isset($_REQUEST['_page']) && is_numeric($_REQUEST['_page']) ? $_REQUEST['_page'] : 1;
}

function get_sliced_items($items, $limit) {
  $page = get_requested_page();
  $start = ($page * $limit) - $limit;
  return array_slice($items, $start, $limit, true);
}

function get_last_page($items, $limit) {
  return ceil(count($items) / $limit);
}

// Pagination end
function get_table_prices() {
  $tarifs = get_field('tarif');
  $firstTarifKey = mb_strtolower(str_replace(' ', '_', $tarifs[0]));
  $table_price = empty(get_field('table_price')) ? [] : get_field('table_price');
  $prices = [];

  foreach ($table_price as $priceArr) {
    $serviceId = $priceArr['service_type']['value'];
    $prices[$serviceId] = empty($priceArr[$firstTarifKey]) ? __('по запросу', 'prifinance') : $priceArr[$firstTarifKey];
  }
  return $prices;
}

// Advanced Custom Fields plugin functions

// Add Theme Options
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Настройки темы',
    'menu_title' => 'Настройки темы',
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}
function get_post_type_names() {
  static $post_types, $labels = '';

  // Get all post type *names*, that are shown in the admin menu
  empty($post_types) and $post_types = get_post_types(
    array(
      'show_in_menu' => true,
      '_builtin' => false,
    ),
    'objects'
  );
  empty($labels) and $labels = wp_list_pluck($post_types, 'labels');
  $names = wp_list_pluck($labels, 'singular_name');
  return $names;
}

function get_term_current($taxonomy) {
  $result = '';
  $terms = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
  ]);

  $uri = $_SERVER['REQUEST_URI'];
  $uri = str_replace(['/en/', '/'], ['', ''], $uri);
  $uri = strtok($uri, "?");

  if ($terms) {
    foreach ($terms as $term) {
      if ($term->slug === $uri) {
        $result = $term;
      }
    }
  }
  return $result;
}
